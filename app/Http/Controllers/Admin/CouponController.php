<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validation;
use App\Models\Coupon;
use Carbon\Carbon;
class CouponController extends Controller
{

     public function index()
        {
            $data['coupon']=Coupon::orderBy('couponId','DESC')->get();
            $data['heading']='Coupon';
          return view('admin.coupon',compact('data'));  
        }
    
        public function saveCoupon(Request $request)
        {
            if(isset($request->couponId))
            {
                $coupon=Coupon::find($request->couponId);
                $msg="updated";
            }
            else{
                 $coupon=new Coupon();
                 $msg="added";
            }
           $coupon->coupon_code=$request->coupon_code;
           $coupon->discount=$request->discount;
           $coupon->status='Active';
           $coupon->created_at=Carbon::now();
           $coupon->save();
         return redirect()->route('coupon')->with('success', "Coupon {$msg} successfully!");
        }
    
        public function coupon_getvalue(Request $request)
      {
        $getdata = Coupon::findOrFail($request->couponId);

        return response()->json([
            "couponId" =>$getdata->couponId, 
            "coupon_code" =>$getdata->coupon_code,
            "discount" =>$getdata->discount,
            ]);
      }

       function deleteCoupon($couponId)
       {
        $coupon = Coupon::findOrFail($couponId);
        $coupon->delete();
         return redirect()->route('coupon')->with('success', 'Coupon deleted successfully!');
       }

}
