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
        Schema::create('technical', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('phone')->nullable();
            $table->string('specialty')->nullable();
            $table->timestamps();
        });

        Schema::create('service_order', function (Blueprint $table) {
            $table->id();
            $table->foreignId('technicial_id')->references('id')->on('technical')->onDelete('cascade');
            $table->string('client_name');
            $table->string('client_address')->nullable();
            $table->string('client_plan')->nullable();
            $table->enum('type', ['instalacao', 'mudanca_endereco', 'suporte', 'infra', 'outros'])->default('instalacao');
            $table->text('description')->nullable();
            $table->enum('status', ['open', 'in_progress', 'closed'])->default('open');
            $table->timestamps();
        });

        Schema::create('equipment_service_order', function (Blueprint $table) {
            $table->id();
            $table->foreignId('service_order_id')->references('id')->on('service_order')->onDelete('cascade');
            $table->foreignId('equipment_id')->references('id')->on('equipment')->onDelete('cascade');
            $table->integer('quantity_used');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('technical');
        Schema::dropIfExists('service_order');
        Schema::dropIfExists('equipment_service_order');
    }
};
