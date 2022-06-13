<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commission extends Model
{
    use HasFactory;
    protected $table = "commissions";
    protected $primaryKey = "id_commission";
    protected $fillable = ['id_commission','commission','employee_id'];

    function employee()
    {
        return $this->belongsTo('App\Models\Employee');
    }
}
