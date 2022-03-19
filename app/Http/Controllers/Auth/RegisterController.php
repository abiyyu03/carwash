<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{User, Role};

class RegisterController extends Controller
{
    function register()
    {
        $roles_data = Role::get();
        return view('auth.register',compact('roles_data'));
    }

    function register_process()
    {
        $data = new User();
        $data->name = request()->get('name');
        $data->email = request()->get('email');
        $data->password = bcrypt(request()->get('password'));
        $data->role_id = request()->get('role_id');
        dd($data);
    }
}
