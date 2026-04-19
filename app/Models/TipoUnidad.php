<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoUnidad extends Model
{
    protected $table = 'tipo_unidad';

    public function ordenes()
    {
        return $this->hasMany(Orden::class, 'id_tipo_unidad', 'id_tipo_unidad');
    }
}
