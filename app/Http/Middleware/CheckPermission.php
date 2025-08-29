<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Auth;
class CheckPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
   public function handle(Request $request, Closure $next, $permission)
    {   
       
         if (!Auth::guard('admin')->check()) {
        return redirect()->route('login');
    }
    $employee = Auth::guard('admin')->user();
     if ($employee->hasPermission($permission)) {
        return $next($request);
    }
    
    abort(403, 'Unauthorized action.');
}
}