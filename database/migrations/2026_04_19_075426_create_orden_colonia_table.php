<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orden_colonia', function (Blueprint $table) {

            $table->primary(['id_orden', 'id_colonia']);
            $table->unsignedBigInteger('id_orden');
            $table->unsignedBigInteger('id_colonia');
            $table->integer('habitantes');
            $table->decimal('porcentaje_atendido', 5, 2);

            $table->foreign('id_orden')->references('id_orden')->on('orden')->onDelete('cascade');
            $table->foreign('id_colonia')->references('id_colonia')->on('colonia');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orden_colonia');
    }
};
