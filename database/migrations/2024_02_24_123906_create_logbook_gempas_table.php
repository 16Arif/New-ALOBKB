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
        Schema::create('logbook_gempas', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal');
            $table->string('jam');
            $table->string('onduty1');
            $table->string('onduty2')->nullable();
            $table->string('onduty3')->nullable();
            $table->string('kehadiran');
            $table->string('kegiatan1');
            $table->string('kegiatan2');
            $table->string('monitoring1');
            $table->string('berita1');
            $table->string('monitoring2');
            $table->string('berita2');
            $table->string('kondisi');
            $table->string('note')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('logbook_gempas');
    }
};
