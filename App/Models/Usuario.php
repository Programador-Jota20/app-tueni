<?php
namespace App\Models;

use PDO;
use Config\Config;

class Usuario
{
    protected static function GetConnection(): PDO
    {
        $db = new PDO(
            "mysql:host=" . Config::DB_HOST . ";dbname=" . Config::DB_NAME . ";charset=" . Config::DB_CHARSET,
            Config::DB_USER,
            Config::DB_PASS
        );
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $db;
    }

    public static function FindByUsername($username)
    {
        $db = self::GetConnection();
        $stmt = $db->prepare("SELECT CodUsuario, NomUsuario, Password AS Password, Correo, Telefono, CodRol, FlgEli 
                              FROM users WHERE NomUsuario = :username LIMIT 1");
        $stmt->execute([':username' => $username]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function MostrarUsuarios($username)
    {
        $db = self::GetConnection();
        $stmt = $db->prepare("SELECT CodUsuario, NomUsuario, Correo, Telefono, CodRol, FlgEli 
                              FROM users WHERE NomUsuario = :username LIMIT 1");
        $stmt->execute([':username' => $username]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
}