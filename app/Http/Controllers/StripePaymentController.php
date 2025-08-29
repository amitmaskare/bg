<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\PaymentIntent;
use Stripe\PaymentMethod;
use Stripe\Exception\CardException;
use Stripe\Exception\ApiErrorException;
use Stripe\Customer;
use Stripe\SetupIntent;
use Illuminate\Support\Facades\Auth;
use App\Models\{User};

class StripePaymentController extends Controller
{
    public function index()
    {
        return view('payment');
    }


    public function payment(Request $request)
    {

        Stripe::setApiKey(config('services.stripe.secret'));

        try {
            // Create a PaymentIntent
            $paymentIntent = PaymentIntent::create([
                'amount' => 10 * 100, // $10.00 in cents
                'currency' => 'usd',
                'payment_method' => $request->payment_method,
                'confirm' => true,
                'automatic_payment_methods' => [
                    'enabled' => true,
                    'allow_redirects' => 'never',
                ],
                //// 'return_url' => route('payment.success'),
            ]);
            echo "<pre>";
            print_r($paymentIntent);
            exit;
            if ($paymentIntent->status === 'succeeded') {

                // return redirect()->route('payment.success');
            } else {
                //  return redirect()->route('payment.cancel');
            }
        } catch (\Exception $e) {
            return back()->withErrors('Error: ' . $e->getMessage());
        }
    }

    public function success()
    {
        return view('success');
    }

    public function cancel()
    {
        return view('cancel');
    }


    public function createStripeCustomer($user)
    {
        Stripe::setApiKey(config('services.stripe.secret'));

        $customer = Customer::create([
            'email' => $user->email,
            'name' => $user->name,
        ]);

        $user->stripe_id = $customer->id;
        $user->save();

        return $customer;
    }

    public function setupCard(Request $request)
    {
        Stripe::setApiKey(config('services.stripe.secret'));
        $user = Auth::user();

        if (!$user->stripe_id) {
            $this->createStripeCustomer($user);
        }

        $intent = SetupIntent::create([
            'customer' => $user->stripe_id,
        ]);

        return view('payment', [
            'clientSecret' => $intent->client_secret,
            'stripeKey' => config('services.stripe.key'),
        ]);
    }

       public function checkoutForm()
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));
        $customerId = auth()->user()->stripe_id ?? ''; // from DB

        $cards = [];
        if ($customerId) {
            $paymentMethods = PaymentMethod::all([
                'customer' => $customerId,
                'type'     => 'card',
            ]);

            foreach ($paymentMethods->data as $pm) {
                $cards[] = [
                    'id'    => $pm->id, 
                    'brand' => $pm->card->brand,
                    'last4' => $pm->card->last4,
                    'exp'   => $pm->card->exp_month . '/' . $pm->card->exp_year,
                ];
            }
        }

        return view('payment', compact('cards'));

    }

    // First time payment and save card
   public function payFirstTime(Request $request)
{
    // 1️⃣ Validate request
    $request->validate([
        'name'              => 'required|string|max:255',
        'email'             => 'required|email',
        'amount'            => 'required|numeric|min:1',
        'payment_method_id' => 'required|string',
    ]);

    Stripe::setApiKey(env('STRIPE_SECRET'));

    try {
        $user = Auth::user();
        
        if (!empty($user->stripe_id)) {
           
            $customerId = $user->stripe_id;
            $user->wallet = $user->wallet + $request->amount;
             $user->save();
        } else {
           
            $customer = Customer::create([
                'name'  => $request->name,
                'email' => $request->email,
            ]);
            $customerId = $customer->id;
            $user->stripe_id = $customerId;
            $user->wallet   = $user->wallet + $request->amount;
            $user->save();
        }
      
        // 2️⃣ Retrieve payment method user is trying to save
        $paymentMethod = PaymentMethod::retrieve($request->payment_method_id);

        // 3️⃣ Get all existing saved cards for this customer
        $existingMethods = PaymentMethod::all([
            'customer' => $customerId,
            'type'     => 'card',
        ]);

        foreach ($existingMethods->data as $pm) {
            if (
                $pm->card->last4 == $paymentMethod->card->last4 &&
                $pm->card->exp_month == $paymentMethod->card->exp_month &&
                $pm->card->exp_year == $paymentMethod->card->exp_year &&
                $pm->card->brand == $paymentMethod->card->brand
            ) {
                return response()->json([
                    'success' => false,
                    'error'   => 'This card is already saved.',
                ], 400);
            }
        }

        // 4️⃣ Attach new card if not duplicate
        $paymentMethod->attach(['customer' => $customerId]);

        // 5️⃣ Create payment intent
        $paymentIntent = PaymentIntent::create([
            'amount'     => intval($request->amount * 100), // cents
            'currency'   => 'usd',
            'customer'   => $customerId,
            'payment_method' => $request->payment_method_id,
            'confirm'    => true,
            'off_session' => false,
            'setup_future_usage' => 'off_session', // save card for later
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

    public function payWithSavedCard(Request $request)
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
