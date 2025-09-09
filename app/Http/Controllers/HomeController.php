<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Trigger,ListingProduct,Category,Bid,Order,Wallet,Order_billing,Brand,Message,EmailTemplate,User};
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use App\Models\Address;
use DB;
class HomeController extends Controller
{
     function index()
     {
        $data['category']=Category::where('status','Active')->orderBy('categoryId','DESC')->limit(8)->get();
        //$data['listingDesc']=ListingProduct::where('type','purchase')->orderBy('id','DESC')->get(['id','main_image','productId','price','sellerId','product_name','offer','mrp','discount']);
        $data['listingDesc'] = ListingProduct::where('type', 'purchase')
    ->leftJoin('reviews', 'listing_products.id', '=', 'reviews.product_id')
    ->select(
        'listing_products.id',
        'listing_products.main_image',
        'listing_products.productId',
        'listing_products.price',
        'listing_products.sellerId',
        'listing_products.product_name',
        'listing_products.offer',
        'listing_products.mrp',
        'listing_products.discount',
        DB::raw('AVG(reviews.rating) as avg_rating'),
        DB::raw('COUNT(reviews.id) as total_reviews')
    )
    ->groupBy(
        'listing_products.id',
        'listing_products.main_image',
        'listing_products.productId',
        'listing_products.price',
        'listing_products.sellerId',
        'listing_products.product_name',
        'listing_products.offer',
        'listing_products.mrp',
        'listing_products.discount'
    )
    ->orderBy('listing_products.id', 'DESC')
    ->get();
       $data['buy_now'] = ListingProduct::where('type', 'purchase')
            ->leftJoin('reviews', 'listing_products.id', '=', 'reviews.product_id')
            ->select(
                'listing_products.id',
                'listing_products.main_image',
                'listing_products.productId',
                'listing_products.price',
                'listing_products.sellerId',
                'listing_products.product_name',
                'listing_products.offer',
                'listing_products.mrp',
                'listing_products.discount',
                DB::raw('AVG(reviews.rating) as avg_rating'),
                DB::raw('COUNT(reviews.id) as total_reviews')
            )
            ->groupBy(
                'listing_products.id',
                'listing_products.main_image',
                'listing_products.productId',
                'listing_products.price',
                'listing_products.sellerId',
                'listing_products.product_name',
                'listing_products.offer',
                'listing_products.mrp',
                'listing_products.discount'
            )
            ->orderBy('listing_products.id', 'ASC')
            ->limit(5)
            ->get();
        
        
        
        $data['lowestPrice'] = ListingProduct::where('type', 'purchase')
            ->leftJoin('reviews', 'listing_products.id', '=', 'reviews.product_id')
            ->select(
                'listing_products.id',
                'listing_products.main_image',
                'listing_products.price',
                'listing_products.sellerId',
                'listing_products.product_name',
                'listing_products.offer',
                'listing_products.mrp',
                'listing_products.discount',
                DB::raw('AVG(reviews.rating) as avg_rating'),
                DB::raw('COUNT(reviews.id) as total_reviews')
            )
            ->groupBy(
                'listing_products.id',
                'listing_products.main_image',
                'listing_products.price',
                'listing_products.sellerId',
                'listing_products.product_name',
                'listing_products.offer',
                'listing_products.mrp',
                'listing_products.discount'
            )
            ->orderBy('listing_products.price', 'ASC')
            ->limit(5)
            ->get();
        $data['featuredProduct'] = ListingProduct::where('feature_product', 1)
            ->leftJoin('reviews', 'listing_products.id', '=', 'reviews.product_id')
            ->select(
                'listing_products.id',
                'listing_products.main_image',
                'listing_products.productId',
                'listing_products.price',
                'listing_products.sellerId',
                'listing_products.product_name',
                'listing_products.offer',
                'listing_products.mrp',
                'listing_products.discount',
                DB::raw('AVG(reviews.rating) as avg_rating'),
                DB::raw('COUNT(reviews.id) as total_reviews')
            )
            ->groupBy(
                'listing_products.id',
                'listing_products.main_image',
                'listing_products.productId',
                'listing_products.price',
                'listing_products.sellerId',
                'listing_products.product_name',
                'listing_products.offer',
                'listing_products.mrp',
                'listing_products.discount'
            )
            ->orderBy('listing_products.id', 'DESC')
            ->limit(8)
            ->get();
        $topSearchedNames = DB::table('search_product')
                ->select('product_name', DB::raw('COUNT(*) as count'))
                ->groupBy('product_name')
                ->orderByDesc('count')
                ->limit(5)
                ->pluck('product_name')
                ->toArray();

// Step 2: Fetch matching products using LIKE
   $data['mostSearch'] = ListingProduct::leftJoin('reviews', 'listing_products.id', '=', 'reviews.product_id')
    ->where(function($query) use ($topSearchedNames) {
        foreach ($topSearchedNames as $name) {
            $query->orWhere('listing_products.product_name', 'LIKE', "%{$name}%");
        }
    })
    ->select(
        'listing_products.id',
        'listing_products.main_image',
        'listing_products.productId',
        'listing_products.price',
        'listing_products.sellerId',
        'listing_products.product_name',
        'listing_products.offer',
        'listing_products.mrp',
        'listing_products.discount',
        DB::raw('AVG(reviews.rating) as avg_rating'),
        DB::raw('COUNT(reviews.id) as total_reviews')
    )
    ->groupBy(
        'listing_products.id',
        'listing_products.main_image',
        'listing_products.productId',
        'listing_products.price',
        'listing_products.sellerId',
        'listing_products.product_name',
        'listing_products.offer',
        'listing_products.mrp',
        'listing_products.discount'
    )
    ->limit(5)
    ->get();
       $data['highestPrice']=ListingProduct::orderBy('price','DESC')->limit(5)->get(['id','main_image','price','sellerId','product_name','offer','mrp','discount']);
        return view('frontend.home',compact('data'));
     }

