<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ruta extends Model
{
    protected $table = 'ruta';

    public function colonias()
    {
        return $this->belongsToMany(
            Colonia::class,
            'ruta_colonia',
            'id_ruta',
            'id_colonia'
        );
    }

    public function ordenes()
    {
        return $this->hasMany(Orden::class, 'id_ruta', 'id_ruta');
    }
}
