<?php

require_once __DIR__ . '/../config/app.php';
require_once __DIR__ . '/../app/core/Router.php';

// Crear instancia antes de incluir routes
$router = new Router();

// Incluir rutas del admin
require_once __DIR__ . '/../routes/admin.php';

// Ejecutar
$router->dispatch($_GET['url'] ?? '');
