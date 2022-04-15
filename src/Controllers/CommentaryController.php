<?php

namespace App\Controllers;

use App\Models\Commentary;
use App\Models\CommentaryManager;

class CommentaryController extends Controller
{

    public function index()
    {
        if (isset($_POST['addComment'])) {
            $email = $_POST['email'];
            $comment = $_POST['comment'];
            $postId = $_POST['postId'];
            $commentary = new CommentaryManager;
            $commentary->create($email, $comment, $postId);
            var_dump($_POST);
        }
    }
}
