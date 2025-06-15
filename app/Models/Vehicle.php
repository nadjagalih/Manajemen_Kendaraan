<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Vehicle extends Model
{
    use HasFactory;

    /**
     * Atribut yang boleh diisi massal.
     */
    protected $fillable = [
        'name',
        'license_plate',
        'type',
        'fuel_type',
        'is_company_owned',
    ];

    /**
     * Tipe data cast otomatis.
     */
    protected $casts = [
        'is_company_owned' => 'boolean',
    ];

    /**
     * Relasi ke vehicle bookings.
     */
    public function bookings()
    {
        return $this->hasMany(VehicleBooking::class);
    }

    public function fuelLogs()
    {
        return $this->hasMany(FuelLog::class);
    }

    public function serviceSchedules()
    {
        return $this->hasMany(ServiceSchedule::class);
    }

}
