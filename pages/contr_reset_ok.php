<?php

//($_POST) = $_POST['id'], $_POST['password'] et $_POST['password_confirm']

if(!empty($_POST['password']) && ($_POST['password'] == $_POST['password_confirm'])){

    $idUser = $_POST['id'];

    require '../app/Autoloader.php';
    App\Autoloader::register();

    $passHash = \App\Table\User::passwordHash($_POST['password']);

    $updatedPass = \App\Table\User::updatePass($passHash, $idUser);

    session_start();
    $_SESSION['flash']['success'] = "Modification de mot de passe effectuée avec sucès";

    header('Location:../public/index.php?p=login');
    exit();



} else {
    session_start();
    $_SESSION['flash']['danger'] = " Erreur lors de l'enregistrement";
    header('Location:index.php?p=login');
    exit();
}

