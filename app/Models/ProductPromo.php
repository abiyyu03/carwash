<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductPromo extends Model
{
    use HasFactory;
    protected $table = "product_promos";
    protected $fillable = ['discount','product_id'];
    protected $primaryKey = "id_product_promo";

    function product()
    {
        return $this->belongsTo('App\Models\Product','product_id');
    }
}
