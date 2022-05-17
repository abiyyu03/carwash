<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Alert;

class LoginController extends Controller
{
    public function login()
    {
        //check if user have already logged in
        if(Auth()->check()){
            return back();
        } else {
            return view('auth.login');
        }   
    }
    public function login_process(Request $request)
    {
        $data = $request->only('email','password');
        if(Auth()->attempt($data))
        {
            //check roles
            // if(Auth()->user()->role->role_name == 'owner'){
            //     return redirect()->to('/');
            // }elseif(Auth()->user()->role->role_name == 'cashier'){
            //     return redirect()->to('/');
            // }elseif(Auth()->user()->role->role_name == 'supervisor'){
            //     return redirect()->to('/');
            // }
            return redirect()->to('/');
        } 
        //back if wrong username or password
        Alert::warning('Warning','Username atau Password salah');
        return redirect()->back();
    }
    
    function logout()
    {
        Auth()->logout();
        return redirect()->to('/login');
    }


    // public function login_owner()
    // {
    //     //check if user have already logged in
    //     if(Auth()->guard('owner')->check()){
    //         return redirect()->back();
    //     } else {
    //         return view('auth.login');
    //     }   
    // }
    // public function login_owner_process(Request $request)
    // {
    //     $data = $request->only('email','password');
    //     if(Auth()->guard('owner')->attempt($data))
    //     {
    //         //check roles
    //         // if(Auth()->user()->role->role_name == 'owner'){
    //         //     return redirect()->to('/');
    //         // }elseif(Auth()->user()->role->role_name == 'cashier'){
    //             //     return redirect()->to('/');
    //         // }elseif(Auth()->user()->role->role_name == 'supervisor'){
    //         //     return redirect()->to('/');
    //         // }
    //         return redirect()->to('/');
    //     } 
    //     //back if wrong username or password
    //     return redirect()->back()->with('message','Username atau password belum sesuai');
    // }
    // public function logout_owner()
    // {
    //     Auth()->guard('owner')->logout();
    //     return redirect()->to('/login');
    // }

    // public function login_supervisor()
    // {
    //     //check if user have already logged in
    //     if(Auth()->check()){
    //         return redirect()->back();
    //     } else {
    //         return view('auth.login');
    //     }   
    // }
    // public function login_supervisor_process(Request $request)
    // {
    //     $data = $request->only('email','password');
    //     if(Auth()->attempt($data))
    //     {
    //         //check roles
    //         // if(Auth()->user()->role->role_name == 'owner'){
    //             //     return redirect()->to('/');
    //         // }elseif(Auth()->user()->role->role_name == 'cashier'){
    //         //     return redirect()->to('/');
    //         // }elseif(Auth()->user()->role->role_name == 'supervisor'){
    //             //     return redirect()->to('/');
    //         // }
    //         return redirect()->to('/');
    //     } 
    //     //back if wrong username or password
    //     return redirect()->back()->with('message','Username atau password belum sesuai');
    // }
    // public function logout_supervisor()
    // {
    //     Auth()->logout();
    //     return redirect()->to('/login');
    // }
    
    // public function login_cashier()
    // {
    //     //check if user have already logged in
    //     if(Auth()->guard('cashier')->check()){
    //         return redirect()->back();
    //     } else {
    //         return view('auth.login');
    //     }   
    // }
    // public function login_cashier_process(Request $request)
    // {
    //     $data = $request->only('email','password');
    //     if(Auth()->guard('cashier')->attempt($data))
    //     {
    //         //check roles
    //         // if(Auth()->user()->role->role_name == 'owner'){
    //             //     return redirect()->to('/');
    //         // }elseif(Auth()->user()->role->role_name == 'cashier'){
    //         //     return redirect()->to('/');
    //         // }elseif(Auth()->user()->role->role_name == 'supervisor'){
    //         //     return redirect()->to('/');
    //         // }
    //         return redirect()->to('/');
    //     } 
    //     //back if wrong username or password
    //     return redirect()->back()->with('message','Username atau password belum sesuai');
    // }
    // public function logout_cashier()
    // {
    //     Auth()->guard('cashier')->logout();
    //     return redirect()->to('/login');
    // }
}

