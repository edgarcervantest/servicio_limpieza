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
        Schema::create('ruta_colonia', function (Blueprint $table) {
            $table->primary(['id_ruta', 'id_colonia']);
            $table->unsignedBigInteger('id_ruta');
            $table->unsignedBigInteger('id_colonia');

            $table->foreign('id_ruta')->references('id_ruta')->on('ruta')->onDelete('cascade');
            $table->foreign('id_colonia')->references('id_colonia')->on('colonia')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ruta_colonia');
    }
};
