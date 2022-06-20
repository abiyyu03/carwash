<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttendanceSchedule extends Model
{
    use HasFactory;
    protected $table = "attendance_schedules";
    protected $fillable = ['attendance_date'];
    // protected $casts = ['id_attendance_schedule' => 'integer'];
    // public $incrementing = false;
    protected $primaryKey = "id_attendance_schedule";

    function attendanceStarts()
    {
        return $this->hasMany('App\Models\AttendanceStart');
    }

    function attendanceLeaves()
    {
        return $this->hasMany('App\Models\AttendanceLeave');
    }
    
    function attendanceSchedules()
    {
        return $this->hasMany('App\Models\AttendanceSchedule');
    }
}
