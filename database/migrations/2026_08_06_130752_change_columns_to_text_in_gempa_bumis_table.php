<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('gempa_bumis', function (Blueprint $table) {
            $table->text('dirasakan')->nullable()->change();
            $table->text('keterangan')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('gempa_bumis', function (Blueprint $table) {
            $table->string('dirasakan', 255)->nullable()->change();
            $table->string('keterangan', 255)->nullable()->change();
        });
    }
};