    //  public function shop()
    //  {
    //       $data['listing']=ListingProduct::where('status','pending')->orderBy('id','DESC')->limit(12)->get(['id','main_image','productId','price','sellerId','product_name']);
    //       $data['category']=Category::where('status','Active')->orderBy('categoryId','DESC')->get();
    //       $data['brand']=Brand::where('status','Active')->orderBy('brandId','DESC')->get();
    //       return view('frontend.shop',compact('data'));
    //  }

    public  function shopdetail($id)
     {
        $userId = Auth::user()->id ?? 0;
      $data['listingDetail']=ListingProduct::where('id',$id)->first();
      $data['listingAsc'] = ListingProduct::orderBy('id', 'ASC')->limit(5)->get(['id', 'main_image', 'productId', 'price']);
     $data['relatedProducts'] = ListingProduct::where('listing_products.id', '!=', $id)
    ->where('listing_products.price', '!=', $data['listingDetail']->price)
    ->leftJoin('reviews', 'listing_products.id', '=', 'reviews.product_id')
    ->select(
        'listing_products.id',
        'listing_products.main_image',
        'listing_products.productId',
        'listing_products.price',
        'listing_products.product_name',
        DB::raw('AVG(reviews.rating) as avg_rating'),
        DB::raw('COUNT(reviews.id) as total_reviews')
    )
    ->groupBy(
        'listing_products.id',
        'listing_products.main_image',
        'listing_products.productId',
        'listing_products.price',
        'listing_products.product_name'
    )
    ->orderBy('listing_products.id', 'DESC')
    ->limit(10)
    ->get();
     $data['bids'] = Bid::where('bidderId', $userId)->orderBy('bidId','desc')->get();
      

      $latestBid = $data['bids']->sortBy('created_at')->last();
      if($latestBid ){
        $amount = $latestBid->amount;
        $finalAmount = $amount + ($amount * 0.01);
        $data['latestAmount'] = $finalAmount ? $finalAmount : '';
      }

       $data['reviews'] = DB::table('reviews')
        ->join('users', 'users.id', '=', 'reviews.user_id')
        ->where('reviews.product_id', $id)  // <-- This is important
        ->orderBy('reviews.created_at', 'desc')
        ->get([
            'reviews.rating',
            'reviews.content',
            'reviews.created_at',
            'users.name as reviewer_name'
        ]);

         $ratings = DB::table('reviews')
        ->selectRaw('rating, COUNT(*) as count')
        ->where('product_id', $id)
        ->groupBy('rating')
        ->pluck('count', 'rating');

    $totalRatings = $ratings->sum();
    $avgRating = DB::table('reviews')->where('product_id', $id)->avg('rating');

    // Prepare percentages for progress bars
    $data['ratingStats'] = [
        'average' => round($avgRating, 2),
        'total' => $totalRatings,
        'breakdown' => [
            5 => ['count' => $ratings[5] ?? 0, 'percent' => $totalRatings ? round(($ratings[5] ?? 0) / $totalRatings * 100) : 0],
            4 => ['count' => $ratings[4] ?? 0, 'percent' => $totalRatings ? round(($ratings[4] ?? 0) / $totalRatings * 100) : 0],
            3 => ['count' => $ratings[3] ?? 0, 'percent' => $totalRatings ? round(($ratings[3] ?? 0) / $totalRatings * 100) : 0],
            2 => ['count' => $ratings[2] ?? 0, 'percent' => $totalRatings ? round(($ratings[2] ?? 0) / $totalRatings * 100) : 0],
            1 => ['count' => $ratings[1] ?? 0, 'percent' => $totalRatings ? round(($ratings[1] ?? 0) / $totalRatings * 100) : 0],
        ],
    ];

      return view('frontend.shopdetail',compact('data'));
     }
     public function store(Request $request)
     {
        
         $request->validate([
            'bid_amount' => 'required|numeric|min:1.05',
             'listiD' => 'required|numeric',
             'quantity' => 'required|integer|min:1',
        ]); 

        if($request->bid_amount > Auth::user()->wallet)
        {
             return response()->json(['success' => 'Insufficient','Insufficient amount in wallet.']);
                exit;
        }
        $lopId = Auth::user()->id ;

        $latestBid = Bid::where('bidderId', $lopId)
        ->where('listingId', $request->listiD)
        ->latest('created_at') 
        ->first();

        $product = ListingProduct::find($request->listiD);

        if(!empty($latestBid )){
            $status = $latestBid->status;
            $stockquantity = $product->quantity;
            $bidquantity = $latestBid->quantity;

            $oprderBilling = DB::table('order_billings')->where('listingId', $request->listiD)->get();
            $orderQuantity = $oprderBilling->sum('quantity');

            //$latestavailableQuantity = $stockquantity-$bidquantity; old Logic 

            $latestavailableQuantity = $stockquantity-$orderQuantity; 

            $lastAmount = $latestBid->amount;
            $finalAmount = $lastAmount + ($lastAmount * 0.01);
            if($status=='pending'){
                return response()->json(['success' => 'failed','Your First biding is pending You can not do again bidding for this product']);
                exit;
            }
                if($request->quantity > $latestavailableQuantity){

                    return response()->json(['success' => 'quantityExceed','avail_quantity'=>$latestavailableQuantity]);
                    exit;
                }
            if($product->type =='sale' && $request->bid_amount < $finalAmount){
                return response()->json(['success' => 'lessAmount','validAmount'=>$finalAmount]);
                exit;
            }
        }

         $bid = [
             'amount' => $request->bid_amount,
             'listingId' =>$request->listiD,
             'bidderId'=>$lopId,
             'quantity' => $request->quantity,
             'time' => now()->format('Y-m-d H:i:s'),
             'status' => 'Pending',
         ];
     
         // Optionally: Save to DB
          Bid::create($bid);
          $template = EmailTemplate::where('type', 'bidding')->first();
    
         $trigger=Trigger::find($template->template_id);
    $tags=json_decode($trigger->fields,true);
    $allowed_tags = [];
    foreach ($tags as $item) {
        $allowed_tags[] = '{' . $item['tags'] . '}';
    }
        $template->body = preg_replace_callback('/\{[^\}]+\}/', function ($matches) use ($allowed_tags) {
            return in_array($matches[0], $allowed_tags) ? $matches[0] : '';
        }, $template->body);
        $tag_values = [
        '{name}'       => Auth::user()->name,
        '{product}'    => $product->title ?? 'Product',
        '{price}'      => $product->price ?? 'N/A',
        '{bid_amount}' => $bid->amount,
        '{quantity}'   => $bid->quantity,
        '{date_time}'   => date('Y-m-d H:i')
    ];

        $subject = str_replace(array_keys($tag_values), array_values($tag_values), $template->subject);
        $body = str_replace(array_keys($tag_values), array_values($tag_values), $template->body);

        Mail::send('emails.template', ['subject' => $subject, 'body' => $body], function ($message) use ($subject) {
            $message->to('abc@gmail.com')
                    ->subject($subject)
                    ->from('info@brgn.in', 'BURGAIN');
        });

     
         return response()->json(['success' =>'success', 'bid' => $bid]);
     }

