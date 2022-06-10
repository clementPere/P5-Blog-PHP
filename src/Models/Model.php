<?php

namespace App\Models;

class Model
{

    //Récupère toutes les données d'une table
    /**
     * @param string $table
     * 
     * @return array
     */
    public static function getAll(string $table): array
    {
        $req = DBManager::getDb()->prepare('SELECT * FROM ' . $table . ' ORDER BY created_at DESC');
        $req->execute();
        return $req->fetchAll();
    }

    //Récupère une ligne dans une table
    /**
     * @param string $table
     * @param string $select
     * @param string $value
     * 
     * @return [type]
     */
    public function getOneBy(string $table, string $select, string $value)
    {
        $req = DBManager::getDb()->prepare('SELECT * FROM ' . $table . ' WHERE ' . $select . ' = ' . $value);
        $req->execute();
        return $req->fetchAll();
    }

    public function delete(string $table, string $select, string $value)
    {
        $req = DBManager::getDb()->prepare('DELETE FROM ' . $table . ' WHERE ' . $select . ' = ' . $value);
        $req->execute();
    }

    public function update()
    {
        $req = DBManager::getDb()->prepare($this->setUpdateRequest());
        $req->execute();
    }


    public function create()
    {
        $req = DBManager::getDb()->prepare($this->setCreateRequest());
        $req->execute();
    }

    public function setCreateRequest()
    {
        $champ = '';
        $data = '';
        foreach ($_POST as $key => $value) {
            $set = 'set' . ucfirst($key);
            $get = 'get' . ucfirst($key);
            $value = htmlspecialchars($value);
            $explode = explode('update', $key);
            $value = str_replace("'", "\'", $value);
            $removeValues = ['created_at', 'id', 'create_post', 'addComment', 'confirm-password', 'register-submit'];
            if (substr($explode[0], 0) and !in_array($key, $removeValues)) {
                if ($key == 'User_id') {
                    $value = $_SESSION['id'];
                }
                $this->$set($value);
                $champ .= $key . ', ';
                $data .= "'" . $this->$get()  . "', ";
            }
        }
        return 'INSERT INTO ' . $this->getClassName() . ' (' . substr($champ, 0, -2) . ") VALUES (" . substr($data, 0, -2) . ")";
    }

    private function setUpdateRequest(): string
    {
        $sql = 'UPDATE ' . $this->getClassName() . ' SET ';
        foreach ($_POST as $key => $value) {
            $set = 'set' . ucfirst($key);
            $get = 'get' . ucfirst($key);
            $value = htmlspecialchars($value);
            $value = str_replace("'", "\'", $value);
            $explode = explode('update', $key);
            if ($key !== 'created_at' and substr($explode[0], 0) and $key !== 'id') {
                $this->$set($value);
                $sql .= $key . "='" . $this->$get() . "', ";
            }
            if ($key == 'id') {
                $id = $value;
            }
        }
        $sql = substr($sql, 0, -2);
        $sql .= "WHERE id = $id";
        return $sql;
    }

    private function getClassName()
    {
        $path = explode('\\', get_class($this));
        return strtolower(end($path));
    }
}
