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
$router->post('/', "Home->index");

$router->get('/posts', "Post->index");
$router->post('/posts/commentary', "Commentary->index");

$router->get('/auth', "Auth->index");
$router->post('/auth', "Auth->index");
$router->get('/logout', "Auth->logout");

$router->get('/user/account', 'UserAccount->index');

$router->get('/admin/comments', "AdminCommentary->index");
$router->post('/admin/comments', "AdminCommentary->index");

$router->get('/admin/posts', "AdminPost->index");
$router->post('/admin/posts', "AdminPost->index");

$router->get('/admin/user', "User->index");
$router->post('/admin/user', "User->index");

$router->run();
