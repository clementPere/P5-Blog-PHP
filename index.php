<?php

require_once realpath("vendor/autoload.php");

use App\Router\Router;

define('ROOT', dirname(__DIR__) . '\Blog');
define('BASE_URL', "http://localhost/Formation/OpenClassrooms/P5blog/Blog/");
$router = new Router($_GET['url']);

/**
 * Nom du controller à appeler avec sa methode
 */
$router->get('/', "Home->index");
$router->get('/posts', "Post->index");
$router->get('/login', "Auth->index");
$router->post('/login', "Auth->index");
$router->get('/logout', "Auth->logout");
$router->run();
