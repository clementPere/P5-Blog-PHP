<?php

namespace App\Controllers;

use App\Models\Commentary;
use App\Models\CommentaryManager;

class CommentaryController extends Controller
{

    public function index()
    {

        if (isset($_POST['addComment'])) {
            $commentary = new Commentary;
            $commentary->create();
            return $this->twig->display("post/newCommentary.html.twig");
        }
    }
}
