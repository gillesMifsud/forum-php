<?php

//$post = App\App::getDb()->prepare('SELECT * FROM topic WHERE ID_FORUM = ?' , [$_GET['id']] , 'App\Table\Topic' , false);
$post = App\Table\Topic::getTopicByForum($_GET['id']);





    echo '<h2>Liste des Topics du forum:</h2>';

    foreach ($post as $listTopic){


        $iduser = $listTopic->ID_USER;

        $profile = App\Table\User::getUser(intval($iduser));


    echo '<h3><a href="'. App\Table\Topic::getUrlTopic($listTopic->ID_TOPIC) .'">' . $listTopic->NOM_TOPIC . '</a></h3>';
    echo '<em>Descriptif du topic: ' . $listTopic->DESCRIPTION_TOPIC .'</em>';
    echo '<em>Par: ' . $profile->USERNAME .'</em>';


    }
?>




