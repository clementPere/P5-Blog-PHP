<?php

namespace App\Controllers;

use App\Models\Post;


class PostController extends Controller
{

    public function index()
    {
        var_dump("Bonjour " . $_SESSION['email']);
        $this->redirectNotConnected();
        $post = Post::getAll('post');

        $this->twig->display("post/index.html.twig", [
            'post' => $post
        ]);
    }
}
