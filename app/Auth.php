<?php


namespace App;



class Auth
{

    private $session;

    public function __construct($session){
        $this->session = $session;
    }

    public function connect($user){
        $this->session_start($user);
    }

    public function login( $username, $password){
        $user = App::getDb()->queryOne('
         SELECT USERNAME, PASSWORD FROM user
         WHERE USERNAME = '.$username.'
         ');

        if(password_verify($password, $user->PASSWORD)){
            $this->connect($user);
            return $user;
        }else{
            return false;
        }
    }

    public function restrict(){
        if(!$this->session->read('auth')){
            $this->session->setFlash('danger', "Vous n'avez pas le droit d'accéder à cette page");
            header('Location: login.php');
            exit();
        }
    }
}

}