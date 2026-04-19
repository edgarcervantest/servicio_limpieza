@extends('layouts.user')

@section('content')
<div class="home-container min-h-screen">
    <div class="home-wrapper">
        
        <div class="home-welcome">
            <h1>Sistema de Consulta</h1>
            <p>Ingresa el número de folio para ver los detalles</p>
        </div>

        <div class="flex justify-center">
            <div class="query-card">
                <h2>Consultar Folio</h2>
                
                <form action="{{ route('home.buscar_orden') }}" method="GET" class="flex flex-col gap-6">
                    <input type="number" name="folio" placeholder="Ejemplo: 101" class="query-input" required>
                    
                    <button type="submit" class="btn-primary justify-center w-full">
                        BUSCAR ORDEN
                    </button>
                </form>
            </div>
        </div>

        <div class="text-center mt-12">
            <a href="{{ route('home') }}" class="text-gray-500 hover:text-white text-xs uppercase tracking-widest font-bold transition-all duration-300">
                ← Volver al inicio
            </a>
        </div>
    </div>
</div>
@endsection