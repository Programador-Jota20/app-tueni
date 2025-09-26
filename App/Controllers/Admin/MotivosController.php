<?php
namespace App\Controllers\Admin;

use App\Models\Modulos; 
use App\Models\Motivos; 

class MotivosController
{
    private $Campo;   // Singular mayúscula
    private $camp;    // Singular minúscula
    private $Campos;  // Plural mayúscula
    private $camps;   // Plural minúscula
    private $model;   // Modelo dinámico

    public function __construct()
    {
        $this->Campo  = "Motivo";
        $this->camp   = "motivo";
        $this->Campos = "Motivos";
        $this->camps  = "motivos";

        // Define el modelo dinámicamente
        $this->model = "App\\Models\\" . $this->Campos; 
        // → App\Models\Motivos
    }

    public function index()
    {
        if (!isset($_SESSION['user_id'])) {
            header("Location: /app-tueni/public/admin/login");
            exit;
        }

        $modulos = Modulos::MostrarActivos();

        // Normalizamos para vista
        $Campo  = $this->Campo;
        $camp   = $this->camp;
        $Campos = $this->Campos;
        $camps  = $this->camps;

        // Llamada dinámica
        $model = $this->model;
        $$camps = $model::Mostrar(); // crea $motivos

        require __DIR__ . '/../../Views/Admin/' . $Campos . '.php';
    }

    public function guardar()
    {
        header('Content-Type: application/json; charset=utf-8');

        $Cod = $_POST['Cod'.$this->Campo] ?? null;
        $Nom = trim($_POST['Nom'.$this->Campo] ?? '');
        $Tipo = $_POST['TipoTransaccion'] ?? '';

        if ($Nom === '' || $Tipo === '') {
            echo json_encode(['success' => false, 'message' => 'Todos los campos son obligatorios']);
            exit;
        }

        $model = $this->model;

        if ($Cod && $Cod != 0) {
            $ok = $model::Actualizar($Cod, $Nom, $Tipo);
        } else {
            $ok = $model::Insertar($Nom, $Tipo);
        }

        echo json_encode([
            'success' => $ok,
            'message' => $ok ? $this->Campo.' guardado correctamente' : 'Error al guardar en la base de datos'
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
            echo json_encode(['success' => false, 'message' => $this->Campo.' no encontrado']);
        }
    }

    public function eliminar()
    {
        header('Content-Type: application/json; charset=utf-8');

        $Cod = $_POST['Cod'.$this->Campo] ?? null;
        if (!$Cod) {
            echo json_encode(['success' => false]);
            return;
        }

        $model = $this->model;
        $ok = $model::Eliminar($Cod);

        echo json_encode(['success' => $ok]);
    }

    // NUEVO: Obtener motivos por Tipo (para combo dependiente AJAX)
    public function obtenerPorTipo()
    {
        header('Content-Type: application/json; charset=utf-8');

        $tipo = $_GET['tipo'] ?? null;
        if (!$tipo) {
            echo json_encode(['success' => false, 'data' => []]);
            return;
        }

        $motivos = Motivos::MostrarPorTipo($tipo); // aquí tu método en el modelo
        echo json_encode(['success' => true, 'data' => $motivos]);
}


}
