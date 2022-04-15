<?php

namespace App\Models;

use PDO;


abstract class DBManager
{
    private static $db;

    //Instancie la connexion à la base de donnée
    static function setDb()
    {
        self::$db = new PDO('mysql:host=localhost;dbname=blog;charset=utf8', 'root', 'root', array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
        self::$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
    }

    //Récupére la connexion à la base de donnée
    static function getDb()
    {
        if (self::$db == null)
            self::setDb();
        return self::$db;
    }
}
