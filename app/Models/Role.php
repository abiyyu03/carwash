<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;
    protected $table = "roles";
    protected $fillable = ['role_name'];
    protected $primaryKey = "id_role";

    function users()
    {
        return $this->hasMany('App\Models\User');
    }
}
