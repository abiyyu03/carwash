<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    protected $table = "customers";
    protected $primaryKey = "id_customer";
    protected $casts = ['id' => 'string'];
    public $incrementing = false;
    protected $fillable = ['id_customer','customer_name','customer_contact',
                        'customer_license_plate','customer_vehicle','customer_attend'];

    // // every customer has a vehicletype
    // function vehicleType()
    // {
    //     return $this->belongsTo('App\Models\VehicleType','vehicle_type_id');
    // }

    function transactions()
    {
        return $this->hasMany('App\Models\Transaction');
    }
}
