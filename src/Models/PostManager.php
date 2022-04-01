<?php

namespace App\Models;

use DateTime;

class PostManager extends Post
{

    public function create(string $author, string $content, string $header, string $title, int $userId)
    {
        $req = DBManager::getDb()->prepare("INSERT INTO post (`author`, `content`, `header`, `title`, `User_id`) VALUES ('$author', '$content', '$header', '$title', '$userId')");
        $req->execute();
    }


    public function update(string $title, string $content, string $header, string $author, string $user_id, $id)
    {
        $date = new DateTime('now');
        $date = $date->format('Y-m-d H:i:s');

        $req = DBManager::getDb()->prepare(
            "UPDATE post 
            SET title = '$title', content = '$content', header = '$header', `author` = '$author', `user_id` = '$user_id', `updated_at` = '$date'
            WHERE id = $id"
        );
        $req->execute();
    }
}
