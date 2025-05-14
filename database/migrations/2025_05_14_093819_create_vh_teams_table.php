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
        Schema::create('vh_teams', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('teem_number', false, true)->unique('uq_vht_tn');
            $table->string('name')->unique('uq_vht_name')->comment('Назва команди (об\'єкту)');
            $table->text('description')->nullable()->comment('Опис команди або об\'єкту');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vh_teams');
    }
};
