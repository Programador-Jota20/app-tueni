document.addEventListener("DOMContentLoaded", function () {

    // ======================
    // Variables dinámicas
    // ======================
    const campo  = "Motivo";   // singular Mayus
    const campos = "Motivos";  // plural Mayus
    const camp   = "motivo";   // singular minus
    const camps  = "motivos";  // plural minus

    const baseURL = `${window.APP_BASE_URL}admin/${camps}`; // 🚀 ruta dinámica

    const form = document.getElementById("formRegistrar" + campo);
    const btnGuardar = document.getElementById("btnGuardar" + campo);
    const btnCancelar = document.getElementById("btnCancelar" + campo);

    // ======================
    // Guardar / Actualizar
    // ======================
    if(form) {
        form.addEventListener("submit", function (e) {
            e.preventDefault();
            let formData = new FormData(this);

            fetch(`${baseURL}/guardar`, {
                method: "POST",
                body: formData
            })
            .then(res => res.json())
            .then(res => {
                if (!res.success) {
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
                    const container = document.getElementById("Nom" + campo).parentNode;
                    container.insertBefore(alerta, document.getElementById("Nom" + campo));
                    setTimeout(() => alerta.remove(), 3000);
                    return;
                }

                location.reload();
            })
            .catch(err => {
                console.error(`Error al guardar el ${camp}:`, err);
                location.reload();
            });
        });
    }

    // ======================
    // Editar
    // ======================
    document.querySelectorAll(".btnEditar" + campo).forEach(btn => {
        btn.addEventListener("click", function () {
            const id = this.dataset.id;
            fetch(`${baseURL}/obtener?id=${id}`)
                .then(res => res.json())
                .then(res => {
                    if(res.success){
                        document.getElementById("Cod" + campo).value = res.data["Cod" + campo];
                        document.getElementById("Nom" + campo).value = res.data["Nom" + campo];
                        
                        // Mantener campo TipoTransaccion
                        const tipo = (res.data.TipoTransaccion || "").trim().toUpperCase();
                        const tipoField = document.getElementById("TipoTransaccion");
                        if(tipoField) tipoField.value = tipo;

                        btnGuardar.textContent = "Actualizar";
                    } else {
                        alert(res.message);
                    }
                })
                .catch(err => console.error(err));
        });
    });

    // ======================
    // Cancelar vuelve a modo Guardar
    // ======================
    if(btnCancelar){
        btnCancelar.addEventListener("click", function(){
            form.reset();
            btnGuardar.textContent = "Guardar";
        });
    }

    // ======================
    // Eliminar
    // ======================
    document.querySelectorAll(".btnEliminar" + campo).forEach(btn => {
        btn.addEventListener("click", function() {
            if(confirm(`¿Seguro de eliminar este ${camp}?`)){
                const id = this.dataset.id;
                fetch(`${baseURL}/eliminar`, {
                    method: "POST",
                    headers: { "Content-Type": "application/x-www-form-urlencoded" },
                    body: `Cod${campo}=${id}`
                })
                .then(res => res.json())
                .then(res => {
                    if(res.success) location.reload();
                });
            }
        });
    });

});
