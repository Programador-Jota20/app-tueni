<?php
namespace App\Controllers\Admin;

use App\Models\Modulos;

class ModulosController
{
    public function index()
    {
        
        if (!isset($_SESSION['user_id'])) {
            header("Location: /app-tueni/public/admin/login");
            exit;
        }

        // Obtener módulos activos
        $modulos = Modulos::MostrarActivos();

        // Pasamos la variable a la vista
        require __DIR__ . '/../../Views/Admin/Modulos.php';

        
    }

    // Método para cargar el sidebar dinámico   
    public function menu()
    {
        if (!isset($_SESSION['user_id'])) {
            header("Location: /app-tueni/public/admin/login");
            exit;
        }

        $modulos = Modulos::MostrarActivos();

        // Cargar la vista parcial del sidebar
        require __DIR__ . '/../../Views/Admin/partials/sidebar.php';
    }


    public function obtener()
    {
        $CodModulo = $_GET['id'] ?? null;
        if (!$CodModulo) {
            echo json_encode(['success' => false, 'message' => 'ID no válido']);
            return;
        }

        $modulo = \App\Models\Modulos::ObtenerPorId($CodModulo);

        if ($modulo) {
            echo json_encode(['success' => true, 'data' => $modulo]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Módulo no encontrado']);
        }
    }

    public function guardar()
    {
        header('Content-Type: application/json; charset=utf-8');

        $CodModulo   = $_POST['CodModulo'] ?? null;
        $NomModulo   = trim($_POST['NomModulo'] ?? '');
        $FlgMaestro  = isset($_POST['FlgMaestro']) ? 1 : 0;
        $IdHref      = $_POST['IdHref'] ?? null;
        $IconoClase  = $_POST['IconoClase'] ?? null;

        if ($NomModulo === '') {
            echo json_encode(['success' => false, 'message' => 'El nombre es obligatorio']);
            exit;
        }

        // Verificar duplicados
        if (Modulos::existeDuplicado($NomModulo, $CodModulo)) {
            echo json_encode(['success' => false, 'message' => 'Ya existe un módulo con ese nombre']);
            exit;
        }

        // Insertar o actualizar
        if ($CodModulo) {
            $ok = Modulos::actualizar($CodModulo, $NomModulo, $FlgMaestro, $IdHref, $IconoClase);
        } else {
            $ok = Modulos::insertar($NomModulo, $FlgMaestro, $IdHref, $IconoClase);
        }

        echo json_encode([
            'success' => $ok,
            'message' => $ok ? 'Módulo guardado correctamente' : 'Error al guardar en la base de datos'
        ]);
        exit;
    }

    public function guardarOrden()
    {
        header('Content-Type: application/json; charset=utf-8');

        $json = file_get_contents('php://input');
        $data = json_decode($json, true);

        if(empty($data['modulos'])){
            echo json_encode(['success' => false, 'message' => 'No hay datos para actualizar']);
            exit;
        }

        foreach($data['modulos'] as $mod){
            \App\Models\Modulos::actualizarOrden($mod['CodModulo'], $mod['FlgMaestro'], $mod['OrdenModulo']);
        }

        echo json_encode(['success' => true, 'message' => 'Orden guardado correctamente']);
        exit;
    }


}

