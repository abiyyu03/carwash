<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promo extends Model
{
    use HasFactory;
    protected $table = "promos";
    protected $primaryKey = "id_promo";
    protected $fillable = ['discount','product_id'];

    function product()
    {
        return $this->belongsTo('App\Models\Product');
    }
}
