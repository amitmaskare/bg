<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Employee;    
use Illuminate\Http\Request;

class AddEmpoyeeController extends Controller
{
    public function index()
    {
        $employee = Employee::latest()->get();
        return view('admin.employee.emplist', compact('employee'));
    }
}
