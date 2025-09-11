<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\{ListingProduct, Product, User, Order, CartItem, Address, Order_billing, Wallet,EmailTemplate};
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Stripe\Stripe;
use Stripe\PaymentIntent;
use Stripe\PaymentMethod;
use Stripe\Customer;
use Stripe\SetupIntent;
class OrderInfoController extends Controller
{

    public function orders(Request $request)
{
    $user = Auth::user();
    $userId = $user->id ?? 0;
    Stripe::setApiKey(config('services.stripe.secret'));
    try {
        if ($request->payment_method == 'wallet' && $request->total_amount > $user->wallet) {
            return redirect()->back()->with('error', 'Insufficient amount in wallet.');
        }
        if ($request->payment_method != 'wallet') {
            if (!empty($user->stripe_id)) {
                $customerId = $user->stripe_id;
            } else {
                $customer = Customer::create([
                    'name'  => $request->name,
                    'email' => $request->email,
                ]);
                $customerId = $customer->id;
                $user->stripe_id = $customerId;
                $user->save();
            }
            $paymentMethod = PaymentMethod::retrieve($request->payment_method_id);
            $paymentMethod->attach(['customer' => $customerId]);
            $paymentIntent = PaymentIntent::create([
                'amount'   => intval($request->total_amount * 100),
                'currency' => 'usd',
                'customer' => $customerId,
                'payment_method' => $request->payment_method_id,
                'confirm'  => true,
                'off_session' => false, // User is present
                'automatic_payment_methods' => [
                    'enabled' => true,
                    'allow_redirects' => 'never',
                ],
            ]);

            if ($paymentIntent->status !== 'succeeded') {
                return redirect()->back()->with('error', 'Payment failed, please try again.');
            }
        }

        $order = new Order();
        $order->orderId = 'UUID-' . rand(1111, 99999);
        $order->buyerId = $userId;
        $order->order_type = 'buy_now';
        $order->status = 'pending';
        $order->shipping_address_id = $request->shipping_address_id ?? '0';
        $order->billing_address_id = $request->billing_address_id ?? '0';
        $order->subtotal = $request->subtotal;
        $order->total_amount = $request->total_amount;
        $order->taxes = $request->tax;
        $order->currency = 'Rs';
        $order->order_date = date('Y-m-d');
        $order->transaction_id = strtoupper(Str::random(10));
        $order->payment_method = $request->payment_method;
        $order->save();

        $orderId = $order->id;

        $cartItems = CartItem::where('user_id', $userId)->with('product:id,price')->get();
        foreach ($cartItems as $item) {
            $orderBilling = new Order_billing();
            $orderBilling->orderId = $orderId;
            $orderBilling->listingId = $item->listing_id;
            $orderBilling->price = $item->product?->price ?? 0;
            $orderBilling->quantity = $item->quantity;
            $orderBilling->shipping_charge = $item->shipping_charge;
            $orderBilling->created_at = now();
            $orderBilling->save();
            $orderQuantity = Order_billing::where('listingId', $item->listing_id)->sum('quantity');
            $bidQuantity   = DB::table('bids')->where('listingId', $item->listing_id)->where('status', 'pending')->sum('quantity');
            $listing       = DB::table('listing_products')->where('id', $item->listing_id)->first();

            if ($listing) {
                $finalLeftQuantity = $listing->quantity - $orderQuantity;
                if ($bidQuantity > $finalLeftQuantity) {
                    DB::table('bids')->where('listingId', $item->listing_id)->where('status', 'pending')->update(['status' => 'rejected']);
                }
            }
            // $order = Order::with('billings.listing')->find($orderId);

            // $template = EmailTemplate::where('type', 'bid_counter')->first();
            // $trigger = Trigger::find($template->template_id);
            // $tags = json_decode($trigger->fields, true);

            // $allowed_tags = [];
            // foreach ($tags as $item) {
            //     $allowed_tags[] = '{' . $item['tags'] . '}';
            // }

            // $template->body = preg_replace_callback('/\{[^\}]+\}/', function ($matches) use ($allowed_tags) {
            //     return in_array($matches[0], $allowed_tags) ? $matches[0] : '';
            // }, $template->body);


            // $firstItem = $order->billings->first();
            // $product = $firstItem?->listing;
            // $productTitle = $product?->title ?? 'Product';
            // $productPrice = $firstItem?->price ?? $order->total_amount;
            // $productQty   = $firstItem?->quantity ?? 1;

            // $tag_values = [
            //     '{name}'           => $user->name,
            //     '{product}'        => $productTitle,
            //     '{price}'          => $productPrice,
            //     '{quantity}'       => $productQty,
            //     '{payment_status}' => ucfirst($order->status),
            //     '{date_time}'      => date('Y-m-d H:i'),
            // ];

            // $subject = str_replace(array_keys($tag_values), array_values($tag_values), $template->subject);
            // $body = str_replace(array_keys($tag_values), array_values($tag_values), $template->body);

            // // Email Send
            // Mail::send('emails.template', ['subject' => $subject, 'body' => $body], function ($message) use ($subject, $user) {
            //     $message->to($user->email)
            //             ->subject($subject)
            //             ->from('info@brgn.in', 'BRGN');
            // });
        }

        CartItem::where('user_id', $userId)->delete();
        if ($request->payment_method == 'wallet') {
            $lastWallet = Wallet::orderBy('id', 'desc')->first();
            $lastId = $lastWallet ? intval(substr($lastWallet->wallet_id, -4)) : 0;
            $wallet_id = str_pad($lastId + 1, 4, '0', STR_PAD_LEFT);

            $wallet = new Wallet();
            $wallet->userId = $userId;
            $wallet->wallet_id = 'Bargain-' . $wallet_id;
            $wallet->amount = $request->total_amount;
            $wallet->remark = "Wallet amount successfully debited for Order #{$order->orderId}";
            $wallet->status = 'Purchase';
            $wallet->save();

            $user->wallet -= $request->total_amount;
            $user->save();
        }

        return redirect()->route('successorder', ['orderId' => $orderId]);

    } catch (\Exception $e) {
        return redirect()->back()->with('error', $e->getMessage());
    }
}


