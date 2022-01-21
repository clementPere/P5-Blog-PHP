<?php
namespace App\Controllers;

use App\Models\ArticleManager;


class ArticleController {
    private $articleManager;
    private $view;

    public function __construct(){
        if(isset($url) && count($url) > 1){
                throw new \Exception('Page introuvable');
        }else{
            ob_start();
            $articles = $this->getArticles();
            require_once('src/Views/ArticleView.php');
          
        }
    }

    public function getArticles(){
        $this->articleManager = new ArticleManager;
        $articles = $this->articleManager->getArticles();
        return $articles;
    }
}