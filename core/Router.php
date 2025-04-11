<?php

namespace Velty\Core;

class Router
{
    protected array $routes = [
        'GET' => [],
        'POST' => [],
        'PUT' => [],
        'DELETE' => [],
        'PATCH' => [],
    ];

    protected string $groupPrefix = '';
    protected array $groupMiddlewares = [];

    protected array $namedRoutes = [];

    public function get(string $uri, $action): Route
    {
        return $this->addRoute('GET', $uri, $action);
    }

    public function post(string $uri, $action): Route
    {
        return $this->addRoute('POST', $uri, $action);
    }

    public function put(string $uri, $action): Route
    {
        return $this->addRoute('PUT', $uri, $action);
    }

    public function delete(string $uri, $action): Route
    {
        return $this->addRoute('DELETE', $uri, $action);
    }

    public function patch(string $uri, $action): Route
    {
        return $this->addRoute('PATCH', $uri, $action);
    }

    protected function addRoute(string $method, string $uri, $action): Route
    {
        $uri = $this->normalize($this->groupPrefix . $uri);
        $route = new Route($method, $uri, $action);

        if (!empty($this->groupMiddlewares)) {
            $route->middleware($this->groupMiddlewares);
        }

        $this->routes[$method][] = $route;
        return $route;
    }

    public function group(string $prefixOrCallback, ?\Closure $callback = null): void
    {
        if (is_callable($prefixOrCallback) && $callback === null) {
            $callback = $prefixOrCallback;
            $prefix = '';
        } else {
            $prefix = $prefixOrCallback;
        }

        $previousPrefix = $this->groupPrefix;
        $this->groupPrefix .= $prefix;

        $previousMiddlewares = $this->groupMiddlewares;

        $callback($this);

        $this->groupPrefix = $previousPrefix;
        $this->groupMiddlewares = $previousMiddlewares;
    }

    public function middleware(array $middlewares): static
    {
        $this->groupMiddlewares = $middlewares;
        return $this;
    }

    public function dispatch(string $uri, string $method): void
    {
        $uri = $this->normalize(parse_url($uri, PHP_URL_PATH));
        $routes = $this->routes[$method] ?? [];

        foreach ($routes as $route) {
            $pattern = $this->convertUriToPattern($route->uri);

            if (preg_match($pattern, $uri, $matches)) {
                array_shift($matches); // Remove full match

                // Ejecutar middlewares
                foreach ($route->middlewares as $middlewareClass) {
                    if (!class_exists($middlewareClass)) {
                        http_response_code(500);
                        echo "Middleware '$middlewareClass' no encontrado.";
                        return;
                    }
                    if (!is_subclass_of($middlewareClass, \Velty\Core\MiddlewareInterface::class)) {
                        http_response_code(500);
                        echo "Middleware '$middlewareClass' debe implementar MiddlewareInterface.";
                        return;
                    }

                    $middleware = new $middlewareClass();

                    if (method_exists($middleware, 'handle')) {
                        $response = $middleware->handle();
                        if ($response === false) {
                            http_response_code(403);
                            echo "Acceso denegado por middleware.";
                            return;
                        }
                    }
                }

                // Ejecutar controlador
                $action = $route->action;
                // Función anónima (Closure)
                if (is_callable($action)) {
                    call_user_func_array($action, $matches);
                    return;
                }

                if (is_array($action)) {
                    [$controllerClass, $methodName] = $action;

                    if (!class_exists($controllerClass)) {
                        http_response_code(500);
                        echo "Controlador '$controllerClass' no existe.";
                        return;
                    }

                    $controller = new $controllerClass();

                    if (!method_exists($controller, $methodName)) {
                        http_response_code(500);
                        echo "Método '$methodName' no existe en '$controllerClass'.";
                        return;
                    }

                    call_user_func_array([$controller, $methodName], $matches);
                    return;
                }

                // Invokable controller
                if (class_exists($action)) {
                    $controller = new $action();
                    if (method_exists($controller, '__invoke')) {
                        call_user_func_array($controller, $matches);
                        return;
                    }
                }

                http_response_code(500);
                echo "Acción inválida.";
                return;
            }
        }

        // Si no se encuentra ninguna ruta
        http_response_code(404);
        require_once __DIR__ . '/../resources/views/errors/404.php';
        exit;
    }

    protected function convertUriToPattern(string $uri): string
    {
        $pattern = preg_replace('/\{[a-zA-Z_][a-zA-Z0-9_]*\}/', '([a-zA-Z0-9_-]+)', $uri);
        return '@^' . $pattern . '$@';
    }

    protected function normalize(string $uri): string
    {
        return trim($uri, '/');
    }

    public function registerNamedRoute(string $name, Route $route): void
    {
        $this->namedRoutes[$name] = $route;
    }

    public function route(string $name, array $params = []): ?string
    {
        if (!isset($this->namedRoutes[$name])) {
            return null;
        }

        $uri = $this->namedRoutes[$name]->uri;

        foreach ($params as $key => $value) {
            $uri = preg_replace("/\{$key\}/", $value, $uri);
        }

        return '/' . $uri;
    }

}
