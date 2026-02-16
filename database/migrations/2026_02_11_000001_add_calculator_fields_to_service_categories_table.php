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
        Schema::table('service_categories', function (Blueprint $table) {
            $table->dropColumn([
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
