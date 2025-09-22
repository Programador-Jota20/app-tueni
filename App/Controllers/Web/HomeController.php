<?php
namespace App\Controllers\Web;

class HomeController {
    public function login() {
        // Mostrar vista login
        include __DIR__ . '/../../views/web/login.php';
    }

    public function doLogin() {
        session_start();

        $user = $_POST['user'] ?? '';
        $pass = $_POST['pass'] ?? '';

        // Demo: usuario/clave fijos (luego lo haces desde DB)
        if ($user === 'admin' && $pass === '1234') {
            $_SESSION['user'] = $user;
            header("Location: /app-tueni/public/admin");
            exit;
        } else {
            $error = "Usuario o contraseña incorrectos";
            include __DIR__ . '/../../views/web/login.php';
        }
    }
}
