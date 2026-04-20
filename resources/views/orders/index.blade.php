{{-- resources/views/orders/index.blade.php --}}
@extends('layouts.user')

@section('content')
<div class="form-container">
    <div class="form-wrapper">
        <div class="mb-4">
            <h1>Órdenes de Servicio</h1>
            <a href="{{ route('orders.create') }}" class="btn-primary">Nueva Orden</a>
        </div>

        @if(session('success'))
            <div class="alert-success">{{ session('success') }}</div>
        @endif

        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>Folio</th>
                        <th>Fecha</th>
                        <th>Ruta</th>
                        <th>Chofer</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($orders as $order)
                    <tr>
                        <td>{{ $order->folio->folio ?? 'N/A' }}</td>
                        <td>{{ $order->fecha_orden }}</td>
                        <td>{{ $order->ruta->nombre ?? 'N/A' }}</td>
                        <td>{{ $order->chofer->nombre ?? 'N/A' }}</td>
                        <td>
                            <a href="#" class="btn-sm">Ver</a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5">No hay órdenes registradas</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
      
    </div>
</div>
@endsection