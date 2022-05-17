<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckRole
{
    public function handle(Request $request, Closure $next, $role)
    {
        if(!Auth()->check())
        {
            return redirect()->to('login');
        }
        
        // $user = Auth()->user();
        if(!Auth()->user()->role->role_name == $role)
        {
            return redirect()->to('login');
        }
        return $next($request);
    }
}
