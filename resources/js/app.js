// ─────────────────────────────────────────────────────────────────────────────
// app.js — punto de entrada único
// ─────────────────────────────────────────────────────────────────────────────
import './bootstrap';
import './rutas-colonias.js';
import './porcentaje-ruta.js';

// ── 1. RELOJ ─────────────────────────────────────────────────────────────────
const updateClock = () => {
    const formatter = new Intl.DateTimeFormat('es-MX', {
        timeZone: 'America/Matamoros',
        year: 'numeric', month: '2-digit', day: '2-digit',
        hour: '2-digit', minute: '2-digit', second: '2-digit',
        hour12: false,
    });

    const parts = {};
    formatter.formatToParts(new Date()).forEach(({ type, value }) => {
        if (type !== 'literal') parts[type] = value;
    });

    const fechaCaptura = document.getElementById('fecha_captura');
    if (fechaCaptura) {
        fechaCaptura.value = `${parts.year}-${parts.month}-${parts.day}T${parts.hour}:${parts.minute}`;
    }

    const liveClock = document.getElementById('liveClock');
    if (liveClock) {
        liveClock.textContent =
            `${parts.year}-${parts.month}-${parts.day} ${parts.hour}:${parts.minute}:${parts.second}`;
    }
};

window.updateClock = updateClock;
window.actualizarFechaCaptura = updateClock;

updateClock();
setInterval(updateClock, 1000);

// ── 2. MENÚ HAMBURGUESA ───────────────────────────────────────────────────────
const menuBtn = document.getElementById('menuBtn');
const mobileMenu = document.getElementById('mobileMenu');
const menuIcon = document.querySelector('.menu-icon');
const closeIcon = document.querySelector('.close-icon');

menuBtn?.addEventListener('click', () => {
    mobileMenu.classList.toggle('hidden');
    menuIcon.classList.toggle('hidden');
    closeIcon.classList.toggle('hidden');
});

document.addEventListener('click', (e) => {
    if (!menuBtn || !mobileMenu) return;
    if (!menuBtn.contains(e.target) && !mobileMenu.contains(e.target)) {
        if (!mobileMenu.classList.contains('hidden')) {
            mobileMenu.classList.add('hidden');
            menuIcon.classList.remove('hidden');
            closeIcon.classList.add('hidden');
        }
    }
});

// ── 3. COLLAPSIBLE ────────────────────────────────────────────────────────────
const toggleSection = (header) => {
    const section = header.parentElement;
    section.querySelector('.collapsible-content').classList.toggle('open');
    section.querySelector('.icon-plus').classList.toggle('hidden');
    section.querySelector('.icon-minus').classList.toggle('hidden');
};

window.toggleSection = toggleSection;

