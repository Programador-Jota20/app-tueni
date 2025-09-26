<?php
namespace App\Controllers\Admin;

use App\Models\Modulos; // 🔹 IMPORTANTE: importar el modelo

class DashboardController
{
    public function index()
    {
        if (!isset($_SESSION['user_id'])) {
            header("Location: /app-tueni/public/admin/login");
            exit;
        }

        // Traer módulos activos para el sidebar
        $modulos = Modulos::MostrarActivos();

        // Incluir la vista principal
        require __DIR__ . '/../../Views/Admin/Dashboard.php';
    }
}
