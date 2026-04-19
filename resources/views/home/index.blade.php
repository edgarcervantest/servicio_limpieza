@extends('layouts.user')
@section('content')

<div class="home-container">
    <div class="home-wrapper">
        <!-- Header -->
        <div class="home-welcome">
            <h1>¿Qué vamos a hacer hoy?</h1>
            <p>Selecciona alguna de las siguientes opciones</p>
        </div>

        <!-- Cards Container -->
        <div class="home-card-container">
            <a href="#" class="home-card">
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

            <a href="#" class="home-card">
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