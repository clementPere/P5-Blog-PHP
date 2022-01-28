<?php

namespace App\Controllers;

use App\Models\Article;
use App\Models\ArticleManager;


class ArticleController extends Controller
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
        $this->getVue('Article', $this->getArticles());
    }

    public function getArticles(): array
    {
        $article = new Article;
        return $article->getArticles();
    }
}
