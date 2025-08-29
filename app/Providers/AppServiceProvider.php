<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use App\Models\Setting;
use Illuminate\Support\Facades\View;
use Auth;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
      Blade::if('admincan', function ($permissions) {
    $admin = Auth::guard('admin')->user();
    //dd($admin->designationId);
    if (!$admin) {
        return false;
    }

    $permissions = is_array($permissions) ? $permissions : func_get_args();
      if ($admin->designationId=='admin') {
                return true;
            }
    foreach ($permissions as $permission) {
        if ($admin->hasPermission($permission)) {
            return true;
        }
    }
    
    return false;
});

  $setting = Setting::first(); // or where('id', 1)->first();
    View::share('setting', $setting);
    }
}
