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
        Schema::create('assessments', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->foreignUuid('application_id')
                ->constrained('applications')
                ->cascadeOnDelete();
            
            $table->foreignUuid('asesor_id')
                ->constrained('asesors')
                ->cascadeOnDelete();
            
            $table->text('notes')->nullable();

            $table->enum('status', [
                'approved',
                'rejected'
            ]);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assessments');
    }
};
