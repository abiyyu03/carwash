<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Employee, User, Role, WorkDetail, TransactionDetail};
use Illuminate\Support\Facades\DB;
use DataTables;
use Alert;
use Image;
use App\Actions\Employee\{StorePhotoAction, StoreUserAction, StoreEmployeeAction};

class EmployeeController extends Controller
{
    function __construct()
    {
        $this->employee_data = Employee::with('user');
    }
    function employeeJson(Request $request)
    {
        if($request->ajax()){
            $employee_data = $this->employee_data->get();
            return Datatables::of($employee_data)
                ->addIndexColumn()
                ->make(true);
        }
    }
    function index()
    {
      $role_data = Role::get();
      return view('employee.index',compact('role_data'));
    }

    function store(Request $request, StoreEmployeeAction $storeEmployeeAction)
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
            // 'name' => ['required'],
            // 'email' => ['required'],
            'password' => ['required'],
            'role_id' => ['required'],
        ]);

        DB::transaction(function() use ($request, $user_data, $employee_data, $storeEmployeeAction){
            $storeEmployeeAction->execute($request);
        });
        Alert::success('Sukses','Data Karyawan berhasil ditambahkan !');
        return redirect()->back()->with('success','Data Karyawan berhasil ditambahkan');
    }

    function delete($id_employee)
    {
        DB::transaction(function() use ($id_employee){
            $employee_data = $this->employee_data->find($id_employee);
            
            $user_data = User::find($employee_data->user_id);
            unlink(public_path('/img/employee/'.$employee_data->employee_photo));

            $employee_data->delete();
            $user_data->delete();
        });
        Alert::success('Sukses','Data Karyawan berhasil dihapus !');
        return redirect()->back();
    }


}
