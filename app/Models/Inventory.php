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
                        'inventory_capital_price','supplier_id'];
}
