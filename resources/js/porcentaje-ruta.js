// porcentaje-ruta.js
// Responsabilidad: SOLO calcular y escribir valores. Sin validar, sin disparar eventos.

const calcularPorcentaje = () => {
    const sumaVisible      = document.getElementById('suma_porcentaje');
    const atendidoVisible  = document.getElementById('porcentaje_atendido');
    const sumaHidden       = document.getElementById('suma_porcentaje_hidden');
    const atendidoHidden   = document.getElementById('porcentaje_atendido_hidden');

    const inputs = document.querySelectorAll('.colonias-input-porcentaje');
    const totalColonias = inputs.length;

    let suma = 0;
    inputs.forEach(inp => (suma += parseFloat(inp.value) || 0));

    const totalEsperado = totalColonias * 100;

    // ✔️ fórmula de efectividad (la de tu profe)
    const efectividad = totalEsperado > 0
        ? parseFloat(((suma / totalEsperado) * 100).toFixed(2))
        : 0;

    // ── UI visibles ─────────────────────
    if (sumaVisible)     sumaVisible.value     = suma.toFixed(2);
    if (atendidoVisible) atendidoVisible.value = efectividad.toFixed(2);

    // ── backend (hidden inputs) ─────────
    if (sumaHidden)     sumaHidden.value     = suma.toFixed(2);
    if (atendidoHidden) atendidoHidden.value = efectividad.toFixed(2);
};

// Recalcular cuando cambia la tabla
document.addEventListener('DOMContentLoaded', () => {
    const tbody = document.getElementById('colonias-tbody');
    if (!tbody) return;

    new MutationObserver(() => calcularPorcentaje())
        .observe(tbody, { childList: true, subtree: true });
});

window.calcularPorcentaje = calcularPorcentaje;