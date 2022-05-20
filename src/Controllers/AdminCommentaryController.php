<?php

namespace App\Controllers;

use App\Models\Commentary;

class AdminCommentaryController extends Controller
{
    public function index()
    {
        $this->redirectNotConnected();
        if ($_SESSION['role'] != 'admin') {
            $this->twig->display('admin/user/error.html.twig', [
                'BASE_URL' => BASE_URL,
            ]);
        }

        $this->redirect();
    }

    private function redirect()
    {
        if ($_SESSION['role'] === 'admin') {
            if (!isset($_POST['delete_comment']) && !isset($_POST['update_comment']) && !isset($_POST['create_comment'])) {
                $this->render();
            }
            if (isset($_POST['update_comment'])) {
                $this->updateComment();
            }
            if (isset($_POST['delete_comment'])) {
                $this->deleteComment();
            }
        }
    }

    private function updateComment()
    {
        $comment = new Commentary;
        $comment->update();
        $message = "La modification de l'article a bien été prise en compte";
        $this->render(true, $message);
    }

    private function deleteComment()
    {
        $comment = new Commentary;
        $comment->delete('commentary', 'id', $_POST['id']);
        $this->render(true, 'Commentaire supprimé !');
    }



    private function render($updateComment = false, $message = "")
    {
        $comments = Commentary::getAll('commentary');
        $this->twig->display("admin/commentary/index.html.twig", [
            'comments' => $comments,
            'update_comment' => $updateComment,
            'message' => $message,
        ]);
    }
}
