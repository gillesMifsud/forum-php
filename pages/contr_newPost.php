<?php

require '../app/Autoloader.php';
App\Autoloader::register();
session_start();

var_dump($_POST);
var_dump($_SESSION['auth']);

$user = $_SESSION['auth'];
$topic = $_POST['idTopic'];
$subjectNewPost = $_POST['subjectNewPost'];
$messageNewPost = $_POST['messageNewPost'];

if(!empty($_POST)) {
    //mise en session des erreurs
    $_SESSION['flash'] = array();

    //test sujet
    if(empty($subjectNewPost)){
        $subjectNewPost = htmlentities($subjectNewPost);
        //renvoi erreur
        $_SESSION['flash']['danger'][] = "Veuillez écrire un sujet valide";
    }

    // Test Message
    if(empty($messageNewPost)){
        $messageNewPost = htmlentities($messageNewPost);
        //renvoi erreur
        $_SESSION['flash']['danger'][] = "Veuillez écrire un message valide";
    }

    // si il y a des erreurs on renvoit sur le topic précédant ou la get topic = $topic
    if(!empty($_SESSION['flash'])) {
        header("Location:../public/index.php?p=topic&id=$topic");
    }

    else {
        $save = App\Table\Post::saveNewPost($topic, $user, $subjectNewPost, $messageNewPost);
        $_SESSION['flash']['success'] = "Post enregistré avec succès";
        header("Location:../public/index.php?p=topic&id=$topic");
    }

}