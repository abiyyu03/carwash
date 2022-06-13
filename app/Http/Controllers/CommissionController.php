<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Employee, User, Role, WorkDetail, TransactionDetail};
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CommissionController extends Controller
{
    function __construct()
    {
        date_default_timezone_set('Asia/Jakarta');
    }

    function index()
    {
        $totalCommission = $this->getTotalCommission();
        $workDetail_data = WorkDetail::with('employee')->groupBy('employee_id')
                ->selectRaw('employee_id, sum(commission) as commission')
                ->get();
        // $employee_data = Employee::pluck('employee_fullname');
        // $employee_data2 = Employee::pluck('id_employee');
        // $employee_data3 = WorkDetail::pluck('date');
        // // dd($employee_data3);
        // // dd(Carbon::today()->isoFormat('Y-MM-D'));
        // $arr = [];
        // for ($i=0; $i < count($employee_data); $i++) { 
        //     $arr[] = [
        //         'nip' => $employee_data2[$i],
        //         'name' => $employee_data[$i],
        //         // 'created_at' => $employee_data3[$i],
        //         'date' => @$employee_data3[$i],
        //         'commission' => $commission_data[$i]
        //     ];
        // }
        
        return view('employee.commission',compact('workDetail_data','totalCommission'));
    }

    function getTotalCommission()
    {
        $total = 0;
        $workDetail_data = WorkDetail::groupBy('employee_id')
                ->selectRaw('employee_id, sum(commission) as commission')
                ->get();
        foreach ($workDetail_data as $workDetail) {
            $total += $workDetail->commission;
        }
        return $total;
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
