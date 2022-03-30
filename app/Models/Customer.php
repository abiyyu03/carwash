<?php

namespace App\Models;

use App\Models\VehicleType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Customer extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function vehicleType()
    {
        return $this->belongsTo(VehicleType::class);
    }
    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}
