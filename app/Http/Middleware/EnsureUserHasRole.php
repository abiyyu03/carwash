<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EnsureUserHasRole
{
    public function handle(Request $request, Closure $next, ... $roles)
    {
        if(!Auth()->check())
        {
            return redirect()->to('login');
        }
        
        // $user = Auth()->user();
        // if(!Auth()->user()->role->role_name == $role)
        // {
        //     return redirect()->to('login');
        // }
        // foreach ($roles as $role) {
        //     if($this->hasRole($role)) return $next($request);
        // }
        // return redirect()->to('login');
        // $role = Auth()->user()->role->role_name;
        // dd($roles);
        $user = Auth()->user();

        foreach ($roles as $role) {
            if($user->hasRole($role)) {
                return $next($request);
            }
            // dd($role);
            // if($role->role_name == $roles) return $next($request);
        }
        return redirect()->to('login');
    }
}