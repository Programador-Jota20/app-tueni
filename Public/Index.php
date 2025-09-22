<?php
// Cargamos el Router
require_once __DIR__ . '/../App/Core/Router.php';

// Public/Index.php (arriba)
session_set_cookie_params([
    'lifetime' => 0,
    'path' => '/',
    'domain' => '',           // o tu dominio
    'secure' => false,        // true en HTTPS
    'httponly' => true,
    'samesite' => 'Lax'
]);
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Autoloader básico (para clases en App, Config, etc.)
spl_autoload_register(function ($class) {
    $baseDir = __DIR__ . '/../';
    $classPath = str_replace('\\', '/', $class) . '.php';
    $file = $baseDir . $classPath;

    if (file_exists($file)) {
        require_once $file;
    }
});

// Cargar helpers
require_once __DIR__ . '/../App/Core/Helpers.php';

use App\Core\Router;

// Instancia del Router
$router = new Router();

// Cargar rutas del Admin
require_once __DIR__ . '/../Routes/Admin.php';

// Cargar rutas de la Web (si quieres separar lo público de lo privado)
require_once __DIR__ . '/../Routes/Web.php';

// Detectar la URL actual
$uri = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
$base = trim(str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'])), '/');

// Quitar base si existe (para localhost/app-tueni/public)
if ($base && strpos($uri, $base) === 0) {
    $uri = substr($uri, strlen($base));
}

$uri = trim($uri, '/');

// Ejecutar la ruta
$router->dispatch($uri);