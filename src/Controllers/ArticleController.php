<?php

namespace App\Controllers;

use App\Models\Article;


class ArticleController extends Controller
{

    public function index()
    {
        $article = new Article;

        // $this->getVue('Article', $article->getOneBy('category', 'id', '2'));

        $articles = Article::getAll('articles');

        $this->twig->display("article/index.html.twig", [
            'articles' => $articles
        ]);
        // $this->getVue('Article', $this->article->getOneBy('category', '1'));
    }
}
