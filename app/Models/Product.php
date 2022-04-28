<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = "products";
    protected $primaryKey = "id_product";
    protected $fillable = ['product_name','product_code','product_description','product_stock','image','product_category_id'];

    function productCategory()
    {
        return $this->belongsTo('App\Models\ProductCategory','product_category_id');
    }

    function transactionDetails()
    {
        return $this->hasaMany('App\Models\TransactionDetail');
    }
}
