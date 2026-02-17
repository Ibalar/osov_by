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
        Schema::table('services', function (Blueprint $table) {
            // Hero Section
            $table->text('hero_title')->nullable()->comment('Заголовок в hero секции');
            $table->text('hero_subtitle')->nullable()->comment('Подзаголовок в hero секции');
            $table->string('hero_bg_image')->nullable()->comment('Фоновое изображение hero секции');
            $table->json('hero_items')->nullable()->comment('Преимущества в hero секции');

            // Types Section (like foundation_types)
            $table->text('types_title')->nullable()->comment('Заголовок секции типов');
            $table->json('types')->nullable()->comment('Массив типов (название, цена, изображение)');

            // Examples Section
            $table->text('examples_title')->nullable()->comment('Заголовок секции выполненных работ');
            $table->json('examples')->nullable()->comment('Выполненные работы');

            // Gallery Section
            $table->text('gallery_title')->nullable()->comment('Заголовок галереи');
            $table->json('gallery_images')->nullable()->comment('Изображения галереи');

            // Price Table Section
            $table->text('price_title')->nullable()->comment('Заголовок таблицы цен');
            $table->json('price_table')->nullable()->comment('Таблица цен');

            // Reviews Section
            $table->text('reviews_title')->nullable()->comment('Заголовок отзывов');
            $table->json('reviews')->nullable()->comment('Отзывы (слайдер)');

            // Calculator Section
            $table->boolean('calculator_enabled')->default(false)->comment('Включен ли калькулятор');
            $table->string('calculator_title')->nullable()->comment('Заголовок калькулятора');
            $table->text('calculator_description')->nullable()->comment('Описание калькулятора');
            $table->text('calculator_formula')->nullable()->comment('Формула расчета');
            $table->string('calculator_currency')->default('BYN')->comment('Валюта');
            $table->string('calculator_result_label')->default('Итоговая стоимость')->comment('Подпись результата');
            $table->json('calculator_fields')->nullable()->comment('Поля калькулятора (key, label, type, default_value, options, min, max, step)');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('services', function (Blueprint $table) {
            $table->dropColumn([
                // Hero Section
                'hero_title',
                'hero_subtitle',
                'hero_bg_image',
                'hero_items',
                // Types Section
                'types_title',
                'types',
                // Examples Section
                'examples_title',
                'examples',
                // Gallery Section
                'gallery_title',
                'gallery_images',
                // Price Table Section
                'price_title',
                'price_table',
                // Reviews Section
                'reviews_title',
                'reviews',
                // Calculator Section
                'calculator_enabled',
                'calculator_title',
                'calculator_description',
                'calculator_formula',
                'calculator_currency',
                'calculator_result_label',
                'calculator_fields',
            ]);
        });
    }
};
