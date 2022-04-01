<?php

namespace App\Controllers;


class ContactController extends Controller
{

    public function index()
    {
        $this->twig->display("contact/index.html.twig");
    }
}
