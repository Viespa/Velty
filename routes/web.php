<?php

use Velty\App\Controllers\HomeController;
use Velty\Core\Router;


/** @var Router $router */
$router->get('/', [HomeController::class, 'index']);


$router->get('/debug-test', function () {
    throw new Exception("Esto es una prueba del sistema de errores de Velty");
});
