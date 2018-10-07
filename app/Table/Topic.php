<?php

namespace App\Table;

use App\App;

class Topic
{

    public function getTopic(){
        return App::getDb()->query('
                SELECT *
                FROM topic
                ORDER BY DATE_TOPIC DESC'
                , __CLASS__ , false);
    }



    public static function getTopicById($id){

        return App::getDb()->queryOne('
               SELECT *
               FROM topic
               WHERE topic.ID_FORUM = '.$id.' ',
               __CLASS__ , false);

    }

    public static function getTopicInfo(){

        return App::getDb()->prepare('
          SELECT *
          FROM topic
          WHERE ID_TOPIC = ?' , [$_GET['id']] , __CLASS__ , true);
    }



    public static function getTopicAndUser(){

        return App::getDb()->prepare('
          SELECT ID_TOPIC, NOM_TOPIC, DATE_TOPIC, DESCRIPTION_TOPIC, topic.ID_USER,
          AVATAR, USERNAME
          FROM topic, user
          WHERE topic.ID_USER = user.ID_USER
          AND ID_TOPIC = ?' , [$_GET['id']] , __CLASS__ , true);
    }



    public static function getTopicByForum($forumId){
        // __CLASS__ = class courante
        return App::getDb()->queryAll('
                SELECT DATE_TOPIC, DESCRIPTION_TOPIC, NOM_TOPIC, ID_USER, ID_TOPIC
                FROM topic
                WHERE ID_FORUM = '.$forumId.'
                ORDER BY DATE_TOPIC DESC
                LIMIT 2' , __CLASS__ , false);

    }

    public static function getUrlTopic($id){

        return 'index.php?p=topic&id='.$id ;

    }
}