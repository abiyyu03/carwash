<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    use HasFactory;
    protected $table="inventories";
    protected $primaryKey = "id_inventory";
    // public $incrementing = false;
    protected $fillable = ['inventory_name','inventory_amount','inventory_usable',
                        'inventory_unit','inventory_code','inventory_usage',
                        'inventory_capital_price'];

    function inventoryDetails()
    {
        return $this->hasMany('App\Models\InventoryDetail');
    }

    function products()
    {
        return $this->belongsToMany('App\Models\Product','inventory_product','inventory_id','product_id');//->withPivot('product_id');//,'inventory_product','inventory_id','product_id');
    }
}
