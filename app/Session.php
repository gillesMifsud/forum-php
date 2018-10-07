<?php


namespace App;


class Session{

    static $instance;

    // Pour se servir de l'instance: App\Session::getInstance()

    static function getInstance(){
        if(!self::$instance){
            self::$instance = new Session();
        }
        return self::$instance;
    }

    public function __construct(){
        session_start();
    }



    public static function reconnectCookie(){
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
            $user = Table\User::getUser($user_id);
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
    }



    public static function restricLogin(){
        if(session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        if(!isset($_SESSION['auth'])) {
            $_SESSION['flash']['danger'][] = "Accès interdit, authentification requise";
            header('Location:../public/index.php?p=login');
            exit();
        }
    }

    //Definit un message flash
    public function setFlash($key, $message){
        $_SESSION['flash'][$key] = $message;
    }

    public function hasFlashes(){
        return isset($_SESSION['flash']);
    }

    public function getFlashes(){
        $flash = $_SESSION['flash'];
        unset($_SESSION['flash']);
        return $flash;
    }

    public function write($key, $value){
        $_SESSION[$key] = $value;
    }

    public function read($key){
        return isset($_SESSION[$key]) ? $_SESSION[$key] : null;
    }

    public function delete($key){
        unset($_SESSION[$key]);
    }

}