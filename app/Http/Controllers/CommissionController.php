<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Employee, User, Role, WorkDetail, TransactionDetail,Config};
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use DataTables;
use PDF;

class CommissionController extends Controller
{
    function __construct()
    {
        date_default_timezone_set('Asia/Jakarta');
    }

    function index()
    {
        $workDetail_data = WorkDetail::with('employee')
                ->groupBy('employee_id')
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
        
        return view('employee.commission');
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

    function commissionJson()
    {
        $workDetail_data = WorkDetail::with('employee','transactionDetail')
            ->groupBy('employee_id')
            ->selectRaw('employee_id, sum(commission) as commission')
            ->get();
        // if(request()->ajax()){
        return DataTables::of($workDetail_data)
            ->addIndexColumn()
            ->addColumn('id_employee',function (WorkDetail $workDetail){
                return $workDetail->employee->id_employee;
            })
            ->addColumn('employee_fullname',function (WorkDetail $workDetail){
                return $workDetail->employee->employee_fullname;
            })
            // ->editColumn('action', function(WorkDetail $workDetail){
                //     return '<a href="/work-detail/delete/'.$workDetail->id_work_detail.'" class="btn btn-info editButton" id="editButton"><i class="fas fa-pencil-alt"></i> Edit</a>
                //     <a href="/work-detail/delete/'.$workDetail->id_work_detail.'" class="btn btn-danger" id="deleteButton"><i class="fas fa-trash-alt"></i> Hapus</a>';
                // })
            ->toJson();
        // }
    }

    function commissionExportPDF()
    {
        $config_data = Config::first();
        $data = json_decode(json_encode($this->commissionJson()),true);
        $commission_data = $data['original']['data'];
        $pdf = PDF::loadView('employee.export.commission-pdf',compact('commission_data','config_data'))
            ->setOptions(['defaultFont' => 'sans-serif']);
            // ->setPaper('a4', 'landscape');
        return $pdf->stream();
    }

    function trackRecord($id_employee)
    {
        $workDetail_data = WorkDetail::where('employee_id',$id_employee)->get();
        $employee_data = Employee::find($id_employee);
        return view('employee.track-record',compact('workDetail_data','employee_data'));
    }
}
