<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validation;
use App\Models\Category;
use Carbon\Carbon;
class CategoryController extends Controller
{
    public function index()
    {
      $data['title']='Category';
      $data['page']='category';
      return view('admin.category',compact('data'));  
    }

    public function ajax_manage_page(Request $request)
    {
      $Category = new Category();
        $getData = $Category->getDatatables($request);
        $start = $request->input('start', 0);
        $draw = $request->input('draw', 1);
        $data = [];
        $no = $start;
        foreach ($getData as $item) {
          $btn='';
         
            $btn .= '<a href="javascript:void(0)" class="btn-success btn-sm me-2" data-bs-toggle="modal" data-bs-target="#editModal"  onclick="getValue('.$item->categoryId.')">Edit</a>';
          
            $btn .= '<a href="javascript:void(0)" class="btn-danger btn-sm" onclick="deletecategory('.$item->categoryId.')">Delete</a>';
             
               if($item->image && file_exists(public_path('uploads/category/'.$item->image)))
               {
                  $img= '<img src="'.asset('uploads/category/'.$item->image).'" alt="" width="70px" height="70px">';
               }
                  else
                    {
                  $img='<img src="'.asset('assets/images/product-details/product/1.jpg').'" alt="" width="70px" height="70px">';
                  }
                $status=$item->status=='Active' ? '<span class="badge bg-success">Active<span>':'<span class="badge bg-danger">Inactive<span>';
                      
            $no++;
            $nestedData = [];
            $nestedData[] = $no;
            $nestedData[] = $img;
            $nestedData[] = ucfirst($item->categoryName);
            $nestedData[] = $status;
            $nestedData[] = date('d-M-Y H:i A',strtotime($item->created_at));
            $nestedData[] = $btn;
            $data[] = $nestedData;
        }

        $output = [
            "draw" => $draw,
            "recordsTotal" => $Category->countAll(),
            "recordsFiltered" => $Category->countFiltered($request),
            "data" => $data,
        ];

        return response()->json($output);
    }

    public function saveCategory(Request $request)
    {

      $image = isset($request->old_image) ? $request->old_image :'';
      if ($request->hasFile('image')) {
          $file = $request->file('image');
          $filename = rand(0000,9999) . "_" . preg_replace('/[()\s]/', '', $file->getClientOriginalName());
          $file->move(public_path('uploads/category'), $filename);
          $image = $filename;
      }
     
      $categoryId=$request['categoryId'];
      if(isset($categoryId))
      {
        $category=Category::findOrFail($categoryId);
        $msg="updated";
      }
      else{
         $category=new Category();
          $msg="added";
      }
     
      $category->categoryName=$request->categoryName;
      $category->image=$image;
      $category->status='Active';
      $category->created_at=Carbon::now()->format('Y-m-d H:i:s');
      $category->save();
      session()->flash('success',"Category {$msg} successfully!");
       return redirect()->route('category');
    }

    public function getvalue(Request $request)
    {
  
      $getdata=Category::findOrFail($request->categoryId);
      if($getdata->image && file_exists(public_path('uploads/category/'.$getdata->image)))
      {
        $img='<img src="'.asset('uploads/category/'.$getdata->image).'" width="50px" height="50px"/>';
      }
      else{
        $img='<img src="'.asset('assets/images/product-details/product/1.jpg').'" width="50px" height="50px"/>';
      }
      return response()->json([
          "id" =>$getdata->categoryId, 
          "name" =>$getdata->categoryName,
          "img" =>$img,
          "old_image" =>$getdata->image,
          ]);
    }
     
     function category_delete($categoryId)
     {
          $category=Category::findOrFail($categoryId);
          $category->delete();
         session()->flash('success',"Category deleted successfully!");
         return redirect()->route('category');
     }

     public function saveCategoryAjax(Request $request)
     {
         $category = Category::create([
             'categoryName' => $request->category_name,
             'status' => 'Active',
             'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
         ]);
        
         return response()->json([
             'success' => true,
             'category' => $category,
         ]);
     }
  
}