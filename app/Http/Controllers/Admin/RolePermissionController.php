<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Role,RolePermission,Permission};
use Carbon\Carbon;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
class RolePermissionController extends Controller
{
     public function index()
    {
      $data['role_permission']=RolePermission::selectRaw('MAX(id) as id, role_id,MAX(created_at) as created_at')->groupBy('role_id')->with('role:role_id,name')->get();
      $data['title']="Role Permission";
      $data['heading']="Role Permission";
      return view('admin.role_permission.list',compact('data'));  
    }

     public function add()
    {
      $data['role']=Role::orderBy('role_id','DESC')->get();
      $data['permission']=Permission::orderBy('permission_id','ASC')->get();
      $data['title']="Role Permission";
      $data['heading']="Role Permission";
      return view('admin.role_permission.form',compact('data'));  
    }


    function givepermission(Request $request)
    {
       $id=$request->roleId;
       $validator=Validator::make($request->all(),[
        'role_id'=>['required', Rule::unique('role_permissions', 'role_id')->ignore($id, 'role_id')],
        'permission_id' => 'required'
       ],[
        'role_id.unique' => 'This Role already has permissions assigned',
        'permission_id.required' => 'Please select at least one permission'
       ]);

       if($validator->fails())
       {
        return redirect()->back()->withErrors($validator)->withInput();
       }
       
         if($request->role_id!=$id)
         {
            RolePermission::where('role_id',$id)->delete();
         }
        $permission=explode(',',$request['permission_id']);
         if($permission && is_array($permission)) {
        foreach($permission as $value)
        {
            $rolePermission= new RolePermission();
             $rolePermission->role_id=$request->role_id;
              $rolePermission->permission_id=$value;
              $rolePermission->created_at=Carbon::now();
               $rolePermission->save();
        }

        session()->flash('success','Role permission added successfully');
    }else {
        session()->flash('error', 'No permissions selected');
    }
        return redirect()->route('rolepermission');
    
    }

    public function edit($role_id)
    {
      $data['role_permission']=RolePermission::where('role_id',$role_id)->get();
        $permissionData=[];
        $role_id='';
        if(!$data['role_permission']->isEmpty())
        {
          foreach($data['role_permission'] as $item)
          {
            $role_id=$item->role_id;
            $permissionData[]=$item->permission_id;
          }
        }
      $data['permissionData']=$permissionData;
       $data['role_id']=$role_id;
       $data['role']=Role::orderBy('role_id','DESC')->get();
      $data['permission']=Permission::orderBy('permission_id','ASC')->get();
      $data['title']="Role Permission";
      $data['heading']="Role Permission";
      return view('admin.role_permission.form',compact('data'));  
    }

}
