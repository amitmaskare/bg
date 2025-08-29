<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Employee,Role,Permission,RolePermission}; // Assuming you have an Employee model
use Illuminate\Support\Facades\Validation;
use Illuminate\Validation\Rule;
use Carbon\Carbon;
use DB;
class EmployeeController extends Controller
{
    public function index()
    {
        // Logic to list employees
       //$employee = Employee::whereHas('role', function ($query) {
               // $query->where('name', '!=', 'admin');
               $roless = \App\Models\Role::all();
 $employee = Employee::leftJoin('roles', 'roles.role_id', '=', 'employees.role_id')
    ->where('roles.name', '!=', 'admin')
    ->select('employees.*', 'roles.name as role_name')
    ->get();
            
        return view('admin.employee.emplist',compact('employee','roless'));
    }

    // public function create()
    // {
    //     // Logic to show form for creating a new employee
    //     $roles = \App\Models\Role::all(); // Assuming you have a Role model
    //     return view('admin.employee.employeeform', compact('roles'));
       
    // }
public function create()
{
    $roles = \App\Models\Role::all();
    return view('admin.employee.employeeform', [
        'roles' => $roles,
        'employee' => null // For create, pass null
    ]);
}

     public function edit($id)
    {
        $roles = \App\Models\Role::all();
        $employee = Employee::findOrFail($id);
        return view('admin.employee.employeeform', compact('roles', 'employee'));
    }

    

    public function save(Request $request, $id = null)
{
    // Determine if this is create or update
    $isUpdate = !is_null($id);
    $employee = $isUpdate ? Employee::findOrFail($id) : new Employee();

    // Validation rules
    $rules = [
        'name' => 'required|string|max:255',
        'email' => ['required', 'email', Rule::unique('employees')->ignore($id)],
        'password' => $isUpdate ? 'nullable|string|min:6' : 'required|string|min:6',
        'role_id' => 'required|exists:roles,role_id',
        'profile' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5048',
        'adhaar_numer' => ['required', 'digits:12', Rule::unique('employees')->ignore($id)],
        'phone' => ['required','digits:10',Rule::unique('employees')->ignore($id)],
        'emerg_phone' => 'nullable|digits:10',
        'postal_code' => 'required|digits:6',
    ];

    $request->validate($rules);

    // Image upload
    $imageName = $employee->profile;
    if ($request->hasFile('profile')) {
        $image = $request->file('profile');
        $imageName = time() . '_' . $image->getClientOriginalName();
        $image->move(public_path('uploads/employee'), $imageName);
    }

    // Fill employee data
    $employee->name = $request->name;
    $employee->email = $request->email;
    if ($request->filled('password')) {
        $employee->password = bcrypt($request->password);
    }
    $employee->role_id = $request->role_id;
    $employee->profile = $imageName;
    $employee->address = $request->input('address');
    $employee->adhaar_numer = $request->adhaar_numer;
    $employee->phone = $request->phone;
    $employee->emerg_phone = $request->emerg_phone;
    $employee->postal_code = $request->postal_code;

    // Save employee
    $employee->save();

    // Insert into employee_roles table only on create
    if (!$isUpdate) {
    // Insert for new employee
    DB::table('employee_roles')->insert([
        'employee_id' => $employee->id,
        'role_id' => $employee->role_id,
        'created_at' => now(),
            ]);
        } else {
            // Update role if changed
            DB::table('employee_roles')
                ->where('employee_id', $employee->id)
                ->update([
                    'role_id' => $employee->role_id,
                   
                ]);
        }

    return redirect()->route('employee')->with('success', $isUpdate ? 'Employee updated successfully!' : 'Employee created successfully!');
}

    public function destroy($id)
    {
        $employee = Employee::findOrFail($id);
        DB::table('employee_roles')->where('employee_id',$id)->delete();
         if ($employee->profile && file_exists(public_path('assets/employee/' . $employee->profile))) {
            unlink(public_path('assets/employee/' . $employee->profile));
        }     
         $employee->delete();   
        // Redirect back with success message
        return redirect()->route('employee')->with('success', 'Employee deleted successfully.');
    }

    public function updateRole(Request $request)
{
    $request->validate([
        'employee_id' => 'required|exists:employees,id',
        'role_id' => 'required|exists:roles,role_id',
    ]);

    $employee = Employee::findOrFail($request->employee_id);
    $employee->role_id = $request->role_id;
    $employee->save();
     DB::table('employee_roles')->updateOrInsert(
        ['employee_id' => $request->employee_id],
        ['role_id' => $request->role_id]
    );

    return redirect()->back()->with('success', 'Role updated successfully.');
}

  public function empPermission($id)
{
     $data['employee'] = Employee::findOrFail($id);

    // Get all roles (optional, in case you want them elsewhere)
    $data['role'] = Role::orderBy('role_id', 'DESC')->get();

    // Get all permissions
    $data['permission'] = Permission::orderBy('permission_id', 'ASC')->get();

    // Get permission IDs already assigned to the employee's role
    $data['assigned_permission_ids'] = DB::table('role_permissions')
        ->where('role_id', $data['employee']->role_id)
        ->pluck('permission_id')
        ->toArray();

    $data['title'] = "Role Permission";
    $data['heading'] = "Role Permission";

    return view('admin.employee.empPermission', compact('data'));
}

 public function empgivepermission(Request $request)
{
   
     $validator=Validator::make($request->all(),[
        'permission_id' => 'required'
       ],[
        'permission_id.required' => 'Please select at least one permission'
       ]);

       if($validator->fails())
       {
        return redirect()->back()->withErrors($validator)->withInput();
       }
    $roleId = $request->role_id;
    $permissions = explode(',',$request['permission_id']);
    RolePermission::where('role_id', $roleId)->delete();
    if (!empty($permissions)) {
        foreach ($permissions as $permissionId) {
            $rolePermission = new RolePermission();
            $rolePermission->role_id = $roleId;
            $rolePermission->permission_id = $permissionId;
            $rolePermission->created_at = Carbon::now();
            $rolePermission->save();
        }

        return redirect()->route('employee')->with('success', 'Role permissions updated successfully.');
    } else {
        return redirect()->route('employee')->with('error', 'No permissions selected. Existing permissions have been removed.');
    }
}

}
