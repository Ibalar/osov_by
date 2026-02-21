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
        Schema::create('requests', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('phone');
            $table->string('source_type')->nullable(); // 'service', 'service_category', 'landing', etc.
            $table->unsignedBigInteger('source_id')->nullable();
            $table->string('source_title')->nullable(); // Название услуги/категории
            $table->text('comment')->nullable();
            $table->enum('status', ['new', 'processed', 'completed', 'rejected'])->default('new');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('requests');
    }
};
