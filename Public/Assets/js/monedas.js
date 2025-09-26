document.addEventListener("DOMContentLoaded", () => {

  function initCrud({Campo, camp, Campos, camps}) {

    const form = document.getElementById(`formRegistrar${Campo}`);
    const btnGuardar = document.getElementById(`btnGuardar${Campo}`);
    const btnCancelar = document.getElementById(`btnCancelar${Campo}`);

    const showAlertNearField = (fieldId, message) => {
      const field = document.getElementById(fieldId);
      const container = field ? field.parentNode : document.body;
      const alerta = document.createElement("div");
      alerta.className = "alert alert-danger alert-dismissible fade show shadow-sm border-theme-white-2 mb-2";
      alerta.role = "alert";
      alerta.innerHTML = `
        <div class="d-inline-flex justify-content-center align-items-center thumb-xs bg-danger rounded-circle mx-auto me-1">
          <i class="fas fa-xmark align-self-center mb-0 text-white"></i>
        </div>
        <strong>¡Error!</strong> ${message}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      `;
      container.insertBefore(alerta, field || container.firstChild);
      setTimeout(() => alerta.remove(), 4000);
    };

    const urlBase = `${window.APP_BASE_URL}admin/${camps}`;

    // Guardar / Actualizar
    if (form) {
      form.addEventListener("submit", async (e) => {
        e.preventDefault();
        const formData = new FormData(form);
        try {
          const res = await fetch(`${urlBase}/guardar`, { method: "POST", body: formData });
          const payload = await res.json();
          if (!payload.success) {
            showAlertNearField(`Nom${Campo}`, payload.message || "Error al guardar.");
            return;
          }
          location.reload();
        } catch (err) {
          console.error("Fetch error:", err);
          showAlertNearField(`Nom${Campo}`, "Error de red / servidor. Revisa consola.");
        }
      });
    }

    // Editar
    document.querySelectorAll(`.btnEditar${Campo}`).forEach(btn => {
      btn.addEventListener("click", async function () {
        const id = this.dataset.id;
        try {
          const res = await fetch(`${urlBase}/obtener?id=${encodeURIComponent(id)}`);
          const data = await res.json();
          if (data.success) {
            document.getElementById(`Cod${Campo}`).value = data.data[`Cod${Campo}`] || "";
            document.getElementById(`Nom${Campo}`).value = data.data[`Nom${Campo}`] || "";
            if (btnGuardar) btnGuardar.textContent = "Actualizar";
          } else {
            alert(data.message || "No se pudo obtener el registro");
          }
        } catch (err) {
          console.error(err);
          alert("Error al obtener datos. Revisa consola.");
        }
      });
    });

    // Cancelar
    if (btnCancelar && form) {
      btnCancelar.addEventListener("click", () => {
        form.reset();
        if (btnGuardar) btnGuardar.textContent = "Guardar";
      });
    }

    // Eliminar
    document.querySelectorAll(`.btnEliminar${Campo}`).forEach(btn => {
      btn.addEventListener("click", async function () {
        if (!confirm(`¿Seguro de eliminar este ${camp}?`)) return;
        const id = this.dataset.id;
        try {
          const res = await fetch(`${urlBase}/eliminar`, {
            method: "POST",
            headers: { "Content-Type": "application/x-www-form-urlencoded" },
            body: `Cod${Campo}=${encodeURIComponent(id)}`
          });
          const payload = await res.json();
          if (payload.success) location.reload();
          else alert(payload.message || "No se pudo eliminar");
        } catch (err) {
          console.error(err);
          alert("Error al eliminar. Revisa consola.");
        }
      });
    });

  }

  // 🚀 Inicializa usando las variables que vienen de PHP
  if (window.CRUD_VARS) {
    initCrud(window.CRUD_VARS);
  }

});
