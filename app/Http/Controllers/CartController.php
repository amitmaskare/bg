<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\{EmailTemplate,User,ListingProduct,Category,Bid,Product,CartItem,Address,StockLocation,Trigger};
use DB;
use Mail;
use App\Services\ShiprocketService;
class CartController extends Controller
{

     protected $shiprocket;

    public function __construct(ShiprocketService $shiprocket)
    {
        $this->shiprocket = $shiprocket;
    }

    public function getCount()
    {
       
        $count = 0;
        if (Auth::check()) {
            $count = CartItem::where('user_id', Auth::id())->sum('id');
        }
        return response()->json(['count' => $count]);
    }

   

public function add(Request $request)
{
   
    if (!Auth::check()) {
          return response()->json([
        'success' => false,
       
    ]);
    }
    
    $userId = auth()->id();
    $listingId = $request->input('listing_id');
    $price = $request->input('price');
    $address=Address::where('user_id',$userId)->first(['postal_code']);
    $listing=ListingProduct::where('id',$listingId)->first(['sellerId']);
    $stockLocation=StockLocation::where('sellerID',$listing->sellerId)->first(['postal_code']);
    $data = [
            'pickup_postcode'    => $stockLocation->postal_code ?? 440011,
            'delivery_postcode'  => $address->postal_code  ?? 440016,
            'weight'             => '50',
            'cod'                => false,
            'declared_value'     => '1000',
        ];

        $response = $this->shiprocket->checkServiceability($data);
       //echo "<pre>"; print_r($response['data']['available_courier_companies'][2]); exit;
      $shipping_charge=0;
        if(isset($response))
        {
            foreach($response['data']['available_courier_companies'] as $item)
            {
                if($item['courier_name']==='DTDC Surface 20kg')
                {
                    $shipping_charge=$item['freight_charge'] ?? 0;
                }
            }
        }

    $item = CartItem::where('user_id', $userId)
        ->where('listing_id', $listingId)
        ->first();

    if ($item) {
        $item->quantity += 1;
        $item->save();
    } else {

        $oprderBilling = DB::table('order_billings')->where('listingId', $listingId)->get();
        $orderQuantity = $oprderBilling->sum('quantity');

        $quantityData = DB::table('listing_products')->where('id', $listingId)->get();
        $totalQuantity = $quantityData->sum('quantity');
        $NewQuantity = 1 + $orderQuantity ;
        
        if($NewQuantity > $totalQuantity ){
           return response()->json([
                    'failed' => true,
                    'message' => 'Product is Out of Stock',
                    
                ]);
        }
         
        CartItem::create([
            'user_id' => $userId,
            'listing_id' => $listingId,
            'price' => $price,
            'quantity' => 1,
            'shipping_charge' => $shipping_charge,
        ]);
    }

    $items = CartItem::where('user_id', $userId)->with('product')->get();

    // Prepare cart data for JSON
    $cartItems = $items->map(function ($item) {
        return [
            'id' => $item->id,
            'name' => $item->product->product_name,
            'image' => asset('uploads/product/' . $item->product->main_image),
            'quantity' => $item->quantity,
            'shipping_charge' => $item->shipping_charge,
            'price' => $item->product->price,
            'subtotal' => $item->product->price * $item->quantity,
        ];
    });

    $cartCount = $items->count();
    $cartSubtotal = $items->sum(fn($i) => ($i->product->price * $i->quantity)+$i->shipping_charge);

    $user    = User::find($userId);
    $product = ListingProduct::find($listingId);

    $userName    = $user->name ?? 'Customer';
    $userEmail   = $user->email ?? 'info@brgn.in';
    $productName = $product->product_name ?? '';
     $productPrice= number_format($product->price, 2);
     $date  = now()->format('d M Y H:i');

    $template = EmailTemplate::where('type', 'add_to_cart')->first();
    $trigger=Trigger::find($template->template_id);
    $tags=json_decode($trigger->fields,true);
    $allowed_tags = [];
foreach ($tags as $item) {
    $allowed_tags[] = '{' . $item['tags'] . '}';
}
   
    $template->body = preg_replace_callback('/\{[^\}]+\}/', function ($matches) use ($allowed_tags) {
        return in_array($matches[0], $allowed_tags) ? $matches[0] : '';
    }, $template->body);


    $values = [
    'name'      => $userName ?? '',
    'product'   => $productName ?? '',
    'price'     => $productPrice ?? '',
    'date_time' => $date ?? '',
];
    $tag_values = [];
foreach ($tags as $item) {
    $tag = $item['tags']; 
    $tag_values['{' . $tag . '}'] = $values[$tag] ?? '';
}

    // $tag_values = [
    //     '{name}'    => $userName ?? '',
    //     '{product}' => $productName ?? '',
    //     '{price}'   => $productPrice ?? '',
    //     '{date_time}'    => $date ?? '',
    // ];

    $subject = str_replace(array_keys($tag_values), array_values($tag_values), $template->subject);
    $body    = str_replace(array_keys($tag_values), array_values($tag_values), $template->body);

    Mail::send('emails.template', ['subject' => $subject, 'body' => $body], function ($message) use ($subject, $userEmail) {
        $message->to($userEmail)
                ->subject($subject)
                ->from('info@brgn.in', 'BRGN');
    });

    return response()->json([
        'success' => true,
        'message' => 'Cart updated successfully',
        'cart_count' => $cartCount,
        'cart_subtotal' => $cartSubtotal,
        'cart_items' => $cartItems,
    ]);
}
// CartController.php
public function updateQuantity(Request $request)
{
    $userId = auth()->id();
    $cartItemId = $request->input('cart_item_id');
    $change = intval($request->input('change'));

    $item = CartItem::where('id', $cartItemId)->where('user_id', $userId)->first();
 
    if (!$item) {
        return response()->json(['success' => false, 'message' => 'Cart item not found.']);
    }
    $oprderBilling = DB::table('order_billings')->where('listingId', $item->listing_id)->get();
    $orderQuantity = $oprderBilling->sum('quantity');
    
    $quantityData = DB::table('listing_products')->where('id', $item->listing_id)->get();
    $totalQuantity = $quantityData->sum('quantity');

    $newQty = $item->quantity + $change;
   
    if ($newQty < 1) {
        $item->delete();
    } else {
        $NewQuantity = $newQty + $orderQuantity ;

        if($NewQuantity > $totalQuantity ){
            return response()->json(['success' => false, 'message' => 'You can Not add more than '.$item->quantity.' Stock']);
        }
        $item->quantity = $newQty;
        $item->save();
    }

    $items = CartItem::where('user_id', $userId)->with('product')->get();

    $cartItems = $items->map(function ($item) {
        return [
            'id' => $item->id,
            'name' => $item->product->product_name,
            'image' => asset('uploads/product/' . $item->product->main_image),
            'quantity' => $item->quantity,
            'price' => $item->product->price,
            'shipping_charge' => $item->shipping_charge,
            'subtotal' => ($item->product->price * $item->quantity)+$item->shipping_charge,
        ];
    });

    $cartCount = $items->count();
    $cartSubtotal = $items->sum(fn($i) => ($i->product->price * $i->quantity)+$i->shipping_charge);

    return response()->json([
        'success' => true,
        'cart_count' => $cartCount,
        'cart_subtotal' => $cartSubtotal,
        'cart_items' => $cartItems,
    ]);
}

public function deleteCart(Request $request)
{
    $userId = auth()->id();
    $id = $request->input('id');

    $deletedItem = CartItem::find($id);
    DB::table('cart_items')->where('id', $id)->delete();
    $items = CartItem::where('user_id', $userId)->with('product')->get();

    $cartCount = $items->count();
    $cartSubtotal = $items->sum(fn($i) => $i->product->price * $i->quantity);

    $template = EmailTemplate::where('type', 'remove_cart')->first();
    
    $allowed_tags = ['{name}', '{product}','{price}','{date_time}'];
    $template->body = preg_replace_callback('/\{[^\}]+\}/', function ($matches) use ($allowed_tags) {
        return in_array($matches[0], $allowed_tags) ? $matches[0] : '';
    }, $template->body);

    $userEmail = Auth::user()->email;
    $userName = Auth::user()->name ?? 'Customer';
    $product     = ListingProduct::find($deletedItem->listing_id);

    $tag_values = [
        '{name}'      => $userName,
        '{product}'   => $product->name ?? '',
        '{price}'     => $product->price ?? 0,
        '{date_time}' => now()->format('d-m-Y H:i:s'),
    ];

    $subject = str_replace(array_keys($tag_values), array_values($tag_values), $template->subject);
    $body = str_replace(array_keys($tag_values), array_values($tag_values), $template->body);

    Mail::send('emails.template', ['subject' => $subject, 'body' => $body], function ($message) use ($subject, $userEmail) {
        $message->to($userEmail)
                ->subject($subject)
                ->from('info@brgn.in', 'BRGN');
    });

    return response()->json([
        'success' => true,
        'cart_subtotal' => $cartSubtotal,
        'cart_count'=>$cartCount
        
    ]);
}

}
