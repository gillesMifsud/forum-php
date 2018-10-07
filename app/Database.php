<?php

namespace App;

use \PDO;

//Connexion a la Base de donnees
class Database
{

    private $db_name;
    private $db_user;
    private $db_pass;
    private $db_host;
    private $pdo;


    public function __construct($db_name, $db_user = 'root', $db_pass = 'root', $db_host = 'localhost')
    {
        $this->db_name = $db_name;
        $this->db_user = $db_user;
        $this->db_pass = $db_pass;
        $this->db_host = $db_host;
    }

    // Recup du PDO //
    private function getPDO(){
        if($this->pdo === NULL){
            $pdo = new PDO('mysql:dbname=forum_gil;host=localhost', 'root', '');
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // SET UTF8 pour les connexions a la bdd //
            $pdo->exec('SET CHARACTER SET utf8');
            $this->pdo = $pdo;
        }
        return $this->pdo;
    }


    // SUPER QUERY GENERATOR // A FINIR

    /*public function query($statement, $fetchMode = PDO::FETCH_CLASS , $class_name, $fetchAll = false){

        $req = $this->getPDO()->query($statement);
        $req->setFetchMode($fetchMode, $class_name);

        if($fetchAll) { $data = $req->fetch(); }

        else { $data = $req->fetchAll(); }

        return $data;

    }*/




    // Requetes
    public function queryAll($statement, $class_name){

        $req = $this->getPDO()->query($statement);
        $req->setFetchMode(PDO::FETCH_CLASS, $class_name);
        $datas = $req->fetchAll(PDO::FETCH_CLASS, $class_name);
        return  $datas;
    }

    public function queryOne($statement, $class_name){

        $req = $this->getPDO()->query($statement);
        $req->setFetchMode(PDO::FETCH_CLASS, $class_name);
        $data = $req->fetch();
        return $data;
    }


    public function insert($statement, $attributes){

        $req = $this->getPDO()->prepare($statement);

        if(is_array($attributes)){
            $req->execute($attributes);
        }
        else $req->execute(array($attributes));

        return true;
    }



    public function update($statement, $attributes)
    {

        $req = $this->getPDO()->prepare($statement);

        if (is_array($attributes)) {
            $req->execute($attributes);
        } else $req->execute(array($attributes));

        return $req;

    }


    public function prepare($statement, $attributes, $class_name, $one){

        $req = $this->getPDO()->prepare($statement);

        if(is_array($attributes)){
            $req->execute($attributes);
        }
        else $req->execute(array($attributes));

        $req->setFetchMode(PDO::FETCH_CLASS, $class_name);

        if($one)
        {
           $datas = $req->fetch();
        }
        else
        {
           $datas = $req->fetchAll();
        }

        return $datas;
    }


    public function lastInsertId(){
        return $this->getPDO()->lastInsertId();
    }


    public function queryCount($statement){

        $req = $this->getPDO()->query($statement);
        $data = $req->fetchColumn();
        return $data;
    }

}