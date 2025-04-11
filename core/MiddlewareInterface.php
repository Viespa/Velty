<?php

namespace Velty\Core;

interface MiddlewareInterface
{
    /**
     * Retorna true si puede continuar, false si no.
     */
    public function handle(): bool;
}
