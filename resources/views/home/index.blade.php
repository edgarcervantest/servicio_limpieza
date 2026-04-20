@extends('layouts.user')
@section('content')

    <!-- Mostrar errores de validación -->
    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            <strong>¡Error!</strong> No se pudo guardar la orden:
            <ul class="mt-2 list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Mostrar mensaje de éxito -->
    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <!-- Mostrar mensaje de error -->
    @if(session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            {{ session('error') }}
        </div>
    @endif

    <div class="home-container">

        <div class="home-wrapper">

            <!-- Header -->
            <div class="home-welcome">
                <h1>¿Qué vamos a hacer hoy?</h1>
                <p>Selecciona alguna de las siguientes opciones</p>
            </div>


            <!-- <a href="{{ route('home.consulta') }}" class="home-card">
                    <div class="home-card-content">
                        <x-heroicon-s-magnifying-glass-circle class="icon" />
                        <div class="home-card-text">
                            <p>Buscar orden por folio</p> -->

            <!-- Cards Container -->
            <div class="home-card-container">
                <a href="{{ route('orders.create') }}" class="home-card">
                    <div class="home-card-content">
                        <x-heroicon-s-plus-circle class="icon" />
                        <div class="home-card-text">
                            <p>Crear nueva orden</p>
                        </div>
                    </div>
                </a>

                <a href="#" class="home-card">
                    <div class="home-card-content">
                        <x-heroicon-s-pencil-square class="icon" />
                        <div class="home-card-text">
                            <p>Editar orden</p>
                        </div>
                    </div>
                </a>

                <a href="{{ route('home.consulta') }}" class="home-card">
                    <div class="home-card-content">
                        <x-heroicon-s-magnifying-glass-circle class="icon" />
                        <div class="home-card-text">
                            <p>Buscar orden por folio</p>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>

@endsection