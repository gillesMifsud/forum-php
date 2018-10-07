<?php

require '../app/Autoloader.php';
App\Autoloader::register();
session_start();

if(!empty($_POST)){

    $_SESSION['flash'] = array();


    //test username
    if(empty($_POST['username']) || !preg_match('/^[a-zA-Z0-9_]+$/', $_POST['username'])){

        $_SESSION['flash']['danger'][] = "Invalid username";
    } else {
        $check = App\Table\User::exist($_POST['username']);
        if($check){

            $_SESSION['flash']['danger'][] = "Username déjà pris";
        }
    }


    if (isset($_POST['email'])) {
        // On rend inoffensives les balises HTML que le visiteur a pu rentrer
        $_POST['email'] = htmlspecialchars($_POST['email']);

        if (!preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#", $_POST['email'])) {
            $_SESSION['flash']['danger'][] = "Invalid Email";
        }
    } else {
        $check = App\Table\User::exist($_POST['email']);
        if($check){

            $_SESSION['flash']['danger'][] = "Email déjà pris";
        }
    }

    if(empty($_POST['password']) || $_POST['password'] != $_POST['password_confirm']){

        $_SESSION['flash']['danger'][] = "Invalid password";
    }




    if(!empty($_SESSION['flash'])){

        header('Location:../public/index.php?p=register');

        } else {
        // Hashage du password
        $passHash = App\Table\User::passwordHash($_POST['password']);
        // Generation du token
        $token = App\Table\User::strRandom(60);
        // Enregistrement dans la bdd
        $profile = App\Table\User::insertUser($_POST['username'] ,  $passHash , $_POST['email'], $token);
        // Recup Last DB Record
        $user_id = App\Table\User::getLast();
        // Generation du mail de confirmation
        mail($_POST['email'], 'Confirmation du compte Forum Gil' , "Pour valider le compte cliquez ici: http://localhost/forum/public/confirm.php?id=".$user_id."&token=$token");
        // Renvoi popup de succes (voir template pr affich msg err)
        $_SESSION ['flash']['success'] = "Un Email de confirmation vous a été envoyé afin de valider votre compte";
        // Renvoi vers le login
        header('location:../public/index.php?p=login');
        exit();
    }

}
