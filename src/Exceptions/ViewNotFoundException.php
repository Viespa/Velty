<?php
namespace Velty\Exceptions;

class ViewNotFoundException extends VeltyException
{
    public function __construct(string $viewPath)
    {
        $message = "La vista no fue encontrada: $viewPath";
        $solution = "Crea el archivo de vista en esa ruta, o revisa que el nombre esté bien escrito.";
        parent::__construct($message, $solution);
    }
}
