<?php

namespace App\Controllers;

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

abstract class Controller
{

    private $loader;
    protected $twig;

    public function __construct()
    {
        //init folder with view file
        $this->loader = new FilesystemLoader(ROOT . '\Views');

        //init twig environment
        $this->twig = new Environment($this->loader);
    }
}
