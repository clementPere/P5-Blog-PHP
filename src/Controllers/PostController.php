<?php

namespace App\Controllers;

use App\Models\Commentary;
use App\Models\Post;


class PostController extends Controller
{

    public function index()
    {
        $posts = Post::getAll('post');
        $comments = Commentary::getAll('commentary');
        $this->twig->display("post/index.html.twig", [
            'posts' => $posts,
            'comments' => $comments
        ]);
    }
}
