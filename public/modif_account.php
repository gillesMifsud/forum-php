<?php
// Modification des donnees utilisateur account

if(isset($_SESSION['auth'])){

    //var_dump($_SESSION['auth']);
    $user = App\Table\User::getUSer($_SESSION['auth']);

    //var_dump($user);

echo '<form class="form-horizontal" method="post" action="../pages/contr_acount.php">


    <div class="container">
        <h1>Modification Profile</h1>
        <hr>
        <div class="row">
            <!-- left column -->
            <div class="col-md-3">
                <div class="text-center">
                    <img src="img/' . $user->AVATAR  .  '" class="avatar img-circle" alt="avatar">
                    <h6>Choisir un nouvel avatar</h6>
                    <input type="file" class="form-control" name="newImg" value="img/' . $user->AVATAR  .  '">
                </div>
            </div>

            <!-- edit form column -->
            <div class="col-md-9 personal-info">
                <div class="alert alert-info alert-dismissable">
                    <a class="panel-close close" data-dismiss="alert">×</a>
                    <i class="fa fa-coffee"></i>
                    This is an <strong>.alert</strong>. Use this to show important messages to the user.
                </div>
                <h3>Informations personelles</h3>

                <form class="form-horizontal" role="form">
                    <div class="form-group">
                        <label class="col-lg-3 control-label">Prénom:</label>
                        <div class="col-lg-8">
                            <input class="form-control" type="text" value="' . $user->PRENOM  . '" name="newPrenom">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-3 control-label">Nom:</label>
                        <div class="col-lg-8">
                            <input class="form-control" type="text" value="' . $user->NOM  . '" name="newName">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-3 control-label">Email:</label>
                        <div class="col-lg-8">
                            <input class="form-control" type="text" value="' . $user->EMAIL  . '" name="newEmail">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-3 control-label">Adresse:</label>
                        <div class="col-lg-8">
                            <input class="form-control" type="text" value="' . $user->ADRESSE  . '" name="newAdresse">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-3 control-label">CP:</label>
                        <div class="col-lg-8">
                            <input class="form-control" type="text" value="' . $user->CP  . '" name="newCp">
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="col-md-3 control-label">Password:</label>
                        <div class="col-md-8">
                            <input class="form-control" type="password" value="" name="newPassword">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Confirm password:</label>
                        <div class="col-md-8">
                            <input class="form-control" type="password" value="" name="passwordConfirm">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label"></label>
                        <div class="col-md-8">
                            <input type="submit" class="btn btn-primary" value="Save Changes">
                            <span></span>
                            <input type="reset" class="btn btn-default" value="Cancel">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</form>
<hr>';
} else {
    $_SESSION['flash']['danger'][] = "Accès interdit, authentification requise";
    header('Location:index.php?p=login');
}