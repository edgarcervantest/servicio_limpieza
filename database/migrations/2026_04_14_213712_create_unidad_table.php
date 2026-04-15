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
        Schema::create('unidad', function (Blueprint $table) {
            $table->id('id_unidad');
            $table->string('nombre', 255);
            $table->unsignedBigInteger('id_tipo_unidad');
            $table->foreign('id_tipo_unidad')->references('id_tipo_unidad')->on('tipo_unidad')->onDelete('cascade');
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('unidad');
    }
};
