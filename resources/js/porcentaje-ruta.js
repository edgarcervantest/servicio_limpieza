// ============================================================
// porcentaje-ruta.js → importar en app.js:
//   import './porcentaje-ruta.js'
// ============================================================

const initPorcentajeRuta = () => {

    const sumaInput = document.getElementById('suma_porcentaje');
    const atendidoInput = document.getElementById('porcentaje_atendido');

    if (!sumaInput || !atendidoInput) return;

    const calcular = () => {
        const inputs = document.querySelectorAll('.colonias-input-porcentaje');

        let suma = 0;
        let totalColonias = inputs.length;

        inputs.forEach(input => {
            const valor = parseFloat(input.value) || 0;
            suma += valor;
        });

        // total esperado (100 por colonia)
        const totalEsperado = totalColonias * 100;

        // porcentaje atendido real
        const porcentajeAtendido = totalEsperado > 0
            ? (suma / totalEsperado) * 100
            : 0;

        // actualizar inputs
        sumaInput.value = suma.toFixed(2);
        atendidoInput.value = porcentajeAtendido.toFixed(2);
    };

    // escuchar cambios en inputs dinámicos
    document.addEventListener('input', (e) => {
        if (e.target.classList.contains('colonias-input-porcentaje')) {
            calcular();
        }
    });

    // recalcular cuando cambian las colonias (nueva ruta)
    const observer = new MutationObserver(() => calcular());

    const tbody = document.getElementById('colonias-tbody');
    if (tbody) {
        observer.observe(tbody, { childList: true, subtree: true });
    }
};

// ejecutar
document.addEventListener('DOMContentLoaded', initPorcentajeRuta);