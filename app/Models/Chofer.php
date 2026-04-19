<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Chofer extends Model
{
    protected $table = 'chofer';

    public function ordenes()
    {
        return $this->hasMany(Orden::class, 'id_chofer', 'id_chofer');
    }
}
