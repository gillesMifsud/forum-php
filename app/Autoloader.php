<?php
namespace App;

class Autoloader{

    /*Enregister notre autoloader*/

    static function register(){

        spl_autoload_register(array(__CLASS__, 'autoloading')); /*__CLASS__ = constante contenant la class courante */
    }


    /*
     * Inclue le fichier correspondant à notre classe
     * $class = nom de la classe à charger
    */

    static function autoloading($class){
        if (strpos($class, __NAMESPACE__ . '\\') === 0){
            $class = str_replace(__NAMESPACE__ . '\\', '', $class);
            $class = str_replace('\\', '/', $class);
            require __DIR__ . '/' . $class . '.php'; /*__DIR__ = constante contenant nom du dossier parent */
        }
    }
}


