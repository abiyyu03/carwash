<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;

class EmployeeController extends Controller
{
    function index()
    {
        return view('employee.index');
    }

    function store(Request $request)
    {
        $employee_data = $request->validate([
            'employee_fullname' => ['required'],
            'employee_nickname' => ['required'],
            'employee_nik' => ['required'],
            'employee_gender' => ['required'],
            'employee_birthdate' => ['required'],
            'employee_photo' => ['required'],
            'employee_contact' => ['required'],
            'employee_email' => ['required'],
            'employee_address' => ['required']
        ]);
        Employee::create($employee_data);
        dd($employee_data);
    }
}
