<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Config extends Model
{
    use HasFactory;
    protected $table = "configs";
    protected $primaryKey = "id_config";
    protected $fillable = ['id_config','carwash_name','carwash_address','commission_percentage','ppn_percentage'];
}
