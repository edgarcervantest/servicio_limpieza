<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Folio;

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
    
    
    public function mostrarOrden() 
    {
    return view('home.mostrarConsulta'); 
    }
    
    
    public function buscarOrden(Request $request)
    
    {
        $numero_folio = $request->input('folio');
        
        //  relación con colonias, chofer y despachador, cuandoo se obtiene la orden
    $orden = Folio::with('colonias', 'chofer', 'despachador')->find($numero_folio);

        // duda de suma, en el calculo
    if ($orden) { 
        $orden->suma_habitantes = $orden->colonias->sum('habitantes');
    }

    return view('home.buscarOrden', ['orden' => $orden, 'folio' => $numero_folio]);
    }

}
    