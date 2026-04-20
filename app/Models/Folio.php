<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Folio extends Model
{
    protected $table = 'folio';
    protected $primaryKey = 'id_folio';

    public $timestamps = false;

    protected $fillable = ['folio'];
}
