<?php

namespace App\Controllers;

use App\Models\User;
use App\models\UserManager;
use GuzzleHttp\Psr7\Response;

class AuthController extends Controller
{


    public function index()
    {

        $this->twig->display("login.html.twig");
        //If the user want to connect
        if (isset($_POST['login-submit'])) {
            if (isset($_POST['email']) and isset($_POST['password'])) {
                if ($_POST['email'] != "" and $_POST['password'] != "") {
                    $this->checkCredentials($_POST['email'], $_POST['password']);
                    echo 'Login ou mot de passe non valide !';
                }
            }
        }

        //if the user want to register
        if (isset($_POST['register-submit'])) {
            if (isset($_POST['firstname']) and isset($_POST['lastname']) and isset($_POST['email']) and isset($_POST['password']) and isset($_POST['confirm-password'])) {
                if ($_POST['password'] === $_POST['confirm-password']) {
                    $firstname = htmlspecialchars($_POST['firstname']);
                    $lastname = htmlspecialchars($_POST['lastname']);
                    $email = htmlspecialchars($_POST['email']);
                    $password = htmlspecialchars($_POST['password']);
                    $user = new UserManager;
                    $user->create($firstname, $lastname, $email, $password);
                    header('Location: http://localhost/Formation/OpenClassrooms/P5blog/Blog/login');
                }
            }
        }
    }



    /**
     * @param string $email
     * @param string $password
     * 
     */
    private function checkCredentials(string $email, string $password)
    {
        $email = htmlspecialchars($email);
        $pass = htmlspecialchars($password);
        $user = new UserManager;
        $userCredentials = $user->checkCredentials("$email", "$pass");
        if ($userCredentials) {
            $this->connectUser($userCredentials);
        }
        return false;
    }

    /**
     * @param array $userCredentials
     * 
     */
    private function connectUser(array $userCredentials)
    {
        $_SESSION['email'] = $userCredentials[0]['email'];
        $_SESSION['id'] = $userCredentials[0]['id'];
        header('Location: http://localhost/Formation/OpenClassrooms/P5blog/Blog/');
    }
}