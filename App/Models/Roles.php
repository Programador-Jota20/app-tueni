<?php
namespace App\Models;

use PDO;
use Config\Config;

class Roles
{
    private static string $campo  = "Rol";   // singular Mayus
    private static string $campos = "Roles";  // plural Mayus
    private static string $camp   = "rol";   // singular minus
    private static string $camps  = "roles";  // plural minus 

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

    // Listar activos
    public static function Mostrar(): array
    {
        $db = self::GetConnection();
        $pk   = "Cod" . self::$campo;
        $nom  = "Nom" . self::$campo;
        $tabla = self::$camps;

        $stmt = $db->prepare("SELECT $pk, $nom, FlgEli FROM $tabla WHERE FlgEli = 0 ORDER BY $pk ASC");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Obtener por ID
    public static function ObtenerPorId($id): ?array
    {
        $db = self::GetConnection();
        $pk   = "Cod" . self::$campo;
        $nom  = "Nom" . self::$campo;
        $tabla = self::$camps;

        $stmt = $db->prepare("SELECT $pk, $nom, FlgEli FROM $tabla WHERE $pk = :id");
        $stmt->execute([':id' => $id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row ?: null;
    }

    // Insertar
    public static function Insertar($nombre): bool
    {
        $db = self::GetConnection();
        $nom   = "Nom" . self::$campo;
        $tabla = self::$camps;

        $stmt = $db->prepare("INSERT INTO $tabla ($nom, FlgEli) VALUES (?, 0)");
        return $stmt->execute([$nombre]);
    }

    // Actualizar
    public static function Actualizar($id, $nombre): bool
    {
        $db = self::GetConnection();
        $pk   = "Cod" . self::$campo;
        $nom  = "Nom" . self::$campo;
        $tabla = self::$camps;

        $stmt = $db->prepare("UPDATE $tabla SET $nom = ? WHERE $pk = ?");
        return $stmt->execute([$nombre, $id]);
    }

    // Eliminar (solo marca FlgEli = 1)
    public static function Eliminar($id): bool
    {
        $db = self::GetConnection();
        $pk   = "Cod" . self::$campo;
        $tabla = self::$camps;

        $stmt = $db->prepare("UPDATE $tabla SET FlgEli = 1 WHERE $pk = ?");
        return $stmt->execute([$id]);
    }
}
