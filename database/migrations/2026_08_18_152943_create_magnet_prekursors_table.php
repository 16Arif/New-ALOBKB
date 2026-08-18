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
        Schema::create('magnet_prekursors', function (Blueprint $table) {
            $table->id();
            $table->string('nama_site');
            $table->string('lokasi');
            $table->string('latitude');
            $table->string('longitude');
            $table->string('tahun_instalasi')->nullable();
            $table->string('sensor')->nullable();
            $table->string('digitizer')->nullable();
            $table->string('regulator')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('magnet_prekursors');
    }
};
