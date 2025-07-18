<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('role_user', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->foreignId('user_id')->constrained('user_roles')->onDelete('cascade')->index('fk_ru_uid');
            $table->foreignId('role_id')->constrained('user_roles')->onDelete('cascade')->index('fk_ru_rid');
            $table->primary(['user_id', 'role_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('role_user');
    }
};
