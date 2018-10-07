<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">

    <!-- recup dynamique du titre -->
    <title><?php echo App\App::getTitle(); ?></title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <style>
        body {
            padding-top: 60px; /* 60px to make the container go all the way to the bottom of the topbar */
        }
    </style>
    <link href="../assets/css/bootstrap-responsive.css" rel="stylesheet">
</head>

<body>

<div class="container">

    <!-- Static navbar -->
    <nav class="navbar navbar-default">

        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">Accueil</a>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
                <ul class="nav navbar-nav">

                 <?php if(isset($_SESSION['auth'])) {
                 echo '<li><a class="brand" href="index.php?p=logout">Deconnexion</a></li>
                       <li><a class="brand" href="index.php?p=account">Mon Compte</a></li>
                       <!--Recup du nom utilisateur si connecté-->
                       <li style="margin-left: 100px; text-align: right"><a class="brand">Connecté en tant que: <strong>'. App\Table\User::getUser($_SESSION['auth'])->USERNAME.'</strong></a></li>';

                 } else {
                 unset($_SESSION['auth']);
                 echo '<li><a class="brand" href="index.php?p=login">Connexion</a></li>
                       <li><a class="brand" href="index.php?p=register">Inscription</a></li>';

                 }
                 ?>
                </ul>
            </div>
        </div>
    </nav>
    <?php
    // Si la session est vide, commence la!
    if(session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    // Affiche les erreurs de $_SESSION['flash']
    if(isset($_SESSION['flash'])) {

        foreach ($_SESSION['flash'] as $typeFlash=>$message) {
            if($typeFlash=="danger"){
                foreach($message as $error){
                    echo '<div class="alert alert-' . $typeFlash . '">' . $error . '</div>';
                }
            }
            else{
                echo '<div class="alert alert-' . $typeFlash . '">' . $message . '</div>';
            }

            unset($_SESSION['flash']);
        }
    }
    ?>
    <div class="jumbotron">
        <?= $content; ?>
    </div>

</div> <!-- /container -->

</body>
</html>
