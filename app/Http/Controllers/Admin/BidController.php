<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Trigger,Bid,ListingProduct,Order,Order_billing,EmailTemplate,User};
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class BidController extends Controller
{
    function list()
    {
      // dd(session()->all()); exit;
    $data['bidlist']=DB::table('bids')->leftjoin('listing_products as lp',"bids.listingId",'=','lp.id')->where('lp.sellerId',Session::get('id'))->select('bids.*','lp.type')->get();
    $data['listingId'] = DB::table('bids')
    ->leftJoin('listing_products as lp', 'bids.listingId', '=', 'lp.id')
    ->where('lp.sellerId', Session::get('id'))
    ->groupBy('bids.listingId')
    ->pluck('bids.listingId');
       $data['product_name'] = DB::table('bids')
    ->leftJoin('listing_products as lp', 'bids.listingId', '=', 'lp.id')
    ->where('lp.sellerId', Session::get('id'))
    //->groupBy('bids.listingId', 'bids.id', 'lp.type')
    ->select('bids.*', 'lp.type')
    ->get();
        return view('admin.bid.list',compact('data'));
    }

    function bidlist($id)
    {
        $data['bidlist']=Bid::where('listingId',$id)->get();
        return view('admin.bid.view',compact('data'));
    }

    function updateStatus(Request $request)
    {
         $bidId=$request->bidId;
         $bid=Bid::findorFail($bidId);
        $bid->status=$request->status;
        $bid->counter_offer_amount=$request->counter_offer_amount ?? 0;
        $bid->counter_response_time=now();
        $bid->save();

        if($request->status=='approved')
        {
            $listing=ListingProduct::find($bid->listingId);
            $order=new Order();
           $order->orderId='UUID-'.rand(11111,99999);
           $order->bidId=$bidId;
           $order->sellerId=Session::get('id');
           $order->buyerId=$bid->bidderId;
           $order->order_type='bid';
           $order->subtotal=$bid->amount;
           $order->total_amount=$bid->amount;
           $order->status='pending';
           $order->order_date=date('Y-m-d');
           $order->created_at=date('Y-m-d H:i:s');
           $order->save();

           $orderBilling=new Order_billing();
           $orderBilling->orderId=$order->id;
           $orderBilling->listingId=$bid->listingId;
           $orderBilling->quantity=$bid->quantity;
           $orderBilling->price=$listing->price;
           $orderBilling->save();
        }

        $buyer = User::find($bid->bidderId);
        if($request->status=='approved'){
            $template = EmailTemplate::where('type', 'bid_accept')->first();
        }else{
            $template = EmailTemplate::where('type', 'bid_reject')->first();
        }
    
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
        '{name}'                => $buyer->name ?? 'Buyer',
        '{product}'             => $listing->title ?? 'Product',
        '{bid_amount}'          => $bid->amount,
        '{counter_offer_amount}'=> $bid->counter_offer_amount ?? 0,
        '{quantity}'            => $bid->quantity,
        '{status}'              => ucfirst($bid->status),
        '{date_time}'           => date('Y-m-d H:i') 
    ];

        $subject = str_replace(array_keys($tag_values), array_values($tag_values), $template->subject);
        $body    = str_replace(array_keys($tag_values), array_values($tag_values), $template->body);

        Mail::send('emails.template', ['subject' => $subject, 'body' => $body], function ($message) use ($buyer, $subject) {
            $message->to($buyer->email)
                    ->subject($subject)
                    ->from('info@brgn.in', 'BRGN');
        });
        
        session::flash('success',"Change Status Successfully");
        return redirect()->route('bidlist', $bid->listingId);
    }

    public function expire(Request $request, $bidId)
{
    $bid = DB::table('bids')->where('bidId', $bidId)->first();

    if ($bid && $bid->status === 'pending') {
        DB::table('bids')->where('bidId', $bidId)->update([
            'status' => 'rejected',
            'updated_at' => now() 
        ]);

        $buyer   = DB::table('users')->where('id', $bid->bidderId)->first();
        $listing = ListingProduct::find($bid->listingId);

        $template = EmailTemplate::where('type', 'bid_reject')->first();

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
        '{name}'                => $buyer->name ?? 'Buyer',
        '{product}'             => $listing->title ?? 'Product',
        '{bid_amount}'          => $bid->amount,
        '{counter_offer_amount}'=> $bid->counter_offer_amount ?? 0,
        '{quantity}'            => $bid->quantity,
        '{status}'              => ucfirst($bid->status),
        '{date_time}'           => date('Y-m-d H:i') 
    ];

        $subject = str_replace(array_keys($tag_values), array_values($tag_values), $template->subject);
        $body    = str_replace(array_keys($tag_values), array_values($tag_values), $template->body);

        Mail::send('emails.template', ['subject' => $subject, 'body' => $body], function ($message) use ($buyer, $subject) {
            $message->to($buyer->email)
                    ->subject($subject)
                    ->from('info@brgn.in', 'BRGN');
        });

        return response()->json(['success' => true]);
    }
    

    return response()->json(['success' => false]);
}

}