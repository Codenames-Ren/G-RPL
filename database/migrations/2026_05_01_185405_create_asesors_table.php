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
        Schema::create('asesors', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('user_id')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->string('nama');
            $table->string('nidn');
            $table->string('bidang_keahlian');

            $table->foreignUuid('prodi_id')
                ->constrained('prodis')
                ->cascadeOnDelete();
                
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('asesors');
    }
};
