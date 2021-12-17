<?php
namespace App\Controllers;

use App\Models\Article;
use App\Models\ArticleManager;


class HomeController{

    public function index(){
        require_once('src/Views/HomeView.php');
    }
}