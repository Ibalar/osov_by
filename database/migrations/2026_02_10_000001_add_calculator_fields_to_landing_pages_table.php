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
        Schema::table('landing_pages', function (Blueprint $table) {
            $table->json('calculator_types')->nullable()->comment('Типы фундамента для калькулятора (label, value)');
            $table->json('calculator_services')->nullable()->comment('Дополнительные услуги для калькулятора (label, value)');
            $table->json('calculator_range')->nullable()->comment('Параметры диапазона калькулятора (min, max, step, default)');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('landing_pages', function (Blueprint $table) {
            $table->dropColumn(['calculator_types', 'calculator_services', 'calculator_range']);
        });
    }
};
