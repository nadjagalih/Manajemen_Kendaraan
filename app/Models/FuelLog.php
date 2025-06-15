<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FuelLog extends Model
{
    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }

}
