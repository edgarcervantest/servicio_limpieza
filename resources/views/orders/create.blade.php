@extends('layouts.user')
@section('content')

    <div class="form-container">
        <div class="form-wrapper">
            {{ Breadcrumbs::render('create') }}

            <div class="mb-4">
                <h1>Complete todos los apartados</h1>
            </div>

            <form action="{{ route('orders.store') }}" method="POST">
                @csrf

                <!-- INFORMACIÓN GENERAL -->
                <div class="form-card modern-card">

                    <div class="card-header collapsible-header" onclick="toggleSection(this)">
                        <h2>Información general</h2>

                        <span class="toggle-icon">
                            <x-heroicon-o-plus-circle class="icon-plus w-6 h-6" />
                            <x-heroicon-o-minus-circle class="icon-minus w-6 h-6 hidden" />
                        </span>
                    </div>

                    <div class="collapsible-content">
                        <div class="form-grid">
                            <div class="input-group">
                                <input type="datetime-local" name="fecha_orden" id="fecha_orden" required>
                                <label>Fecha de la orden</label>
                            </div>

                            <div class="input-group">
                                <input type="datetime-local" name="fecha_captura" id="fecha_captura" readonly>
                                <label for="fecha_captura">Fecha de captura</label>
                            </div>

                            <div class="input-group">
                                <select id="turno" name="turno" required>
                                    <option value="" disabled hidden selected>Seleccione un turno</option>
                                    @foreach($turnos as $turno)
                                        <option value="{{ $turno->id_turno }}">{{ $turno->turno }}
                                        </option>
                                    @endforeach
                                </select>
                                <label for="turno">Turno</label>
                            </div>

                            <div class="input-group">
                                <select id="ruta" name="ruta" required>
                                    <option value="" disabled hidden selected>Seleccione una ruta</option>
                                    @foreach($rutas as $ruta)
                                        <option value="{{ $ruta->id_ruta }}">{{ $ruta->nombre }}
                                        </option>
                                    @endforeach
                                </select>
                                <label for="ruta">Ruta</label>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- PERSONAL Y UNIDADES -->
                <div class="form-card modern-card mt-6">

                    <div class="card-header collapsible-header" onclick="toggleSection(this)">
                        <h2>Personal y Unidades</h2>

                        <span class="toggle-icon">
                            <x-heroicon-o-plus-circle class="icon-plus w-6 h-6" />
                            <x-heroicon-o-minus-circle class="icon-minus w-6 h-6 hidden" />
                        </span>
                    </div>

                    <div class="collapsible-content">
                        <div class="form-grid">

                            <div class="input-group">
                                <select id="despachador" name="despachador" required>
                                    <option value="" disabled hidden selected>Seleccione un despachador</option>
                                    @foreach($despachadores as $despachador)
                                        <option value="{{ $despachador->id_despachador }}">{{ $despachador->nombre }}
                                        </option>
                                    @endforeach
                                </select>
                                <label for="despachador">Despachador</label>
                            </div>

                            <div class="input-group">
                                <select id="chofer" name="chofer" required>
                                    <option value="" disabled hidden selected>Seleccione un chofer</option>
                                    @foreach($choferes as $chofer)
                                        <option value="{{ $chofer->id_chofer }}">{{ $chofer->nombre }}
                                        </option>
                                    @endforeach
                                </select>
                                <label for="chofer">Chofer</label>
                            </div>

                            <div class="input-group">
                                <select id="tipo_unidad" name="tipo_unidad" required
                                    data-url="{{ route('orders.get_by_tipo_unidad') }}">
                                    <option value="" disabled hidden selected>Seleccione un tipo de unidad</option>
                                    @foreach($tipos_unidades as $id => $tipo_unidad)
                                        <option value="{{ $id }}">{{ $tipo_unidad }}</option>
                                    @endforeach
                                </select>
                                <label for="tipo_unidad">Tipo de unidad</label>
                            </div>

                            <div class="input-group {{ $errors->has('id_unidad') ? 'has-error' : '' }}">
                                <select id="unidad" name="unidad" required>
                                </select>
                                @if($errors->has('id_unidad'))
                                    <p class="help-block">{{ $errors->first('id_unidad') }}</p>
                                @endif
                                <label for="unidad">Unidad</label>
                            </div>

                        </div>
                    </div>
                </div>

                <!-- DATOS OPERATIVOS -->
                <div class="form-card modern-card mt-6">

                    <div class="card-header collapsible-header" onclick="toggleSection(this)">
                        <h2>Datos operativos</h2>

                        <span class="toggle-icon">
                            <x-heroicon-o-plus-circle class="icon-plus w-6 h-6" />
                            <x-heroicon-o-minus-circle class="icon-minus w-6 h-6 hidden" />
                        </span>
                    </div>

                    <div class="collapsible-content">
                        <div class="form-grid">

                            <div class="input-group">
                                <input type="number" step="0.01" id="cantidad_basura" name="cantidad_basura"
                                    placeholder="Ingrese la cantidad" required>
                                <label for="cantidad_basura">Cantidad de basura (kilos)</label>
                            </div>

                            <div class="input-group">
                                <input type="number" id="puches" name="puches" placeholder="Ingrese la cantidad" required>
                                <label for="puches">Cantidad de puches</label>
                            </div>

                            <div class="input-group">
                                <input type="number" step="0.01" id="km_salida" name="km_salida"
                                    placeholder="Ingrese la cantidad" required>
                                <label for="km_salida">Cantidad de kilometros al salir</label>
                            </div>

                            <div class="input-group">
                                <input type="number" step="0.01" id="km_regreso" name="km_regreso"
                                    placeholder="Ingrese la cantidad" required>
                                <label for="km_regreso">Cantidad de kilometros al regresar</label>
                            </div>

                            <div class="input-group">
                                <input type="number" step="0.01" id="km_total" name="km_total"
                                    placeholder="Ingrese la cantidad" readonly>
                                <label for="km_total">Total de kilometros recorridos</label>
                            </div>


                        </div>
                    </div>
                </div>

                <!-- CONTROL DE COMBUSTIBLE -->
                <div class="form-card modern-card mt-6">

                    <div class="card-header collapsible-header" onclick="toggleSection(this)">
                        <h2>Control de combustible</h2>

                        <span class="toggle-icon">
                            <x-heroicon-o-plus-circle class="icon-plus w-6 h-6" />
                            <x-heroicon-o-minus-circle class="icon-minus w-6 h-6 hidden" />
                        </span>
                    </div>

                    <div class="collapsible-content">
                        <div class="form-grid">

                            <div class="input-group">
                                <input type="number" step="0.01" id="diesel_inicial" name="diesel_inicial"
                                    placeholder="Ingrese la cantidad" required>
                                <label for="diesel_inicial">Diesel inicial (litros)</label>
                            </div>

                            <div class="input-group">
                                <input type="number" step="0.01" id="diesel_cargado" name="diesel_cargado"
                                    placeholder="Ingrese la cantidad" required>
                                <label for="diesel_cargado">Diesel cargado (litros)</label>
                            </div>

                            <div class="input-group">
                                <input type="number" step="0.01" id="diesel_final" name="diesel_final"
                                    placeholder="Ingrese la cantidad" required>
                                <label for="diesel_final">Diesel final (litros)</label>
                            </div>

                            <div class="input-group">
                                <input type="number" step="0.01" id="diesel_gastado" name="diesel_gastado" readonly>
                                <label for="diesel_gastado">Diesel gastado (litros)</label>
                            </div>

                        </div>
                    </div>
                </div>

                <div id="colonias-card" class="form-card modern-card mt-6 hidden">

                    <div class="card-header collapsible-header" onclick="toggleSection(this)">
                        <h2>Colonias de la ruta</h2>

                        <span class="toggle-icon">
                            <x-heroicon-o-plus-circle class="icon-plus w-6 h-6" />
                            <x-heroicon-o-minus-circle class="icon-minus w-6 h-6 hidden" />
                        </span>
                    </div>

                    <div class="collapsible-content">
                        <div class="colonias-tabla-wrapper">
                            <table class="colonias-tabla">
                                <thead>
                                    <tr>
                                        <th class="colonias-th">#</th>
                                        <th class="colonias-th">Nombre</th>
                                        <th class="colonias-th">Habitantes</th>
                                        <th class="colonias-th">Porcentaje %</th>
                                    </tr>
                                </thead>
                                <tbody id="colonias-tbody"></tbody>
                            </table>
                        </div>
                    </div>

                </div>

                <!-- METRICAS Y RENDIMIENTO -->
                <div class="form-card modern-card mt-6">

                    <div class="card-header collapsible-header" onclick="toggleSection(this)">
                        <h2>Métricas y Rendimiento</h2>

                        <span class="toggle-icon">
                            <x-heroicon-o-plus-circle class="icon-plus w-6 h-6" />
                            <x-heroicon-o-minus-circle class="icon-minus w-6 h-6 hidden" />
                        </span>
                    </div>

                    <div class="collapsible-content">
                        <div class="form-grid">

                            <div class="input-group">
                                <input type="number" step="0.01" id="suma_porcentaje" name="suma_porcentaje"
                                    placeholder="Ingrese el porcentaje para cada colonia" readonly>
                                <label for="suma_porcentaje">Suma de porcentaje atendido</label>
                            </div>

                            <div class="input-group">
                                <input type="number" step="0.01" id="porcentaje_atendido" name="porcentaje_atendido"
                                    placeholder="Ingrese el porcentaje para cada colonia" readonly>
                                <label for="porcentaje_atendido">Porcentaje atendido</label>
                            </div>

                        </div>
                    </div>
                </div>

                <!-- OBSERVACIONES -->
                <div class="form-card modern-card mt-6">

                    <div class="card-header collapsible-header" onclick="toggleSection(this)">
                        <h2>Observaciones</h2>

                        <span class="toggle-icon">
                            <x-heroicon-o-plus-circle class="icon-plus w-6 h-6" />
                            <x-heroicon-o-minus-circle class="icon-minus w-6 h-6 hidden" />
                        </span>
                    </div>

                    <div class="collapsible-content">
                        <div class="form-grid">

                            <div class="input-group">
                                <textarea id="observaciones" name="observaciones"
                                    placeholder="En caso de no tener observaciones, dejar en blanco"></textarea>
                                <label for="observaciones">Comentario</label>
                            </div>

                        </div>
                    </div>
                </div>

                <!-- BOTN GLOBAL -->
                <div class="form-actions mt-6">
                    <button type="submit" id="btnGuardar" class="btn-secondary">Guardar</button>
                </div>
            </form>
        </div>
    </div>

@endsection