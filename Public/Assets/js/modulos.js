document.addEventListener("DOMContentLoaded", function () {

    const baseURL = window.APP_BASE_URL + "admin/modulos";

    // ======================
    // Guardar formulario
    // ======================
    document.getElementById("formModulo").addEventListener("submit", function (e) {
        e.preventDefault(); // evita que se recargue

        let formData = new FormData(this);

        fetch(`${baseURL}/guardar`, { method: "POST", body: formData })
        .then(res => res.json())
        .then(res => {
            if (!res.success) {
                // Crear alerta temporal dentro del modal
                let alerta = document.createElement("div");
                alerta.className = "alert alert-danger alert-dismissible fade show shadow-sm border-theme-white-2 mb-2";
                alerta.role = "alert";
                alerta.innerHTML = `
                    <div class="d-inline-flex justify-content-center align-items-center thumb-xs bg-danger rounded-circle mx-auto me-1">
                        <i class="fas fa-xmark align-self-center mb-0 text-white"></i>
                    </div>
                    <strong>¡Error!</strong> ${res.message}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                `;
                const container = document.getElementById("NomModulo").parentNode;
                container.insertBefore(alerta, document.getElementById("NomModulo"));
                setTimeout(() => alerta.remove(), 3000);
                return;
            }

            location.reload();
        })
        .catch(err => {
            console.error("Error al guardar el módulo:", err);
            location.reload();
        });
    });

    // ======================
    // Botón Guardar Orden
    // ======================
    document.getElementById("GuardarOrden").addEventListener("click", function(e){
        e.preventDefault();

        const filas = document.querySelectorAll("#tabla-mover tbody tr");
        const datos = [];

        filas.forEach((fila, index) => {
            const cod = fila.querySelector(".btnEditar").dataset.id;
            const maestro = fila.querySelector(".toggleMaestro").checked ? 1 : 0;
            const orden = index + 1;
            datos.push({ CodModulo: cod, FlgMaestro: maestro, OrdenModulo: orden });
        });

        fetch(`${baseURL}/guardar-orden`, {
            method: "POST",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify({ modulos: datos })
        })
        .then(res => res.json())
        .then(res => {
            if(res.success){
                location.reload();
            } else {
                alert(res.message || "Error al guardar el orden");
            }
        })
        .catch(err => {
            console.error(err);
            alert("Error inesperado al guardar el orden");
        });
    });

    // ======================
    // Botón Nuevo
    // ======================
    document.getElementById("btnNuevo").addEventListener("click", function () {
        document.getElementById("formModulo").reset();
        document.getElementById("CodModulo").value = "";
        document.getElementById("tituloModal").innerText = "Nuevo Módulo";
        document.getElementById("previewIcon").className = "";

        new bootstrap.Modal(document.getElementById("modalModulo")).show();
    });

    // ======================
    // Botones Editar
    // ======================
    document.querySelectorAll(".btnEditar").forEach(btn => {
        btn.addEventListener("click", function () {
            let id = this.dataset.id;

            fetch(`${baseURL}/obtener?id=${id}`)
                .then(res => res.json())
                .then(res => {
                    if (res.success) {
                        let data = res.data;
                        document.getElementById("CodModulo").value   = data.CodModulo;
                        document.getElementById("NomModulo").value   = data.NomModulo;
                        document.getElementById("FlgMaestro").checked = data.FlgMaestro == 1;
                        document.getElementById("IconoClase").value  = data.IconoClase;
                        document.getElementById("IdHref").value      = data.IdHref;
                        document.getElementById("previewIcon").className = data.IconoClase;
                        document.getElementById("tituloModal").innerText = "Editar Módulo";
                        new bootstrap.Modal(document.getElementById("modalModulo")).show();
                    } else {
                        alert(res.message || "No se pudo cargar el módulo");
                    }
                })
                .catch(err => {
                    console.error(err);
                    alert("Error al consultar módulo");
                });
        });
    });

    // ======================
    // SortableJS - Reordenar filas
    // ======================
    if (document.querySelector("#tabla-mover tbody")) {
        new Sortable(document.querySelector("#tabla-mover tbody"), {
            handle: ".handle",
            animation: 150,
            onEnd: function (evt) {
                console.log("Nuevo orden:", evt.newIndex);
                // aquí podrías enviar el nuevo orden usando fetch si quieres
            }
        });
    }

});
