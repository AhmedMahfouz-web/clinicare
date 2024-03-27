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
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->foreignUuid('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreignId('hospital_id')->references('id')->on('hospitals')->onDelete('cascade');
            $table->timestamp('date')->nullable();
            $table->string('status')->default('انتظار');
            $table->text('notes', 255000)->nullable();
            $table->json('rays')->nullable();
            $table->text('rays_notes', 255000)->nullable();
            $table->json('analysis')->nullable();
            $table->text('analysis_notes', 255000)->nullable();
            $table->json('test')->nullable();
            $table->json('diseas')->nullable();
            $table->string('transaction');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
