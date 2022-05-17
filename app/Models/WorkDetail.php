<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkDetail extends Model
{
    use HasFactory;
    protected $table = "work_details";
    protected $primaryKey = "id_work_detail";
    protected $fillable = ['employee_id','commission','transaction_detail_id','date'];

    function employee()
    {
        return $this->belongsTo('App\Models\Employee','employee_id');
    }

    function transactionDetail()
    {
        return $this->belongsTo('App\Models\TransactionDetail','transaction_detail_id');
    }
}
