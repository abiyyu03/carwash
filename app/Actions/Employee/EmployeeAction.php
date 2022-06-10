<?php
namespace App\Actions\Employee;

use Illuminate\Http\Request;
use App\Models\{Employee, User, Role, WorkDetail, TransactionDetail};
use App\Actions\Employee\{StoreUserAction, StorePhotoAction};
use Carbon\Carbon;

class EmployeeAction
{
    function __construct()
    {
        date_default_timezone_set('Asia/Jakarta');
        $this->employee = new Employee();
        $this->storeUserAction = new StoreUserAction();
        $this->storeEmployeeImage = new StorePhotoAction();
    }
    function store(Request $request)
    {   
        //save user data
        $this->storeUserAction->execute($request);
        
        //save image 
        $this->storeEmployeeImage->executeEmployee($request);

        $this->employee->id_employee = $this->generateIdEmployee();
        $this->employee->user_id = $this->storeUserAction->user->id_user;
        $this->employee->employee_fullname = $request->employee_fullname;
        $this->employee->employee_nickname = $request->employee_nickname;
        $this->employee->employee_nik = $request->employee_nik;
        $this->employee->employee_gender = $request->employee_gender;
        $this->employee->employee_birthdate = $request->employee_birthdate;
        $this->employee->employee_photo = $this->storeEmployeeImage->filename;
        $this->employee->employee_contact = $request->employee_contact;
        $this->employee->employee_email = $request->employee_email;
        $this->employee->employee_address = $request->employee_address;
        $this->employee->save();
    }

    function generateIdEmployee()
    {
        //date for generate id_employee
        $date = Carbon::now();

        return $id_employee = strtoupper(substr($this->storeUserAction->roleName(),0,1)).
                $date->year.
                $date->month.
                $date->day.
                $date->hour.
                $date->minute.
                $date->second;
    }

    function update(Request $request, $id_employee)
    {
        $employee_data = Employee::findOrFail($id_employee);
        // $employee_data->id_employee = $this->generateIdEmployee();
        // $employee_data->user_id = $this->storeUserAction->user->id_user;
        $employee_data->employee_fullname = $request->employee_fullname;
        $employee_data->employee_nickname = $request->employee_nickname;
        $employee_data->employee_nik = $request->employee_nik;
        $employee_data->employee_gender = $request->employee_gender;
        $employee_data->employee_birthdate = $request->employee_birthdate;
        // $employee_data->employee_photo = $this->storeEmployeeImage->filename;
        $employee_data->employee_contact = $request->employee_contact;
        $employee_data->employee_email = $request->employee_email;
        $employee_data->employee_address = $request->employee_address;
        $employee_data->save();
    }
}