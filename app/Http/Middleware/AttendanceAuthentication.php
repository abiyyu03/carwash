<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AttendanceAuthentication
{
    public function handle(Request $request, Closure $next)
    {
        if(!Auth()->check())
        {
            return redirect()->to('/attendance/login');
        }
        if(Auth()->user()->role->role_name !== "owner")
        {
            return $next($request);
        }
        return redirect()->back();
    }
}
