<?php

namespace Velty\Core;

class Response
{
    public function json(array $data, int $status = 200): void
    {
        http_response_code($status);
        header('Content-Type: application/json');
        echo json_encode($data);
        exit;
    }

    public function redirect(string $to): void
    {
        header("Location: $to");
        exit;
    }

    public function back(): void
    {
        $referer = $_SERVER['HTTP_REFERER'] ?? '/';
        $this->redirect($referer);
    }

    public function text(string $content, int $status = 200): void
    {
        http_response_code($status);
        header('Content-Type: text/plain');
        echo $content;
        exit;
    }

    public function html(string $html, int $status = 200): void
    {
        http_response_code($status);
        header('Content-Type: text/html');
        echo $html;
        exit;
    }
}
