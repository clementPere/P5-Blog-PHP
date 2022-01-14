<?php

require_once realpath("vendor/autoload.php");

use App\Router\Router;

$router = new Router($_GET['url']); 

/**
 * Nom du controller à appeler avec sa methode
 */
$router->get('/', "Home->index" ); 
$router->get('/articles', "Article->index" );
$router->run(); 