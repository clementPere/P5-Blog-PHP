<?php
namespace App\Models;

use PDO;

abstract class Model {
    private static $db;

    //Instancie la connexion à la base de donnée
    private static function setDb(){
        self::$db = new PDO('mysql:host=localhost;dbname=blog;charset=utf8','root','root');
        self::$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
    }

    //Récupére la connexion à la base de donnée
    protected function getDb(){
        if(self::$db == null)
            self::setDb();
            return self::$db;
    }

    protected function getAll($table, $obj){
        $var = [];
        $req = $this->getDb()->prepare('SELECT * FROM ' .$table. ' ORDER BY id ASC');
        $req->execute();
        
        while($data = $req->fetch(PDO::FETCH_ASSOC)){
            var_dump($data);
            $obj = new $obj;
            $var[] = $obj->hydrate($data);
        }
        return $var;
        $req->closeCursor();
    }

    // public function getAll($table){
    //     $req = $this->getDb()->prepare('SELECT * FROM ' .$table. ' ORDER BY id ASC');
        
    //     $req->execute();
    //     return $req->fetchAll();    
    // }


}