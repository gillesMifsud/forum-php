<?php


namespace App;


class App{

    const DB_NAME = 'forum_gil';
    const DB_USER = 'root';
    const DB_PASS = '';
    const DB_HOST = 'localhost';


    private static $database;

    private static $title = 'Forum';

    // Function recup connexion bdd
    // App\App\::getDb() pour l'utiliser
    public static function getDb(){
    if ( self::$database === null ){
        self::$database = new Database(self::DB_NAME, self::DB_USER, self::DB_PASS, self::DB_HOST);
    }
    return self::$database;
    }


     public static function getTitle(){
        return self::$title;
    }


    public static function setTitle($title){
        self::$title = $title;
    }


    public static function debug($variable){
        echo '<pre>' . print_r($variable, true) . '</pre>';
    }



}