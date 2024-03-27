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
        Schema::create('old__test__models', function (Blueprint $table) {
            $table->id();
            $table->foreignId('report_id')->nullable()->references('id')->on('reports')->onDelete('cascade');
            $table->foreignId('meeting_id')->nullable()->references('id')->on('meetings')->onDelete('cascade');
            $table->foreignId('reservation_id')->nullable()->references('id')->on('reservations')->onDelete('cascade');
            $table->foreignId('dentist_id')->nullable()->references('id')->on('dentists')->onDelete('cascade');
            $table->foreignId('old_test_id')->nullable()->references('id')->on('diseas')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('old__test__models');
    }
};
