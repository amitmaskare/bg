<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use App\Models\Employee;
use Illuminate\Support\Facades\Hash;
class LoginController extends Controller
{
    
    public function index()
    {
        return view('admin.login');
    }

    public function actionLogin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => ['required'],
            'password' => ['required']
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $credentials = $request->only('email', 'password');
        if (Auth::guard('admin')->attempt($credentials,true)) {
            $request->session()->regenerate();
            $admin = Auth::guard('admin')->user();
                session([
                    'id' => $admin->id,
                    'name' => $admin->name,
                    'email' => $admin->email,
                    'role' => $admin->designationId,
                ]);
                
                return redirect('admin/dashboard');
            }
            return back()->withErrors([
                'email' => 'The provided credentials do not match.',
            ])->withInput();
    }

    function profile()
    {
        $admindata=Employee::where('id',Session::get('id'))->first();
        return view('admin.profile',compact('admindata'));
    }

    function updateProfile(Request $request)
    {
        $employee=Employee::findOrFail(Session::get('id'));
        $employee->name=$request->name;
        $employee->email=$request->email;
        $employee->country=$request->country;
        $employee->save();
       return  redirect('admin/profile');

    }

    function changePassword()
    {
        $data['heading']="Change Password";
        $data['title']="Change Password";
        return view('admin.change_password',compact('data'));
    }

    public function updatePassword(Request $request)
    {
        
       $validator = Validator::make($request->all(), [
    'old_password'     => ['required'],
    'new_password'     => ['required', 'min:6'],
    'confirm_password' => ['required', 'same:new_password'],
   ]);

       if ($validator->fails()) {
    return back()->withErrors($validator)->withInput();
        }
        
         $employee=Employee::findOrFail(Session::get('id'));
         if(!Hash::check($request->old_password,$employee->password))
         {
            
            Session()->flash('error',"Old Password incorrect"); 
            return back();
         }
         
         $employee->password=Hash::make($request->new_password);
         $employee->save();
         Session()->flash('success',"Password updated successfully"); 
         return redirect()->route('changepassword');
    }

    function logout()
    {
        Auth::guard('admin')->logout();
        session()->flush();
        session()->flash('success','Logout Successful');
        return redirect()->route('admin/login');
    }
}