<?php

namespace App\Table;

use App\App;

class Forum
{
    /*private $_id;
     private $nom_forum;
     private $date_forum;
     private $description_forum;*/

    public function __get($key){

       $method = 'get' . ucfirst($key);

       $this->$key = $this->$method();

       return $this->$key;
    }


    public static function saveNewForum($nom, $description, $idUser){
        return App::getDb()->insert('
                INSERT INTO forum (NOM_FORUM, DESCRIPTION_FORUM, ID_USER)
                VALUES (? , ? , ?)',
            array($nom, $description, $idUser), __CLASS__, true);
    }


    public static function getAllForum(){

        return App::getDb()->queryAll("
            SELECT DATE_FORUM, NOM_FORUM, DESCRIPTION_FORUM, ID_FORUM, NOM_FORUM, ID_USER
            FROM forum ORDER BY DATE_FORUM", __CLASS__ );

    }



    public static function getUrlForum($id){

        return 'index.php?p=forum&id='.$id ;

    }


}