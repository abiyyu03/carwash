<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;
    protected $table = "attendances";
    protected $primaryKey = "id_attendance";
    protected $fillable = ['employee_id','attendance_date','attendance_time','attendance_status','photo'];

    function employee()
    {
        return $this->belongsTo('App\Models\Employee','employee_id');
    }
}
