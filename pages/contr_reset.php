<?php
// Controller de la modif du mdp

if(isset($_GET['id']) && isset($_GET['token'])){


    // Verif si les $_GET ID_USER & RESET TOKEN existent dans la base
    $verify = App\Table\User::verifyTokenPass($_GET['id'], $_GET['token']);

        $_SESSION['verify'] = $verify->ID_USER;
        header('Location:../public/index.php?p=reset');

} else {
    $_SESSION['flash']['danger'] = "Ce token n'existe pas";
    header('Location:index.php?p=login');
    exit();
}

