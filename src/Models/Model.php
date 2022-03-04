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
        $req = DBManager::getDb()->prepare('SELECT * FROM ' . $table . ' ORDER BY id ASC');
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
}
