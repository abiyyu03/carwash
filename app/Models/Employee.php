<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    protected $table = "employees";
    protected $primaryKey = "id_employee";
    protected $fillable = [
        'id_employee','employee_fullname','employee_nickname',
        'employee_nik','employee_birthdate','employee_photo',
        'employee_gender','employee_contact','employee_email','employee_address'
    ];

    function user()
    {
        return $this->belongsTo('App\Models\user','user_id');
    }

    function transactions()
    {
        return $this->hasMany('App\Models\Transaction');
    }
}
