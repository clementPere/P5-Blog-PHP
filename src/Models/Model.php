<?php

namespace App\Models;

class Model extends getDB
{

    //Récupère toutes les données d'une table
    public function getAll(string $table): array
    {
        $req = $this->getDb()->prepare('SELECT * FROM ' . $table . ' ORDER BY id ASC');
        $req->execute();
        return $req->fetchAll();
    }
}