     public function checkQuantity($id)
     {
         $product = ListingProduct::find($id);
        
         if (!$product) {
             return response()->json(['available_quantity' => 0]);
         }
       
            $stockquantity=$product->quantity;
            $oprderBilling = DB::table('order_billings')->where('listingId', $id)->get();
            $orderQuantity = $oprderBilling->sum('quantity');
            $latestavailableQuantity = $stockquantity-$orderQuantity;
            return response()->json(['available_quantity' => $latestavailableQuantity]);
        
     }

     function dashboard()
     {
        $data['title']="Dashboard";
        $userId=Auth::user()->id ?? 0;
        $data['bid']=Bid::where('bidderId',$userId)->get();
        $data['user'] = DB::table('users')->where('id', $userId)->first();
        $data['addresses'] = Address::where('user_id', $userId)->get();
       
         return view('userDashboard.dashboard',compact('data'));
     }

     public function updateStatus(Request $request, $id)
     {
        // print_r($request); exit;
         $bid = Bid::findOrFail($id); 
         $bid->status = $request->status; 
         $bid->save(); 
          if($request->status=='approved')
        {
            $order=new Order();
           $order->orderId='UUID-'.rand(11111,99999);
           $order->bidId=$bidId;
           $order->sellerId=$bid->bidderId;
           $order->buyerId=$bid->bidderId;
           $order->order_type='bid';
           $order->status='pending'; 
           $order->order_date=date('Y-m-d');
           $order->created_at=date('Y-m-d H:i:s');
           $order->save();
        }

        $template = EmailTemplate::where('type', 'bid_accept')->first();
    
        $trigger=Trigger::find($template->template_id);
    $tags=json_decode($trigger->fields,true);
    $allowed_tags = [];
    foreach ($tags as $item) {
        $allowed_tags[] = '{' . $item['tags'] . '}';
    }
        $template->body = preg_replace_callback('/\{[^\}]+\}/', function ($matches) use ($allowed_tags) {
            return in_array($matches[0], $allowed_tags) ? $matches[0] : '';
        }, $template->body);
        $product = ListingProduct::find($bid->listingId);
    $tag_values = [
        '{name}'      => Auth::user()->name,        
        '{product}'   => $product->title ?? 'Product',      
        '{bid_amount}'=> $bid->amount,                     
        '{quantity}'  => $bid->quantity,                    
        '{status}'    => ucfirst($bid->status),             
        '{date_time}' => date('Y-m-d H:i')  
    ];

        $subject = str_replace(array_keys($tag_values), array_values($tag_values), $template->subject);
        $body = str_replace(array_keys($tag_values), array_values($tag_values), $template->body);

        Mail::send('emails.template', ['subject' => $subject, 'body' => $body], function ($message) use ($subject) {
            $message->to('abc@gmail.com')
                    ->subject($subject)
                    ->from('info@brgn.in', 'BRGN');
        });

         return response()->json(['success' => true]);
     }

