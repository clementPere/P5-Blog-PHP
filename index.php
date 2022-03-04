<?php

require_once realpath("vendor/autoload.php");

use App\Router\Router;

define('ROOT', dirname(__DIR__) . '\Blog\src');
$router = new Router($_GET['url']);

/**
 * Nom du controller à appeler avec sa methode
 */
$router->get('/', "Home->index");
$router->get('/posts', "Post->index");
$router->get('/login', "Auth->index");
$router->post('/login', "Auth->index");
$router->run();
