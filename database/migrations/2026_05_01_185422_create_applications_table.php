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
        Schema::create('applications', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('applicant_id')
                ->constrained('applicants')
                ->cascadeOnDelete();
            
            $table->enum('jenis_RPL', ['A','B']);

            $table->foreignUuid('prodi_id')
                ->constrained('prodis')
                ->cascadeOnDelete();

            $table->foreignUuid('konsentrasi_id')
                ->nullable()
                ->constrained('konsentrasis')
                ->nullOnDelete();
            
            $table->enum('status', [
                'draft',
                'submitted',
                'assigned',
                'assessed',
                'approved',
                'rejected',
                'cancelled'
            ])->default('draft');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('applications');
    }
};
