<?php

namespace App\Controllers;

use App\Models\ArticleManager;


class ArticleController
{
    private $articleManager;

    public function __construct()
    {
        if (isset($url) && count($url) > 1) {
            throw new \Exception('Page introuvable');
        } else {
            $this->index();
        }
    }

    public function index()
    {
        ob_start();
        $articles = $this->getArticles();
        require_once('src/Views/ArticleView.php');
    }

    public function getArticles(): array
    {
        $this->articleManager = new ArticleManager;
        return $articles = $this->articleManager->getArticles();
    }
}
