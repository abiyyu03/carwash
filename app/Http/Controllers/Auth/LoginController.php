<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function loginCashier()
    {
        return view('cashier.auth.login');
    }

    public function loginOwner()
    {
        return view('owner.auth.login');
    }

    public function authCashier(Request $request)
    {
        $data = $request->only('email','password');
        dd($data);
        // if(Auth()->attempt($data))
        // {
        //     return redirect()->route('/owner');
        // }
    }
    
    public function authOwner(Request $request)
    {
        $data = $request->only('email','password');
        dd($data);
        // if(Auth()->attempt($data))
        // {
        //     return redirect()->route('/owner');
        // }
    }
}
