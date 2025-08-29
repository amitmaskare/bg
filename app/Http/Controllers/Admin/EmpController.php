<?php
namespace App\Http\Controllers\Admin;
namespace App\Http\Controllers;
use App\Models\Employee;    
use Illuminate\Http\Request;

class EmpController extends Controller
{
    public function index()
    {
        $employee = Employee::latest()->get();
        return view('admin.employee.emplist', compact('employee'));
    }
}
