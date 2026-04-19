<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Folio extends Model
{
    //
    protected $table = 'orden'; 

    protected $fillable = [
        'fecha_orden',
        'fecha_captura',
        'id_turno',
        'id_ruta',
        'id_despachador',
        'id_chofer',
        'id_tipo_unidad',
        'id_unidad',
        'cantidad_kl',
        'puches',
        'km_salir',
        'km_volver',
        'diesel_inicial',
        'diesel_final',
        'diesel_cargado',
        'diesel_en_unidad',
        'anio',
        'mes',
        'dia',
        'suma', 
        'porcentaje_atendido'
    ];

    // relación con las colonias
    public function colonias() {
        return $this->hasMany(Colonia::class, 'folio_id');
    }
 
    // relación para obtener nombres de choferess
    public function chofer() {
        return $this->belongsTo(Chofer::class, 'id_chofer');
    }
    // relación para obtener nombres de despachadores
    public function despachador() {
        return $this->belongsTo(Despachador::class, 'id_despachador');
    }
}
