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
        Schema::table('service_categories', function (Blueprint $table) {
            // Hero Section
            $table->text('hero_title')->nullable()->comment('Заголовок в hero секции');
            $table->text('hero_subtitle')->nullable()->comment('Подзаголовок в hero секции');
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
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('service_categories', function (Blueprint $table) {
            $table->dropColumn([
                'hero_title',
                'hero_subtitle',
                'hero_items',
                'types_title',
                'types',
                'examples_title',
                'examples',
                'gallery_title',
                'gallery_images',
                'price_title',
                'price_table',
                'reviews_title',
                'reviews',
            ]);
        });
    }
};
