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
        Schema::table('logbook_petirs', function (Blueprint $table) {
            $table->string('onduty4')->after('onduty3')->nullable();
            $table->string('onduty5')->after('onduty4')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('logbook_petirs', function (Blueprint $table) {
            $table->dropColumn('onduty4');
            $table->dropColumn('onduty5');
        });
    }
};
