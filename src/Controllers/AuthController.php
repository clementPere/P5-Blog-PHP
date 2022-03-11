<?php

namespace App\Controllers;

use App\Models\User;
use App\models\UserManager;
use GuzzleHttp\Psr7\Response;

class AuthController extends Controller
{



    public function index()
    {

        // $this->logout();

        $this->isConnected();
        // var_dump($_GET['url']);

        //If the user want to connect
        if (isset($_POST['login-submit'])) {
            if (isset($_POST['email']) and isset($_POST['password'])) {
                if ($_POST['email'] != "" and $_POST['password'] != "") {
                    $email = htmlspecialchars($_POST['email']);
                    $pass = htmlspecialchars($_POST['password']);
                    $user = new UserManager;
                    $userCredentials = $user->checkCredentials("$email", "$pass");
                    if (!$userCredentials) {
                        echo 'Login ou mot de passe non valide !';
                    }
                    if ($userCredentials) {
                        $_SESSION['email'] = $userCredentials[0]['email'];
                        $_SESSION['id'] = $userCredentials[0]['id'];

                        // return new Response(200, [], $this->twig->display('home/index.html.twig'));
                        // $this->twig->display('home/index.html.twig');
                        // $this->router->get('/', "Home->index");
                        // header('Location: http://localhost/P5/Blog/');
                    }
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
                    echo 'Vous avez bien créer votre compte vous pouvez maintenant vous connecter !!!!';
                }
            }
        }
    }
}
