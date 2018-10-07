<?php
// Si authentifié OK sinon retour au login
App\Session::restricLogin();

foreach (App\Table\Forum::getAllForum() as $forum) {

echo'<div class="bs-example">';
    
    echo "<h1>Forum ";
    echo "<a href='". App\Table\Forum::getUrlForum($forum->ID_FORUM) . "'>" . $forum->NOM_FORUM . "</a>";
    echo "</h1>";


    echo "<p>".$forum->DESCRIPTION_FORUM."</p>";
    echo "<p>Crée le " . $forum->DATE_FORUM. "</p>";



    echo '<table class="table">';
        echo '<thead><h3>Derniers Topics du forum ' . $forum->NOM_FORUM . ":</h3>";
         echo  '<tr>
                    <th>Id Topic</th>
                    <th>Nom Topic</th>
                    <th>Date de Création</th>
                    <th>Dernier Post</th>
                    <th>Date Dernier Post</th>
                </tr>
            </thead>';

        $lastTopics = App\Table\Topic::getTopicByForum($forum->ID_FORUM);
        foreach ($lastTopics as $Topic) {
        echo   '<tbody>
                     <tr class="active">';
                        echo '<td>' . $Topic->ID_TOPIC; '</td>';
                        echo '<td>';
                            echo "<a href=" . App\Table\Topic::getUrlTopic($Topic->ID_TOPIC) . ">" . $Topic->NOM_TOPIC . "</a>";
                             '</td>';
                        echo '<td>' . $Topic->DATE_TOPIC; '</td>';
                        echo '<td></td>';
                        echo '<td></td>';
                        echo '</tr>
                </tbody>';
        }
    echo '</table>
</div>';
}
