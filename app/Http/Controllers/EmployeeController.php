<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Employee, User, Role};
use DataTables;

class EmployeeController extends Controller
{
    function employeeJson(Request $request)
    {
        if($request->ajax()){
            $employee_data = Employee::get();
            return Datatables::of($employee_data)
                ->addIndexColumn()
                ->make(true);
                // ->addColumn('productCategory',function (Product $product){
                //     return $product->productCategory->category_name;
                // })
                // ->toJson();
        }
    }
    function index()
    {
      $role_data = Role::get();
      return view('employee.index',compact('role_data'));
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

        $user_data = $request->validate([
            'name' => ['required'],
            'email' => ['required'],
            'password' => ['required'],
            'role_id' => ['required'],
        ]);

        $image = $request->file('employee_photo');
        $filename = $image->getClientOriginalName();

        $image->move(public_path().'/img/img_temp/',$filename);
        $image_compressed = Image::make(public_path().'/img/img_temp/'.$filename);
        $image_compressed->fit(240,120);
        $image_compressed->save(public_path('/img/employee/'.$filename));
        unlink(public_path('/img/img_temp/'.$filename));

        $employee_data = new Employee();
        $employee_data->employee_fullname = $request->get('employee_fullname');
        $employee_data->employee_nickname = $request->get('employee_nickname');
        $employee_data->employee_nik = $request->get('employee_nik');
        $employee_data->employee_gender = $request->get('employee_gender');
        $employee_data->employee_birthdate = $request->get('employee_birthdate');
        $employee_data->employee_photo = $filename;
        $employee_data->employee_contact = $request->get('employee_contact');
        $employee_data->employee_email = $request->get('employee_email');
        $employee_data->employee_address = $request->get('employee_address');
        $employee_data->save();

        $user_data = new User();
        $user_data->id_user = rand();
        $user_data->name = $request->get('employee_fullname');
        $user_data->email = $request->get('employee_email');
        $user_data->password = bcrypt($request->get('password'));
        $user_data->role_id = $request->get('role_id');
        $user_data->save();
        // Employee::create($employee_data);
        return redirect()->back()->with('success','Data Karyawan berhasil ditambahkan');
    }
}
