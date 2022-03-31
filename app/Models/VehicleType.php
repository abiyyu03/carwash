<?php

namespace App\Models;

use App\Models\Customer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class VehicleType extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function customers()
    {
        return $this->hasMany(Customer::class);
    }
}
