<?php
namespace App\Controllers;

use App\Models\ArticleManager;

class ArticleController {
    private $articleManager;
    private $view;

    public function __construct(){
        if(isset($url) && count($url) > 1){
                throw new Exception('Page introuvable');
        }else{
            
            $this->articleManager = new ArticleManager;
            $articles = $this->articleManager->getArticles();
            require_once('src/Views/ArticleView.php');
            $this->index();
        }
    }

    public function index(){
        $this->articleManager = new ArticleManager;
        $articles = $this->articleManager->getArticles();
    }
}