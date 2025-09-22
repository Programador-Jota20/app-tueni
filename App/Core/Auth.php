<?php
namespace App\Core;

class Auth
{
    // Verifica si hay sesión válida; si no, redirige al login
    public static function CheckAuth()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['User'])) {
            // Si no está logueado, redirige al login admin
            header('Location: ' . inicio() . 'admin/login');
            exit;
        }
    }

    // Genera token CSRF (lo guarda en sesión)
    public static function GenerateCsrfToken(): string
    {
        if (session_status() === PHP_SESSION_NONE) session_start();
        $token = bin2hex(random_bytes(32));
        $_SESSION['CsrfToken'] = $token;
        $_SESSION['CsrfTokenTime'] = time();
        return $token;
    }

    // Verifica token CSRF (y caducidad opcional)
    public static function VerifyCsrfToken($token): bool
    {
        if (session_status() === PHP_SESSION_NONE) session_start();
        if (empty($_SESSION['CsrfToken'])) return false;
        $valid = hash_equals($_SESSION['CsrfToken'], $token);
        // Opcional: caducidad 30 min
        if ($valid && (time() - ($_SESSION['CsrfTokenTime'] ?? 0) <= 1800)) {
            // evitar reuso: destruir token
            unset($_SESSION['CsrfToken'], $_SESSION['CsrfTokenTime']);
            return true;
        }
        return false;
    }
}