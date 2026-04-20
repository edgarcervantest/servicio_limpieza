// porcentaje-ruta.js
// Responsabilidad: SOLO calcular y escribir valores. Sin validar, sin disparar eventos.

const calcularPorcentaje = () => {
    const sumaVisible      = document.getElementById('suma_porcentaje');
    const atendidoVisible  = document.getElementById('porcentaje_atendido');
    const sumaHidden       = document.getElementById('suma_porcentaje_hidden');
    const atendidoHidden   = document.getElementById('porcentaje_atendido_hidden');

    const inputs        = document.querySelectorAll('.colonias-input-porcentaje');
    const totalColonias = inputs.length;

    let suma = 0;
    inputs.forEach(inp => (suma += parseFloat(inp.value) || 0));

    const totalEsperado      = totalColonias * 100;
    const porcentajeAtendido = totalEsperado > 0
        ? parseFloat(((suma / totalEsperado) * 100).toFixed(2))
        : 0;

    // Actualizar campos visuales
    if (sumaVisible)     sumaVisible.value     = suma.toFixed(2);
    if (atendidoVisible) atendidoVisible.value = porcentajeAtendido.toFixed(2);

    // ⚡ Actualizar hiddens que van al backend — siempre, sin excepción
    if (sumaHidden)     sumaHidden.value     = suma.toFixed(2);
    if (atendidoHidden) atendidoHidden.value = porcentajeAtendido.toFixed(2);
};

// Recalcular cuando el DOM de colonias cambia (nueva ruta → nuevas filas)
document.addEventListener('DOMContentLoaded', () => {
    const tbody = document.getElementById('colonias-tbody');
    if (!tbody) return;

    new MutationObserver(() => calcularPorcentaje())
        .observe(tbody, { childList: true, subtree: true });
});

// Exponer globalmente para que app.js lo invoque
window.calcularPorcentaje = calcularPorcentaje;