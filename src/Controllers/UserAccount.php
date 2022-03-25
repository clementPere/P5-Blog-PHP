<?php

namespace App\Controllers;

use App\Models\User;


class UserAccount extends Controller
{

    public function index()
    {
        $this->redirectNotConnected();

        $user = new User;
        $user = $user->getOneBy('user', 'id', $_SESSION['id']);
    }
}
