<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Turno;
use App\Models\Ruta;
use App\Models\Despachador;
use App\Models\Chofer;
use App\Models\TipoUnidad;
use App\Models\Unidad;
use Carbon\Carbon;

class OrderController extends Controller
{
    public function index()
    {
        return view('orders.index', compact('orders'));
    }

    public function create(Request $request)
    {
        $turnos = Turno::all();
        $rutas = Ruta::select('ruta')->distinct()->get();
        $despachadores = Despachador::select('nombre')->orderBy('nombre')->get();
        $choferes = Chofer::select('nombre')->orderBy('nombre')->get();
        $tipos_unidades = TipoUnidad::pluck('nombre', 'id_tipo_unidad')->toArray();
        $fecha_captura = Carbon::now('America/Matamoros')->format('Y-m-d H:i:s');

        return view('orders.create', compact('turnos', 'rutas', 'despachadores', 'choferes', 'tipos_unidades', 'fecha_captura'));
    }
    public function get_by_tipo_unidad(Request $request)
    {
        $id_tipo_unidad = $request->input('id_tipo_unidad');

        $unidades = Unidad::where('id_tipo_unidad', $id_tipo_unidad)->get();

        if ($unidades->isEmpty()) {
            $html = '<option value="" disabled hidden selected>No hay unidades disponibles</option>';
        } else {
            $html = '<option value="" disabled hidden selected>Seleccione una unidad</option>';

            foreach ($unidades as $unidad) {
                $html .= '<option value="' . $unidad->id_unidad . '">' . $unidad->nombre . '</option>';
            }
        }

        return response()->json(['html' => $html]);
    }

}
