<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttendanceStart extends Model
{
    use HasFactory;
    protected $table = "attendance_starts";
    protected $fillable = ['attendance_start','attendance_schedule_id'];
    protected $primaryKey = "id_attendance_start";

    function attendanceSchedule()
    {
        return $this->belongsTo('App\Models\AttendanceSchedule','attendance_schedule_id');
    }
    function attendanceStatuses()
    {
        return $this->hasMany('App\Models\AttendanceStatus');
    }
}
