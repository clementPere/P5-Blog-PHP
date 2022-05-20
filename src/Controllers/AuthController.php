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

                    if ($this->checkAlreadyExist($email)) {
                        $this->render(false, "cet email est déjà utilisé. merci d'en saisir un nouveau");
                    } else {
                        $user = new User;
                        $user->create($firstname, $lastname, $email, $password);
                        return $this->render(true, "Votre Compte à bien été ajouté");
                    }
                }
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
        echo '<script language="Javascript"> document.location.replace("../Blog"); </script>';
    }
}
