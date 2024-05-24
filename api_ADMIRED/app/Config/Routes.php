<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->group("api", function ($routes) {
    $routes->post("register", "Register::index");
    $routes->post("login", "Login::index");
    $routes->get("users", "User::index", ['filter' => 'authFilter']);
    $routes->post('Usuarios/create', 'Usuarios::create');
    $routes->get('usuarios/show/(:num)', 'Usuarios::show/$1');
    $routes->get("usuarios", "Usuarios::index");
    $routes->put('usuarios/update/(:num)', 'Usuarios::update/$1');
    $routes->delete('usuarios/delete/(:num)', 'Usuarios::delete/$1');
    $routes->post("pqr/create", "Pqr::create");
    $routes->get("pqr/show/(:num)", "Pqr::show/$1");
    $routes->get("pqr", "Pqr::index");
    $routes->put("pqr/update/(:num)", "Pqr::update/$1");
    $routes->delete("pqr/delete/(:num)", "Pqr::delete/$1");
});

