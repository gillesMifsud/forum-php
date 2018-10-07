<?php


namespace App\Table;

use App\App;

class Post
{
    /*private $_date_post;
    private $_id_post;
    private $_id_topic;
    private $_id_user;
    private $_img_post;
    private $_message_post;
    private $_nom_post;*/

    /*public static function getPostsByTopic(){
        return App::getDb()->prepare('
          SELECT * FROM post,topic
          WHERE topic.ID_TOPIC = post.ID_TOPIC
          AND post.ID_TOPIC = ?
          ORDER BY DATE_POST' , [$_GET['id']] , __CLASS__ , false);
    }*/


    public static function getPostsByTopic(){
        return App::getDb()->prepare('
                SELECT * FROM post
                WHERE ID_TOPIC = ?
                ORDER BY DATE_POST' ,
                [$_GET['id']] , __CLASS__ , false);
    }

    public static function saveNewPost($topic, $idUser, $subjectNewPost, $messageNewPost){
        return App::getDb()->insert('
                INSERT INTO post (NOM_POST, MESSAGE_POST, ID_TOPIC, ID_USER)
                VALUES (? , ? , ? , ?)',
                array($subjectNewPost , $messageNewPost , $topic , $idUser), __CLASS__, true);
    }


}




/*ColonneDATE_TOPIC
ColonneDESCRIPTION_TOPIC
ColonneID_FORUM
ColonneID_TOPIC
ColonneID_USER
ColonneNOM_TOPIC


ColonneDATE_POST
ColonneID_POST
ColonneID_TOPIC
ColonneID_USER
ColonneIMG_POST
ColonneMESSAGE_POST
ColonneNOM_POST */