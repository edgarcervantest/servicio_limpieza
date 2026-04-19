<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('home.index');
    }

    public function fecha_captura(){
        $fecha_captura = Carbon::now();
        return $fecha_captura->format('Y-m-d H:i:s');
    }
}
