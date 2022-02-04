<?php

namespace App\Models;

class Model
{

    //Récupère toutes les données d'une table
    public static function getAll(string $table): array
    {
        $req = DBManager::getDb()->prepare('SELECT * FROM ' . $table . ' ORDER BY id ASC');
        $req->execute();
        return $req->fetchAll();
    }

    //Récupère une ligne dans une table
    public function getOneBy(string $table, string $select, string $value)
    {
        $req = DBManager::getDb()->prepare('SELECT * FROM ' . $table . ' WHERE ' . $select . ' = ' . $value);
        $req->execute();
        return $req->fetchAll();
    }
}
