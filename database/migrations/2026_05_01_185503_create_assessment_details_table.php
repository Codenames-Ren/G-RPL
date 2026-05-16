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
        Schema::create('assessment_details', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->foreignUuid('assessment_id')
                ->constrained('assessments')
                ->cascadeOnDelete();
            
            $table->foreignUuid('learning_experience_id')
                ->constrained('learning_experiences')
                ->cascadeOnDelete();

            $table->foreignUuid('course_id')
                ->constrained('courses')
                ->cascadeOnDelete();
            
            $table->integer('sks_diakui');

            $table->integer('nilai_konversi');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assessment_details');
    }
};