    function success($orderId)
    {
        $data['title'] = 'Success Order';
        $userId = Auth::user()->id ?? 0;
        $data['order'] = Order::where('buyerId', $userId)->where('id', $orderId)->firstOrFail();
        return view('userDashboard.order_success', compact('data'));
    }

    public function generatePDF($id)
    {
        $order = Order::with('items')->findOrFail($id);
        $pdf = Pdf::loadView('userDashboard.orderpdf', compact('order'));
        return $pdf->download('order_' . $order->id . '.pdf');
    }

    function saveCard(Request $request)
{
    Stripe::setApiKey(env('STRIPE_SECRET'));

    try {
      
        $user = Auth::user();
        
        if (!empty($user->stripe_id)) {
           
            $customerId = $user->stripe_id;
           
        } else {
           
            $customer = Customer::create([
                'name'  => $request->name,
                'email' => $request->email,
            ]);
            $customerId = $customer->id;
            $user->stripe_id=$customerId;
            $user->save();
        }

            $paymentMethod = PaymentMethod::retrieve($request->payment_method_id);
            $paymentMethod->attach(['customer' => $customerId]);

        $paymentIntent = PaymentIntent::create([
            'amount'                 => intval($request->amount * 100), // cents
            'currency'               => 'usd',
             'customer' => $customerId,
            'payment_method'         => $request->payment_method_id,
            'confirm'                => true,
            'off_session'            => false,
            'setup_future_usage'     => 'off_session', // save card for later
            'automatic_payment_methods' => [
                'enabled'         => true,
                'allow_redirects' => 'never', // only card payments
            ],
        ]);

        return response()->json([
                'success'           => true,
                'customer_id'       => $customerId,
                'payment_method_id' => $request->payment_method_id,
                'payment_intent'    => $paymentIntent,
            ]);

    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'error'   => $e->getMessage(),
        ], 500);
    } 
}
}
