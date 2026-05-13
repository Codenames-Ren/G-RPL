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
        Schema::create('asesor_prodis', function (Blueprint $table) {

            $table->foreignUuid('asesor_id')
                ->constrained('asesors')
                ->cascadeOnDelete();

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
        Schema::dropIfExists('asesor_prodis');
    }
};