     public function updateStatusCounterd(Request $request, $id)
            {
                $bid = Bid::findOrFail($id);

                if (!in_array($request->status, ['countered_rejected', 'countered_approved'])) {
                    return response()->json(['success' => false, 'message' => 'Invalid status'], 400);
                }

                $bid->status = $request->status;
                $bid->counter_response_time = Carbon::now();
                $bid->save();

                $template = EmailTemplate::where('type', 'bid_counter')->first();
    
                $trigger=Trigger::find($template->template_id);
                $tags=json_decode($trigger->fields,true);
                $allowed_tags = [];
                foreach ($tags as $item) {
                    $allowed_tags[] = '{' . $item['tags'] . '}';
                }
                $template->body = preg_replace_callback('/\{[^\}]+\}/', function ($matches) use ($allowed_tags) {
                    return in_array($matches[0], $allowed_tags) ? $matches[0] : '';
                }, $template->body);
                $product = ListingProduct::find($bid->listingId);
                 $tag_values = [
                    '{name}'      => Auth::user()->name,        
                    '{product}'        => $product->title ?? 'Product',             
                    '{bid_amount}'     => $bid->amount,                             
                    '{counter_amount}' => $bid->counter_offer_amount ?? 'N/A',                           
                    '{quantity}'       => $bid->quantity,                           
                    '{status}'         => ucfirst(str_replace('_',' ',$bid->status)),            
                    '{date_time}' => date('Y-m-d H:i') 
                ];

                $subject = str_replace(array_keys($tag_values), array_values($tag_values), $template->subject);
                $body = str_replace(array_keys($tag_values), array_values($tag_values), $template->body);

                Mail::send('emails.template', ['subject' => $subject, 'body' => $body], function ($message) use ($subject) {
                    $message->to('abc@gmail.com')
                            ->subject($subject)
                            ->from('info@brgn.in', 'BRGN');
                });

                return response()->json(['success' => true], 200);
            }
            
