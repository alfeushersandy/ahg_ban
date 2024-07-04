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
            $table->string('nama_kendaraan');
            $table->string('kode_kabin');
            $table->string('nopol')->nullable();
            $table->string('sn')->nullable();
            $table->string('no_mesin')->nullable();
            $table->string('no_rangka')->nullable();
            $table->foreignId('kategori_id')->constrained('categories')->cascadeOnDelete();
            $table->foreignId('sub_kategori_id')->constrained('sub_categories')->cascadeOnDelete();
            $table->boolean('is_active')->default(true);
            $table->string('status')->default('Tersedia'); // Tersedia, On Duty, On Service, Rusak, OFF
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicles');
    }
};
