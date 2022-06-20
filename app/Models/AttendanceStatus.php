<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttendanceStatus extends Model
{
    use HasFactory;
    protected $table = "attendance_statuses";
    protected $fillable = ['attendance_schedule_id','attendance_start_id','attendance_leave_id','employee_id','attendance_status','photo'];
    protected $primaryKey = "id_attendance_status";
    
    function employee()
    {
        return $this->belongsTo('App\Models\Employee','employee_id');
    }
    function attendanceStart()
    {
        return $this->belongsTo('App\Models\AttendanceStart','attendance_start_id');
    }
    function attendanceLeave()
    {
        return $this->belongsTo('App\Models\AttendanceLeave','attendance_leave_id');
    }
    function attendanceSchedule()
    {
        return $this->belongsTo('App\Models\AttendanceSchedule','attendance_schedule_id');
    }
}
