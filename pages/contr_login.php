<?php
require 'functions.php';
require '../app/Autoloader.php';
App\Autoloader::register();

// Verifier si il existe un cookie
if(isset($_COOKIE['remember'])){
    //affectation a une variable du cookie de session
    $remember_token = $_COOKIE['remember'];
    //explode par == pour recuperer la premiere partie ID_USER du setcookie cours
    //voir plus bas lors de la creation du setcookie
    $parts = explode('==', $remember_token);
    //affectation de la premiere partie explosee a une variable
    $user_id = $parts[0];
    //recup de l'user correspondant dans la base
    $user = App\Table\User::getUser($user_id);
    //si il y a un user
    if($user){
        //on regenere un remember token du setcookie(voir plus bas setcookie)
        //mais cette fois ci avec les infos recuperees plus haut
        $expected = $user_id . '==' . $user->remember_token . sha1($_SESSION['auth'].'chucknorris');
        if($expected == $remember_token){
            session_start();
            // Pass en session ID_USER
            $_SESSION['auth'] = $checkUser->ID_USER;
            // Puis redirection vers le compte en tant que connecté
            header('Location:../public/index.php?p=account');
        }
    }
}


if(!empty($_POST['username']) && !empty($_POST['password']) && !empty($_POST)) {
    // Recupere ID_USER, USERNAME, PASSWORD, EMAIL (USERNAME = :USERNAME OR EMAIL = :USERNAME)
    $checkUser = App\Table\User::loginCheck(['USERNAME' => $_POST['username']]);

    // Fonction de PHP verifie SI password crypté POST = password from BDD
    if(password_verify($_POST['password'], $checkUser->PASSWORD)){
        session_start();
        // Pass en session ID_USER
        $_SESSION['auth'] = $checkUser->ID_USER;
        $_SESSION['flash']['success'] = 'Connexion réussie';

        // Si il a coché se souvenir de moi creation d'un cookie
        if($_POST['remember']){
            // Creation du token en Chaine aleatoire
            $rememberToken = App\Table\User::strRandom(250);
            // Entrée du token dans la base
            App\Table\User::rememberMe($rememberToken, $_SESSION['auth'] );
            // Creation cu cookie, nom, parametres, duree
            setcookie('remember', $_SESSION['auth'] . '==' . $rememberToken . sha1($_SESSION['auth'].'chucknorris'), time()+60*60*24*7, "/");
        }
        // Puis redirection vers le compte en tant que connecté
        header('Location:../public/index.php?p=account');

    } else {
        $_SESSION['flash']['danger'][] = 'Identifiant ou mot de passe incorrect';
        header('Location:../public/index.php?p=login');
        exit();
    }

}
/*Session::getInstance();

$username = $_POST['username'];
$password = $_POST['password'];


$_SESSION['username'] = 'green';
$_SESSION['animal']   = 'cat';

if(!empty($_POST)){

    $errors = [];
    $db = App\App::getDb();

    $validator = new \App\Validator($_POST);
    $validator->isAlpha('username', " Username incorrect! (alphanumérique)");
    $validator->isUnique('username', 'Username déjà pris!');
    $validator->isConfirmed('password', 'Invalid password!');
    //$validator->isEmail()

    echo '<pre>';
        var_dump($validator);
    echo '</pre>';*/









/*id="pseudo"
id="inputPassword"
value="remember-me"*/
