<?php

namespace App\Controllers;

use App\Controllers\Controller;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $this->redirectNotConnected();


        $user = new User;
        $user = $user->getOneBy('user', 'id', $_SESSION['id']);
        if ($user[0]['role'] !== 'admin') {
            $this->twig->display('admin/user/error.html.twig', [
                'BASE_URL' => BASE_URL,
            ]);
        }



        if ($user[0]['role'] === 'admin') {
            if (!isset($_POST['delete_form']) && !isset($_POST['update_form'])) {
                $this->render();
            }
            if (isset($_POST['update_form'])) {
                $this->updateUser();
            }
            if (isset($_POST['delete_form'])) {
                $this->delete();
            }
        }
    }

    //Cette fonction est appelé directement depuis le index.php
    public function updateUser()
    {
        if (isset($_POST['update_form'])) {
            $user = new User;
            $user->update();
            $this->render(true);
        }
    }

    private function delete()
    {
        $user = new User;
        $user->delete('user', 'id', $_POST['id']);
        $this->render(true);
    }

    /**
     * @param bool $updateUser
     * 
     */
    private function render($updateUser = false)
    {
        $users = User::getAll('user');
        $this->twig->display('admin/user/index.html.twig', [
            'BASE_URL' => BASE_URL,
            'users' => $users,
            'update_user' => $updateUser
        ]);
    }
}
