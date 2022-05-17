<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductType extends Model
{
    use HasFactory;
    protected $table = "product_types";
    protected $primaryKey = "id_product_type";
    protected $fillable = ['product_type','product_type_id'];

    function productCategories()
    {
        return $this->hasMany('App\Models\ProductCategory');
    }
}
