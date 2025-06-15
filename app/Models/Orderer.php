<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Orderer extends Model
{
    protected $fillable = [
        'name',
        'email',
        'phone',
    ];
}

