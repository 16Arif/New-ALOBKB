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
        Schema::create('inatews_information', function (Blueprint $table) {
            $table->id();
            $table->string('lat');
            $table->string('long');
            $table->string('elevasi');
            $table->date('th_install');
            $table->string('alamat_site');
            $table->string('kel_site');
            $table->string('kec_site');
            $table->string('kota');
            $table->string('prov');
            $table->string('pic_site');
            $table->string('kontak_pic');
            $table->string('upt');
            $table->string('alamat_upt');
            $table->string('kel_upt');
            $table->string('kec_upt');
            $table->string('kota_upt');
            $table->string('jab_pic_upt');
            $table->string('pic_upt');
            $table->string('kontak_pic_upt');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inatews_information');
    }
};
