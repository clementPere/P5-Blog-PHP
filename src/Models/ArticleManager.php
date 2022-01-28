<?php

namespace App\Models;

use App\Models\Article;

class ArticleManager extends Model
{


    public function getArticles(): array
    {
        $article = new Article();
        return $this->getAll('articles');
    }
}
