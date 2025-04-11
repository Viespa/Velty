<?php

namespace Velty\Core;

class Route
{
    public string $method;
    public string $uri;
    public $action;
    public array $middlewares = [];
    public ?string $name = null;

    public function __construct(string $method, string $uri, $action)
    {
        $this->method = $method;
        $this->uri = $uri;
        $this->action = $action;
    }

    public function middleware(array $middlewares): static
    {
        $this->middlewares = $middlewares;
        return $this;
    }

    public function name(string $name): static
    {
        $this->name = $name;

        // Registra en el Router global (esto requiere acceso, o cambiar a un servicio global)
        global $router;
        if ($router instanceof Router) {
            $router->registerNamedRoute($name, $this);
        }

        return $this;
    }
}
