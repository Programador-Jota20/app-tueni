<?php

use App\Core\Router;

/** Rutas del panel Admin **/

// Mostrar login
$router->get('admin', 'Admin\LoginController@index');
$router->get('admin/login', 'Admin\LoginController@index');

// Procesar login
$router->post('admin/login', 'Admin\LoginController@auth');

// Cerrar sesión
$router->get('admin/logout', 'Admin\LoginController@logout');

// Dashboard (solo logueado)
$router->get('admin/dashboard', 'Admin\DashboardController@index');