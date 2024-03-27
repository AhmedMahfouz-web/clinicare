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
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->text('desc', 255000);
            $table->string('profession');
            $table->string('family_related');
            $table->string('sleep_on_hospital');
            $table->string('surgery');
            $table->text('notes', 255000)->nullable();
            $table->foreignUuid('doctor_id')->nullable()->references('id')->on('doctors')->onDelete('cascade');
            $table->text('doctor_comment', 255000)->nullable();
            $table->json('test')->nullable();
            $table->json('diseas')->nullable();
            $table->string('transaction');
            $table->foreignUuid('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reports');
    }
};
