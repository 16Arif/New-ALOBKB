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
        Schema::create('logbook_petirs', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal');
            $table->string('jam');
            $table->string('onduty1');
            $table->string('onduty2')->nullable();
            $table->string('onduty3')->nullable();
            $table->string('pengamatan1');
            $table->string('pengamatan2');
            $table->string('pengamatan3');
            $table->string('pengamatan4');
            $table->string('pengamatan5');
            $table->string('pengamatan6');
            $table->string('pengamatan7');
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
        Schema::dropIfExists('logbook_petirs');
    }
};
