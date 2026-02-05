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
        // Add fields to portfolio_items
        Schema::table('portfolio_items', function (Blueprint $table) {
            $table->string('slug')->unique()->after('title');
            $table->text('excerpt')->nullable()->after('slug');
            $table->longText('content')->nullable()->after('description');
            $table->boolean('is_active')->default(true)->after('content');
            $table->integer('sort_order')->default(0)->after('is_active');
            $table->string('cover_image')->nullable()->after('sort_order');
        });

        // Add fields to portfolio_categories
        Schema::table('portfolio_categories', function (Blueprint $table) {
            $table->text('description')->nullable()->after('slug');
            $table->boolean('is_active')->default(true)->after('description');
            $table->integer('sort_order')->default(0)->after('is_active');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('portfolio_items', function (Blueprint $table) {
            $table->dropColumn(['slug', 'excerpt', 'content', 'is_active', 'sort_order', 'cover_image']);
        });

        Schema::table('portfolio_categories', function (Blueprint $table) {
            $table->dropColumn(['description', 'is_active', 'sort_order']);
        });
    }
};
