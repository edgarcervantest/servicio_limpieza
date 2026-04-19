<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Despachador extends Model
{
    protected $table = 'despachador';

    public function ordenes()
    {
        return $this->hasMany(Orden::class, 'id_despachador', 'id_despachador');
    }
}
