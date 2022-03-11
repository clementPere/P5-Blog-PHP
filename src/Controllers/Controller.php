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
        if (empty($_SESSION['email']) and empty($_SESSION['id'])) {
            $this->twig->display('login.html.twig');
            // header('Location: http://localhost/Formation/OpenClassrooms/P5blog/Blog/login');
            return false;
        }
        var_dump('Vous êtes déjà connecté !');

        $url = $_GET['url'];

        if ($url === "login") {
            header('Location: http://localhost/Formation/OpenClassrooms/P5blog/Blog');
        }
        if ($url = !"login") {
            header("Location: http://localhost/Formation/OpenClassrooms/P5blog/Blog/$url");
        }
        // header("Location: http://localhost/Formation/OpenClassrooms/P5blog/Blog/$url");
        return true;
    }

    public function logout()
    {
        if (!empty($_SESSION['email']) and !empty($_SESSION['id'])) {
            session_destroy();
            header('Location: http://localhost/Formation/OpenClassrooms/P5blog/Blog/');
        }
    }
}
