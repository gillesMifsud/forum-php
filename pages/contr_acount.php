<?php
// controller modifications du profil
var_dump($_POST);


require '../app/Autoloader.php';
App\Autoloader::register();
session_start();

if(!empty($_POST)){

 $_SESSION['flash'] = array();

    //nettoyage nom, prenom, adresse, email
    $_POST['newPrenom']  = htmlentities($_POST['newPrenom']);
    $_POST['newName']    = htmlentities($_POST['newName']);
    $_POST['newAdresse'] = htmlentities($_POST['newAdresse']);
    $_POST['newEmail']   = htmlspecialchars($_POST['newEmail']);

    if (!preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#", $_POST['newEmail'])) {
            $_SESSION['flash']['danger'][] = "Invalid Email";
            header('Location:../public/index.php?p=account');
    }


    if(!empty($_POST['newPassword']) && ($_POST['newPassword'] == $_POST['passwordConfirm'])){

        $passOk = \App\Table\User::passwordHash($_POST['newPassword']);

        $newImg = $_POST['newImg'];
        $newPrenom = $_POST['newPrenom'];
        $newName = $_POST['newName'];
        $newEmail = $_POST['newEmail'];
        $newAdresse = $_POST['newAdresse'];
        $newCp = $_POST['newCp'];
        //Recup de ID_USER de la personne qui veut modifier son compte
        $idUserAmodifier = $_SESSION['auth'];

        $updateAll = App\Table\User::updateUser($newImg, $newPrenom, $newName, $newEmail, $newAdresse, $newCp, $passOk, $idUserAmodifier);

        // Renvoi popup de succes (voir template pr affich msg err)
        $_SESSION ['flash']['success'] = "Compte modifié avec succes";
        // Renvoi vers le compte
        header('Location:../public/index.php?p=account');
    }
    else{
        $_SESSION['flash']['danger'][] = "Les mots de passe doivent etre identiques";
        header('Location:../public/index.php?p=account');
    }

} else {
    $_SESSION['flash']['danger'][] = "Veuillez remplir tous les champs";
    header('Location:../public/index.php?p=account');
}
