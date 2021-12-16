<?php

class HomeController{


    private $articleManager;
    private $view;

    public function __construct(){
        if(isset($url) && count($url) > 1){
                throw new Exception('Page introuvable');
        }else{
            $this->articles();
        }
    }

    private function articles(){
        $this->articleManager = new ArticleManager;
        $articles = $this->articleManager->getArticles();
        require_once('Views/AccueilView.php');
    }
}