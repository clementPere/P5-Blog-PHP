<?php
namespace App\Controllers;

use App\Models\ArticleManager;

class ArticlesController {
    private $articleManager;
    private $view;

    public function __construct(){
        if(isset($url) && count($url) > 1){
                throw new Exception('Page introuvable');
        }else{
            echo 'Bonsoir';
            $this->articleManager = new ArticleManager;
            $articles = $this->articleManager->getArticles();
            require_once('src/Views/ArticlesView.php');
            $this->articles();
        }
    }

    private function articles(){
        $this->articleManager = new ArticleManager;
        $articles = $this->articleManager->getArticles();
    }
}