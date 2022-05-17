<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $table = "transactions";
    protected $primaryKey = "id_transaction";
    protected $casts = ['id' => 'string'];
    public $incrementing = false;
    protected $fillable = ['id_transaction','customer_id','employee_id','transaction_timestamp','transaction_status','transaction_grandtotal'];

    function customer()
    {
        return $this->belongsTo('App\Models\Customer','customer_id');
    }

    function transactionDetails()
    {
        return $this->hasMany('App\Models\TransactionDetail');
    }

    function employee()
    {
        return $this->belongsTo('App\Models\Employee','employee_id');
    }
}
