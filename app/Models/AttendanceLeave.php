<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttendanceLeave extends Model
{
    use HasFactory;
    protected $table = "attendance_leaves";
    protected $fillable = ['attendance_leave','attendance_schedule_id'];
    protected $casts = ['id'=>'integer'];
    protected $primaryKey = "id_attendance_leave";
    
    function attendanceSchedule()
    {
        return $this->belongsTo('App\Models\AttendanceSchedule','attendance_schedule_id');
    }
    function attendanceStatuses()
    {
        return $this->hasMany('App\Models\AttendanceStatus');
    }
}
