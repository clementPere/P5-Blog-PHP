<?php

namespace App\Models;

class UserManager extends User
{

    /**
     * @param string $valueUsername
     * @param string $valuePassword
     * 
     * @return array
     */
    public function checkCredentials(string $valueUsername, string $valuePassword): array
    {
        $req = DBManager::getDb()->prepare("SELECT * FROM user WHERE email = '$valueUsername' AND password = '$valuePassword'");
        $req->execute();
        return $req->fetchAll();
    }
}
