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
        Schema::create('progress_details', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('progress_id')->constrained('progress')->cascadeOnDelete();
            $table->string('question');
            $table->string('student_answer')->nullable();
            $table->string('correct_answer');
            $table->integer('score')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('progress_details');
    }
};
