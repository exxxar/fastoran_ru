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

        Schema::create('locations', function (Blueprint $table) {
            $table->id();
            $table->string('region', 255)->comment('Регион');
            $table->string('city', 255)->comment('Город');
            $table->string('district', 255)->nullable()->comment('Район');
            $table->string('address', 255)->comment('Адрес');
            $table->string('landmark', 255)->nullable()->comment('Ориентир');
            $table->string('latitude', 50)->nullable()->comment('Широта');
            $table->string('longitude', 50)->nullable()->comment('Долгота');
            $table->integer('object_type')->default(0)->comment('компания \\ пользователь');
            $table->foreignId('object_id')->constrained('companies');
            $table->timestamp('deleted_at')->nullable();
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('locations');
    }
};
