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


        $this->setValue();



        if ($this->checkIfExist()) {
            // var_dump(serialize($this));
            // var_dump($this->getClassName());

            // $req = DBManager::getDb()->prepare('SELECT * FROM ' . $this->getClassName() . ' WHERE id = ' . $this->getId());
            // $req = DBManager::getDb()->prepare('UPDATE ' . $this->getClassName() . ' SET ' . $this . ' WHERE id = ' . $this->getId());
            // $req->execute();
            // var_dump($req->fetchAll());
            // return $req->fetchAll();
            // var_dump(serialize($object));

            // $req = DBManager::getDb()->prepare('UPDATE' . $entity . ' SET ' .  . ' WHERE id = ' . $object->getId());
        }
        // var_dump('key : ' . $key . ' value: ' . $value . '<br>');
    }

    private function setValue()
    {
        foreach ($_POST as $key => $value) {
            $set = 'set' . ucfirst($key);
            $get = 'get' . ucfirst($key);
            $value = htmlspecialchars($value);
            $explode = explode('update', $key);
            if ($key !== 'created_at' and substr($explode[0], 0)) {
                $this->$set($value);
                var_dump($this->$get());
            }
        }
    }

    private function getClassName()
    {
        $path = explode('\\', get_class($this));
        return strtolower(end($path));
    }

    private function checkIfExist()
    {
        if ($this->getOneBy($this->getClassName(), 'id', $this->getId())) {
            return true;
        }
        return false;
    }
}
