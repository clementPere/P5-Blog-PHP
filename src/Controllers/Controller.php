<?php

namespace App\Controllers;

use App\Router\Router;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

abstract class Controller
{

    private $loader;
    protected $twig;
    protected $router;
    public $redirect;

    public function __construct()
    {
        //init folder with view file
        $this->loader = new FilesystemLoader(ROOT . '\Views');

        //init twig environment
        $this->twig = new Environment($this->loader);

        //Démarage de la session
        session_start();


        $this->router = new Router('/');
    }


    public function isConnected()
    {
        if (empty($_SESSION['username']) and empty($_SESSION['id'])) {
            $this->twig->display('login.html.twig');
            return false;
        }
        header('Location: http://localhost/P5/Blog/');
        return true;
    }

    public function logout()
    {
        if (!empty($_SESSION['username']) and !empty($_SESSION['id'])) {
            header('Location: http://localhost/P5/Blog/');
            session_destroy();
        }
    }
}
