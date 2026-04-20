import './bootstrap';
import './rutas-colonias.js';
import './porcentaje-ruta.js';

function updateClock() {
    const now = new Date();

    const options = {
        timeZone: 'America/Matamoros',
        year: 'numeric',
        month: '2-digit',
        day: '2-digit',
        hour: '2-digit',
        minute: '2-digit',
        second: '2-digit',
        hour12: false
    };

    const formatter = new Intl.DateTimeFormat('es-MX', options);
    const formattedParts = formatter.formatToParts(now);

    let dateTime = {};
    formattedParts.forEach(part => {
        if (part.type !== 'literal') {
            dateTime[part.type] = part.value;
        }
    });

    const formattedTime = `${dateTime.year}-${dateTime.month}-${dateTime.day} ${dateTime.hour}:${dateTime.minute}:${dateTime.second}`;

    // Actualizar el campo de fecha captura si existe
    const fechaCapturaInput = document.getElementById('fecha_captura');
    if (fechaCapturaInput) {
        // Para input type="datetime-local" necesitas formato YYYY-MM-DDTHH:MM
        const dateForInput = `${dateTime.year}-${dateTime.month}-${dateTime.day}T${dateTime.hour}:${dateTime.minute}`;
        fechaCapturaInput.value = dateForInput;
    }

    // Si tienes un reloj en vivo
    const liveClock = document.getElementById('liveClock');
    if (liveClock) {
        liveClock.textContent = formattedTime;
    }

    return formattedTime;
}

// Exponer la función globalmente para usarla en cualquier vista
window.updateClock = updateClock;
window.actualizarFechaCaptura = updateClock; // Alias opcional

// Inicializar cuando el DOM esté listo
if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', () => {
        updateClock();
        setInterval(updateClock, 1000);
    });
} else {
    updateClock();
    setInterval(updateClock, 1000);
}

// Menú hamburguesa
const menuBtn = document.getElementById('menuBtn');
const mobileMenu = document.getElementById('mobileMenu');
const menuIcon = document.querySelector('.menu-icon');
const closeIcon = document.querySelector('.close-icon');

if (menuBtn) {
    menuBtn.addEventListener('click', () => {
        mobileMenu.classList.toggle('hidden');
        menuIcon.classList.toggle('hidden');
        closeIcon.classList.toggle('hidden');
    });
}

document.addEventListener('click', (event) => {
    if (menuBtn && mobileMenu) {
        const isClickInside = menuBtn.contains(event.target) || mobileMenu.contains(event.target);
        if (!isClickInside && !mobileMenu.classList.contains('hidden')) {
            mobileMenu.classList.add('hidden');
            menuIcon.classList.remove('hidden');
            closeIcon.classList.add('hidden');
        }
    }
});

function toggleSection(header) {
    const section = header.parentElement;
    const content = section.querySelector('.collapsible-content');
    const plus = section.querySelector('.icon-plus');
    const minus = section.querySelector('.icon-minus');

    content.classList.toggle('open');

    plus.classList.toggle('hidden');
    minus.classList.toggle('hidden');
}

window.toggleSection = toggleSection;

document.addEventListener('DOMContentLoaded', () => {
    const tipo = document.getElementById('tipo_unidad');
    const unidad = document.getElementById('unidad');

    // Estado inicial
    unidad.innerHTML = '<option value="" disabled hidden selected>Seleccione primero un tipo de unidad</option>';

    tipo.addEventListener('change', function () {
        const id = this.value;

        fetch(this.dataset.url + '?id_tipo_unidad=' + id)
            .then(res => res.json())
            .then(data => {
                unidad.innerHTML = data.html;
            });
    });
});

document.addEventListener('DOMContentLoaded', () => {
    const inicial = document.getElementById('diesel_inicial');
    const cargado = document.getElementById('diesel_cargado');
    const final = document.getElementById('diesel_final');
    const gastado = document.getElementById('diesel_gastado');

    function actualizar() {
        const v1 = inicial.value;
        const v2 = cargado.value;
        const v3 = final.value;


        // Flujo de placeholders
        if (!v1) {
            gastado.value = '';
            gastado.placeholder = 'Ingrese diesel inicial';
            return;
        }
        if (!v2) {
            gastado.value = '';
            gastado.placeholder = 'Ingrese diesel cargado';
            return;
        }

        if (!v3) {
            gastado.value = '';
            gastado.placeholder = 'Ingrese diesel final';
            return;
        }

        // Cálculo
        const resultado = ((parseFloat(v1) + parseFloat(v2)) - parseFloat(v3));

        gastado.placeholder = '';
        gastado.value = resultado.toFixed(2);
    }

    [inicial, cargado, final].forEach(input => {
        input.addEventListener('input', actualizar);
    });

    actualizar(); // estado inicial
});

