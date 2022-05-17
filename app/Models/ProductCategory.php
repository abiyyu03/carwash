<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    use HasFactory;

    protected $table = "product_categories";
    protected $primaryKey = "id_product_category";
    protected $fillable = ['category_name','product_type_id'];

    function products()
    {
        return $this->hasMany('App\Models\Product');
    }

    function productType()
    {
        return $this->belongsTo('App\Models\ProductType','product_type_id');
    }
}
