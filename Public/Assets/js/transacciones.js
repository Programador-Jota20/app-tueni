document.addEventListener("DOMContentLoaded", () => {
    const tablaBody = document.querySelector("#tabla-transacciones tbody");
    const pagination = document.querySelector("#pagination");
    const btnBuscar = document.getElementById("btnBuscar");
    const selectTipo = document.getElementById("filterTipo");
    const selectMotivo = document.getElementById("filterMotivo");

    const baseURL = `${window.APP_BASE_URL}admin/transacciones`;

    let paginaActual = 1;
    const limit = 25;

    const getFiltros = () => {
        const hoy = new Date().toISOString().slice(0, 10);
        return {
            TipoTransaccion: selectTipo.value || 0,
            CodMotivo: selectMotivo.value || 0,
            CodLinea: document.getElementById("filterLinea").value || 0,
            NombrePersona: document.getElementById("filterNombre").value.trim() || "",
            PeriodoInicio: document.getElementById("filterDesde").value || "1900-01-01",
            PeriodoFin: document.getElementById("filterHasta").value || hoy,
            pagina: paginaActual,
            limit: limit
        };
    };

    const cargarTransacciones = async () => {
        tablaBody.innerHTML = `<tr><td colspan="11">Cargando...</td></tr>`;
        const filtros = getFiltros();

        const params = new URLSearchParams(filtros);

        try {
            const response = await fetch(`${baseURL}/obtener?${params.toString()}`, {
                headers: { 'Accept': 'application/json' }
            });

            const text = await response.text();
            if (text.trim().startsWith('<')) {
                console.error("Error del servidor:", text);
                tablaBody.innerHTML = `<tr><td colspan="11">Error al conectar al servidor</td></tr>`;
                return;
            }

            const data = JSON.parse(text);
            if (!data.success) {
                tablaBody.innerHTML = `<tr><td colspan="11">${data.message}</td></tr>`;
                return;
            }

            tablaBody.innerHTML = data.data.length === 0
                ? `<tr><td colspan="11">No se encontraron transacciones</td></tr>`
                : data.data.map(t => `
                    <tr>
                        <td>${t.CodCuenta}</td>
                        <td>${t.Fecha}</td>
                        <td>${t.Periodo}</td>
                        <td>${t.TipoTransaccion}</td>
                        <td>${t.NomMotivo}</td>
                        <td>${t.CodLinea}</td>
                        <td>${t.NomLinea}</td>
                        <td>${t.ApellidosNombres}</td>
                        <td>${t.Concepto}</td>
                        <td>${t.CodMoneda}</td>
                        <td>${t.Cantidad}</td>
                    </tr>
                `).join('');

            const totalPages = Math.ceil(data.total / limit);
            renderPagination(totalPages, data.pagina);

        } catch (err) {
            console.error("Error al cargar transacciones:", err);
            tablaBody.innerHTML = `<tr><td colspan="11">Error al conectar al servidor</td></tr>`;
        }
    };

    const renderPagination = (totalPages, currentPage) => {
        let html = '';

        html += `<li class="page-item ${currentPage === 1 ? 'disabled' : ''}">
                    <a class="page-link" href="#" data-page="${currentPage - 1}">«</a>
                </li>`;

        const maxVisible = 2;
        const pages = [];
        pages.push(1, totalPages);
        for (let i = currentPage - maxVisible; i <= currentPage + maxVisible; i++) {
            if (i > 1 && i < totalPages) pages.push(i);
        }
        const uniquePages = [...new Set(pages)].sort((a, b) => a - b);

        let prev = 0;
        uniquePages.forEach(i => {
            if (i - prev > 1) html += `<li class="page-item disabled"><span class="page-link">...</span></li>`;
            html += `<li class="page-item ${i === currentPage ? 'active' : ''}">
                        <a class="page-link" href="#" data-page="${i}">${i}</a>
                    </li>`;
            prev = i;
        });

        html += `<li class="page-item ${currentPage === totalPages ? 'disabled' : ''}">
                    <a class="page-link" href="#" data-page="${currentPage + 1}">»</a>
                </li>`;

        pagination.innerHTML = html;
        pagination.querySelectorAll("a.page-link").forEach(link => {
            link.addEventListener("click", e => {
                e.preventDefault();
                const page = parseInt(link.getAttribute("data-page"));
                if (!isNaN(page) && page >= 1 && page <= totalPages) {
                    paginaActual = page;
                    cargarTransacciones();
                }
            });
        });
    };

    btnBuscar.addEventListener("click", () => {
        paginaActual = 1;
        cargarTransacciones();
    });

    // 🔹 Evento cambio de Tipo para actualizar Motivo (GET)
    selectTipo.addEventListener('change', async function() {
        const tipo = this.value;

        try {
            const res = await fetch(`${window.APP_BASE_URL}admin/motivos/mostrarportipo?tipo=${tipo}`);
            const data = await res.json();

            selectMotivo.innerHTML = '<option value="0">Todos</option>';
            if (data.success) {
                data.data.forEach(m => {
                    selectMotivo.innerHTML += `<option value="${m.CodMotivo}">${m.NomMotivo}</option>`;
                });
            }
        } catch (err) {
            console.error("Error al cargar motivos:", err);
        }
    });

    // 🔹 Carga inicial
    cargarTransacciones();
});
