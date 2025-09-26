<?php
namespace App\Models;

use PDO;
use Config\Config;

class Transacciones
{
    // 🔹 Conexión
    public static function GetConnection(): PDO
    {
        $db = new PDO(
            "mysql:host=" . Config::DB_HOST . ";dbname=" . Config::DB_NAME . ";charset=" . Config::DB_CHARSET,
            Config::DB_USER,
            Config::DB_PASS
        );
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $db;
    }

    // 🔹 Listar transacciones con filtros y paginación
    public static function Listar(
        ?string $TipoTransaccion = null,
        ?int $CodMotivo = null,
        ?int $CodLinea = null,
        ?string $NombrePersona = null,
        ?string $PeriodoInicio = null,
        ?string $PeriodoFin = null,
        int $Offset = 0,
        int $Limit = 50
    ): array {
        $db = self::GetConnection();

        // Normalizar parámetros
        $TipoTransaccion = $TipoTransaccion ?: 0;
        $CodMotivo       = $CodMotivo ?: 0;
        $CodLinea        = $CodLinea ?: 0;
        $NombrePersona   = $NombrePersona ?: null;
        $PeriodoInicio   = $PeriodoInicio ?: '1900-01-01';
        $PeriodoFin      = $PeriodoFin ?: date('Y-m-d');

        $sql = "
            SELECT
                c.CodCuenta,
                CONCAT(LPAD(c.Dia,2,'0'), '/', LPAD(c.Mes,2,'0'), '/', c.Anio) AS Fecha,
                COALESCE(c.Periodo, '') AS Periodo,
                CASE c.TipoTransaccion
                    WHEN 'I' THEN 'Ingreso'
                    WHEN 'S' THEN 'Salida'
                    ELSE '-'
                END AS TipoTransaccion,
                COALESCE(c.CodMotivo, 0) AS CodMotivo,
                COALESCE(m.NomMotivo, '') AS NomMotivo,
                COALESCE(c.CodLinea, 0) AS CodLinea,
                COALESCE(li.NomLinea, '') AS NomLinea,
                COALESCE(l.ApellidosNombres, '') AS ApellidosNombres,
                COALESCE(c.Concepto, '') AS Concepto,
                COALESCE(c.CodMoneda, '') AS CodMoneda,
                COALESCE(c.Cantidad, 0.00) AS Cantidad
            FROM cuentas c
            LEFT JOIN motivos m ON m.CodMotivo = c.CodMotivo AND m.FlgEli = 0
            LEFT JOIN lineas li ON li.CodLinea = c.CodLinea AND li.FlgEli = 0
            LEFT JOIN lineas_historial l ON l.CodLinea = li.CodLinea AND l.FlgActivo = 1
            WHERE c.FlgEli = 0
            AND (:TipoTransaccion = '0' OR c.TipoTransaccion = :TipoTransaccion)
            AND (:CodMotivo = 0 OR c.CodMotivo = :CodMotivo)
            AND (:CodLinea = 0 OR c.CodLinea = :CodLinea)
            AND (:NombrePersona IS NULL OR l.ApellidosNombres LIKE CONCAT('%', :NombrePersona, '%'))
            AND STR_TO_DATE(CONCAT(c.Anio,'-',c.Mes,'-',c.Dia), '%Y-%m-%d') >= :PeriodoInicio
            AND STR_TO_DATE(CONCAT(c.Anio,'-',c.Mes,'-',c.Dia), '%Y-%m-%d') <= :PeriodoFin
            ORDER BY c.Anio DESC, c.Mes DESC, c.Dia DESC,c.CodCuenta DESC
            LIMIT :Limit OFFSET :Offset
        ";

        $stmt = $db->prepare($sql);

        // Bind
        $stmt->bindValue(':TipoTransaccion', $TipoTransaccion, PDO::PARAM_STR);
        $stmt->bindValue(':CodMotivo', (int)$CodMotivo, PDO::PARAM_INT);
        $stmt->bindValue(':CodLinea', (int)$CodLinea, PDO::PARAM_INT);
        $stmt->bindValue(':NombrePersona', $NombrePersona);
        $stmt->bindValue(':PeriodoInicio', $PeriodoInicio);
        $stmt->bindValue(':PeriodoFin', $PeriodoFin);
        $stmt->bindValue(':Limit', (int)$Limit, PDO::PARAM_INT);
        $stmt->bindValue(':Offset', (int)$Offset, PDO::PARAM_INT);


        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    // 🔹 Contar total de transacciones con filtros
    public static function Contar(
        ?string $TipoTransaccion = null,
        ?int $CodMotivo = null,
        ?int $CodLinea = null,
        ?string $NombrePersona = null,
        ?string $PeriodoInicio = null,
        ?string $PeriodoFin = null
    ): int {
        $db = self::GetConnection();

        $PeriodoInicio = $PeriodoInicio ?: null;
        $PeriodoFin    = $PeriodoFin ?: null;

    // 🔹 Depuración: imprimir filtros
    error_log("Filtros recibidos: " . print_r([
        'TipoTransaccion' => $TipoTransaccion,
        'CodMotivo' => $CodMotivo,
        'CodLinea' => $CodLinea,
        'NombrePersona' => $NombrePersona,
        'PeriodoInicio' => $PeriodoInicio,
        'PeriodoFin' => $PeriodoFin,
    ], true));
    
    $sql = "
        SELECT COUNT(*) AS Total
        FROM cuentas c
        LEFT JOIN motivos m ON m.CodMotivo = c.CodMotivo AND m.FlgEli = 0
        LEFT JOIN lineas li ON li.CodLinea = c.CodLinea AND li.FlgEli = 0
        LEFT JOIN lineas_historial l ON l.CodLinea = li.CodLinea AND l.FlgActivo = 1
        WHERE c.FlgEli = 0
            AND (:TipoTransaccion = '0' OR c.TipoTransaccion = :TipoTransaccion)
            AND (:CodMotivo = 0 OR c.CodMotivo = :CodMotivo)
            AND (:CodLinea = 0 OR c.CodLinea = :CodLinea)
            AND (:NombrePersona IS NULL OR l.ApellidosNombres LIKE CONCAT('%', :NombrePersona, '%'))
            AND STR_TO_DATE(CONCAT(c.Anio,'-',c.Mes,'-',c.Dia), '%Y-%m-%d') >= :PeriodoInicio
            AND STR_TO_DATE(CONCAT(c.Anio,'-',c.Mes,'-',c.Dia), '%Y-%m-%d') <= :PeriodoFin
        ";

        $stmt = $db->prepare($sql);
        $stmt->bindValue(':TipoTransaccion', $TipoTransaccion);
        $stmt->bindValue(':CodMotivo', $CodMotivo, PDO::PARAM_INT);
        $stmt->bindValue(':CodLinea', $CodLinea, PDO::PARAM_INT);
        $stmt->bindValue(':NombrePersona', $NombrePersona);
        $stmt->bindValue(':PeriodoInicio', $PeriodoInicio);
        $stmt->bindValue(':PeriodoFin', $PeriodoFin);

        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return (int)$row['Total'];
    }
}
