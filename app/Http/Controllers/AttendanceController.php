<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Attendance, Employee};
use DataTables;
use Alert;

class AttendanceController extends Controller
{
    // function login()
    // {
    //     if(!Auth()->check())
    //     {
    //         return view('attendance.auth.login');
    //     } else {
    //         Alert::warning('Warning','Silahkan Logout dahulu di akun sebelumnya');
    //         return redirect()->to('/attendance/login');
    //     }

    // }

    // function loginProcess(Request $request)
    // {
    //     $data = $request->only('email','password');
    //     if(Auth()->attempt($data))
    //     {
    //         //check roles
    //         // if(Auth()->user()->role->role_name !== 'owner'){
    //             return redirect()->to('/attendance');
    //         // }
    //     } 
    //     //back if wrong username or password
    //     Alert::warning('Warning','Username atau Password salah');
    //     return redirect()->back();
    // }

    // function logoutAttendance()
    // {
    //     Auth()->guard('attendance')->logout();
    //     // return redirect()->to('/);
    // }

    // function attendance()
    // {
    //     return view('attendance.attendance');
    // }

    // function index()
    // {
    //     return view ('attendance.index');
    // }

    function index()
    {
        if(request()->ajax()){
            if(!empty(request()->form_date))
            {
                $attendance_data = Attendance::with('employee')
                    ->whereBetween('attendance_date',[request()->form_date, request()->to_date])
                    ->get();
            } else {
                $attendance_data = Attendance::with('employee')->get();
            }
            return DataTables::of($attendance_data)
                        ->addIndexColumn()
                        ->toJson();
        }
        return view('attendance.index');
    }


}
