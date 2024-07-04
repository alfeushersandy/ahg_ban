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
        Schema::create('tires', function (Blueprint $table) {
            $table->id();
            $table->string('serial_number')->unique();
            $table->string('type');
            $table->date('arrival_date');
            $table->string('cap_code');
            $table->date('usage_date')->nullable();
            $table->foreignId('vehicle_id')->nullable()->constrained('vehicles')->cascadeOnDelete();
            $table->foreignId('position_id')->nullable()->constrained('tire_positions')->cascadeOnDelete();
            $table->foreignId('vehicle_id_used')->nullable()->constrained('vehicles')->cascadeOnDelete();
            $table->foreignId('last_position_id')->nullable()->constrained('tire_positions')->cascadeOnDelete();
            $table->string('status')->default('baru'); // baru, bekas, used
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tires');
    }
};
