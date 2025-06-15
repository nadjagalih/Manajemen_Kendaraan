<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('vehicle_usage_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vehicle_id')->constrained()->onDelete('cascade');
            $table->foreignId('booking_id')->constrained('vehicle_bookings')->onDelete('cascade');
            $table->float('fuel_used')->nullable();
            $table->float('km_start')->nullable();
            $table->float('km_end')->nullable();
            $table->float('distance_travelled')->nullable(); // = km_end - km_start
            $table->timestamps();
        });
    }
};
