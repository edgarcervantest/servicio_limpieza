<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Turno;
use App\Models\Ruta;
use App\Models\Despachador;
use App\Models\Chofer;
use App\Models\TipoUnidad;
use App\Models\Unidad;
use App\Models\Folio;
use App\Models\Orden;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Orden::all();
        return view('orders.index', compact('orders'));
    }

    public function create(Request $request)
    {
        $turnos = Turno::all();
        $rutas = Ruta::all();
        $despachadores = Despachador::all();
        $choferes = Chofer::all();
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

    public function getColonias($id_ruta)
    {
        try {
            $ruta = Ruta::with('colonias')->findOrFail($id_ruta);

            // Verificar qué datos estás enviando
            $colonias = $ruta->colonias->map(function ($colonia) {
                return [
                    'id_colonia' => $colonia->id_colonia,
                    'colonia' => $colonia->colonia, // Ajusta según tu campo
                    'habitantes' => $colonia->habitantes ?? 0,
                ];
            });

            return response()->json($colonias);

        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function store(Request $request)
    {

        try {
            $data = $request->validate([
                'fecha_orden' => 'required|date',
                'turno' => 'required|exists:turno,id_turno',
                'ruta' => 'required|exists:ruta,id_ruta',
                'despachador' => 'required|exists:despachador,id_despachador',
                'chofer' => 'required|exists:chofer,id_chofer',
                'tipo_unidad' => 'required|exists:tipo_unidad,id_tipo_unidad',
                'unidad' => 'required|exists:unidad,id_unidad',

                'cantidad_basura' => 'required|numeric',
                'puches' => 'required|integer',
                'km_salida' => 'required|numeric',
                'km_regreso' => 'required|numeric',

                'diesel_inicial' => 'required|numeric',
                'diesel_cargado' => 'required|numeric',
                'diesel_final' => 'required|numeric',

                'suma_porcentaje' => 'required|numeric',
                'porcentaje_atendido' => 'required|numeric',

                'colonias' => 'required|array|min:1',
                'colonias.*.porcentaje' => 'required|numeric|min:0|max:100',
                'colonias.*.habitantes' => 'required|numeric|min:0', // ← Agregar esta línea
            ]);

            DB::transaction(function () use ($data) {

                // 🔒 Bloquea la tabla para evitar duplicados
                $ultimo = Folio::lockForUpdate()->latest('id_folio')->first();

                if ($ultimo) {
                    // Extrae número del folio: MAT-000123 → 123
                    $numero = (int) substr($ultimo->folio, -6);
                    $numero++;
                } else {
                    $numero = 1;
                }

                // Formato: MAT-000001
                $nuevoFolio = 'MAT-' . str_pad($numero, 6, '0', STR_PAD_LEFT);

                // Guarda folio
                $folio = Folio::create([
                    'folio' => $nuevoFolio
                ]);

                // 🔥 cálculos

                $km_total = $data['km_regreso'] - $data['km_salida'];
                $diesel_gastado = ($data['diesel_inicial'] + $data['diesel_cargado']) - $data['diesel_final'];

                // 🔥 Orden
                $orden = Orden::create([
                    'fecha_orden' => $data['fecha_orden'] = str_replace('T', ' ', $data['fecha_orden']),
                    'fecha_captura' => $data['fecha_captura'] = $this->fecha_captura(),
                    'id_folio' => $folio->id_folio,
                    'id_turno' => $data['turno'],
                    'id_ruta' => $data['ruta'],
                    'id_despachador' => $data['despachador'],
                    'id_chofer' => $data['chofer'],
                    'id_tipo_unidad' => $data['tipo_unidad'],
                    'id_unidad' => $data['unidad'],
                    'creado_por' => auth()->id() ?? 1,

                    'cantidad_kl' => $data['cantidad_basura'],
                    'puches' => $data['puches'],
                    'km_salir' => $data['km_salida'],
                    'km_volver' => $data['km_regreso'],
                    'km_total' => $km_total,

                    'diesel_inicial' => $data['diesel_inicial'],
                    'diesel_cargado' => $data['diesel_cargado'],
                    'diesel_final' => $data['diesel_final'],
                    'diesel_gastado' => $diesel_gastado,

                    'suma_porcentaje' => $data['suma_porcentaje'],
                    'porcentaje_atendido' => $data['porcentaje_atendido'],
                    'observaciones' => $data['observaciones'] ?? '',


                ]);



                // 🔥 Pivot: orden_colonia
                foreach ($data['colonias'] as $id_colonia => $colonia) {


                    DB::table('orden_colonia')->insert([
                        'id_orden' => $orden->id_orden,
                        'id_colonia' => $id_colonia,
                        'porcentaje_atendido' => $colonia['porcentaje'],
                        'habitantes' => $colonia['habitantes'],
                    ]);
                }
            });


            return redirect()->route('home')->with('success', 'Orden guardada correctamente');

        } catch (\Illuminate\Validation\ValidationException $e) {
            // Error de validación - vuelve al formulario con errores
            return redirect()->back()
                ->withErrors($e->validator)
                ->withInput();

        } catch (\Exception $e) {
            // Otros errores
            return redirect()->back()
                ->with('error', 'Error al guardar: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function fecha_captura()
    {
        return Carbon::now('America/Matamoros')->format('Y-m-d H:i:s');
    }

}
