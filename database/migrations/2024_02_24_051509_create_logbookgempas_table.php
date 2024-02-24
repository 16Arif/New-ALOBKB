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
        Schema::create('logbookgempas', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal');
            $table->string('jam');
            $table->string('onduty1');
            $table->string('onduty2')->nullable();
            $table->string('onduty3')->nullable();
            $table->string('kehadiran');
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
        Schema::dropIfExists('logbookgempas');
    }
};
