<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Permission;
use Carbon\Carbon;
use Illuminate\Support\Str;
class PermissionController extends Controller
{

    public function index()
    {
      $data['permission']=Permission::orderBy('permission_id','ASC')->get();
      $data['title']="Permission";
      $data['heading']="Permission";
      return view('admin.permission',compact('data'));  
    }

      public function ajax_manage_page(Request $request)
    {
        $Permission = new Permission();
        $getData = $Permission->getDatatables($request);

        $start = $request->input('start', 0);
        $draw = $request->input('draw', 1);
        $data = [];
        $no = $start;

        foreach ($getData as $item) {
            $btn = '';

            // Show edit button if user has permission
            if (auth()->check() && auth()->user()->can('permission-update')) {
                $btn .= '<a href="javascript:void(0)" class="btn btn-success btn-sm me-2"
                        data-bs-toggle="modal" data-bs-target="#editModal"
                        onclick="getValue('.$item->permission_id.')">Edit</a>';
            }

            // Show delete button if user has permission
           if (auth()->check() && auth()->user()->can('permission-delete')) {
                $btn .= '<a href="javascript:void(0)" class="btn btn-danger btn-sm"
                        onclick="deleteItem('.$item->permission_id.')">Delete</a>';
            }

            $status = $item->status == 'Active'
                ? '<span class="badge bg-success">Active</span>'
                : '<span class="badge bg-danger">Inactive</span>';

            $no++;
            $nestedData = [];
            $nestedData[] = $no;
            $nestedData[] = ucfirst($item->name);
            $nestedData[] = $status;
            $nestedData[] = date('d-M-Y H:i A', strtotime($item->created_at));
            $nestedData[] = $btn;

            $data[] = $nestedData;
        }

        $output = [
            "draw" => $draw,
            "recordsTotal" => $Permission->countAll(),
            "recordsFiltered" => $Permission->countFiltered($request),
            "data" => $data,
        ];

        return response()->json($output);
    }

    public function savepermission(Request $request)
    {
      if(isset($request->permission_id))
      {
         $permission=permission::where('permission_id',$request->permission_id)->first();
         $msg="updated";
      }
      else{
          $permission=new permission();
          $msg="added";
      }
        
      $permission->name=$request->name;
      $permission->slug=Str::slug($request->name);
      $permission->status='Active';
      $permission->created_at=Carbon::now();
      $permission->save();
    return redirect()->route('permission')->with('success', "Permission {$msg} successfully!");
    }


    public function getvalue(Request $request)
  {
   
    $getdata = permission::where('permission_id',$request->permission_id)->first();
    return response()->json([
        "id" =>$getdata->permission_id, 
        "name" =>$getdata->name,
        ]);
  }

   function permission_delete($permission_id)
   {
      $permission=permission::where('permission_id',$permission_id)->delete();
      return redirect()->route('permission')->with('success', 'Permission deleted successfully!');
   }
}