document.addEventListener('DOMContentLoaded', () => {
    const salida = document.getElementById('km_salida');
    const regreso = document.getElementById('km_regreso');
    const total = document.getElementById('km_total');

    function calcular_total_km() {
        const v1 = salida.value;
        const v2 = regreso.value;
        const v3 = total.value;


        // Flujo de placeholders
        if (!v1) {
            total.value = '';
            total.placeholder = 'Ingrese kilometraje inicial';
            return;
        }
        if (!v2) {
            total.value = '';
            total.placeholder = 'Ingrese kilometraje final';
            return;
        }

        // Cálculo
        const resultado = ((parseFloat(v2) - parseFloat(v1)));

        total.placeholder = '';
        total.value = resultado.toFixed(2);
    }

    [salida, regreso].forEach(input => {
        input.addEventListener('input', calcular_total_km);
    });

    calcular_total_km(); // estado inicial
});

// ── Validación del botón Guardar ─────────────────────────────────────────────
document.addEventListener('DOMContentLoaded', () => {
    const btn = document.getElementById('btnGuardar');
    const form = document.querySelector('form');

    if (!btn || !form) return;

    const hayColoniasCargadas = () =>
        document.querySelectorAll('.colonias-input-porcentaje').length > 0;

    const validarFormulario = () => {

        const selectUnidad = document.getElementById('unidad');

let unidadValida = true;

if (selectUnidad) {
    const opciones = selectUnidad.querySelectorAll('option');

    // Si solo tiene 1 opción (placeholder), aún no está listo
    if (opciones.length <= 1) {
        unidadValida = false;
    } else {
        unidadValida = selectUnidad.value !== '';
    }
}

        // 1. Campos estáticos requeridos (select, inputs normales)
        const camposEstaticos = form.querySelectorAll(
            'input[required]:not(.colonias-input-porcentaje), select[required]'
        );
        const estaticosValidos = [...camposEstaticos].every(el => {
            if (el.type === 'number') {
                return el.value !== '';
            }

            if (el.tagName === 'SELECT') {
                return el.value !== '' && el.value !== null;
            }

            return el.value && el.value.trim() !== '';
        });

        // 2. Colonias: solo validar si ya se cargaron
        let coloniasValidas = true;
        if (hayColoniasCargadas()) {
            // Cada input de porcentaje debe tener valor
            const inputsPorcentaje = document.querySelectorAll('.colonias-input-porcentaje');
            const todosConValor = [...inputsPorcentaje].every(
                inp => inp.value.trim() !== '' && parseFloat(inp.value) >= 0
            );

            // La suma debe ser exactamente 100
            const suma = parseFloat(document.getElementById('suma_porcentaje')?.value) || 0;
            const sumaValida = Math.abs(suma - 100) < 0.01; // tolerancia flotante

            coloniasValidas = todosConValor && sumaValida;
        } else {
            // Si no hay colonias, la suma no aplica → resetear el campo visual
            const sumaInput = document.getElementById('suma_porcentaje');
            if (sumaInput) sumaInput.value = '';
        }

        const formValido = estaticosValidos && coloniasValidas;

        console.log({
    estaticosValidos,
    coloniasValidas
});

        btn.disabled = !formValido;
        btn.classList.toggle('btn-ready', formValido); // clase visual opcional
    };

    // Un solo listener global por evento, usando delegación
    document.addEventListener('input', validarFormulario);
    document.addEventListener('change', validarFormulario);

    // Revalidar cuando las colonias se regeneran (evento custom de rutas-colonias.js)
    document.addEventListener('colonias:updated', validarFormulario);

    // Estado inicial
    validarFormulario();
});

console.log('app.js cargado ✓');

document.addEventListener('DOMContentLoaded', () => {
    const input = document.getElementById('fecha_captura');
    if (input) {
        const now = new Date();
        input.value = now.toISOString().slice(0, 16);
    }
});

