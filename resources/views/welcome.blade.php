@extends('layouts.auth')
@section('content')
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
  <title>LimpiezaCDMX · Servicios de limpieza de la ciudad</title>
  <!-- Tailwind CSS v3 + CDN -->
  <script src="https://cdn.tailwindcss.com"></script>
  <!-- Extender tema y personalización para igualar colores institucionales (verde gobierno + tonos) -->
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,400;14..32,500;14..32,600;14..32,700&display=swap');
    body {
      font-family: 'Inter', system-ui, -apple-system, 'Segoe UI', Roboto, Helvetica, sans-serif;
    }
    /* Paleta inspirada en imagen gob.mx: verde bandera, grises neutros, acentos */
    .bg-gob-green {
      background-color: #9D2449;
    }
    .bg-gob-green-light {
      background-color: #E9F4E9;
    }
    .text-gob-green {
      color: #9D2449;
    }
    .border-gob-green {
      border-color: #9D2449;
    }
    .hover-gob-green:hover {
      background-color: #9D2449;
    }
    .focus-ring-gob:focus {
      outline: none;
      ring: 2px solid #9D2449;
      ring-offset: 2px;
    }
    .hero-pattern {
      background-image: linear-gradient(135deg, #f5f7fa 0%, #eef2f5 100%);
    }
    /* efecto tarjeta sutil */
    .service-card {
      transition: transform 0.2s ease, box-shadow 0.2s ease;
    }
    .service-card:hover {
      transform: translateY(-4px);
      box-shadow: 0 20px 25px -12px rgba(0,0,0,0.1);
    }
  </style>
</head>
<body class="bg-gray-50 antialiased flex flex-col min-h-screen">

  <!-- ======================= HEADER + MENÚ HAMBURGUESA ======================= -->
  <header class="bg-white border-b border-gray-200 sticky top-0 z-50 shadow-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex justify-between items-center h-16">
        
        <!-- Logo / marca (estilo institucional) -->
        <div class="flex items-center space-x-2">
          <div class="bg-gob-green rounded-md p-1.5">
            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M19 21H5a2 2 0 01-2-2V5a2 2 0 012-2h11l5 5v11a2 2 0 01-2 2z" />
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M17 21v-4H7v4M9 7h6" />
            </svg>
          </div>
          <span class="font-bold text-xl text-gray-800 tracking-tight">Servicios de<span class="text-gob-green"> Limpieza</span></span>
        </div>

        <!-- Menú de escritorio (visible en md+) -->
        <nav class="hidden md:flex space-x-8 items-center">
          <a href="#" class="text-gray-700 hover:text-gob-green font-medium transition">Inicio</a>
          <a href="#" class="text-gray-700 hover:text-gob-green font-medium transition">Servicios</a>
          <a href="#" class="text-gray-700 hover:text-gob-green font-medium transition">Transparencia</a>
          <a href="#" class="text-gray-700 hover:text-gob-green font-medium transition">Contacto</a>
          <a href="#" class="ml-4 inline-flex items-center justify-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-gob-green hover:bg-[#00563b] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#006847] transition">
            Login
          </a>
        </nav>

        <!-- Botón hamburguesa (mobile) -->
        <button id="menu-btn" class="md:hidden rounded-md p-2 text-gray-500 hover:text-gray-700 hover:bg-gray-100 focus:outline-none">
          <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
          </svg>
        </button>
      </div>

      <!-- Menú mobile (desplegable con JS vanilla) -->
      <div id="mobile-menu" class="hidden md:hidden bg-white border-t border-gray-100 py-3 px-2 pb-4 shadow-inner">
        <div class="space-y-2">
          <a href="#" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-gob-green hover:bg-gray-50 transition">Inicio</a>
          <a href="#" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-gob-green hover:bg-gray-50 transition">Servicios</a>
          <a href="#" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-gob-green hover:bg-gray-50 transition">Transparencia</a>
          <a href="#" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-gob-green hover:bg-gray-50 transition">Contacto</a>
          <div class="pt-2">
            <a href="#" class="w-full flex justify-center items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-gob-green hover:bg-[#00563b] transition">
              Login
            </a>
          </div>
        </div>
      </div>
    </div>
  </header>

  <!-- ======================= HERO ======================= -->
  <section class="hero-pattern border-b border-gray-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 md:py-20">
      <div class="grid md:grid-cols-2 gap-8 items-center">
        <div>
          <!-- <div class="inline-flex items-center gap-2 bg-gob-green-light text-gob-green text-sm font-semibold px-3 py-1 rounded-full mb-4">
            <span class="w-2 h-2 bg-gob-green rounded-full"></span> Ventanilla 24/7
          </div> -->
          <h1 class="text-4xl md:text-5xl font-bold text-gray-800 tracking-tight leading-tight">
            Servicios de <span class="text-gob-green">limpieza urbana</span> para una ciudad más limpia
          </h1>
          <p class="mt-4 text-lg text-gray-600 max-w-lg">
            Recogida de residuos, barrido de calles, limpieza de mercados y más. Programa tu servicio o reporta incidencias en tiempo real.
          </p>
          <div class="mt-8 flex flex-wrap gap-4">
            <a href="#" class="inline-flex items-center px-5 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-gob-green hover:bg-[#00563b] transition">
              Iniciar Sesión
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
          <div class="bg-gob-green-light rounded-2xl p-2 shadow-xl">
            <img src="https://placehold.co/600x400/DDEEEE/006847?text=Limpieza+Ciudadana" alt="Servicios de limpieza de la ciudad" class="rounded-xl w-full object-cover shadow-md">
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- ======================= FOOTER (estilo institucional) ======================= -->
  <footer class="bg-gray-900 text-gray-300 mt-auto">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
      <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
        <div>
          <div class="flex items-center space-x-2 mb-4">
            <div class="bg-gob-green rounded-md p-1">
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

  <!-- JavaScript vanilla para menú hamburguesa (sin frameworks) -->
  <script>
    (function() {
      const menuBtn = document.getElementById('menu-btn');
      const mobileMenu = document.getElementById('mobile-menu');
      
      if (menuBtn && mobileMenu) {
        menuBtn.addEventListener('click', function() {
          // Alternar visibilidad del menú mobile
          if (mobileMenu.classList.contains('hidden')) {
            mobileMenu.classList.remove('hidden');
            mobileMenu.classList.add('block');
          } else {
            mobileMenu.classList.remove('block');
            mobileMenu.classList.add('hidden');
          }
        });
        
        // Cerrar el menú automáticamente cuando se hace clic en un enlace (mejor experiencia)
        const mobileLinks = mobileMenu.querySelectorAll('a');
        mobileLinks.forEach(link => {
          link.addEventListener('click', function() {
            mobileMenu.classList.remove('block');
            mobileMenu.classList.add('hidden');
          });
        });
      }
      
      // pequeño ajuste para responsivo al redimensionar: si se pasa a desktop con menú abierto se oculta estéticamente
      window.addEventListener('resize', function() {
        if (window.innerWidth >= 768) { // md breakpoint
          if (mobileMenu && !mobileMenu.classList.contains('hidden')) {
            mobileMenu.classList.add('hidden');
            mobileMenu.classList.remove('block');
          }
        }
      });
    })();
  </script>
</body>
</html>
@endsection