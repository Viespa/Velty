<?php

namespace Velty\App\Middleware;

use Velty\Core\BaseMiddleware;

class AuthMiddleware extends BaseMiddleware
{
    public function handle(): bool
    {
        session_start();

        if (!isset($_SESSION['user'])) {
            $this->redirect('/login'); // o puedes usar $this->forbidden()
            return false;
        }

        return true;
    }
}
