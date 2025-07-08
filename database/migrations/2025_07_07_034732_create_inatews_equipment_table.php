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
            $table->string('tanggalinstall_seismo');
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
