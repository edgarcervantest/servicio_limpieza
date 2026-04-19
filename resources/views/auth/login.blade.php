<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Iniciar Sesión - Servicios Limpieza</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&display=swap" rel="stylesheet">
  <style>
    body { font-family: 'Montserrat', sans-serif; }
    /* Colores exactos de la imagen */
    .bg-gob-vino { background-color: #541C34; }
    .bg-gob-rojo { background-color: #9D2449; }
    .text-gob-oro { color: #D4C19C; }
    .btn-gob { background-color: #9D2449; transition: all 0.3s; }
    .btn-gob:hover { background-color: #541C34; }
  </style>
</head>
<body class="bg-gray-100 antialiased">

  <header class="bg-gob-vino w-full shadow-md">
    <div class="max-w-7xl mx-auto px-4 h-16 flex justify-between items-center">
      <div class="flex items-center space-x-2">
        <h2 class="text-white text-lg font-bold tracking-wide "> Servicios de Limpieza </h2>
      </div>
      
      <!-- <nav class="hidden md:flex items-center space-x-6 text-white text-sm">
        <button class="text-white">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
          </svg>
        </button>
      </nav> -->
    </div>
  </header>

  <div class="bg-gob-rojo w-full py-3 shadow-sm">
    <div class="max-w-7xl mx-auto px-4">
      <h2 class="text-white text-lg font-medium tracking-wide"></h2>
    </div>
  </div>

  <main class="flex flex-col items-center justify-center py-16 px-4">
    
    <div class="max-w-md w-full mb-8 flex items-center text-xs text-gray-500 space-x-2">
       <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path></svg>
       <span>> Iniciar sesión</span>
    </div>

    <div class="max-w-md w-full bg-white rounded-lg shadow-xl border-t-4 border-gob-rojo overflow-hidden">
      <div class="p-8">
        <h1 class="text-3xl font-bold text-gray-800 mb-2">Ingresa a tu cuenta</h1>
        <div class="w-12 h-1 bg-gob-oro mb-6"></div> <p class="text-sm text-gray-600 mb-8">Por favor, ingresa los datos necesarios para acceder al sistema.</p>

        <form action="{{ route('login') }}" method="POST" class="space-y-6">
          @csrf
          <div>
            <label clss="block text-sm font-semibold text-gray-700 mb-2">Correo electrónico</label>
            <input type="email" name="email" required
              class="w-full px-4 py-3 border border-gray-300 rounded focus:ring-2 focus:ring-gob-rojo focus:border-gob-rojo outline-none transition"
              placeholder="ejemplo@correo.com">
          </div>

          <div>
            <label class="block text-sm font-semibold text-gray-700 mb-2">Contraseña</label>
            <input type="password" name="password" required
              class="w-full px-4 py-3 border border-gray-300 rounded focus:ring-2 focus:ring-gob-rojo focus:border-gob-rojo outline-none transition"
              placeholder="••••••••">
          </div>

          @if($errors->any())
          <div class="p-3 mb-4 text-sm text-red-700 bg-red-100 rounded-lg">
            {{ $errors->first() }}
          </div>
          @endif

           <div class="flex items-center justify-between flex-wrap gap-2">
              <div class="flex items-center">
                  <input type="checkbox" id="remember" class="w-4 h-4 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500">
                  <label for="remember" class="ml-2 text-sm text-gray-600">Recordarme</label>
              </div>
              <a href="#" class="text-sm text-gob-rojo hover:underline">¿Olvidaste tu contraseña?</a>
            </div>

          <button type="submit" 
            class="w-full btn-gob text-white font-bold py-3 rounded shadow-lg uppercase tracking-wider">
            Acceder
          </button>
        </form>

        <div class="mt-8 pt-6 border-t border-gray-100 flex flex-col items-center space-y-4">
          <a href="#" class="text-sm text-gob-rojo hover:underline">¿Olvidaste tu contraseña?</a>
          <p class="text-xs text-gray-400 uppercase tracking-widest">Servicios de Limpieza</p>
        </div>
      </div>
    </div>
  </main>

</body>
</html>