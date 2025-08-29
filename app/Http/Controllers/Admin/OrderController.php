<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{order,Order_billing};
use Illuminate\Support\Facades\Session;
class OrderController extends Controller
{
    public function index()
    {
        if(Session::get('role')==='admin')
        {
            $data['order']=Order::with('user:id,name,email')->orderBy('id','DESC')->get();
        }
        elseif(Session::get('role')==='seller'){
             $id = session('id');
             $data['order']=Order::with('user:id,name,email')->where('sellerId',$id)->orderBy('id','DESC')->get();
        }
      
        $data['title']="Order List";
        return view('admin.order.list',compact('data'));
    }

    public function order_detail($orderId)
    {
         $data['title']="Order List";
        $data['order']=Order::with('shippingAddress:id,address_line,city,state,country,postal_code')->where('id',$orderId)->first();
        $data['orderDetail']=Order_billing::with('listings:id,product_name')->where('orderId',$orderId)->get();
        
        return view('admin.order.order_detail',compact('data'));   
    }

    public function transaction()
    {
        $data['title']="Transaction List";
         $id = session('id');
        $data['transaction']=Order::where('sellerId',$id)->orderBy('id','DESC')->get();
        
        return view('admin.order.transaction',compact('data'));
    }
}
