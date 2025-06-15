<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class VehicleBooking extends Model
{
    use HasFactory;

    /**
     * Atribut yang boleh diisi massal.
     */
    protected $fillable = [
        'user_id',
        'vehicle_id',
        'orderer_id',
        'destination',
        'start_time',
        'end_time',
        'purpose',
        'status',
        'current_approval',
    ];

    /**
     * Cast tipe data otomatis.
     */
    protected $casts = [
        'start_time' => 'datetime',
        'end_time' => 'datetime',
    ];

    /**
     * Relasi ke user (yang membuat pemesanan, jika digunakan).
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relasi ke kendaraan.
     */
    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }

    /**
     * Relasi ke pemesan (Orderer).
     */
    public function orderers()
    {
        return $this->belongsTo(Orderer::class);
    }
}
