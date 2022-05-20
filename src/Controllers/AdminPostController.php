<?php

namespace App\Controllers;

use App\Models\User;
use App\Models\Post;

class AdminPostController extends Controller
{

    public function index()
    {
        $this->redirectNotConnected();
        if ($_SESSION['role'] != 'admin') {
            $this->twig->display('admin/user/error.html.twig', [
                'BASE_URL' => BASE_URL,
            ]);
        }

        if ($_SESSION['role'] === 'admin') {
            if (!isset($_POST['delete_post']) && !isset($_POST['update_post']) && !isset($_POST['create_post'])) {
                $this->render();
            }
            if (isset($_POST['create_post'])) {
                $this->createPost();
            }
            if (isset($_POST['update_post'])) {
                $this->updatePost();
            }
            if (isset($_POST['delete_post'])) {
                $this->deletePost();
            }
        }
    }

    private function updatePost()
    {
        $post = new Post;
        $post->update();
        $message = "La modification de l'article a bien été prise en compte";
        $this->render(true, $message);
    }

    private function deletePost()
    {
        $post = new Post;
        $post->delete('post', 'id', $_POST['id']);
        $message = 'Article supprimé !';
        $this->render(true, $message);
    }

    private function createPost()
    {
        foreach ($_POST as $value) {
            if (empty($value)) {
                $message = 'Tous les champs sont obligatoires';
                $this->render(false, $message);
                echo '';
                return;
            }
        }
        $post = new Post;
        $post->create();
        $message = "La création de votre article a bien été sauvegardé ! Vous pouvez le modifier à tout moment sur cette même page.";
        $this->render(true, $message);
    }

    private function render($updatePost = false, $message = "")
    {
        $posts = Post::getAll('post');
        $users = User::getAll('user');
        $this->twig->display("admin/post/index.html.twig", [
            'posts' => $posts,
            'users' => $users,
            'update_post' => $updatePost,
            'message' => $message,
        ]);
    }
}
