@extends('layouts.auth')
@section('content')
<!DOCTYPE html>
<html lang="es">
<body class="antialiased flex flex-col min-h-screen">

  <!-- ======================= HERO ======================= -->
  <section class="hero-pattern border-b border-gray-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 md:py-20">
      <div class="grid md:grid-cols-2 gap-8 items-center">
        <div>
          <!-- <div class="inline-flex items-center gap-2 bg-gob-green-light text-gob-green text-sm font-semibold px-3 py-1 rounded-full mb-4">
            <span class="w-2 h-2 bg-gob-green rounded-full"></span> Ventanilla 24/7
          </div> -->
          <h1 class="text-4xl md:text-5xl font-bold text-gray-50 tracking-tight leading-tight">
            Servicios de <span class="text-gob-green">limpieza urbana</span> para una ciudad más limpia
          </h1>
          <p class="mt-4 text-lg text-gray-400 max-w-lg">
            Recolección de residuos, barrido de calles, limpieza de mercados y más. Programa tu servicio o reporta incidencias en tiempo real.
          </p>
          <div class="mt-8 flex flex-wrap gap-4">
            <a href="#" class="font-bold ml-4 inline-flex items-center justify-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-[#9D2449] transition-none">
              Servicios
            </a>
            <a href="#" class="inline-flex items-center px-5 py-3 border border-gray-300 text-base font-medium rounded-md bg-white text-gray-700 hover:bg-gray-50 transition">
              Conocer más
            </a>
          </div>
          <!-- Ejemplo de 'buscador rápido' similar a imagen: trámites -->
          <div class="mt-8 pt-4 border-t border-gray-200">
            <!-- <p class="text-sm font-medium text-gray-500 mb-2">Búsqueda rápida de servicios:</p> -->
            <!-- <div class="flex flex-wrap gap-2">
              <span class="bg-white border border-gray-200 text-gray-700 text-sm px-3 py-1.5 rounded-full shadow-sm">Recolección de residuos</span>
              <span class="bg-white border border-gray-200 text-gray-700 text-sm px-3 py-1.5 rounded-full shadow-sm">Barrido de calles</span>
              <span class="bg-white border border-gray-200 text-gray-700 text-sm px-3 py-1.5 rounded-full shadow-sm">Limpieza de alcantarillas</span>
              <span class="bg-white border border-gray-200 text-gray-700 text-sm px-3 py-1.5 rounded-full shadow-sm">Poda de árboles</span>
            </div> -->
          </div>
        </div>
        <div class="relative mt-8 md:mt-0 flex justify-center">
          <div class="bg-gob-red-light rounded-2xl p-2 shadow-xl">
            <img src="{{ asset('img/SL.jpg') }}" 
            alt="Servicios de limpieza" 
            class="rounded-xl w-full object-cover shadow-md aspect-[3/2]">
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- ======================= FOOTER (estilo institucional) ======================= -->
  <footer class="bg-linear-to-r from-[#611232] to-[#9B2247] text-gray-300 mt-auto">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
      <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
        <div>
          <div class="flex items-center space-x-2 mb-4">
            <div class="bg-gob-red rounded-md p-1">
              <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M19 21H5a2 2 0 01-2-2V5a2 2 0 012-2h11l5 5v11a2 2 0 01-2 2z" /></svg>
            </div>
            <span class="font-bold text-white text-lg">Servicios de Limpieza</span>
          </div>
          <p class="text-sm text-gray-400">Trabajando por una ciudad limpia, sostenible y con bienestar para todas y todos.</p>
        </div>
        <div>
          <h4 class="font-semibold text-white mb-3">Servicios</h4>
          <ul class="space-y-2 text-sm">
            <li><a href="#" class="hover:text-white transition">Recolección de residuos</a></li>
            <li><a href="#" class="hover:text-white transition">Barrido de calles</a></li>
            <li><a href="#" class="hover:text-white transition">Limpieza de mercados</a></li>
            <li><a href="#" class="hover:text-white transition">Puntos limpios</a></li>
          </ul>
        </div>
        <div>
          <h4 class="font-semibold text-white mb-3">Transparencia</h4>
          <ul class="space-y-2 text-sm">
            <li><a href="#" class="hover:text-white transition">Marco normativo</a></li>
            <li><a href="#" class="hover:text-white transition">Informes trimestrales</a></li>
            <li><a href="#" class="hover:text-white transition">Contrataciones</a></li>
            <li><a href="#" class="hover:text-white transition">Aviso de privacidad</a></li>
          </ul>
        </div>
        <div>
          <h4 class="font-semibold text-white mb-3">Contacto</h4>
          <ul class="space-y-2 text-sm">
            <li class="flex gap-2"><span>📞</span> 55 5658 1111</li>
            <li class="flex gap-2"><span>✉️</span> contacto@limpiezacdmx.gob.mx</li>
            <li class="flex gap-2"><span>📍</span> Av. Central 200, Col. Centro, CDMX</li>
          </ul>
          <div class="flex space-x-4 mt-4">
            <a href="#" class="text-gray-400 hover:text-white"><span class="sr-only">Facebook</span>📘</a>
            <a href="#" class="text-gray-400 hover:text-white"><span class="sr-only">Twitter</span>🐦</a>
            <a href="#" class="text-gray-400 hover:text-white"><span class="sr-only">Instagram</span>📸</a>
          </div>
        </div>
      </div>
      <div class="border-t border-gray-800 mt-10 pt-6 text-center text-xs text-gray-500">
        <p>© 2026 Servicios de Limpieza de la Ciudad · Administración Pública · Hecho en México</p>
        <p class="mt-1">Este sitio es parte de la plataforma digital única del gobierno.</p>
      </div>
    </div>
  </footer>

</body>
</html>
@endsection