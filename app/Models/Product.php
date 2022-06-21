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
                        'product_stock','product_category_id',
                        'product_minimum_stock','product_capital_price' ];

    function productCategory()
    {
        return $this->belongsTo('App\Models\ProductCategory','product_category_id');
    }

    function transactionDetails()
    {
        return $this->hasMany('App\Models\TransactionDetail');
    }

    function inventoryDetails()
    {
        return $this->hasMany('App\Models\InventoryDetail');
    }

    function inventories()
    {
        return $this->belongsToMany('App\Models\Inventory','inventory_product','product_id','inventory_id'); // //withPivot('inventory_id');
    }

    function productPromo()
    {
        return $this->hasOne('App\Models\ProductPromo');
    }
}
