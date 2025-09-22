<?php
namespace App\Controllers\Admin;

use App\Models\Usuario;

class LoginController
{
    public function index()
    {
        require __DIR__ . '/../../Views/Admin/Login.php';
    }

    public function auth()
    {
        session_start();
        $username = $_POST['username'] ?? '';
        $password = $_POST['password'] ?? '';

        $user = Usuario::FindByUsername($username);

        if ($user && password_verify($password, $user['Password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['usuario'];
            header("Location: /app-tueni/public/admin/dashboard");
            exit;
        } else {
            $_SESSION['error'] = "Usuario o contraseña incorrectos";
            header("Location: /app-tueni/public/admin/login");
            exit;
        }
    }

    public function logout()
    {
        session_start();
        session_destroy();
        header("Location: /app-tueni/public/admin/login");
        exit;
    }
}