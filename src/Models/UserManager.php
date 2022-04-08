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



    /**
     * @param string $firstname
     * @param string $lastname
     * @param string $email
     * @param string $password
     * 
     */
    public function create(string $firstname, string $lastname, string $email, string $password)
    {
        $req = DBManager::getDb()->prepare("INSERT INTO user (firstname, lastname, email, password, is_valid) VALUES ('$firstname', '$lastname', '$email', '$password', 0)");
        $req->execute();
    }

    public function exist($email)
    {
        $req = DBManager::getDb()->prepare("SELECT * FROM user WHERE email = '$email'");
        $req->execute();
    }


    /**
     * @param string $firstname
     * @param string $lastname
     * @param string $email
     * @param string $password
     * @param string $role
     * @param bool $is_valid
     * 
     */
    // public function update(string $firstname, string $lastname, string $email, string $password, string $role, int $is_valid, $id)
    // {
    //     $req = DBManager::getDb()->prepare(
    //         "UPDATE user 
    //         SET firstname = '$firstname', lastname = '$lastname', email = '$email', `password` = '$password', `role` = '$role', is_valid = '$is_valid'
    //         WHERE id = $id"
    //     );
    //     $req->execute();
    // }
}
