<?php

namespace App\Models;

class CommentaryManager extends Commentary
{

    public function create(string $author, string $content, string $postId)
    {

        $postUserId = $this->getPostUserId($postId);
        $req = DBManager::getDb()->prepare("INSERT INTO commentary (`author`, `content`, `is_valid`, `post_id`, `post_User_id`) VALUES ('$author', '$content', '0', '$postId', '$postUserId')");
        $req->execute();
    }

    public function getPostUserId($postId)
    {
        $req = DBManager::getDb()->prepare("SELECT * FROM post WHERE id = $postId");
        $req->execute();
        $value = $req->fetch();
        return $value['User_id'];
    }

    public function updateComment(string $author, string $content, int $is_valid, int $id)
    {
        $req = DBManager::getDb()->prepare(
            "UPDATE commentary 
            SET author = :author, content = :content, is_valid = :is_valid
            WHERE id = :id"
        );
        $req->bindParam(":author", $author);
        $req->bindParam(":content", $content);
        $req->bindParam(":is_valid", $is_valid);
        $req->bindParam(":id", $id);
        $req->execute();
    }
}
