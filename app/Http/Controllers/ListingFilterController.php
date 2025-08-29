<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Category,Brand,ListingProduct};
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use DB;
class ListingFilterController extends Controller
{

    public function index()
    {
        $data['listing']=ListingProduct::where('status','pending')->orderBy('id','ASC')->select(['id', 'main_image', 'productId', 'price', 'sellerId', 'product_name'])->paginate(10);
          $data['category']=Category::where('status','Active')->orderBy('categoryId','DESC')->get();
          $data['brand']=Brand::where('status','Active')->orderBy('brandId','DESC')->get();
          return view('frontend.shop',compact('data'));
    }

    public function ajaxFilter(Request $request)
    {
            
        $query = ListingProduct::query();
        
         if ($request->has('categories') && !empty($request->categories)) {
            $query->whereIn('categoryId', explode(',', $request->categories));
        }
        
         if ($request->has('brands') && !empty($request->brands)) {
            $query->whereIn('brandId', explode(',', $request->brands));
        }
         switch ($request->position) {
    case 'low':
        $query->orderBy('price', 'asc');
        break;
    case 'high':
        $query->orderBy('price', 'desc');
        break;
    case 'desc':
    default:
        $query->orderBy('id', 'desc');
        break;
    }
         
        $products = $query->paginate(10)->appends($request->all());
       
        return response()->json([
            'products' => view('frontend._products', compact('products'))->render(),
            'pagination' => view('frontend._pagination', compact('products'))->render()
        ]);
    
        
    }

    public function search(Request $request)
    {
        $userId = Auth::user()->id ?? 0;
        $request->validate([
            'searchValues' => 'required|string|max:255',
        ]);
        if (!$request->has('searchValues') || empty($request->input('searchValues'))) {
            return redirect()->route('shop.index');
        }
         
        $search = $request->input('searchValues');

         DB::table('search_product')->insert([
                'user_id'    => $userId,
                'product_name' => $search,
                'created_at' => now(),
                'updated_at' => now(),
        ]);
        $data['listing'] = ListingProduct::where('status', 'pending')
            ->where('product_name', 'LIKE', '%' . $search . '%')
            ->orderBy('id', 'ASC');
        $data['listing'] = $data['listing']->paginate(10);
        $data['category'] = Category::where('status', 'Active')->orderBy('categoryId', 'DESC')->get();
        $data['brand'] = Brand::where('status', 'Active')->orderBy('brandId', 'DESC')->get();
        return view('frontend.shop', compact('data'));      
}
}
