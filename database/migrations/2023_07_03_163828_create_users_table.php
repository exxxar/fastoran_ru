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
        Schema::disableForeignKeyConstraints();

        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('full_name', 255)->nullable();
            $table->string('password', 255)->nullable();
            $table->string('email', 255)->unique()->nullable();
            $table->string('phone', 255)->unique()->nullable();
            $table->string('telegram_chat_id', 255)->nullable();
            $table->string('birthday', 255)->nullable();
            $table->string('auth_code', 255)->nullable();
            $table->foreignId('role_id')->constrained();
            $table->string('email_verified_at', 255)->nullable();
            $table->string('phone_verified_at', 255)->nullable();
            $table->string('blocked_at', 255)->nullable();
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
