<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionDetail extends Model
{
    use HasFactory;
    protected $table = "transaction_details";
    protected $primaryKey = "id_transaction_detail";
    public $incrementing = false;
    // protected $casts = ['id'=>'integer'];
    protected $fillable = ['transaction_detail_amount','transaction_detail_price','transaction_detail_date','transaction_detail_total','transaction_id','product_id'];

    function transaction()
    {
        return $this->belongsTo('App\Models\Transaction','transaction_id');
    }

    function product()
    {
        return $this->belongsTo('App\Models\Product','product_id');
    }

    function workDetails()
    {
        return $this->hasMany('App\Models\WorkDetail');
    }
}
