import './bootstrap';

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
