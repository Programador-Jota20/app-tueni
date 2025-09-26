<?php
namespace App\Controllers\Admin;

use App\Models\Modulos;
use App\Models\Transacciones;

class TransaccionesController
{
    public function index()
    {
        if (!isset($_SESSION['user_id'])) {
            header("Location: /app-tueni/public/admin/login");
            exit;
        }

        $modulos = Modulos::MostrarActivos();

        require __DIR__ . '/../../Views/Admin/Transacciones.php';
    }

    // 🔹 Obtener transacciones con filtros y paginación
    public function obtener()
    {
        header('Content-Type: application/json; charset=utf-8');

        // Filtros
        $TipoTransaccion = $_GET['TipoTransaccion'] ?? 0;
        $TipoTransaccion = $TipoTransaccion === '' ? 0 : $TipoTransaccion;

        $CodMotivo = $_GET['CodMotivo'] ?? 0;
        $CodMotivo = $CodMotivo === '' ? 0 : (int)$CodMotivo;

        $CodLinea = $_GET['CodLinea'] ?? 0;
        $CodLinea = $CodLinea === '' ? 0 : (int)$CodLinea;

        $NombrePersona = $_GET['NombrePersona'] ?? null;
        $NombrePersona = ($NombrePersona === '' || strtolower($NombrePersona) === 'null') ? null : $NombrePersona;

        $PeriodoInicio = $_GET['PeriodoInicio'] ?? '1900-01-01';
        $PeriodoInicio = ($PeriodoInicio === '' || strtolower($PeriodoInicio) === 'null') ? '1900-01-01' : $PeriodoInicio;

        $PeriodoFin = $_GET['PeriodoFin'] ?? date('Y-m-d');
        $PeriodoFin = ($PeriodoFin === '' || strtolower($PeriodoFin) === 'null') ? date('Y-m-d') : $PeriodoFin;

        // Paginación
        $pagina = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
        $limit  = isset($_GET['limit'])  ? (int)$_GET['limit']  : 50;
        $offset = ($pagina - 1) * $limit;

        // Consultas
        $datos = Transacciones::Listar($TipoTransaccion, $CodMotivo, $CodLinea, $NombrePersona, $PeriodoInicio, $PeriodoFin, $offset, $limit);
        $total = Transacciones::Contar($TipoTransaccion, $CodMotivo, $CodLinea, $NombrePersona, $PeriodoInicio, $PeriodoFin);

        echo json_encode([
            'success' => true,
            'data'    => $datos,
            'total'   => $total,
            'pagina'  => $pagina,
            'limit'   => $limit
        ]);
    }
}
