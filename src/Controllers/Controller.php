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
        // header('Clear-Site-Data: "cache", "cookies", "storage", "executionContexts"');

        //init folder with view file
        $this->loader = new FilesystemLoader(ROOT . '\src\Views');

        //init twig environment
        $this->twig = new Environment($this->loader);
        $this->twig->addGlobal('BASE_URL', BASE_URL);
        //Démarage de la session
        session_start();

        if (isset($_SESSION['email'])) {
            $this->twig->addGlobal('session', $_SESSION);
        }

        $this->router = new Router('/');
    }

    private function isConnected()
    {
        if (empty($_SESSION['email']) and empty($_SESSION['id'])) {
            return true;
        }
        return false;
    }

    public function redirectNotConnected()
    {
        if ($this->isConnected()) {
            header('Location: ' . BASE_URL . 'auth');
        }
    }

    public function logout()
    {
        if (!empty($_SESSION['email']) and !empty($_SESSION['id'])) {
            session_destroy();
            header('Location: ' . BASE_URL);
        }
    }
}
