<?php
namespace App\Http;
use Illuminate\Foundation\Http\Kernel as HttpKernel;
class Kernel extends HttpKernel
{
   protected $routeMiddleware = [
    'permission' => \App\Http\Middleware\CheckPermission::class,
    'auth.admin' => \App\Http\Middleware\AdminAuthenticate::class,
    ];
}


?>