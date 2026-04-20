<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Servicio de Limpieza Urbana</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.9.2/parsley.min.js"
        integrity="sha512-eyHL1atYNycXNXZMDndxrDhNAegH2BDWt1TmkXJPoGf1WLlNYt08CSjkqF5lnCRmdm3IrkHid8s2jOUY4NIZVQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <div class="main">
        <nav class="nav-desktop-user">
            <div class="nav-header">
                <h1>Servicio de Limpieza Urbana</h1>

                <!-- Botón hamburguesa (solo visible en móvil) -->
                <button id="menuBtn" class="menu-btn">
                    <svg class="menu-icon w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                    <svg class="close-icon hidden w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                        </path>
                    </svg>
                </button>
            </div>

            <!-- Botón logout desktop (visible solo en desktop) -->
            <div class="logout-desktop">

                <a href="{{ route('login') }}" class="btn-primary">
                    <x-heroicon-o-arrow-right-on-rectangle class="icon" />
                    Iniciar Sesión
                </a>

            </div>
        </nav>

        <!-- Menú móvil (solo contiene logout) -->
        <div id="mobileMenu" class="mobile-menu hidden">
            <a href="{{ route('login') }}" class="btn-primary mobile-logout">
                <x-heroicon-o-arrow-right-on-rectangle class="icon" />
                Iniciar Sesión
            </a>
        </div>
    </div>

    @yield('content')

</body>

</html>