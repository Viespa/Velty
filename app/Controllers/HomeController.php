<?php

namespace Velty\App\Controllers;
use Velty\Core\View;
class HomeController
{
    public function index()
    {
        View::render('welcome', ['nombre' => 'Viespa']);
    }

    public function welcome()
    {
        return view('welcome');
    }

}
