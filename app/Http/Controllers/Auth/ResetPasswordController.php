<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Alert;

class ResetPasswordController extends Controller
{
    function sendResetPassword()
    {
        request()->validate(['email' => 'required|email']);
        
        $status = Password::sendResetLink(
            request()->only('email')
        );
        // dd(__($status));
        return $status === Password::RESET_LINK_SENT
            ? back()->with(['status' => __($status)])
            : back()->withErrors(['email' => __($status)]);
    }

    function getResetPassword()
    {
        return view('auth.forgot-password');
    }

    function getResetPasswordToken($token)
    {
        return view('auth.reset-password', ['token' => $token]);
    }

    function processResetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                    ])->setRememberToken(Str::random(60));
                    
                    $user->save();
                    
                    event(new PasswordReset($user));
            }
        );
     
        return $status === Password::PASSWORD_RESET
                    ? redirect()->to('login')->with('status','Password sukses direset, silahkan login')
                    : back()->withErrors(['email' => [__($status)]]);
    }
}
