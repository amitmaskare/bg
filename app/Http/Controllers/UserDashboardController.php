<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\{ListingProduct,Category,Bid,Product,User,Order,CartItem,Address,Order_billing,Wallet};
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use DB;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Message;
use App\Models\Employee;
use Stripe\Stripe;
use Stripe\PaymentIntent;
use Stripe\PaymentMethod;
use Stripe\Customer;
use Stripe\SetupIntent;
class UserDashboardController extends Controller
{

    function dashboard()
     {
        $data['title']="Dashboard";
        $userId=Auth::user()->id ?? 0;
        $data['bid']=Bid::where('bidderId',$userId)->get();
        $data['user'] = DB::table('users')->where('id', $userId)->first();
         return view('userDashboards.dashboard',compact('data'));
     }

     function purchaseOrder()
            {
               $data['title']="Dashboard";
               $userId=Auth::user()->id ?? 0;
                $data['order']=Order::where('buyerId',$userId)->orderBy('id','DESC')->get();
                return view('userDashboard.purchaseOrder',compact('data'));
            }

            function myOrderInfo()
            {
               $data['title']="Dashboard";
               $userId=Auth::user()->id ?? 0;
            $orderdetail=Order_billing::leftjoin('listing_products as lp','lp.id','=','order_billings.listingId')->where('lp.sellerId',$userId)->select('order_billings.*','lp.sellerId','lp.product_name')->get();
               $orderIds = $orderdetail->pluck('orderId')->unique()->filter()->values();
                $data['order']=Order::whereIn('id',$orderIds)->get();
               // dd($data['order']);
             return view('userDashboard.myOrderInformation',compact('data'));
            }
        function mywishList()
            {
                $data['title']="Dashboard";
                $userId=Auth::user()->id ?? 0;
                $data['user'] = DB::table('users')->where('id', $userId)->first();

                $data['WishListData'] = DB::table('wishlist')
                                ->where('user_id', $userId)
                                ->get();
                
                return view('userDashboard.mywishList',compact('data'));
            }
             function mywalletList()
            {
                $data['title']="Dashboard";
                $userId=Auth::user()->id ?? 0;
                $data['user'] = User::where('id',$userId)->first(['wallet','id']);   
                $data['wallet']=Wallet::where('userId',$userId)->get(); 
                Stripe::setApiKey(env('STRIPE_SECRET'));
        $customerId = auth()->user()->stripe_id ?? ''; // from DB

       $cards = [];
if ($customerId) {
    $paymentMethods = PaymentMethod::all([
        'customer' => $customerId,
        'type'     => 'card',
    ]);

    $uniqueCards = []; // To track duplicates

    foreach ($paymentMethods->data as $pm) {
        $key = $pm->card->brand . '-' . $pm->card->last4 . '-' . $pm->card->exp_month . $pm->card->exp_year;

        if (!isset($uniqueCards[$key])) {
            $cards[] = [
                'id'    => $pm->id, 
                'brand' => $pm->card->brand,
                'last4' => $pm->card->last4,
                'exp'   => $pm->card->exp_month . '/' . $pm->card->exp_year,
            ];
            $uniqueCards[$key] = true;
        }
    }
}
        $data['cards'] = $cards;


                return view('userDashboard.mywalletList',compact('data'));
            }


             function mytransactionList()
            {
                $data['title']="Trasantion List";
                $userId=Auth::user()->id ?? 0;
                $data['order']=Order::where('buyerId',$userId)->orderBy('id','DESC')->get();
                return view('userDashboard.mytransactionList',compact('data'));
            }

            function checkout(){

                $userId=Auth::user()->id ?? 0;
                $data['user'] = DB::table('users')->where('id', $userId)->first();
                $data['bid']=Bid::where('bidderId',$userId)->get();
                $data['addresses'] = Address::where('user_id', $userId)->get();
                $data['cart']=CartItem::where('user_id', $userId)->with('product:id,product_name,main_image,price,discount,gst')->get();
                Stripe::setApiKey(env('STRIPE_SECRET'));
        $customerId = auth()->user()->stripe_id ?? ''; // from DB

        $cards = [];
if ($customerId) {
    $paymentMethods = PaymentMethod::all([
        'customer' => $customerId,
        'type'     => 'card',
    ]);

    $uniqueCards = []; // To track duplicates

    foreach ($paymentMethods->data as $pm) {
        $key = $pm->card->brand . '-' . $pm->card->last4 . '-' . $pm->card->exp_month . $pm->card->exp_year;

        if (!isset($uniqueCards[$key])) {
            $cards[] = [
                'id'    => $pm->id, 
                'brand' => $pm->card->brand,
                'last4' => $pm->card->last4,
                'exp'   => $pm->card->exp_month . '/' . $pm->card->exp_year,
            ];
            $uniqueCards[$key] = true;
        }
    }
}
        $data['cards'] = $cards;
                return view('userDashboard.checkout',compact('data'));
            }

             function order_view($id)
            {
                $data['title']="Order View";
                $userId=Auth::user()->id ?? 0;
                $data['order'] = Order::where('id', $id)->first();
                return view('userDashboard.order_view',compact('data'));
            }

