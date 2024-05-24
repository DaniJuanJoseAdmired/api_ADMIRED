<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->group("api", function ($routes) {
    $routes->post("register", "Register::index");
    $routes->post("login", "Login::index");
    $routes->post('Usuarios/create', 'Usuarios::create');
    $routes->get('usuarios/success', 'Usuarios::success');
    $routes->get("users", "User::index", ['filter' => 'authFilter']);
    $routes->get("usuarios", "Usuarios::index", ['filter' => 'authFilter']);
    $routes->get("pqr", "Pqr::index", ['filter' => 'authFilter']);
});

