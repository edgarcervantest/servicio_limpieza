<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Colonia extends Model
{
    protected $table = 'colonia';

    public function ordenes()
    {
        return $this->belongsToMany(
            Orden::class,
            'orden_colonia',
            'id_colonia',
            'id_orden'
        )->withPivot('porcentaje_atendido', 'habitantes');
    }

    public function rutas()
    {
        return $this->belongsToMany(
            Ruta::class,
            'ruta_colonia',
            'id_colonia',
            'id_ruta'
        );
    }
}
