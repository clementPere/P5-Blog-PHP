<?php

namespace App\Controllers;

class HomeController extends Controller
{

    public function index()
    {

        if (isset($_SESSION['email'])) {
            $userData = ['email' => $_SESSION['email']];
        }
        $this->twig->display("home/index.html.twig", [
            'data' => $userData
        ]);
    }
}
