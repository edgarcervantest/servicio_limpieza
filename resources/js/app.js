import './bootstrap';

function updateClock() {
    const now = new Date();

    // Opciones para formato de fecha y hora con zona horaria
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

    // Construir el formato YYYY-MM-DD HH:MM:SS
    let dateTime = {};
    formattedParts.forEach(part => {
        if (part.type !== 'literal') {
            dateTime[part.type] = part.value;
        }
    });

    const formattedTime = `${dateTime.year}-${dateTime.month}-${dateTime.day} ${dateTime.hour}:${dateTime.minute}:${dateTime.second}`;
    document.getElementById('liveClock').textContent = formattedTime;
}

// Actualizar cada segundo
setInterval(updateClock, 1000);
updateClock();

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

// Cerrar menú al hacer clic fuera
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
