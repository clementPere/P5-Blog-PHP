<?php

require_once realpath("vendor/autoload.php");

use App\Controllers\ArticlesController;
use App\Controllers\HomeController;


            
if(isset($_GET['url'])){
        $url = $_GET['url'];
}

$arrayUrl = ["","accueil", "articles"];

//Inclus le controller selon l'action de l'utilisateur
if($url === "accueil" | $url === ""){
        $controller = new HomeController;
        $controller->index();
}
if($url === "articles"){
        $controller = new ArticlesController;
        
}

