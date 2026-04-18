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
        $table->id(); 
        $table->timestamps(); 
        
        // Fechas del formulario
        $table->datetime('fecha_orden');
        $table->timestamp('fecha_captura')->useCurrent();
        
        // Relaciones con otras tablas
        $table->unsignedBigInteger('id_turno');
        $table->unsignedBigInteger('id_ruta');
        $table->unsignedBigInteger('id_despachador');
        $table->unsignedBigInteger('id_chofer');
        $table->unsignedBigInteger('id_tipo_unidad');
        $table->unsignedBigInteger('id_unidad');


        $table->foreign('id_turno')->references('id')->on('turno')->onDelete('cascade');
        $table->foreign('id_despachador')->references('id')->on('despachador')->onDelete('cascade');
        $table->foreign('id_chofer')->references('id')->on('chofer')->onDelete('cascade');
        $table->foreign('id_tipo_unidad')->references('id')->on('tipo_unidad')->onDelete('cascade');
        $table->foreign('id_unidad')->references('id')->on('unidad')->onDelete('cascade');
        $table->foreign('id_ruta')->references('id')->on('ruta')->onDelete('cascade');

        //// Datos numéricos y kilometraje
        $table->float('cantidad_kl');
        $table->integer('puches')->default(0);
        $table->integer('km_salir');
        $table->integer('km_volver');

        // Datos del diesel
        $table->float('diesel_inicial');
        $table->float('diesel_final');
        $table->float('diesel_cargado');
        $table->float('diesel_en_unidad');

        // Tiempo y Cálculos
        $table->integer('anio');
        $table->string('mes', 20);
        $table->integer('dia');
        $table->integer('suma'); 
        $table->float('porcentaje_atendido');
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
