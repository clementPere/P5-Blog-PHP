<?php

namespace App\Controllers;

use App\Models\User;
use App\models\UserManager;

class AuthController extends Controller
{


    public function index()
    {
        if (!isset($_POST['login-submit']) && !isset($_POST['register-submit'])) {
            $this->render();
        }

        if (isset($_POST['login-submit'])) {
            $this->login();
        }

        if (isset($_POST['register-submit'])) {
            $this->register();
        }
    }

    private function login()
    {
        //If the user want to connect
        if (isset($_POST['email']) and isset($_POST['password'])) {
            if ($_POST['email'] != "" and $_POST['password'] != "") {
                $this->isValidUser();
                return $this->render(false, $this->isValidUser());
            }
        }
    }

    private function register()
    {
        //if the user want to register

        if (isset($_POST['firstname']) and isset($_POST['lastname']) and isset($_POST['email']) and isset($_POST['password']) and isset($_POST['confirm-password'])) {
            if ($_POST['password'] === $_POST['confirm-password']) {
                $firstname = htmlspecialchars($_POST['firstname']);
                $lastname = htmlspecialchars($_POST['lastname']);
                $email = htmlspecialchars($_POST['email']);
                $password = htmlspecialchars($_POST['password']);

                if ($this->checkAlreadyExist($email)) {
                    $this->render(false, "cet email est déjà utilisé. merci d'en saisir un nouveau");
                    return;
                }
                $user = new User;
                $user->create($firstname, $lastname, $email, $password);
                return $this->render(true, "Votre compte à bien été ajouté");
            }
        }
    }


    private function checkAlreadyExist($email)
    {
        $user = new UserManager;
        if ($user->alreadyInUse($email)) {
            return true;
        }
        return false;
    }

    /**
     * @param string $email
     * @param string $password
     * 
     */
    private function isValidUser()
    {
        $email = htmlspecialchars($_POST['email']);
        $pass = htmlspecialchars($_POST['password']);
        $user = new UserManager;
        $userCredentials = $user->checkCredentials("$email", "$pass");
        if ($userCredentials) {
            if ($userCredentials[0]['is_valid'] == 1) {
                $this->connectUser($userCredentials);
            }
            return 'Votre compte est bien enregistré mais pas encore validé par notre équipe merci de patienter';
        }
        return 'Login ou mot de passe incorrect';
    }

    private function render($newUser = false, $message = "")
    {
        $this->twig->display("auth/login.html.twig", [
            'newUser' => $newUser,
            'message' => $message,
        ]);
    }

    /**
     * @param array $userCredentials
     * 
     */
    private function connectUser(array $userCredentials)
    {
        $_SESSION['email'] = $userCredentials[0]['email'];
        $_SESSION['id'] = $userCredentials[0]['id'];
        $_SESSION['role'] = $userCredentials[0]['role'];
        $_SESSION['is_valid'] = $userCredentials[0]['is_valid'];
        $_SESSION['firstname'] = $userCredentials[0]['firstname'];
        $_SESSION['lastname'] = $userCredentials[0]['lastname'];
        echo '<script language="Javascript"> document.location.replace("../Blog"); </script>';
    }
}
