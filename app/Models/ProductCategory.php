<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    use HasFactory;

    protected $table = "product_categories";
    protected $primaryKey = "id_product_category";
    protected $fillable = ['category_name'];

    function products()
    {
        return $this->hasMany('App\Models\Product');
    }
}