            public function saveprofileData(Request $request)
            {
              
                $validated = $request->validate([
                    'name' => 'required|string|max:255',
                    'phone_number' => 'required|string|max:10',
                    'email' => 'required|email|max:255',
                    'wallet' => 'required',
                ]);
            
                $userId = auth()->id();
            
                DB::table('users')->where('id', $userId)
                    ->update([
                        'name' => $request->name,
                        'phone_number' => $request->phone_number,
                        'email' => $request->email,
                        'wallet' => $request->wallet,
                        'updated_at' => now(),
                    ]);
                    $lastWallet = Wallet::orderBy('id', 'desc')->first();
                    $lastId = $lastWallet ? intval(substr($lastWallet->wallet_id, -4)) : 0;
                    $wallet_id  = str_pad($lastId + 1, 4, '0', STR_PAD_LEFT);

                    $wallet=new Wallet();
                    $wallet->userId=$userId;
                    $wallet->wallet_id='Bargain-'.$wallet_id;
                    $wallet->amount=$request->wallet;
                    $wallet->remark="Admin has credited the balance.";
                    $wallet->status='Deposit';
                    $wallet->created_at=Carbon::now();
                    $wallet->save();
                return response()->json([
                    'message' => 'Profile updated successfully.'
                ]);
            }

