<?php

namespace App\Table;

use App\App;

class User
{
   /* private $_adresse ;
    private $_avatar ;
    private $_cp ;
    private $_dateInscription ;
    private $_email ;
    private $_idUser ;
    private $_idUsertype ;
    private $_nom ;
    private $_password ;
    private $_prenom ;
    private $_username ;*/

    public static function rememberMe($rememberToken, $idUser){
        return App::getDb()->update("UPDATE user SET REMEMBER_TOKEN = ?
                                      WHERE ID_USER = ?", array($rememberToken, $idUser));
    }

    public static function verifyTokenPass($idUser, $token){
        return App::getDb()->prepare("SELECT ID_USER, RESET_PASS FROM user WHERE ID_USER = ?
                                      AND RESET_PASS_AT > DATE_SUB(NOW(), INTERVAL 30 MINUTE)
                                      AND RESET_PASS = ?" , array($idUser,$token) , __CLASS__, true);
    }


    public static function emailCheck($email){
        return App::getDb()->prepare("SELECT ID_USER, EMAIL FROM user
                                      WHERE EMAIL = ? AND CONFIRMED_AT IS NOT NULL" , $email , __CLASS__ , true);
    }

    public static function resetEmail($resetPass,$idUser){
        return App::getDb()->update("UPDATE user
                                      SET RESET_PASS = '$resetPass',
                                      RESET_PASS_AT = NOW()
                                      WHERE ID_USER = ?" , $idUser);
    }



    public static function updateUser($newImg, $newPrenom, $newName,$newEmail,$newAdresse,$newCp,$newPassword, $idUser){
        return App::getDb()->update("UPDATE user
                                      SET AVATAR  = '$newImg',
                                          PRENOM  = '$newPrenom',
                                          NOM     = '$newName',
                                          EMAIL   = '$newEmail',
                                          ADRESSE = '$newAdresse',
                                          CP      = '$newCp',
                                          PASSWORD= '$newPassword'
                                      WHERE ID_USER = ?" , $idUser);
    }


    public static function updatePass($pass, $idUser){
        return App::getDb()->update("UPDATE user
                                      SET PASSWORD = ?
                                      RESET_PASS = NULL
                                      RESET_PASS_AT = NULL
                                      WHERE ID_USER = ?" ,array($pass, $idUser) );

    }


    public static function postsCount($idUser){
        return App::getDb()->queryCount("SELECT COUNT(ID_POST) FROM post WHERE ID_USER = $idUser", __CLASS__);
    }


    public static function loginCheck($userInfos){
        return App::getDb()->prepare("SELECT ID_USER, USERNAME, PASSWORD, EMAIL FROM user
                                      WHERE (USERNAME = :USERNAME OR EMAIL = :USERNAME) AND CONFIRMED_AT IS NOT NULL" , $userInfos , __CLASS__ , true);
    }


    public static function resetToken($idUser){
        return App::getDb()->update("UPDATE user
                                      SET CONFIRMATION_TOKEN = NULL,
                                      CONFIRMED_AT = NOW()
                                      WHERE ID_USER = ?" , $idUser);
    }


    public static function getTokenUser($idUser){
        return App::getDb()->prepare("SELECT * FROM user WHERE ID_USER = ?" ,$idUser , __CLASS__, true);
    }


    public static function getUser($idUser){
        return App::getDb()->queryOne("
                SELECT ID_USER, USERNAME, AVATAR, DATE_INSCRIPTION, NOM, PRENOM, EMAIL, ADRESSE, CP, ID_USERTYPE
                FROM user
                WHERE ID_USER = $idUser", __CLASS__);
    }


    public static function insertUser($username, $password, $email, $token){
        return App::getDb()->insert("
                INSERT INTO user (USERNAME, PASSWORD, EMAIL, ID_USERTYPE, DATE_INSCRIPTION,CONFIRMATION_TOKEN )
                VALUES (?,?,?,2,now(),?)" , array($username,$password,$email,$token), __CLASS__ , true );
    }


    public static function passwordHash($password){
        return password_hash($password, PASSWORD_BCRYPT);
    }


    public static function exist($username){
        return App::getDb()->prepare("
                SELECT ID_USER
                FROM user
                WHERE USERNAME = ?", $username, __CLASS__ , true);
    }


    public static function strRandom($length){
        $alphabet = "0123456789azertyuiopqsdfghjklmwxcvbnAZERTYUIOPQSDFGHJKLMWXCVBN";
        return substr(str_shuffle(str_repeat($alphabet , $length)) , 0 , $length);
    }


    public static function getLast(){
        return App::getDb()->lastInsertId();
    }


}




/*ADRESSE
AVATAR
CP
DATE_INSCRIPTION
EMAIL
ID_USER
ID_USERTYPE
NOM
PASSWORD
PRENOM
USERNAME*/