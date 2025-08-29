<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;
use DB;
class BannerController extends Controller
{
    public function index()
    {
        $banners = Banner::latest()->get();
        return view('admin.banner', compact('banners'));
    }

    public function ajax_manage_page(Request $request)
    {
        $banners = Banner::latest()->get();
        $start = $request->input('start', 0);
        $draw = $request->input('draw', 1);
        $data = [];
        $no = $start;

        foreach ($banners as $banner) {
            $btn = '';
           
            $btn .= '<a href="javascript:void(0)" class="btn-success btn-sm me-2" data-bs-toggle="modal" data-bs-target="#editModal"  onclick="getValue('.$banner->banner_id.')">Edit</a>';
          
            $btn .= '<a href="javascript:void(0)" class="btn-danger btn-sm" onclick=""deleteBanner('.$banner->banner_id.')">Delete</a>';
             

            if ($banner->banner_image && file_exists(public_path('uploads/banners/' . $banner->banner_image))) {
                $img = '<img src="' . asset('uploads/banners/' . $banner->banner_image) . '" alt="" width="70px" height="70px">';
            } else {
                $img = '<img src="' . asset('assets/images/product-details/product/1.jpg') . '" alt="" width="70px" height="70px">';
            }

            $status = $banner->status == '0' ? '<span class="badge bg-success">Active<span>' : '<span class="badge bg-danger">Inactive<span>';

            $no++;
            $nestedData = [];
            $nestedData[] = $no;
            $nestedData[] = $img;
        //    $nestedData[] = ucfirst($banner->banner_image);
            $nestedData[] = $status;
            $nestedData[] = date('d-M-Y H:i A', strtotime($banner->created_at));
            $nestedData[] = $btn;
            $data[] = $nestedData;
        }

        return response()->json([
            "draw" => intval($draw),
            "recordsTotal" => count($banners),
            "recordsFiltered" => count($banners),
            "data" => $data,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'banner_image' => 'required|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        $imageName = time() . '.' . $request->banner_image->extension();
        $request->banner_image->move(public_path('uploads/banners'), $imageName);

        Banner::create([
            'banner_image' => $imageName,
            'status' => '0',
        ]);

        $banners = Banner::latest()->get();
        return view('admin.banner', compact('banners'))->render();
    }

    public function getvalue()
    {
  
      $getdata =  DB::table('banners')->where('banner_id',$_POST['bannerId'])->first();
       // $img ='/uploads/banners/'.$getdata->banner_image;
        $img = asset('uploads/banners/'.$getdata->banner_image);
      return response()->json([
          "bannerId" =>$getdata->banner_id, 
          "image" =>$img,
          ]);
    }

    public function updateBanner(Request $request)
{
    // Validate input
    $request->validate([
        'banner_image' => 'required|image|mimes:jpg,jpeg,png,gif|max:2048',
        'banner_id' => 'required|exists:banners,banner_id',
    ]);
    
    // Find the existing banner record
    $banner = Banner::findOrFail($request->banner_id);

    // Delete the old image if it exists
    if ($banner->banner_image && file_exists(public_path('uploads/banners/' . $banner->banner_image))) {
        unlink(public_path('uploads/banners/' . $banner->banner_image));
    }

    // Save new image
    $imageName = time() . '.' . $request->banner_image->extension();
    $request->banner_image->move(public_path('uploads/banners'), $imageName);

    // Update banner record
    $banner->update([
        'banner_image' => $imageName,
    ]);

    // Get updated banner list
    $banners = Banner::latest()->get();

    // Return rendered HTML (if you're using AJAX to inject it)
    return view('admin.banner', compact('banners'))->render();
}
    function deleteBanner($bannerID)
     {
            $banner=Banner::findOrFail($bannerID);
            $banner->delete();
           return redirect()->route('banners')->with('success', 'Banner deleted successfully!');
     }
}
?>