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
        Schema::create('vehicle_bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Admin
            $table->foreignId('vehicle_id')->constrained()->onDelete('cascade');
            $table->foreignId('driver_id')->nullable()->constrained()->onDelete('set null');
            $table->string('destination');
            $table->dateTime('start_time');
            $table->dateTime('end_time');
            $table->enum('approval_status', ['pending', 'on process', 'approved', 'rejected'])->default('pending');
            $table->unsignedTinyInteger('current_approval')->default(0);
            $table->timestamps();
        });
    }
};
