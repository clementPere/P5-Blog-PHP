<?php

namespace App\Controllers;


class CommentaryController extends Controller
{

    public function index()
    {
        if (isset($_POST['addComment'])) {
            var_dump($_POST);
        }
    }
}
