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

        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->string('title', 400);
            $table->string('domain', 255)->unique();
            $table->string('logo', 400)->nullable();
            $table->string('vk_group', 255)->nullable()->comment('групп вк для обновления товаров');
            $table->string('telegram_channel', 255)->nullable()->comment('канал для заказов');
            $table->longText('description')->nullable();
            $table->json('contacts')->nullable()->comment('Массив объектов контаков заведения');
            $table->json('socials')->nullable()->comment('Массив объектов соц. сети');
            $table->json('bots')->nullable()->comment('Массив объектов ботов заведения');
            $table->json('banners')->nullable()->comment('Баннеры заведения');
            $table->string('site_url', 255)->nullable()->comment('Сайт заведения');
            $table->boolean('is_active')->default(true);
            $table->string('payment_card', 255)->nullable()->comment('Карта владельца компании для автоматизации переводов');
            $table->json('work_time')->nullable()->comment('Время работы заведения');
            $table->string('amo_link', 255)->nullable()->comment('ссылка подключения к АМО CRM');
            $table->string('amo_login', 255)->nullable()->comment('логин от АМО CRM');
            $table->string('amo_password', 255)->nullable()->comment('пароль от АМО CRM');
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
        Schema::dropIfExists('companies');
    }
};