// ── 4. TODO LO QUE REQUIERE DOM ───────────────────────────────────────────────
document.addEventListener('DOMContentLoaded', () => {

    // 4a. Select dependiente: tipo_unidad → unidades ──────────────────────────
    const tipoUnidad = document.getElementById('tipo_unidad');
    const unidad = document.getElementById('unidad');

    if (tipoUnidad && unidad) {
        unidad.innerHTML =
            '<option value="" disabled hidden selected>Seleccione primero un tipo de unidad</option>';

        tipoUnidad.addEventListener('change', function () {
            fetch(this.dataset.url + '?id_tipo_unidad=' + this.value)
                .then(res => res.json())
                .then(data => {
                    unidad.innerHTML = data.html;
                    // Notificar al validador
                    document.dispatchEvent(new CustomEvent('unidad:updated'));
                });
        });
    }

    // 4b. Diesel gastado ───────────────────────────────────────────────────────
    const dieselInicial = document.getElementById('diesel_inicial');
    const dieselCargado = document.getElementById('diesel_cargado');
    const dieselFinal = document.getElementById('diesel_final');
    const dieselGastado = document.getElementById('diesel_gastado');

    const calcularDiesel = () => {
        if (!dieselInicial || !dieselCargado || !dieselFinal || !dieselGastado) return;

        const v1 = dieselInicial.value;
        const v2 = dieselCargado.value;
        const v3 = dieselFinal.value;

        if (!v1) { dieselGastado.value = ''; dieselGastado.placeholder = 'Ingrese diesel inicial'; return; }
        if (!v2) { dieselGastado.value = ''; dieselGastado.placeholder = 'Ingrese diesel cargado'; return; }
        if (!v3) { dieselGastado.value = ''; dieselGastado.placeholder = 'Ingrese diesel final'; return; }

        dieselGastado.placeholder = '';
        dieselGastado.value = (parseFloat(v1) + parseFloat(v2) - parseFloat(v3)).toFixed(2);
    };

    [dieselInicial, dieselCargado, dieselFinal].forEach(el => el?.addEventListener('input', calcularDiesel));
    calcularDiesel();

    // 4c. Kilómetros totales ───────────────────────────────────────────────────
    const kmSalida = document.getElementById('km_salida');
    const kmRegreso = document.getElementById('km_regreso');
    const kmTotal = document.getElementById('km_total');

    const calcularKm = () => {
        if (!kmSalida || !kmRegreso || !kmTotal) return;

        const v1 = kmSalida.value;
        const v2 = kmRegreso.value;

        if (!v1) { kmTotal.value = ''; kmTotal.placeholder = 'Ingrese kilometraje inicial'; return; }
        if (!v2) { kmTotal.value = ''; kmTotal.placeholder = 'Ingrese kilometraje final'; return; }

        kmTotal.placeholder = '';
        kmTotal.value = (parseFloat(v2) - parseFloat(v1)).toFixed(2);
    };

    [kmSalida, kmRegreso].forEach(el => el?.addEventListener('input', calcularKm));
    calcularKm();

    // ── 5. VALIDADOR CENTRAL ──────────────────────────────────────────────────
    const btn = document.getElementById('btnGuardar');
    const form = document.querySelector('form');

    if (!btn || !form) return;

    // ── helpers ────────────────────────────────────────────────────────────────

    const unidadLista = () => {
        if (!unidad) return true;
        return unidad.querySelectorAll('option').length > 1 && unidad.value !== '';
    };

    const camposEstaticosValidos = () => {
        const campos = form.querySelectorAll(
            'input[required]:not(.colonias-input-porcentaje), select[required]'
        );
        return [...campos].every(el => {
            if (el.tagName === 'SELECT') return el.value !== '';
            return el.value.trim() !== '';
        });
    };

    const hayColonias = () =>
        document.querySelectorAll('.colonias-input-porcentaje').length > 0;

    const coloniasValidas = () => {
        if (!hayColonias()) return true;

        const inputs = [...document.querySelectorAll('.colonias-input-porcentaje')];

        // Todos con valor numérico >= 0
        const todosConValor = inputs.every(
            inp => inp.value.trim() !== '' && parseFloat(inp.value) >= 0
        );

        // La suma debe ser totalColonias * 100 (cada colonia recibe 0-100%)
        const suma = inputs.reduce((acc, inp) => acc + (parseFloat(inp.value) || 0), 0);
        const totalEsperado = inputs.length * 100;

        return todosConValor && Math.abs(suma - totalEsperado) < 0.01;
    };

    // ── validar: NO llama calcularPorcentaje para evitar recursión ────────────
    const validar = () => {
        const ok = camposEstaticosValidos() && unidadLista() && coloniasValidas();
        btn.disabled = !ok;
        btn.classList.toggle('btn-ready', ok);
    };

    // ── UN listener para input (delegación) ───────────────────────────────────
    document.addEventListener('input', (e) => {
        // Si es un input de colonia → recalcular primero, luego validar
        if (e.target.classList.contains('colonias-input-porcentaje')) {
            window.calcularPorcentaje?.();
        }
        validar();
    });

    // ── UN listener para change ───────────────────────────────────────────────
    document.addEventListener('change', validar);

    // ── Eventos custom (sin llamar calcularPorcentaje aquí para no loopear) ───
    document.addEventListener('colonias:updated', validar);  // MutationObserver ya calculó
    document.addEventListener('unidad:updated', validar);
    // NOTA: NO escuchar 'porcentaje:updated' — ese evento ya no se emite

    // ── Garantizar valores antes del submit ───────────────────────────────────
    form.addEventListener('submit', (e) => {
        window.calcularPorcentaje?.(); // última pasada defensiva

        // Doble check: si los hiddens están vacíos y hay colonias, bloquear
        const atendidoHidden = document.getElementById('porcentaje_atendido_hidden');
        if (hayColonias() && (!atendidoHidden?.value || atendidoHidden.value === '')) {
            e.preventDefault();
            console.error('[Submit] porcentaje_atendido vacío — submit bloqueado');
        }
    });

    // estado inicial
    validar();
});

console.log('app.js cargado ✓');