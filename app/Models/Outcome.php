<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Outcome extends Model
{
    use HasFactory;
    protected $table = "outcomes";
    protected $fillable = ['needs','expense_balance','quantity','outcome_type_id'];
    protected $primaryKey = "id_outcomes";

    function outcomeType()
    {
        return $this->belongsTo('App\Models\OutcomeType','outcome_type_id');
    }
}
