<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand;
use Carbon\Carbon;
use DB;
class BrandController extends Controller
{
    
        public function index()
        {
            $data['brand']=Brand::all();
            $data['heading']='Brand';
          return view('admin.brand',compact('data'));  
        }
    
        public function saveBrand(Request $request)
        {
            Brand::create([
            'brand_name' => $request->brand_name,
            'status' => 'Active',
            'created_at'=>Carbon::now()->format('Y-m-d H:i:s'),
    
        ]);
    
        return redirect()->route('brand')->with('success', 'Brand saved successfully!');
        }
    
          public function saveBrandAjax(Request $request)
        {
            $brand = Brand::create([
                'brand_name' => $request->brand_name,
                'status' => 'Active',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ]);
            
            return response()->json([
                'success' => true,
                'brand' => $brand,
            ]);
        }

    
        public function getvalue(Request $request)
      {
    
        $getdata = Brand::where('brandId',$request['brandId'])->first();
     
        return response()->json([
            "brandId" =>$getdata->brandId, 
            "brand_name" =>$getdata->brand_name,
            ]);
      }

       public function updateBrand(Request $request)
       {
       
        $brand = Brand::findOrFail($request->brandId);
        $brand->update([
            'brand_name' => $request->brand_name,
        ]);
          return redirect()->route('brand')->with('success', 'Brand saved successfully!');
       }
    
       function deleteBrand($brandId)
       {
        $brand = Brand::findOrFail($brandId);
        $brand->delete();
         return redirect()->route('brand')->with('success', 'Brand saved successfully!');
       }

   public function ajax_manage_page(Request $request)
    {
        $draw = $request->input('draw');
        $start = $request->input('start');
        $length = $request->input('length');

        $query = Brand::query();

        if ($request->has('search') && $request->input('search')['value'] != '') {
            $search = $request->input('search')['value'];
            $query->where('brand_name', 'like', "%{$search}%");
        }

        $totalData = $query->count();
        $brands = $query->offset($start)->limit($length)->get();

        $data = [];
        foreach ($brands as $key => $brand) {
            $no = $key + 1;
            $status = $brand->status == 'Active' ? '<span class="badge bg-success">Active</span>' : '<span class="badge bg-danger">Inactive</span>';
            $nestedData = [];
            $nestedData[] = $no;
            $nestedData[] = ucfirst($brand->brand_name);
            $nestedData[] = $status;
            $nestedData[] = date('d-M-Y H:i A', strtotime($brand->created_at));
            // Action buttons
            $nestedData[] = '<button class="btn btn-primary" onclick="getValue('.$brand->brandId.')">Edit</button>
                             <button class="btn btn-danger" onclick="deleteBrand('.$brand->brandId.')">Delete</button>';
            $data[] = $nestedData;
        }

        return response()->json([
            "draw" => intval($draw),
            "recordsTotal" => intval($totalData),
            "recordsFiltered" => intval($totalData),
            "data" => $data,
        ]);
    }
  

    
}