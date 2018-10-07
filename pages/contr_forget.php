<?php
// controller modifications du profil
//var_dump($_POST);


require '../app/Autoloader.php';
App\Autoloader::register();
session_start();

if(!empty($_POST) && (!empty($_POST['email']))){
    // Verifie si l'email esxiste dans la base et renvoie aussi ID_USER
    $checkEmail = \App\Table\User::emailCheck($_POST['email']);


    if($checkEmail) {
        // Generation d'un token
        $emailToken = App\Table\User::strRandom(60);
        // Set RESET_PASS pour l'ID_USER de EMAIL
        $resetToken = App\Table\User::resetEmail($emailToken,$checkEmail->ID_USER);
        var_dump($resetToken);
        $_SESSION['flash']['success'] = 'Email de réinitialisation de mot de passe envoyé';
        mail($_POST['email'], 'Oubli de mot de passe -  Forum Gil' , "Pour réinitialiser votre mot de passe cliquez ici: http://localhost/forum/public/index.php?p=reset&id=".$checkEmail->ID_USER."&token=$emailToken");
        header('Location:../public/index.php?p=login');
    }
} else {
    $_SESSION['flash']['danger'] = "Cet email n'existe pas";
    header('Location:../public/index.php?p=forget');
}