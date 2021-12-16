<?php

class Router {
    private $ctrl;
    private $view;

    public function routeReq(){
        try{
            //Chargement des classes
            spl_autoload_register(function($class){
                require_once('Models/'.$class.'.php');
            });
            $url = '';

            //Inclus le controller selon l'action de l'utilisateur
            if(isset($_GET['url'])){
                $url = explode('/', filter_var($_GET['url'],
                FILTER_SANITIZE_URL));
                //Valeur de l'action entré par l'utilisateur dans l'url
                $controller = ucfirst(strtolower($url[0]));
                //Valeur du controlleur à charger
                $controllerClass = $controller."Controller";
                $controllerFile = "Controllers/".$controllerClass.".php";
                if(file_exists($controllerFile)){
                    require_once($controllerFile);
                    $this->ctrl = new $controllerClass($url);
                }
                else{
                    throw new Exception('Page introuvable');
                }
            }
            else{
                require_once('Controllers/HomeController.php');
                $this->ctrl = new HomeController($url);
            }
        }
        //Gestion des erreurs en cas de controlleur non trouvé 
        catch(Exception $e){
            $errorMsg = $e->getMessage();
            require_once('Views/ErrorView.php');
        }
    }
}