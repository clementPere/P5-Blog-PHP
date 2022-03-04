<?php

namespace App\Controllers;

use App\Models\Post;


class PostController extends Controller
{

    public function index()
    {
        // $this->getVue('Article', $article->getOneBy('category', 'id', '2'));

        $post = Post::getAll('post');

        $this->twig->display("post/index.html.twig", [
            'post' => $post
        ]);
        // $this->getVue('Article', $this->article->getOneBy('category', '1'));
    }
}
