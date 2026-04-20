@extends('layouts.auth')
@section('content')
        
  <main class="flex flex-col items-center justify-center min-h-screen py-12 px-4 sm:px-6 lg:px-8">
    <div class="w-full max-w-md">
      {{ Breadcrumbs::render('register') }}
      <div class="bg-[#1c1c1c]/90 backdrop-blur-sm rounded-2xl shadow-2xl border-t-4 border-gob-rojo overflow-hidden">
        <div class="px-8 py-10 sm:px-10">
          <!-- Header -->
          <div class="text-center mb-8">
            <h1 class="text-4xl font-bold text-gray-50 mb-3">Crear cuenta</h1>
            <div class="w-20 h-1 bg-gob-oro mx-auto mb-4"></div>
            <p class="text-sm text-gray-300">Ingresa tus datos para registrarte en el sistema</p>
          </div>

          <!-- Formulario -->
          <form action="{{ route('register') }}" method="POST" class="space-y-6">
            @csrf
            <!-- Nombre y Apellido -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
              <div class="space-y-2">
                <label class="block text-sm font-semibold text-gray-200">Nombre</label>
                <input type="text" name="first_name" required
                  class="w-full px-4 py-3 bg-gray-800/50 text-gray-100 border border-gray-600 rounded-lg focus:ring-2 focus:ring-gob-rojo focus:border-gob-rojo outline-none transition placeholder-gray-500"
                  placeholder="Tu nombre">
              </div>

              <div class="space-y-2">
                <label class="block text-sm font-semibold text-gray-200">Apellido</label>
                <input type="text" name="last_name" required
                  class="w-full px-4 py-3 bg-gray-800/50 text-gray-100 border border-gray-600 rounded-lg focus:ring-2 focus:ring-gob-rojo focus:border-gob-rojo outline-none transition placeholder-gray-500"
                  placeholder="Tu apellido">
              </div>
            </div>

            <!-- Email -->
            <div class="space-y-2">
              <label class="block text-sm font-semibold text-gray-200">Correo electrónico</label>
              <input type="email" name="email" required
                class="w-full px-4 py-3 bg-gray-800/50 text-gray-100 border border-gray-600 rounded-lg focus:ring-2 focus:ring-gob-rojo focus:border-gob-rojo outline-none transition placeholder-gray-500"
                placeholder="ejemplo@correo.com">
            </div>

            <!-- Contraseña -->
            <div class="space-y-2">
              <label class="block text-sm font-semibold text-gray-200">Contraseña</label>
              <input type="password" name="password" required
                class="w-full px-4 py-3 bg-gray-800/50 text-gray-100 border border-gray-600 rounded-lg focus:ring-2 focus:ring-gob-rojo focus:border-gob-rojo outline-none transition placeholder-gray-500"
                placeholder="Crea una contraseña segura">
            </div>

            <!-- Confirmar Contraseña -->
            <div class="space-y-2">
              <label class="block text-sm font-semibold text-gray-200">Confirmar contraseña</label>
              <input type="password" name="password_confirmation" required
                class="w-full px-4 py-3 bg-gray-800/50 text-gray-100 border border-gray-600 rounded-lg focus:ring-2 focus:ring-gob-rojo focus:border-gob-rojo outline-none transition placeholder-gray-500"
                placeholder="Repite tu contraseña">
            </div>

            <!-- Términos -->
            <div class="flex items-center gap-4">
              <label class="flex items-center cursor-pointer">
                <input type="checkbox" id="terms" name="terms" required
                  class="w-4 h-4 text-gob-rojo bg-gray-700 border-gray-600 rounded focus:ring-gob-rojo">
                <span class="ml-2 text-sm text-gray-300">
                  Acepto los <a href="#" class="text-gob-oro hover:text-gob-rojo transition-colors">términos y condiciones</a>
                </span>
              </label>
            </div>

            <!-- Botón -->
            <button type="submit"
              class="w-full group relative flex items-center justify-center gap-2 px-4 py-3 bg-gradient-to-r from-[#9B2247] to-[#7D1A3A] text-gray-50 font-bold text-base rounded-lg hover:from-[#7D1A3A] hover:to-[#611232] transition-all duration-200 transform hover:scale-[1.02]">
              <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
              </svg>
              <span>Registrarme</span>
            </button>
          </form>

          <!-- Footer -->
          <div class="mt-8 pt-6 border-t border-gray-700 text-center">
            <p class="text-sm text-gray-400">
              ¿Ya tienes una cuenta?
              <a href="{{ route('login') }}" class="text-gob-oro hover:text-gob-rojo font-semibold transition-colors">Iniciar sesión</a>
            </p>
            <p class="text-xs text-gray-500 uppercase tracking-widest mt-4">Servicios de Limpieza</p>
          </div>
        </div>
      </div>
    </div>
  </main>

@endsection