            public function updatePassword(Request $request)
            {
                $request->validate([
                    'current_password' => 'required',
                    'new_password' => 'required|string|min:6',
                    'confpassword' => 'required|same:new_password',
                ]);
            
                $user = auth()->user();
            
                if (!Hash::check($request->current_password, $user->password)) {
                    return response()->json(['message' => 'Current password is incorrect.'], 422);
                }
            
                $user->password = Hash::make($request->new_password);
                $user->save();
            
                return response()->json(['message' => 'Password updated successfully.']);
            }

            function userProfile()
            {
               $data['title']="Dashboard";
               $userId=Auth::user()->id ?? 0;
               $data['bid']=Bid::where('bidderId',$userId)->get();
               $data['user'] = DB::table('users')->where('id', $userId)->first();
               $data['addresses'] = Address::where('user_id', $userId)->get();
                return view('userDashboard.userProfile',compact('data'));
            }
            function userAddress()
            {
               $data['title']="Dashboard";
               $userId=Auth::user()->id ?? 0;
               $data['bid']=Bid::where('bidderId',$userId)->get();
             
               $data['user'] = DB::table('users')->where('id', $userId)->first();
               $data['addresses'] = Address::where('user_id', $userId)->get();
                return view('userDashboard.saveAddress',compact('data'));
            }
            
             function myBidInfo()
            {
               $data['title']="Dashboard";
               $userId=Auth::user()->id ?? 0;
               $data['bid']=Bid::where('bidderId',$userId)->get();
             
               $data['user'] = DB::table('users')->where('id', $userId)->first();
               $data['addresses'] = Address::where('user_id', $userId)->get();
                return view('userDashboard.bidInfo',compact('data'));
            }


            public function send(Request $request)
            {
                 $userId = Auth::user()->id ?? 0;
                $request->validate([
                    'product_id' => 'required|integer|exists:listing_products,id',
                    'seller_id' => 'required|integer|exists:users,id',
                    'message' => 'required|string|max:1000',
                ]);

                Message::create([
                    'user_id' => auth()->id(),
                    'product_id' => $request->product_id,
                    'seller_id' => $request->seller_id,
                    'message' => $request->message,
                ]);

                return redirect()->back()->with('success', 'Message sent successfully.');
}

        public function aboutus()
        {
            $aboutus= DB::table('cms_pages')->where('slug','about')->first();
            return view('frontend.aboutus', compact('aboutus'));
        }
         public function blogs()
        {
             $blogs = DB::table('blogs')->get();
            return view('frontend.blogs', compact('blogs'));
        }

          public function contactus()
        {
            $settings= DB::table('settings')->first();
            return view('frontend.contact', compact('settings'));
        }
            public function show($id)
            {
                $blog = DB::table('blogs')->where('blog_id', $id)->first();

                if (!$blog) {
                    abort(404); // Optional: Show 404 if not found
                }

                return view('frontend.blog_detail', compact('blog'));
            }
        public function storeContact(Request $request)
            {
                $request->validate([
                    'full_name' => 'required|string|max:255',
                    'email' => 'required|email',
                    'phone' => 'nullable|string|max:20',
                    'subject' => 'nullable|string|max:255',
                    'message' => 'nullable|string',
                ]);

                 DB::table('contact_messages')->insert([
                    'full_name' => $request->full_name,
                    'email' => $request->email,
                    'phone' => $request->phone,
                    'subject' => $request->subject,
                    'message' => $request->message,
                ]);

                return back()->with('success', 'Your message has been sent successfully.');
            }

    public function terms_condition()
    {
        $terms_condition = DB::table('cms_pages')->where('slug','terms')->first();
        return view('frontend.terms_condition', compact('terms_condition'));
    }
    public function privacy_policy()
    {
        $privacy_policy = DB::table('cms_pages')->where('slug','privacy')->first();
        return view('frontend.privacy_policy', compact('privacy_policy'));
    }
}
