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
        Schema::create('inatews_equipment', function (Blueprint $table) {
            $table->id();
            $table->string('manufaktur_seismo');
            $table->string('tipe_seismo');
            $table->string('sn_seismo');
            $table->string('tglinstall_seismo');
            $table->string('manufaktur_acc');
            $table->string('tipe_acc');
            $table->string('sn_acc');
            $table->string('tglinstall_acc');
            $table->string('manufaktur_digitizer');
            $table->string('tipe_digitizer');
            $table->string('sn_digitizer');
            $table->string('tglinstall_digitizer');
            $table->string('manufaktur_antenna');
            $table->string('tipe_antenna');
            $table->string('sn_antenna');
            $table->string('tglinstall_antenna');
            $table->string('manufaktur_modem_vsat');
            $table->string('tipe_modem_vsat');
            $table->string('sn_modem_vsat');
            $table->string('tglinstall_modem_vsat');
            $table->string('manufaktur_modem_gsm')->nullable();
            $table->string('tipe_modem_gsm')->nullable();
            $table->string('sn_modem_gsm')->nullable();
            $table->string('tglinstall_modem_gsm')->nullable();
            $table->string('manufaktur_gps');
            $table->string('tipe_gps');
            $table->string('sn_gps');
            $table->string('tglinstall_gps');
            $table->string('manufaktur_solar');
            $table->string('tipe_solar');
            $table->string('sn_solar');
            $table->string('tglinstall_solar');
            $table->string('manufaktur_charge');
            $table->string('tipe_charge');
            $table->string('sn_charge');
            $table->string('tglinstall_charge');
            $table->string('manufaktur_battery');
            $table->string('tipe_battery');
            $table->string('sn_battery');
            $table->string('tglinstall_battery');
            $table->string('ip_digitizer')->nullable();
            $table->string('ip_modem_vsat')->nullable();
            $table->string('ip_modem_gsm')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inatews_equipment');
    }
};
