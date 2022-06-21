<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OutcomeType extends Model
{
    use HasFactory;
    protected $table = "outcome_types";
    protected $fillable = ['outcome_type'];
    protected $primaryKey = "id_outcome_type";

    function outcomes()
    {
        return $this->hasMany('App\Models\Outcome');
    }
}
