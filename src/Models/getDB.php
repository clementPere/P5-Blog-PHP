<?php

namespace App\Models;

use PDO;


abstract class getDB
{
    private static $db;

    //Instancie la connexion à la base de donnée
    private static function setDb()
    {
        self::$db = new PDO('mysql:host=localhost;dbname=blog;charset=utf8', 'root', 'root');
        self::$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
    }

    //Récupére la connexion à la base de donnée
    protected function getDb()
    {
        if (self::$db == null)
            self::setDb();
        return self::$db;
    }
}
