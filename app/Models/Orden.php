<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Orden extends Model
{
    protected $table = 'orden';
    public function folio()
    {
        return $this->belongsTo(Folio::class, 'id_folio', 'id_folio');
    }

    public function turno()
    {
        return $this->belongsTo(Turno::class, 'id_turno', 'id_turno');
    }

    public function ruta()
    {
        return $this->belongsTo(Ruta::class, 'id_ruta', 'id_ruta');
    }

    public function chofer()
    {
        return $this->belongsTo(Chofer::class, 'id_chofer', 'id_chofer');
    }

    public function despachador()
    {
        return $this->belongsTo(Despachador::class, 'id_despachador', 'id_despachador');
    }

    public function unidad()
    {
        return $this->belongsTo(Unidad::class, 'id_unidad', 'id_unidad');
    }

    public function usuario()
    {
        return $this->belongsTo(User::class, 'creado_por', 'id');
    }

    public function colonias()
    {
        return $this->belongsToMany(
            Colonia::class,
            'orden_colonia',
            'id_orden',
            'id_colonia'
        )->withPivot('porcentaje_atendido', 'habitantes');
    }
}
