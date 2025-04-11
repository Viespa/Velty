<?php

namespace Velty\Core;

class Auth
{
    protected Session $session;

    public function __construct()
    {
        $this->session = new Session();
    }

    public function check(): bool
    {
        return $this->session->get('user') !== null;
    }

    public function user(): mixed
    {
        return $this->session->get('user');
    }

    public function login(array $user): void
    {
        $this->session->set('user', $user);
    }

    public function logout(): void
    {
        $this->session->forget('user');
    }
}
