<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Unidad extends Model
{
    protected $table = 'unidad';

    public function ordenes()
    {
        return $this->hasMany(Orden::class, 'id_unidad', 'id_unidad');
    }
}
