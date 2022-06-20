<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{AttendanceStart, AttendanceLeave, AttendanceSchedule, AttendanceStatus, Employee};
use DataTables;
use PDF;
use Alert;

class AttendanceController extends Controller
{
    function index()
    {
        return view ('attendance.index');
    }

    function attendanceJson()
    {
        if(request()->ajax()){
            if(!empty(request()->form_date))
            {
                $attendance_data = AttendanceStatus::with('attendanceStart','attendanceLeave','attendanceSchedule','employee')
                // ->whereBetween('attendance_date',[request()->form_date, request()->to_date])
                ->get();
            } else {
                $attendance_data = AttendanceStatus::with('attendanceStart','attendanceLeave','attendanceSchedule','employee')->get();
            }
            return DataTables::of($attendance_data)
                ->addIndexColumn()
                ->addColumn('start',function (AttendanceStatus $attendanceStatus){
                    return $attendanceStatus->attendanceStart->attendance_start;
                })
                ->addColumn('leave',function (AttendanceStatus $attendanceStatus){
                    return $attendanceStatus->attendanceLeave->attendance_leave;
                })
                ->addColumn('schedule',function (AttendanceStatus $attendanceStatus){
                    return \Carbon\Carbon::parse($attendanceStatus->attendanceSchedule->attendance_date)->isoFormat('dddd, D MMMM Y');
                })
                ->addColumn('employee',function (AttendanceStatus $attendanceStatus){
                    return $attendanceStatus->employee->employee_fullname;
                })
                // ->editColumn('schedule', function(AttendanceStatus $attendanceStatus){
                //     return $attendanceStatus->attendanceSchedule->attendance_date ? with(new Carbon($attendanceStatus->attendanceSchedule->attendance_date))->isoFormat('dddd, D MMMM Y')/*->diffForHumans()*/ : '';
                // })
                ->toJson();
        }
        // return view('attendance.index');
    }

    function printPDFReport()
    {
        // return $this->attendanceJson();
        $attendance_data = AttendanceStatus::with('attendanceStart','attendanceLeave','attendanceSchedule','employee')->get();
        return DataTables::of($attendance_data)
                ->addIndexColumn()
                ->addColumn('start',function (AttendanceStatus $attendanceStatus){
                    return $attendanceStatus->attendanceStart->attendance_start;
                })
                ->addColumn('leave',function (AttendanceStatus $attendanceStatus){
                    return $attendanceStatus->attendanceLeave->attendance_leave;
                })
                ->addColumn('schedule',function (AttendanceStatus $attendanceStatus){
                    return \Carbon\Carbon::parse($attendanceStatus->attendanceSchedule->attendance_date)->isoFormat('dddd, D MMMM Y');
                })
                ->addColumn('employee',function (AttendanceStatus $attendanceStatus){
                    return $attendanceStatus->employee->employee_fullname;
                })
                // ->editColumn('schedule', function(AttendanceStatus $attendanceStatus){
                //     return $attendanceStatus->attendanceSchedule->attendance_date ? with(new Carbon($attendanceStatus->attendanceSchedule->attendance_date))->isoFormat('dddd, D MMMM Y')/*->diffForHumans()*/ : '';
                // })
                ->toJson();
        // $pdf = PDF::loadView('attendance.report', $data);
        // return $pdf->download('invoice.pdf');
    }


}
