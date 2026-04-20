// rutas-colonias.js
const initRutaColonias = () => {
    const selectRuta = document.getElementById('ruta');
    const card       = document.getElementById('colonias-card');
    const tbody      = document.getElementById('colonias-tbody');

    if (!selectRuta || !card || !tbody) return;

    const mostrarCard  = () => card.classList.remove('hidden');
    const ocultarCard  = () => card.classList.add('hidden');
    const limpiarTabla = () => (tbody.innerHTML = '');

    const crearFila = (colonia, index) => {
        const tr = document.createElement('tr');
        tr.className = 'colonias-fila';
        tr.innerHTML = `
            <td class="colonias-td">${index}</td>
            <td class="colonias-td">${colonia.colonia}</td>
            <td class="colonias-td">${colonia.habitantes.toLocaleString()}</td>
            <td class="colonias-td">
                <input
                    type="number"
                    name="colonias[${colonia.id_colonia}][porcentaje]"
                    
                    class="colonias-input-porcentaje"
                    min="0"
                    max="100"
                    step="0.01"
                    placeholder="0.00"
                    required
                    data-colonia-id="${colonia.id_colonia}"
                />

                 <!-- Campo oculto para habitantes -->
            <input 
                type="hidden" 
                name="colonias[${colonia.id_colonia}][habitantes]" 
                value="${colonia.habitantes}"
            />
            </td>
        `;
        return tr;
    };

    const renderColonias = (colonias) => {
        limpiarTabla();
        colonias.forEach((colonia, i) => tbody.appendChild(crearFila(colonia, i + 1)));

        // Abrir el panel automáticamente al cargar colonias
        const content = card.querySelector('.collapsible-content');
        const plus    = card.querySelector('.icon-plus');
        const minus   = card.querySelector('.icon-minus');
        if (content && !content.classList.contains('open')) {
            content.classList.add('open');
            plus?.classList.add('hidden');
            minus?.classList.remove('hidden');
        }

        // Notificar al validador que el DOM cambió
        document.dispatchEvent(new CustomEvent('colonias:updated'));
    };

    const fetchColonias = async (rutaId) => {
        try {
            const res = await fetch(`/rutas/${rutaId}/colonias`, {
                headers: { 'Accept': 'application/json' },
            });

            if (!res.ok) throw new Error(`HTTP ${res.status}`);

            const colonias = await res.json();

            if (!colonias.length) {
                limpiarTabla();
                ocultarCard();
                document.dispatchEvent(new CustomEvent('colonias:updated'));
                return;
            }

            renderColonias(colonias);
            mostrarCard();

        } catch (err) {
            console.error('[RutaColonias]', err);
            limpiarTabla();
            ocultarCard();
            document.dispatchEvent(new CustomEvent('colonias:updated'));
        }
    };

    selectRuta.addEventListener('change', (e) => {
        if (!e.target.value) {
            limpiarTabla();
            ocultarCard();
            document.dispatchEvent(new CustomEvent('colonias:updated'));
            return;
        }
        fetchColonias(e.target.value);
    });
};

document.addEventListener('DOMContentLoaded', initRutaColonias);