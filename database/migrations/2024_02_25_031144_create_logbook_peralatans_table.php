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
        Schema::create('logbook_peralatans', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal');
            $table->string('jam');
            $table->string('onduty1');
            $table->string('onduty2')->nullable();
            $table->string('onduty3')->nullable();
            $table->string('fingerprint');
            $table->string('tds');
            $table->string('nexstorm');
            $table->string('obs_nexstorm');
            $table->string('cmss');
            $table->string('monitoring');
            $table->string('acc');
            $table->string('wrsng');
            $table->string('integrasi_data');
            $table->string('seiscomp4');
            $table->string('pc_magnet');
            $table->string('monitor_zoom');
            $table->string('internet_ops');
            $table->string('internet_lokal');
            $table->string('shakemap');
            $table->string('seiscomp_reg');
            $table->string('qc_seiscomp');
            $table->string('monitor_simap');
            $table->string('ws_simap');
            $table->string('bkb_server');
            $table->string('penakar_hujan');
            $table->string('radio_ssb');
            $table->string('note')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('logbook_peralatans');
    }
};
