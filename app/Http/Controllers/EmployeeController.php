<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Employee, User, Role, WorkDetail, TransactionDetail};
use Illuminate\Support\Facades\DB;
use DataTables;
use Alert;
use Image;
use App\Actions\Employee\{StorePhotoAction, StoreUserAction, EmployeeAction};

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
      $employee_data = $this->employee_data->get();
      $role_data = Role::where('role_name','!=','owner')->get();
      return view('employee.index',compact('role_data','employee_data'));
    }

    function store(Request $request, EmployeeAction $EmployeeAction)
    {
        $employee_data = $request->validate([
            'employee_fullname' => ['required'],
            // 'employee_nickname' => ['required'],
            // 'employee_nik' => ['required'],
            'employee_gender' => ['required'],
            // 'employee_birthdate' => ['required'],
            // 'employee_photo' => ['required'],
            'employee_contact' => ['required'],
            'employee_email' => ['required'],
            // 'employee_address' => ['required']
        ]);

        $user_data = $request->validate([
            // 'name' => ['required'],
            // 'email' => ['required'],
            'password' => ['required'],
            'role_id' => ['required'],
        ]);

        DB::transaction(function() use ($request, $user_data, $employee_data, $EmployeeAction){
            $EmployeeAction->store($request);
        });
        Alert::success('Sukses','Data Karyawan berhasil ditambahkan !');
        return redirect()->back();
    }

    function delete($id_employee)
    {
        DB::transaction(function() use ($id_employee){
            $employee_data = $this->employee_data->find($id_employee);
            
            $user_data = User::find($employee_data->user_id);
            if($user_data->employee_image != NULL){
                unlink(public_path('/img/employee/'.$employee_data->employee_photo));
            }

            $employee_data->delete();
            $user_data->delete();
        });
        Alert::success('Sukses','Data Karyawan berhasil dihapus !');
        return redirect()->back();
    }

    function update(Request $request, EmployeeAction $EmployeeAction, $id_employee)
    {
        DB::transaction(function() use ($request, $EmployeeAction, $id_employee){
            $EmployeeAction->update($request, $id_employee);
        });
        Alert::success('Sukses','Data Karyawan berhasil diubah !');
        return redirect()->back();
    }


}
