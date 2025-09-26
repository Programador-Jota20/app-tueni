<?php

use App\Core\Router;

/** ===========================
 *  Rutas del panel Admin
 *  =========================== */

// ---------- Login ----------
$router->get('admin', 'Admin\LoginController@index');
$router->get('admin/login', 'Admin\LoginController@index');
$router->post('admin/login', 'Admin\LoginController@auth');
$router->get('admin/logout', 'Admin\LoginController@logout');

// ---------- Dashboard ----------
$router->get('admin/dashboard', 'Admin\DashboardController@index');

// ---------- Usuarios ----------
$router->get('admin/usuarios', 'Admin\UsuariosController@index');

// ---------- Módulos ----------
$router->get('admin/modulos', 'Admin\ModulosController@index');
$router->get('admin/modulos/obtener', 'Admin\ModulosController@obtener');
$router->post('admin/modulos/guardar', 'Admin\ModulosController@guardar');
$router->post('admin/modulos/guardar-orden', 'Admin\ModulosController@guardarOrden');

// ---------- Roles ----------
$router->get('admin/roles', 'Admin\RolesController@index');
$router->get('admin/roles/obtener', 'Admin\RolesController@obtener');
$router->post('admin/roles/guardar', 'Admin\RolesController@guardar');
$router->post('admin/roles/eliminar', 'Admin\RolesController@eliminar');

// ---------- Motivos ----------
$router->get('admin/motivos', 'Admin\MotivosController@index');
$router->get('admin/motivos/obtener', 'Admin\MotivosController@obtener');
$router->post('admin/motivos/guardar', 'Admin\MotivosController@guardar');
$router->post('admin/motivos/eliminar', 'Admin\MotivosController@eliminar');
$router->get('admin/motivos/mostrarportipo', 'Admin\MotivosController@obtenerPorTipo');

// ---------- Transacciones ----------
$router->get('admin/transacciones', 'Admin\TransaccionesController@index');
$router->get('admin/transacciones/obtener', 'Admin\TransaccionesController@obtener');

// ---------- Monedas ----------
$router->get('admin/monedas', 'Admin\MonedasController@index');
$router->get('admin/monedas/obtener', 'Admin\MonedasController@obtener');
$router->post('admin/monedas/guardar', 'Admin\MonedasController@guardar');
$router->post('admin/monedas/eliminar', 'Admin\MonedasController@eliminar');