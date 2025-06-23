<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceSchedule extends Model
{
    public function vehicle()
    {
        return $this->belongsTo(\App\Models\Vehicle::class, 'vehicle_id');
    }

}
