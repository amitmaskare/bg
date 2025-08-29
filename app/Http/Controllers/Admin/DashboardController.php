<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Session;
use App\Models\{Order,Employee};
class DashboardController extends Controller
{
    
    public function index()
    {
   // $lastMonthStart = Carbon::now()->subMonth()->startOfMonth();
     $lastMonthStart = Carbon::now()->startOfMonth();
   // $lastMonthEnd = Carbon::now()->subMonth()->endOfMonth();
     $lastMonthEnd = Carbon::now()->endOfMonth();

    $lastMonthProductCount = DB::table('listing_products')
        ->whereBetween('created_at', [$lastMonthStart, $lastMonthEnd])
        ->count();
    $lastMonthMessageCount = DB::table('messages')
        ->whereBetween('created_at', [$lastMonthStart, $lastMonthEnd])
        ->count();
    $totalOrderAmountLastMonth = DB::table('orders')
        ->whereBetween('created_at', [$lastMonthStart, $lastMonthEnd])
        ->sum('total_amount');
        $orders = Order::orderBy('id', 'desc')->limit('5')->get(); 

        $employee = Employee::join('roles', 'employees.role_id', '=', 'roles.role_id')
        ->orderBy('employees.id', 'desc')
        ->limit(5)
        ->select('employees.*', 'roles.name as role_name') // optional: select role name
        ->get(); 
        
       return view('admin.dashboard',[
       'lastMonthProductCount' => $lastMonthProductCount,
        'lastMonthMessageCount' => $lastMonthMessageCount,
        'totalOrderAmountLastMonth' => $totalOrderAmountLastMonth,
        'orders' => $orders,
        'employee' => $employee,
        
    ]);
    }


    

}
