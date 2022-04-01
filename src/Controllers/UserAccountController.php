<?php

namespace App\Controllers;

use App\Models\User;


class UserAccountController extends Controller
{

    public function index()
    {
        $this->redirectNotConnected();

        $user = new User;
        $user = $user->getOneBy('user', 'id', $_SESSION['id']);
        $this->twig->display("userAccount/index.html.twig", [
            'user' => $user
        ]);
    }
}
