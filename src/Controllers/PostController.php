<?php

namespace App\Controllers;

use App\Models\Commentary;
use App\Models\Post;
use App\Models\PostManager;

class PostController extends Controller
{

    public function index()
    {


        $posts = Post::getAll('post');
        $comments = Commentary::getAll('commentary');
        $detail = false;

        if (stripos($_SERVER['REQUEST_URI'], '?')) {
            $id = explode('post=', $_SERVER['REQUEST_URI']);
            $posts = new Post;
            $posts = $posts->getOneBy('post', 'id', $id[1]);
            if ($posts) {
                $detail = true;
            }
        }
        $this->render($posts, $comments, $detail);
    }

    private function render($posts, $comments, $detail = false)
    {
        $this->twig->display("post/index.html.twig", [
            'posts' => $posts,
            'comments' => $comments,
            'detail' => $detail
        ]);
    }
}
