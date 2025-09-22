<?php
// Página de login
$router->get('', 'Web\\HomeController@login');

// Procesar login
$router->post('login', 'Web\\HomeController@doLogin');
