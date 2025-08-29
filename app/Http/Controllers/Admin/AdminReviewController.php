<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Models\Review;
class AdminReviewController extends Controller
{
            public function index()
        {
            $reviews = DB::table('reviews')
                ->join('users', 'reviews.user_id', '=', 'users.id')
                ->join('listing_products', 'reviews.product_id', '=', 'listing_products.id')
                ->select(
                    'reviews.id',
                    'users.name as user_name',
                    'listing_products.product_name',
                    'reviews.rating',
                    'reviews.content',
                    'reviews.status',
                    'reviews.created_at'
                )
                ->orderBy('reviews.created_at', 'DESC')
                ->paginate(15);

            return view('admin.reviews.review_list', compact('reviews'));
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

        public function updateStatus(Request $request, $id)
            {
                $request->validate([
                    'status' => 'required|in:1,2'
                ]);

                DB::table('reviews')->where('id', $id)->update([
                    'status' => $request->status,
                    'updated_at' => now(),
                ]);

                return response()->json(['success' => true, 'message' => 'Review status updated.']);
            }
}