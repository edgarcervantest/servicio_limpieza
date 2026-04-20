// ─────────────────────────────────────────────────────────────────────────────
// app.js — punto de entrada único
// ─────────────────────────────────────────────────────────────────────────────
import './bootstrap';
import './rutas-colonias.js';
import './porcentaje-ruta.js';

// ── 1. RELOJ ──────────────────────────────────────────────────────────────────
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
        liveClock.textContent = `${parts.year}-${parts.month}-${parts.day} ${parts.hour}:${parts.minute}:${parts.second}`;
    }
};

window.updateClock            = updateClock;
window.actualizarFechaCaptura = updateClock;
updateClock();
setInterval(updateClock, 1000);

// ── 2. MENÚ HAMBURGUESA ───────────────────────────────────────────────────────
const menuBtn    = document.getElementById('menuBtn');
const mobileMenu = document.getElementById('mobileMenu');
const menuIcon   = document.querySelector('.menu-icon');
const closeIcon  = document.querySelector('.close-icon');

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

// ── 4. DOM READY ──────────────────────────────────────────────────────────────
document.addEventListener('DOMContentLoaded', () => {

    // ── Refs globales dentro del formulario ───────────────────────────────────
    const form     = document.querySelector('form');
    const btn      = document.getElementById('btnGuardar');
    const tipoUnidad = document.getElementById('tipo_unidad');
    const unidad     = document.getElementById('unidad');

    // ── 4a. tipo_unidad → unidad ──────────────────────────────────────────────
    if (tipoUnidad && unidad) {
        unidad.innerHTML =
            '<option value="" disabled hidden selected>Seleccione primero un tipo de unidad</option>';

        tipoUnidad.addEventListener('change', function () {
            fetch(this.dataset.url + '?id_tipo_unidad=' + this.value)
                .then(r => r.json())
                .then(data => {
                    unidad.innerHTML = data.html;
                    markField(unidad);                              // validar visualmente
                    document.dispatchEvent(new CustomEvent('unidad:updated'));
                });
        });
    }

    // ── 4b. Diesel gastado ────────────────────────────────────────────────────
    const dInicial  = document.getElementById('diesel_inicial');
    const dCargado  = document.getElementById('diesel_cargado');
    const dFinal    = document.getElementById('diesel_final');
    const dGastado  = document.getElementById('diesel_gastado');

    const calcularDiesel = () => {
        if (!dInicial || !dCargado || !dFinal || !dGastado) return;
        const v1 = dInicial.value, v2 = dCargado.value, v3 = dFinal.value;
        if (!v1) { dGastado.value = ''; dGastado.placeholder = 'Ingrese diesel inicial';  return; }
        if (!v2) { dGastado.value = ''; dGastado.placeholder = 'Ingrese diesel cargado'; return; }
        if (!v3) { dGastado.value = ''; dGastado.placeholder = 'Ingrese diesel final';    return; }
        dGastado.placeholder = '';
        dGastado.value = (parseFloat(v1) + parseFloat(v2) - parseFloat(v3)).toFixed(2);
    };
    [dInicial, dCargado, dFinal].forEach(el => el?.addEventListener('input', calcularDiesel));
    calcularDiesel();

    // ── 4c. Kilómetros totales ────────────────────────────────────────────────
    const kmSalida  = document.getElementById('km_salida');
    const kmRegreso = document.getElementById('km_regreso');
    const kmTotal   = document.getElementById('km_total');

    const calcularKm = () => {
        if (!kmSalida || !kmRegreso || !kmTotal) return;
        const v1 = kmSalida.value, v2 = kmRegreso.value;
        if (!v1) { kmTotal.value = ''; kmTotal.placeholder = 'Ingrese kilometraje inicial'; return; }
        if (!v2) { kmTotal.value = ''; kmTotal.placeholder = 'Ingrese kilometraje final';   return; }
        kmTotal.placeholder = '';
        kmTotal.value = (parseFloat(v2) - parseFloat(v1)).toFixed(2);
    };
    [kmSalida, kmRegreso].forEach(el => el?.addEventListener('input', calcularKm));
    calcularKm();

    // ─────────────────────────────────────────────────────────────────────────
    // 5. VALIDACIÓN VISUAL + CENTRAL
    // ─────────────────────────────────────────────────────────────────────────

    // Campos de solo lectura — nunca se validan visualmente
    const READONLY_IDS = new Set([
        'fecha_captura', 'km_total', 'diesel_gastado',
        'suma_porcentaje', 'porcentaje_atendido',
    ]);

    // Reglas por campo
    const RULES = {
        fecha_orden: {
            validate: (v) => {
                if (!v) return false;
                return new Date(v) >= new Date(new Date().setHours(0,0,0,0));
            },
            message: 'Seleccione una fecha válida',
        },
        turno:         { validate: v => !!v, message: 'Seleccione un turno' },
        ruta:          { validate: v => !!v, message: 'Seleccione una ruta' },
        despachador:   { validate: v => !!v, message: 'Seleccione un despachador' },
        chofer:        { validate: v => !!v, message: 'Seleccione un chofer' },
        tipo_unidad:   { validate: v => !!v, message: 'Seleccione un tipo de unidad' },
        unidad: {
            validate: () => {
                if (!unidad) return true;
                return unidad.querySelectorAll('option').length > 1 && unidad.value !== '';
            },
            message: 'Seleccione una unidad',
        },
        cantidad_basura: { validate: v => v !== '' && parseFloat(v) > 0,  message: 'Ingrese cantidad válida (>0)' },
        puches:          { validate: v => v !== '' && Number.isInteger(parseFloat(v)) && parseFloat(v) >= 0, message: 'Ingrese número válido' },
        km_salida:       { validate: v => v !== '' && parseFloat(v) >= 0,  message: 'Ingrese kilómetros válidos' },
        km_regreso: {
            validate: (v) => {
                const salida = parseFloat(document.getElementById('km_salida')?.value);
                return v !== '' && parseFloat(v) > (isNaN(salida) ? -Infinity : salida);
            },
            message: 'Debe ser mayor a km de salida',
        },
        diesel_inicial:  { validate: v => v !== '' && parseFloat(v) >= 0, message: 'Ingrese litros válidos' },
        diesel_cargado:  { validate: v => v !== '' && parseFloat(v) >= 0, message: 'Ingrese litros válidos' },
        diesel_final: {
    validate: (v) => {
        const inicial = parseFloat(document.getElementById('diesel_inicial')?.value);
        const cargado = parseFloat(document.getElementById('diesel_cargado')?.value);
        const final   = parseFloat(v);

        if (v === '') return false;
        if (isNaN(final)) return false;

        const base = (isNaN(inicial) ? 0 : inicial) + (isNaN(cargado) ? 0 : cargado);

        return final <= base;
    },
    message: 'El diesel final no puede ser mayor al total disponible',
},
    };

    // ── Helpers visuales ──────────────────────────────────────────────────────

    const getErrorEl = (field) => {
        const next = field.parentElement.querySelector('.field-error');
        return next;
    };

    const showError = (field, message) => {
        clearError(field);
        const span = document.createElement('span');
        span.className = 'field-error text-red-400 text-xs mt-1 block';
        span.textContent = message;
        field.parentElement.appendChild(span);
    };

    const clearError = (field) => {
        getErrorEl(field)?.remove();
    };

    const markValid = (field) => {
        field.classList.remove('border-red-500',  'ring-red-500',  'ring-1');
        field.classList.add   ('border-green-500', 'ring-green-500', 'ring-1');
        clearError(field);
    };

    const markInvalid = (field, message) => {
        field.classList.remove('border-green-500', 'ring-green-500');
        field.classList.add   ('border-red-500',   'ring-red-500', 'ring-1');
        if (message) showError(field, message);
    };

    const markNeutral = (field) => {
        field.classList.remove(
            'border-green-500', 'border-red-500',
            'ring-green-500',   'ring-red-500', 'ring-1'
        );
        clearError(field);
    };

    // ── Validar un campo individual ───────────────────────────────────────────
    const markField = (field) => {
        if (!field || READONLY_IDS.has(field.id)) return true;

        const rule = RULES[field.id];
        if (!rule) return true;                    // sin regla → neutro, no bloquea

        // Si el campo no ha sido tocado aún y está vacío → neutro
        const untouched = !field.dataset.touched && field.value === '';
        if (untouched) { markNeutral(field); return true; }

        const valid = rule.validate(field.value);
        valid ? markValid(field) : markInvalid(field, rule.message);
        return valid;
    };

    // ── Marcar campo como tocado al primer blur ───────────────────────────────
    if (form) {
        form.querySelectorAll('input, select, textarea').forEach(el => {
            el.addEventListener('blur', () => {
                if (!READONLY_IDS.has(el.id)) {
                    el.dataset.touched = '1';
                    markField(el);
                    validar();
                }
            });
        });
    }

const hayColonias = () =>
    document.querySelectorAll('.colonias-input-porcentaje').length > 0;

const coloniasValidas = () => {
    if (!hayColonias()) return true;

    const inputs = [...document.querySelectorAll('.colonias-input-porcentaje')];

    return inputs.every(inp => {
        const val = parseFloat(inp.value);
        return (
            inp.value.trim() !== '' &&
            !isNaN(val) &&
            val >= 0 &&
            val <= 100
        );
    });
};

    const actualizarFeedbackColonias = () => {
    const wrapper = document.querySelector('.colonias-tabla-wrapper');
    if (!wrapper) return;

    wrapper.querySelector('.colonias-feedback')?.remove();

    if (!hayColonias()) return;

    const inputs = [...document.querySelectorAll('.colonias-input-porcentaje')];

    const suma = inputs.reduce((acc, inp) => acc + (parseFloat(inp.value) || 0), 0);

    const span = document.createElement('p');
    span.className = 'colonias-feedback text-xs mt-2';

    span.className += ' text-yellow-400';
    span.textContent = `ℹ️ Total actual: ${suma.toFixed(2)}% (referencial)`;

    wrapper.appendChild(span);
};

    // ── Validador central ─────────────────────────────────────────────────────
    const validar = () => {
        if (!btn || !form) return;

        // Validar todos los campos con regla (sin marcar visualmente los no tocados)
        const camposOk = Object.keys(RULES).every(id => {
            const el = document.getElementById(id);
            if (!el) return true;
            return RULES[id].validate(el.value);
        });

        const ok = camposOk && coloniasValidas();
        btn.disabled = !ok;
    };

    // ── Listeners globales — UN solo input, UN solo change ───────────────────
    document.addEventListener('input', (e) => {
        const el = e.target;

        if (el.classList.contains('colonias-input-porcentaje')) {
            el.dataset.touched = '1';
            window.calcularPorcentaje?.();
            actualizarFeedbackColonias();
            validar();
            return;
        }

        if (!READONLY_IDS.has(el.id)) {
            el.dataset.touched = '1';
            markField(el);

            // km_regreso depende de km_salida → revalidar ambos al cambiar cualquiera
            if (el.id === 'km_salida') markField(document.getElementById('km_regreso'));
        }
        validar();
    });

    document.addEventListener('change', (e) => {
        const el = e.target;
        if (!READONLY_IDS.has(el.id) && !el.classList.contains('colonias-input-porcentaje')) {
            el.dataset.touched = '1';
            markField(el);
        }
        validar();
    });

    // ── Eventos custom ────────────────────────────────────────────────────────
    document.addEventListener('colonias:updated', () => {
        actualizarFeedbackColonias();
        validar();
    });
    document.addEventListener('unidad:updated', validar);

    // ── Submit defensivo ──────────────────────────────────────────────────────
    form?.addEventListener('submit', (e) => {
        window.calcularPorcentaje?.();

        const atendidoHidden = document.getElementById('porcentaje_atendido_hidden');
        if (hayColonias() && !atendidoHidden?.value) {
            e.preventDefault();
            console.error('[Submit] porcentaje_atendido vacío — bloqueado');
        }
    });

    // Estado inicial
    validar();
});

console.log('app.js cargado ✓');