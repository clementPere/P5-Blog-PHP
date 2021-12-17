<?php
namespace App\Models;
use App\Models\Article;

class ArticleManager extends Model{
    

    public function getArticles(){
        $article = new Article();
        return $this->getAll('articles', $article);
    }
    
}