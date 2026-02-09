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
        Schema::create('landing_pages', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique()->comment('URL slug лендинга (например: foundations)');
            $table->string('title')->comment('Заголовок лендинга');
            $table->text('hero_title')->nullable()->comment('Заголовок в hero секции');
            $table->text('hero_subtitle')->nullable()->comment('Подзаголовок в hero секции');
            $table->json('hero_items')->nullable()->comment('4 преимущества в hero секции');
            $table->text('foundations_title')->nullable()->comment('Заголовок секции типов фундаментов');
            $table->json('foundation_types')->nullable()->comment('Массив типов фундаментов (название, цена, изображение)');
            $table->text('help_text')->nullable()->comment('Текст секции помощи');
            $table->text('examples_title')->nullable()->comment('Заголовок секции выполненных работ');
            $table->json('examples')->nullable()->comment('Выполненные работы');
            $table->text('gallery_title')->nullable()->comment('Заголовок галереи');
            $table->json('gallery_images')->nullable()->comment('Изображения галереи');
            $table->text('price_title')->nullable()->comment('Заголовок таблицы цен');
            $table->json('price_table')->nullable()->comment('Таблица цен');
            $table->text('calculator_title')->nullable()->comment('Заголовок калькулятора');
            $table->text('calculator_text')->nullable()->comment('Описание калькулятора');
            $table->text('facility_title')->nullable()->comment('Заголовок секции преимуществ');
            $table->text('facility_text')->nullable()->comment('Текст секции преимуществ');
            $table->text('reviews_title')->nullable()->comment('Заголовок отзывов');
            $table->json('reviews')->nullable()->comment('Отзывы (слайдер)');
            $table->text('faq_title')->nullable()->comment('Заголовок FAQ');
            $table->json('faq')->nullable()->comment('Вопросы и ответы');
            $table->text('meta_title')->nullable()->comment('SEO meta title');
            $table->text('meta_description')->nullable()->comment('SEO meta description');
            $table->boolean('is_active')->default(true)->comment('Активность лендинга');
            $table->integer('sort_order')->default(0)->comment('Порядок сортировки');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('landing_pages');
    }
};
