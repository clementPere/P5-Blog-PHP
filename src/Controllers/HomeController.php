<?php

namespace App\Controllers;

class HomeController extends Controller
{

    public function index(): void
    {
        if (!isset($_POST['contact-submit'])) {
            $this->render();
            return;
        }
        $this->sendEmail($_POST);
        $this->render(true, 'Nous avons bien reçu votre demande');
        return;
    }

    private function render($contactSend = false, $message = "")
    {
        $this->twig->display("home/index.html.twig", [
            'contactSend' => $contactSend,
            'message' => $message,
        ]);
    }

    private function sendEmail($value)
    {
        $user = htmlspecialchars($value['email']);
        $reason = 'L\'utilisateur ' . $user . ' vous contacte pour ' . strtolower(htmlspecialchars($value['reason']));
        $content = htmlspecialchars($value['content']);

        mail('clement.pere.dev@gmail.com', $reason, $content);
    }
}
