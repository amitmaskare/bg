<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Role};
use Carbon\Carbon;
class RoleController extends Controller
{
    
    public function index()
    {
      $data['role']=Role::orderBy('role_id','DESC')->get();
      $data['title']="Role";
      $data['heading']="Role";
      return view('admin.role',compact('data'));  
    }

    public function saverole(Request $request)
    {
      if(isset($request->role_id))
      {
         $role=Role::where('role_id',$request->role_id)->first();
         $msg="updated";
      }
      else{
          $role=new Role();
          $msg="added";
      }
        
      $role->name=$request->name;
      $role->status='Active';
      $role->created_at=Carbon::now();
      $role->save();
    return redirect()->route('role')->with('success', "Role {$msg} successfully!");
    }


    public function getvalue(Request $request)
  {
   
    $getdata = Role::where('role_id',$request->role_id)->first();
    return response()->json([
        "id" =>$getdata->role_id, 
        "name" =>$getdata->name,
        ]);
  }

   function role_delete($role_id)
   {
      $role=Role::where('role_id',$role_id)->delete();
      return redirect()->route('role')->with('success', 'Role deleted successfully!');
   }



}