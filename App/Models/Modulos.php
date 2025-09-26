<?php
namespace App\Models;

use PDO;
use Config\Config;

class Modulos
{
    // 🔹 conexión (ahora pública)
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

    // Traer todos los módulos activos, ordenados
    public static function MostrarActivos(): array
    {
        $db = self::GetConnection();
        $stmt = $db->prepare("SELECT CodModulo, OrdenModulo, NomModulo, FlgMaestro, IconoClase, IdHref
                              FROM modulos
                              WHERE FlgEli = 0
                              ORDER BY CAST(OrdenModulo AS UNSIGNED) ASC");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    // 🔹 obtener por id
    public static function ObtenerPorId($CodModulo): ?array
    {
        $db = self::GetConnection();
        $stmt = $db->prepare("SELECT CodModulo, NomModulo, FlgMaestro, IconoClase, IdHref
                              FROM modulos 
                              WHERE CodModulo = :CodModulo AND FlgEli = 0");
        $stmt->execute([':CodModulo' => $CodModulo]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row ?: null;
    }

    // 🔹 insertar
    public static function Insertar($NomModulo, $FlgMaestro, $IdHref, $IconoClase): bool
    {
        $db = self::GetConnection();
        $sql = "INSERT INTO modulos (NomModulo, FlgMaestro, IdHref, IconoClase, FlgEli) 
                VALUES (?, ?, ?, ?, ?)";
        return $db->prepare($sql)->execute([$NomModulo, $FlgMaestro, $IdHref, $IconoClase, 0]);
    }

    // 🔹 actualizar
    public static function Actualizar($CodModulo, $NomModulo, $FlgMaestro, $IdHref, $IconoClase): bool
    {
        $db = self::GetConnection();
        $sql = "UPDATE modulos 
                SET NomModulo=?, FlgMaestro=?, IdHref=?, IconoClase=? 
                WHERE CodModulo=?";
        return $db->prepare($sql)->execute([$NomModulo, $FlgMaestro, $IdHref, $IconoClase, $CodModulo]);
    }

    public static function actualizarOrden($CodModulo, $FlgMaestro, $OrdenModulo): bool
    {
        $db = self::GetConnection();
        $sql = "UPDATE modulos SET FlgMaestro=?, OrdenModulo=? WHERE CodModulo=?";
        return $db->prepare($sql)->execute([$FlgMaestro, $OrdenModulo, $CodModulo]);
    }

    // 🔹 verificar duplicados
    public static function ExisteDuplicado($NomModulo, $CodModulo = 0): bool
    {
        $db = self::GetConnection();
        $stmt = $db->prepare("SELECT CodModulo FROM modulos WHERE NomModulo = ? AND CodModulo != ?");
        $stmt->execute([$NomModulo, $CodModulo]);
        return (bool) $stmt->fetch();
    }
}
