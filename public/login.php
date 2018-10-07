<?php

if(isset($_COOKIE['remember'])){

}

/*
require '../pages/functions.php';
debug($_SESSION);

*/?>


<div class="container">

    <form class="form-signin" action="../pages/contr_login.php" method="post">
        <h2 class="form-signin-heading">Connexion</h2>

        <br><label for="inputEmail" class="sr-only">Username or Email</label>
        <input type="text" id="username" name="username" class="form-control" placeholder="Username" required autofocus>

        <br><label for="inputPassword" class="sr-only">Password</label>
        <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Password" required>
        <a href="index.php?p=forget">Mot de passe oublié?</a><br>

        <br><div class="form-group">
            <label>
                <input type="checkbox" name="remember" value="1">Se souvenir de moi
            </label>
        </div>

        <br><button class="btn btn-lg btn-primary btn-block" type="submit">Valider</button>
    </form>
    <a href="index.php?p=register" >S'inscrire</a>
</div>