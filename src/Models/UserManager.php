<?php

namespace App\Models;

class Usermanager extends User
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



    public function create(string $firstname, string $lastname, string $email, string $password)
    {
        $req = DBManager::getDb()->prepare("INSERT INTO user (firstname, lastname, email, password, is_valid) VALUES ('$firstname', '$lastname', '$email', '$password', 0)");
        $req->execute();
    }
}
