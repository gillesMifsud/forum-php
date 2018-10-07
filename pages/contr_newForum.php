<?php

require '../app/Autoloader.php';
App\Autoloader::register();
session_start();

var_dump($_POST);

  /*'nomNewForum' => string 'Jean Claude' (length=11)
  'idCreator' => string '36' (length=2)
  'descriptionNewForum' => string 'Vendamme' (length=8)*/
$user = $_SESSION['auth'];
$nomNewForum = $_POST['nomNewForum'];
$descriptionNewForum = $_POST['descriptionNewForum'];

if(!empty($_POST)) {
    //mise en session des erreurs
    $_SESSION['flash'] = array();

    //test sujet
    if(empty($nomNewForum)){
        $nomNewForum = htmlentities($nomNewForum);
        //renvoi erreur
        $_SESSION['flash']['danger'][] = "Veuillez écrire un nom de forum valide";
    }

    // Test Message
    if(empty($descriptionNewForum)){
        $descriptionNewForum = htmlentities($descriptionNewForum);
        //renvoi erreur
        $_SESSION['flash']['danger'][] = "Veuillez écrire une description de forum valide";
    }

    // si il y a des erreurs on renvoit sur le topic précédant ou la get topic = $topic
    if(!empty($_SESSION['flash'])) {
        header("Location:../public/index.php?p=newForum");
    }

    else {
        $save = App\Table\Forum::saveNewForum($nomNewForum, $descriptionNewForum, $user);
        //lastindertid recup last forum
        $last = App\App::getDb()->lastInsertId();
        $_SESSION['flash']['success'] = "Nouveau Forum enregistré avec succès";
        header("Location:../public/index.php?p=forum&id=$last");
    }

}