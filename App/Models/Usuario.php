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
        $stmt = $db->prepare("SELECT id, usuario, password AS Password, correo, telefono, id_rol, FlgEli 
                              FROM users WHERE usuario = :username LIMIT 1");
        $stmt->execute([':username' => $username]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function SetRememberToken($id, $token, $expiresAt)
    {
        $db = self::GetConnection();
        $stmt = $db->prepare("UPDATE users SET remember_token = :token, remember_expires = :exp WHERE id = :id");
        $stmt->execute([':token'=>$token, ':exp'=>$expiresAt, ':id'=>$id]);
    }

    public static function FindByRememberToken($token)
    {
        $db = self::GetConnection();
        $stmt = $db->prepare("SELECT * FROM users WHERE remember_token = :token AND remember_expires > NOW() LIMIT 1");
        $stmt->execute([':token'=>$token]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function ClearRememberToken($token)
    {
        $db = self::GetConnection();
        $stmt = $db->prepare("UPDATE users SET remember_token = NULL, remember_expires = NULL WHERE remember_token = :token");
        $stmt->execute([':token'=>$token]);
    }
}