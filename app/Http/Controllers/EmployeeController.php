<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use DataTables;

class EmployeeController extends Controller
{
    function employeeJson(Request $request)
    {
        if($request->ajax()){
            $employee_data = Employee::get();
            return Datatables::eloquent($employee_data)->make(true);
                // ->addColumn('productCategory',function (Product $product){
                //     return $product->productCategory->category_name;
                // })
                // ->toJson();
        }
    }
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
        return redirect()->back()->with('success','Data Karyawan berhasil ditambahkan');
    }
}
