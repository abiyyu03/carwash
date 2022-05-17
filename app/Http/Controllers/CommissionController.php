<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Employee, User, Role, WorkDetail, TransactionDetail};
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CommissionController extends Controller
{
    function index()
    {
        date_default_timezone_set('Asia/Jakarta');
        $commission_data = $this->getCommission();
        $employee_data = Employee::pluck('employee_fullname');
        $employee_data2 = Employee::pluck('id_employee');
        $employee_data3 = WorkDetail::pluck('date');
        // dd($employee_data3);
        // dd(Carbon::today()->isoFormat('Y-MM-D'));
        $arr = [];
        for ($i=0; $i < count($employee_data); $i++) { 
            $arr[] = [
                'nip' => $employee_data2[$i],
                'name' => $employee_data[$i],
                // 'created_at' => $employee_data3[$i],
                'date' => @$employee_data3[$i],
                'commission' => $commission_data[$i]
            ];
        }
        // $employee_data = Employee::pluck('employee_fullname')->where('employee_fullname','Fitrah')->map(function($employee_fullname, $index) use ($commission_data){
        //     return [
        //         $employee_fullname,
        //         $commission_data[$index]
        //     ];
        // });
        
        // for ($i=0; $i < count($arr); $i++) { 
        //     $hihi[] = [
        //         0 => $merged[$i]['nip'],
        //         1 => $merged[$i]['name'],
        //         2 => $merged[$i]['commission'],
        //     ];
        // }
        // dd($hihi);
        return view('employee.commission',compact('arr'));
    }

    function getCommission()
    {
        $commission = [];
        $employee_data = Employee::with('user')->get();
        foreach ($employee_data as $employee) {
            $commission[] = $this->setCommission($employee->id_employee);
        }
        return $commission;
    }

    function setCommission($id_employee)
    {
        // $workDetail_data = WorkDetail::whereHas('employee', function($query, ){ 
        //     $query->where('employee_id',$id_employee); 
        // })->sum('commission');
        $workDetail_data = WorkDetail::select('employee_id','commission')
                ->where('employee_id',$id_employee)
                ->sum('commission');
        // dd($workDetail_data);
        return $workDetail_data;
    }

    function commissionJson(Request $request)
    {
        if($request->ajax()){
            $workDetail_data = WorkDetail::get();
        //     $workDetail_data = WorkDetail::whereHas('employee', function($query){ 
        //     $query->where('employee_id',request()->route('id_transaction')); 
        // })->get();
            return Datatables::of($workDetail_data)
                ->addIndexColumn()
                ->addColumn('employee',function (WorkDetail $workDetail){
                    return $workDetail->employee->id_employee;
                })
                ->addColumn('employee_fullname',function (WorkDetail $workDetail){
                    return $workDetail->employee->employee_fullname;
                })
                ->make(true);
        }
    }
}
