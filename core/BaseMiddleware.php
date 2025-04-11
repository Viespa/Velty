<?php

namespace Velty\Core;

abstract class BaseMiddleware implements MiddlewareInterface
{
    protected function redirect(string $path): void
    {
        header("Location: $path");
        exit;
    }

    protected function json(array $data, int $status = 200): void
    {
        http_response_code($status);
        header('Content-Type: application/json');
        echo json_encode($data);
        exit;
    }

    protected function forbidden(string $message = 'Acceso no autorizado'): void
    {
        http_response_code(403);
        echo $message;
        exit;
    }
}
