<?php
namespace App\Controllers\Admin;

use App\Models\Modulos;

class RolesController
{
    private $Campo;   // Singular capitalizado
    private $camp;    // Singular minúscula
    private $Campos;  // Plural capitalizado 
    private $camps;   // Plural minúscula
    private $model;   // Clase del modelo

    public function __construct()
    {
        // Aquí defines tú los valores exactos
        $this->Campo  = "Rol";
        $this->Campos = "Roles";
        $this->camp   = "rol";
        $this->camps  = "roles";

        // Modelo dinámico según plural
        $this->model = "App\\Models\\" . $this->Campos;
    }

    public function index()
    {
        if (!isset($_SESSION['user_id'])) {
            header("Location: /app-tueni/public/admin/login");
            exit;
        }

        $modulos = Modulos::MostrarActivos();

        // Variables para la vista
        $Campo  = $this->Campo;
        $camp   = $this->camp;
        $Campos = $this->Campos;
        $camps  = $this->camps;

        // Llamada dinámica
        $model = $this->model;
        $$camps = $model::Mostrar();

        require __DIR__ . '/../../Views/Admin/' . $Campos . '.php';
    }

    public function guardar()
    {
        header('Content-Type: application/json; charset=utf-8');

        $Cod = $_POST['Cod' . $this->Campo] ?? null;
        $Nom = trim($_POST['Nom' . $this->Campo] ?? '');

        if ($Nom === '') {
            echo json_encode(['success' => false, 'message' => 'El nombre es obligatorio']);
            exit;
        }

        $model = $this->model;

        if ($Cod && $Cod != 0) {
            $ok = $model::Actualizar($Cod, $Nom);
        } else {
            $ok = $model::Insertar($Nom);
        }

        echo json_encode([
            'success' => $ok,
            'message' => $ok ? $this->Campo . ' guardado correctamente' : 'Error al guardar en la base de datos'
        ]);
    }

    public function obtener()
    {
        $Cod = $_GET['id'] ?? null;
        if (!$Cod) {
            echo json_encode(['success' => false, 'message' => 'ID no válido']);
            return;
        }

        $model = $this->model;
        $fila = $model::ObtenerPorId($Cod);

        if ($fila) {
            echo json_encode(['success' => true, 'data' => $fila]);
        } else {
            echo json_encode(['success' => false, 'message' => $this->Campo . ' no encontrado']);
        }
    }

    public function eliminar()
    {
        header('Content-Type: application/json; charset=utf-8');

        $Cod = $_POST['Cod' . $this->Campo] ?? null;
        if (!$Cod) {
            echo json_encode(['success' => false]);
            return;
        }

        $model = $this->model;
        $ok = $model::Eliminar($Cod);

        echo json_encode(['success' => $ok]);
    }
}
