<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{User, Role};

class RegisterController extends Controller
{
    function index()
    {
        $role_data = Role::get();
        return view('auth.register',compact('role_data'));
    }

    function store(Request $request)
    {
        $user_data = $request->validate([
            'name' => ['required'],
            'email' => ['required','unique:users','email','max:255'],
            'password' => ['required'],
            'role_id' => ['required']
        ]);
        
        // $user_data = User::create([
        //     'id_user' => rand(),
        //     'name' => $request->name,
        //     'email' => $request->email,
        //     'password' => Hash::make($request->password),
        //     'role_id' => $request->role_id
        // ]);
        $user_data = new User();
        $user_data->id_user = rand();
        $user_data->name = $request->get('name');
        $user_data->email = $request->get('email');
        $user_data->password = bcrypt($request->get('password'));
        $user_data->role_id = $request->get('role_id');
        $user_data->save();

        return redirect()->back()->with('success','Akun Berhasil didaftarkan');
    }
}
