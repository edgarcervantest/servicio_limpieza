@extends('layouts.auth')

@section('content')
<main class="flex flex-col items-center justify-center min-h-screen py-12 px-4 sm:px-6 lg:px-8">
    
    <div class="w-full max-w-md">
        {{ Breadcrumbs::render('login') }}
        
        <div class="bg-[#1c1c1c]/90 backdrop-blur-sm rounded-2xl shadow-2xl border-t-4 border-gob-rojo overflow-hidden">
            <div class="px-8 py-10 sm:px-10">
                <!-- Header -->
                <div class="text-center mb-8">
                    <h1 class="text-4xl font-bold text-gray-50 mb-3">Iniciar sesión</h1>
                    <div class="w-20 h-1 bg-gob-oro mx-auto mb-4"></div>
                    <p class="text-sm text-gray-300">Ingresa tus credenciales para acceder al sistema</p>
                </div>

                <!-- Formulario -->
                <form action="{{ route('login') }}" method="POST" class="space-y-6">
                    @csrf

                    <!-- Campo Email -->
                    <div class="space-y-2">
                        <label class="block text-sm font-semibold text-gray-200">
                            Correo electrónico
                        </label>
                        <input type="email" 
                               name="email" 
                               required
                               value="{{ old('email') }}"
                               class="w-full px-4 py-3 bg-gray-800/50 text-gray-100 border border-gray-600 rounded-lg focus:ring-2 focus:ring-gob-rojo focus:border-gob-rojo outline-none transition placeholder-gray-500"
                               placeholder="ejemplo@correo.com">
                    </div>

                    <!-- Campo Contraseña -->
                    <div class="space-y-2">
                        <label class="block text-sm font-semibold text-gray-200">
                            Contraseña
                        </label>
                        <input type="password" 
                               name="password" 
                               required
                               class="w-full px-4 py-3 bg-gray-800/50 text-gray-100 border border-gray-600 rounded-lg focus:ring-2 focus:ring-gob-rojo focus:border-gob-rojo outline-none transition placeholder-gray-500"
                               placeholder="Ingresa tu contraseña">
                    </div>

                    <!-- Errores -->
                    @if($errors->any())
                        <div class="p-4 text-sm text-red-200 bg-red-900/50 border border-red-700 rounded-lg">
                            <div class="flex items-center gap-2">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                </svg>
                                <span>{{ $errors->first() }}</span>
                            </div>
                        </div>
                    @endif

                    <!-- Opciones adicionales -->
                    <div class="flex flex-col sm:flex-row items-center justify-between gap-4">
                        <label class="flex items-center cursor-pointer">
                            <input type="checkbox" 
                                   id="remember" 
                                   name="remember"
                                   class="w-4 h-4 text-gob-rojo bg-gray-700 border-gray-600 rounded focus:ring-gob-rojo focus:ring-offset-0">
                            <span class="ml-2 text-sm text-gray-300">Recordarme</span>
                        </label>
                        <a href="#" class="text-sm text-gray-300 hover:text-gob-oro hover:text-gob-rojo transition-colors">
                            ¿Olvidaste tu contraseña?
                        </a>
                    </div>

                    <!-- Botón Submit -->
                    <button type="submit"
                            class="w-full group relative flex items-center justify-center gap-2 px-4 py-3 bg-gradient-to-r from-[#9B2247] to-[#7D1A3A] text-gray-50 font-bold text-base rounded-lg hover:from-[#7D1A3A] hover:to-[#611232] transition-all duration-200 transform hover:scale-[1.02] focus:ring-2 focus:ring-gob-rojo focus:ring-offset-2 focus:ring-offset-[#1c1c1c]">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
                        </svg>
                        <span>Acceder al sistema</span>
                    </button>
                </form>

                <!-- Footer -->
                <div class="mt-8 pt-6 border-t border-gray-700 text-center">
                    <p class="text-sm text-gray-400">
                        ¿No tienes una cuenta?
                        <a href="{{ route('register') }}" class="hover:text-gob-rojo font-semibold transition-colors">
                            Crear una cuenta
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection