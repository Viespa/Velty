<?php

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../core/helpers.php';
require_once __DIR__ . '/../bootstrap/app.php';

use Velty\Core\Router;

$router = new Router();
global $router; // ✅ hace que esté disponible en routes y helpers

require_once __DIR__ . '/../routes/web.php';

$router->dispatch($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);
