<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Attendance extends Authenticatable
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
