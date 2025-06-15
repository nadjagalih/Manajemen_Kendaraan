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
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->enum('type', ['angkutan_orang', 'angkutan_barang']);
            $table->boolean('is_company_owned')->default(true);
            $table->string('license_plate')->unique();
            $table->string('fuel_type')->nullable();
            $table->timestamps();
        });
    }
};
