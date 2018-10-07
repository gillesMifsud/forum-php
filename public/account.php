<?php

App\Session::restricLogin();

if(isset($_SESSION['auth'])){

    //var_dump($_SESSION['auth']);
    $user = App\Table\User::getUSer($_SESSION['auth']);
    $nbPosts = App\Table\User::postsCount($user->ID_USER);
    //var_dump($user);
    //var_dump($nbPosts);

    echo '<h1>Votre Compte</h1>';
    // Nom
    echo '<div><p>Bienvenue<strong> ' . $user->USERNAME . '</strong></p>';
    // Avatar
    echo'<p><img src="img/' . $user->AVATAR . '" width="150px" class="avatar img-circle" alt="avatar"></p>';
    // Email
    echo '<br/><p>Adresse Email: <strong>' . $user->EMAIL . '</strong></p>';
    // Date Inscription
    echo "<p>Date d'inscription: " . $user->DATE_INSCRIPTION . '</p>';
    // Nb posts
    echo "<p>Nombre de Posts: <strong>" . $nbPosts . '</strong></p>';

    // Usertype 1=Moderateur donc peut créer forums ,topics et posts
    // Usertype 2=User peut JUSTE creer topics et posts
    if($user->ID_USERTYPE == 1){
        echo  '<p>Rang: Modérateur <a href="index.php?p=newForum">Créer un Forum</a></p>';
    }

    echo  '<p>Nom: <strong>' . $user->NOM . "</strong> | Prénom: <strong>" . $user->PRENOM . '</strong></p>';
    echo '<p>Adresse: <strong>' . $user->ADRESSE . " " . $user->CP . '</strong></p></div>';

    echo '<a href="index.php?p=modif"><button class="btn btn-lg">Modifier votre profil</button></a>';
} else {
    $_SESSION['flash']['danger'][] = "Accès interdit, authentification requise";
    header('Location:index.php?p=login');
}



