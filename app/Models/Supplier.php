<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;
    protected $table = "suppliers";
    protected $primaryKey = "id_supplier";
    protected $fillable = ['supplier_name','supplier_contact','supplier_address'];

    function products()
    {
        return $this->hasMany('App\Models\Product');
    }

    function inventories()
    {
        return $this->hasMany('App\Models\Inventory');
    }
}
