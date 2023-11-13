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

        Schema::create('ingredients', function (Blueprint $table) {
            $table->id();
            $table->string('title', 255)->nullable();
            $table->longText('description')->nullable();
            $table->string('image', 255)->nullable();
            $table->string('weight', 255)->nullable();
            $table->string('price', 255)->nullable();
            $table->foreignId('ingredient_category_id')->constrained();
            $table->foreignId('product_id')->constrained();
            $table->boolean('is_checked')->default(false);
            $table->boolean('is_disabled')->default(false);
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ingredients');
    }
};
