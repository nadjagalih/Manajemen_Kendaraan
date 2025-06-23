<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FuelLog extends Model
{
    protected $fillable = [
    'vehicle_id',
    'tanggal',
    'jumlah_liter',
    'odometer',
    'catatan',
];
    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }

}
