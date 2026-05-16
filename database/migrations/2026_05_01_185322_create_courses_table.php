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
        Schema::create('courses', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('prodi_id')
                ->constrained('prodis')
                ->cascadeOnDelete();
            
            $table->foreignUuid('konsentrasi_id')
                ->nullable()
                ->constrained('konsentrasis')
                ->nulldeOnDelete();
            
            $table->string('kode_mk')->unique();
            
            $table->string('nama_matkul');
            
            $table->integer('sks');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
