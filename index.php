<?php

require_once realpath("vendor/autoload.php");

use App\Controllers\ArticlesController;
use App\Controllers\HomeController;


            
// if(isset($_GET['url'])){
//         $url = $_GET['url'];
// }

// $arrayUrl = ["","accueil", "articles"];

// //Inclus le controller selon l'action de l'utilisateur
// if($url === "accueil" | $url === ""){
//         $controller = new HomeController;
//         $controller->index();
// }
// if($url === "articles"){
//         $controller = new ArticlesController;
        
// }

try{
        
        $url = '';
        $ctrl = '';

        //Inclus le controller selon l'action de l'utilisateur
        if(isset($_GET['url'])){
            $url = explode('/', filter_var($_GET['url'], FILTER_SANITIZE_URL));
            //Valeur de l'action entré par l'utilisateur dans l'url
            $controller = ucfirst(strtolower($url[0]));
            //Valeur du controlleur à charger
            $controllerClass = $controller."Controller";
            $controllerFile = "src/Controllers/".$controllerClass.".php";
            if(file_exists($controllerFile)){
                require_once($controllerFile);
                var_dump($controllerClass);
                // var_dump($controllerClass);
                $this->ctrl = new $controllerClass($url);
            }
            else{
                throw new Exception('Page introuvable');
            }
        }
        else{
        require_once('src/Controllers/HomeController.php');
            $this->ctrl = new HomeController($url);
        }
    }
    //Gestion des erreurs en cas de controlleur non trouvé 
    catch(Exception $e){
        $errorMsg = $e->getMessage();
        require_once('src/Views/ErrorView.php');
    }

