<?php

use Velty\Core\Router;
use Velty\Core\View;
use Velty\Core\Response;
use Velty\Core\Session;
use Velty\Core\Auth;
/**
 * Summary of route
 * @param string $name
 * @param array $params
 * @throws \Exception
 * @return string
 */
function route(string $name, array $params = []): string
{
    global $router;

    if (!$router instanceof Router) {
        throw new Exception("Router no definido o no es válido.");
    }

    $uri = $router->route($name, $params);

    if (!$uri) {
        throw new Exception("Ruta con nombre '$name' no encontrada.");
    }

    return $uri;
}

/**
 * Summary of view
 * @param string $name
 * @param array $data
 * @return void
 */
function view(string $name, array $data = []): void
{
    View::render($name, $data);
}

/*
 * Summary of response
 * @return Response
 */
function response(): Response
{
    return new Response();
}

function session(): Session
{
    return new Session();
}

function auth(): Auth
{
    return new Auth();
}

