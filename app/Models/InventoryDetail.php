<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventoryDetail extends Model
{
    use HasFactory;
    protected $table = "inventory_details";
    protected $primaryKey = "id_inventory_detail";
    protected $fillable = ['id_inventory_detail', 'inventory_detail_name', 'inventory_detail_amount', 'inventory_detail_price', 
                         'inventory_id','product_id','supplier_name', 'supplier_contact'];

    function product()
    {
        return $this->belongsTo('App\Models\Product','product_id');
    }

    function inventory()
    {
        return $this->belongsTo('App\Models\Inventory','inventory_id');
    }

}
