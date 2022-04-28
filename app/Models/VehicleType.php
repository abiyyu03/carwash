<?php

namespace App\Models;

use App\Models\Customer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class VehicleType extends Model
{
    use HasFactory;

    protected $table = "vehicle_types";
    protected $primaryKey = "id_vehicle_type";
    protected $fillable = ['vehicle_type','vehicle_classification'];

    // every vehicletype has many data in customer
    public function customers()
    {
        return $this->hasMany('App\Models\Customer');
    }
}
