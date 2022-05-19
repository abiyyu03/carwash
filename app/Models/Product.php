<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = "products";
    protected $primaryKey = "id_product";
    protected $fillable = ['product_name','product_code','product_price',
                        'product_stock','product_image','product_category_id',
                        'product_minimum_stock','product_capital_price','supplier_id'
                        ];

    function productCategory()
    {
        return $this->belongsTo('App\Models\ProductCategory','product_category_id');
    }

    function transactionDetails()
    {
        return $this->hasMany('App\Models\TransactionDetail');
    }

    function supplier()
    {
        return $this->belongsTo('App\Models\Supplier','supplier_id');
    }
}
