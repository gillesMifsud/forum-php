<?php
    // Select tous les posts en fonction de l'ID_TOPIC
    $list = App\Table\Post::getPostsByTopic();

    // Select des infos USER en fonction de l'ID_TOPIC
    $name = App\Table\Topic::getTopicAndUser();

    // Mise en place du titre dynamique
    App\App::setTitle($name->NOM_TOPIC);



    //Titre du Topic
    echo '<div class="container">';
    echo '<h2> Topic: ' . $name->NOM_TOPIC  . '</h2>';
    echo '<p>Ecrit par: ' . $name->USERNAME . ' le ' . $name->DATE_TOPIC . '</p>';

    //Repondre au topic
    //Recup de l'user en session
    $userSession = App\Table\User::getUser($_SESSION['auth']);
    $countPostsUserSession = App\Table\User::postsCount($_SESSION['auth']);



    // Tableau Reponse au Topic, Creation d'un nouveau POST
    echo '<table class="table table-bordered" ">';
    echo' <thead><tr>';
    echo '</tr></thead>

        <tbody>
        <!--Infos User En Cours-->
        <tr><td rowspan = 2 class="col-md-3"><em style="text-align: center">'.$userSession->USERNAME.'</em></br>';
    echo '<img src="../public/img/' . $userSession->AVATAR .'"class="avatar img-circle" alt="avatar" width="100px"></br>';
    echo "<em>Nombre de posts: </em>" . $countPostsUserSession . '</br>';
    echo "<em>Id de l'utilisateur: </em>" . $userSession->ID_USER   . '</br>';
    echo '</td>';
    echo '</tr>

        <tr><td class="col-md-9">'; //Form dans le tableau
            echo '<div class="form-group">
                    <!--Debut Formulaire-->
                    <form id="newPost" method="post" action="../pages/contr_newPost.php">
                    <!--Sujet du nouv post-->
                    <label for="subjectNewPost">Sujet du post:</label><br>
                    <input style="width: 100%" id="subjectNewPost" maxlength="50" type="text" name="subjectNewPost">
                    <!--Passage ID_TOPIC for SAVE in BDD $_GET[\'id\']=TOPIC CONCERNé-->
                    <input type="hidden" name="idTopic" value="'.$_GET['id'].'">
                    <br>
                    <!--Message du nouv post-->
                    <br><label for="reponsePost">Message:</label>
                    <textarea style="width: 100%" form="newPost" id="reponsePost" rows="8" name="messageNewPost" placeholder="Tapez votre message ici..."></textarea>
                    <br><input class="btn btn-primary pull-right" type="submit" value="Créer le Post">
                    </form><br>
              </div>
             </td>';

    echo'</tr>
        </tbody>
        </table>';




    //Messages recupérés dyamiquement
    foreach ($list as $total) {

        $iduser = $total->ID_USER;

        $profile = App\Table\User::getUser(intval($iduser));


    echo '<table class="table table-bordered" ">';
    echo' <thead>
    <tr>
        <th colspan=4>Sujet du post: ' . $total->NOM_POST . '<em> - Posté le: ' . $total->DATE_POST . '</em>

        <br><a href="">Répondre</a></th>';
        echo '</tr>
    </thead>
    <tbody>
    <tr>
        <td rowspan = 2 ><em style="text-align: center">'  . $profile -> USERNAME  . '</em></br>';
                     echo '<img src="../public/img/'  . $profile -> AVATAR    . '"class="avatar img-circle" alt="avatar" width="100px"></br>';

                            echo "<em>Id de l'utilisateur: </em>" . $total -> ID_USER   . '</br>';
           echo '</td>';
        echo '</tr>
    <tr>
        <td>' . $total->MESSAGE_POST . '</td>';

        echo '</tr>
    </tbody>
    </table>';

    }

    echo '</div>';


?>








