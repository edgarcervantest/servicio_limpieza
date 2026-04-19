@extends('layouts.user')

@section('content')
<div class="home-container min-h-screen pb-20">
    <div class="home-wrapper">
        
        <div class="home-welcome">
            <h1 class="uppercase tracking-tighter">Sistema de Consulta</h1>
        </div>

        <div class="flex justify-center mb-10">
            <div class="query-card !max-w-2xl"> 
                <form action="{{ route('home.buscar_orden') }}" method="GET" class="flex flex-col md:flex-row gap-4">
                    <input type="number" name="folio" value="{{ request('folio') }}" 
                           class="query-input flex-1 font-bold" placeholder="Folio">
                    <button type="submit" class="btn-primary font-bold uppercase tracking-widest">
                        Buscar otra orden 
                    </button>
                </form>
            </div>
        </div>

        <div class="flex justify-center">
            @if($orden)
            <div class="w-full max-w-4xl mx-auto bg-[#9B2247] rounded-lg shadow-xl overflow-hidden border border-white/10">
                
                <div class="bg-[#611232] p-6 border-b border-white/10 flex justify-between items-start">
                    <div>
                        <h2 class="text-white font-bold text-xl uppercase tracking-tight">Folio #{{ $orden->id }}</h2>
                        <p class="text-[10px] text-gray-400 uppercase font-bold tracking-widest mt-1">Fecha Orden: {{ $orden->fecha_orden }}</p>
                        <p class="text-[10px] text-gray-400 uppercase font-bold tracking-widest mt-1">Fecha Captura: {{ $orden->fecha_captura }}</p>
                    </div>
                    <div class="text-right">
                        <span class="text-[10px] block text-gray-400 uppercase font-bold tracking-widest">Turno</span>
                        <span class="text-white font-bold text-lg">{{ $orden->turno }}</span>
                        <span class="text-[10px] block text-gray-400 uppercase font-bold tracking-widest mt-2">Ruta</span>
                        <span class="text-white font-bold text-lg">{{ $orden->ruta }}</span>
                    </div>
                </div>

                <div class="p-8 space-y-10">
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                        <div><span class="result-label uppercase tracking-widest">Despachador</span><p class="result-value font-bold">{{ $orden->despachador->nombre ?? 'N/A' }}</p></div>
                        <div><span class="result-label uppercase tracking-widest">Chofer</span><p class="result-value font-bold">{{ $orden->chofer->nombre ?? 'N/A' }}</p></div> 
                        <div><span class="result-label uppercase tracking-widest">Tipo Unidad</span><p class="result-value font-bold">{{ $orden->tipo_unidad->nombre ?? 'N/A' }}</p></div>
                        <div><span class="result-label uppercase tracking-widest">Unidad</span><p class="result-value font-bold">{{ $orden->unidad_num->nombre ?? 'N/A' }}</p></div> 
                    </div>

                    <div class="space-y-4">
                        <h3 class="text-white/30 text-[10px] font-bold uppercase tracking-widest border-b border-white/5 pb-2">Kilometraje</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                            <div><span class="result-label uppercase tracking-widest">Cantidad kl</span><p class="result-value font-bold">{{ number_format($orden->cantidad_kl, 2) }}</p></div>
                            <div><span class="result-label uppercase tracking-widest">Puches</span><p class="result-value font-bold">{{ $orden->puches }}</p></div>
                            <div><span class="result-label uppercase tracking-widest">Km Salida</span><p class="result-value font-bold">{{ number_format($orden->km_salir)}}</p></div>
                            <div><span class="result-label uppercase tracking-widest">Km Vuelta</span><p class="result-value font-bold">{{ number_format($orden->km_volver) }}</p></div>
                        </div>
                    </div>

                    <div class="space-y-4">
                        <h3 class="text-white/30 text-[10px] font-bold uppercase tracking-widest border-b border-white/5 pb-2">Diesel [L]</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                            <div><span class="result-label uppercase tracking-widest">Inicial</span><p class="result-value font-bold">{{ $orden->diesel_inicial }}</p></div>
                            <div><span class="result-label uppercase tracking-widest">Final</span><p class="result-value font-bold">{{ $orden->diesel_final }}</p></div>
                            <div><span class="result-label uppercase tracking-widest">Cargado</span><p class="result-value font-bold">{{ $orden->diesel_cargado }}</p></div>
                            <div><span class="result-label uppercase tracking-widest">Unidad</span><p class="result-value font-bold">{{ $orden->diesel_en_unidad }}</p></div>
                        </div>
                    </div>

                    <div>
                        <h3 class="text-white/30 text-[10px] font-bold uppercase tracking-widest mb-4 border-b border-white/5 pb-2">Colonias de Ruta</h3>
                        <div class="overflow-x-auto">
                            <table class="w-full text-left text-sm text-white">
                                <thead>
                                    <tr class="text-[10px] uppercase text-gray-400 border-b border-white/10 font-bold tracking-widest">
                                        <th class="py-3 pr-4">Número</th>
                                        <th class="py-3 pr-4">Nombre</th>
                                        <th class="py-3 px-4 text-center">Porcentaje</th>
                                        <th class="py-3 pl-4 text-right">Habitantes</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-white/5">
                                    @foreach($orden->colonias as $colonia)
                                    <tr class="font-bold">
                                        <td class="py-4 pr-4 text-gray-300">{{ $colonia->id_colonia }}</td>
                                        <td class="py-4 pr-4 uppercase tracking-tight">{{ $colonia->colonia }}</td>
                                        <td class="py-4 px-4 text-center font-mono">{{ $colonia->porcentaje ?? 0 }}%</td>
                                        <td class="py-4 pl-4 text-right font-mono">{{ number_format($colonia->habitantes) }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr class="border-t border-white/20">
                                        <td colspan="3" class="py-6 text-right text-[10px] uppercase text-gray-400 font-bold tracking-widest">Suma:</td>
                                        <td class="py-6 text-right font-black text-2xl tracking-tighter">{{ number_format($orden->suma_habitantes) }}</td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>

                    <div class="flex justify-center pt-6 border-t border-white/5">
                        <div class="text-center">
                            <span class="result-label uppercase tracking-widest font-bold">Porcentaje Atendido</span>
                            <p class="text-4xl font-black text-white mt-2 tracking-tighter">{{ $orden->porcentaje_atendido }}%</p>
                        </div>
                    </div>

                </div>
            </div>
            @else
                <div class="text-center py-20">
                    <p class="text-gray-500 italic font-bold uppercase tracking-widest">No se encontró el folio solicitado</p>
                </div>
            @endif
        </div>

        <div class="text-center mt-12">
            <a href="{{ route('home') }}" class="text-gray-500 hover:text-white text-xs uppercase tracking-widest font-bold transition-all duration-300">
                ← Volver al inicio
            </a>
        </div>

    </div>
</div>
@endsection