            public function wishListadd(Request $request)
                {
                    if (!auth()->check()) {
                            return response()->json(['success' => false, 'message' => 'Please log in first.']);
                        }

                        $userId = auth()->id();
                        $productId = $request->input('product_id');

                        // Prevent duplicates
                        $exists = DB::table('wishlist')
                                    ->where('user_id', $userId)
                                    ->where('product_id', $productId)
                                    ->exists();

                        if ($exists) {
                            return response()->json(['success' => false, 'message' => 'Already in wishlist.']);
                        }

                        // Insert wishlist item
                        DB::table('wishlist')->insert([
                            'user_id' => $userId,
                            'product_id' => $productId,
                            'added_at' => now()
                        ]);

                        return response()->json(['success' => true]);
            }
    public function expireBid($bidId, Request $request)
{
    $bid = Bid::find($bidId);

    if ($bid && $bid->status === 'countered') {
        $bid->status = 'countered_rejected';
        $bid->save();

        return response()->json(['success' => true]);
    }

    return response()->json(['success' => false], 404);
}



public function order_view_pdf($id)
{
    $userId = Auth::user()->id ?? 0;

    // Fetch the order
    $order = Order::with(['user','shippingAddress'])->where('buyerId', $userId)->first();

    // Fetch related products (adjust according to your DB structure)
    $products = DB::table('order_billings')
        ->leftJoin('listing_products', 'order_billings.listingId', '=', 'listing_products.id')
        ->where('order_billings.orderId', $order->id)
        ->select(
            'listing_products.product_name as product_name',
            'order_billings.quantity as quantity',
            'order_billings.price as price',
            'order_billings.shipping_charge'
        )
        ->get();

    // Pass data to PDF view
    $pdf = Pdf::loadView('userDashboard.ordderpdf', [
        'order' => $order,
        'products' => $products,
        'title' => 'Order View'
    ]);

    return $pdf->download('order_' . $order->orderId . '.pdf');
}
public function store(Request $request)
{
    $userId = Auth::user()->id ?? 0;

    $request->validate([
        'rating' => 'required|integer|min:1|max:5',
        'content' => 'required|string|max:1000',
        'product_id' => 'required|exists:listing_products,id',
    ]);

    // 🔒 Check if review already exists
    $alreadyReviewed = DB::table('reviews')
        ->where('user_id', $userId)
        ->where('product_id', $request->product_id)
        ->exists();

    if ($alreadyReviewed) {
        return response()->json([
            'success' => false,
            'message' => 'You have already submitted a review for this product.'
        ]);
    }

    // ✅ Insert review
    DB::table('reviews')->insert([
        'user_id'    => $userId,
        'product_id' => $request->product_id,
        'rating'     => $request->rating,
        'content'    => $request->content,
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    return response()->json([
        'success' => true,
        'message' => 'Review submitted successfully.'
    ]);
}

public function messageList()
{
    $userId = Auth::id();

    // Get unique product_ids where this user has messages
    $productIds = Message::where('user_id', $userId)
        ->where('status', 1)
        ->pluck('product_id')
        ->unique();

    // Get the latest message per product
    $latestMessages = Message::with(['sender', 'product'])
        ->where('user_id', $userId)
        ->where('status', 1)
        ->whereIn('product_id', $productIds)
        ->orderBy('created_at', 'desc')
        ->get()
        ->unique('product_id'); // Only one per product

    return view('userDashboard.messages', [
        'messages' => $latestMessages,
        'title' => 'Product Messages',
    ]);
}
public function messageThread($productId)
{
     $userId = Auth::id(); // Or Session::get('id') if you're not using Auth
    $role = 'user'; // Since this is user side

    // Get the product
    $product = \App\Models\ListingProduct::findOrFail($productId);

    // Get the seller ID for this product
    $sellerId = \App\Models\ListingProduct::where('id', $productId)->value('sellerId');

    // Fetch only approved messages for this product between this user and the seller
    $messages = \App\Models\Message::with(['sender'])
        ->where('product_id', $productId)
        ->where(function ($q) use ($userId, $sellerId) {
            $q->where('user_id', $userId)
              ->orWhere('seller_id', $sellerId);
        })
        ->where('status', 1) // Only approved messages
        ->orderBy('created_at')
        ->get();

   return view('userDashboard.message_thread', compact('messages', 'product'));
}


public function sendMessage(Request $request)
{
    $request->validate([
        'product_id' => 'required|exists:listing_products,id',
        'message' => 'required|string|max:1000',
    ]);

    $product = ListingProduct::find($request->product_id);

    $newMessage = new Message();
    $newMessage->user_id = Auth::id();
    $newMessage->seller_id = $product->sellerId;
    $newMessage->product_id = $product->id;
    $newMessage->message = $request->message;
    $newMessage->sender_type = 'user';
    $newMessage->status = 0; // Pending approval
    $newMessage->save();

 return redirect()->route('user.messages.thread', $product->id)
    ->with('success', 'Your message has been sent for approval.');
}
}