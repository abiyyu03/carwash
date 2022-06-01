<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Attendance, Employee};
use DataTables;

class AttendanceController extends Controller
{
    function login()
    {
        return view('attendance.auth.login');
    }

    function loginProcess()
    {
        
    }

    function index()
    {
        return view ('attendance.index');
    }

    function attendanceJson()
    {
        $attendance_data = Attendance::with('employee')->get();
        return Datatables::of($attendance_data)
                    ->addIndexColumn()
                    ->make(true);
    }
}
