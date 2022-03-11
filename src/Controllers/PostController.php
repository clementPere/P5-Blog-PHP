<?php

namespace App\Controllers;

use App\Models\Post;


class PostController extends Controller
{

    public function index()
    {
        var_dump("Bonjour " . $_SESSION['email']);
        if (!$this->isConnected()) {
            header('Location: http://localhost/Formation/OpenClassrooms/P5blog/Blog/login');
        }

        // $this->getVue('Article', $article->getOneBy('category', 'id', '2'));

        $post = Post::getAll('post');

        $this->twig->display("post/index.html.twig", [
            'post' => $post
        ]);
        // $this->getVue('Article', $this->article->getOneBy('category', '1'));
    }
}
