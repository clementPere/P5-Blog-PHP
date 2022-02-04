<?php

namespace App\Controllers;

use App\Models\Article;


class ArticleController extends Controller
{

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
        $article = new Article;

        $this->getVue('Article', $article->getOneBy('category', 'id', '2'));
        $this->getVue('Articles', Article::getAll('articles'));

        // $this->getVue('Article', $this->article->getOneBy('category', '1'));
    }
}
