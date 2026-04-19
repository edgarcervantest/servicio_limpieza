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
        Schema::create('orden', function (Blueprint $table) {

        $table->id('id_orden');
        $table->dateTime('fecha_orden');
        $table->dateTime('fecha_captura');

        $table->unsignedBigInteger('id_folio')->unique();
        $table->unsignedBigInteger('id_turno');
        $table->unsignedBigInteger('id_ruta');
        $table->unsignedBigInteger('id_despachador');
        $table->unsignedBigInteger('id_chofer');
        $table->unsignedBigInteger('id_tipo_unidad');
        $table->unsignedBigInteger('id_unidad');
        $table->unsignedBigInteger('creado_por');

        $table->foreign('id_folio')->references('id_folio')->on('folio')->onDelete('cascade');
        $table->foreign('id_turno')->references('id_turno')->on('turno')->onDelete('cascade');
        $table->foreign('id_ruta')->references('id_ruta')->on('ruta')->onDelete('cascade');
        $table->foreign('id_despachador')->references('id_despachador')->on('despachador')->onDelete('cascade');
        $table->foreign('id_chofer')->references('id_chofer')->on('chofer')->onDelete('cascade');
        $table->foreign('id_tipo_unidad')->references('id_tipo_unidad')->on('tipo_unidad')->onDelete('cascade');
        $table->foreign('id_unidad')->references('id_unidad')->on('unidad')->onDelete('cascade');
        $table->foreign('creado_por')->references('id')->on('users')->onDelete('cascade');
        

        //// Datos numéricos y kilometraje
        $table->decimal('cantidad_kl');
        $table->integer('puches')->default(0);
        $table->decimal('km_salir');
        $table->decimal('km_volver');
        $table->decimal('km_total', 10, 2);

        // Datos del diesel
        $table->decimal('diesel_inicial');
        $table->decimal('diesel_final');
        $table->decimal('diesel_cargado');
        $table->decimal('diesel_gastado');

        // Tiempo y Cálculos
        $table->decimal('suma_porcentaje'); 
        $table->decimal('porcentaje_atendido');

        $table->text('observaciones', 255);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orden');
    }
};
