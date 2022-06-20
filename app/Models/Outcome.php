<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Outcome extends Model
{
    use HasFactory;
    protected $table = "outcomes";
    protected $fillable = ['needs','expense_balance','quantity'];
    protected $primaryKey = "id_outcomes";
}
