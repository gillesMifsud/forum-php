<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

<form class="form-horizontal" action="../pages/contr_register.php" method="post">
    <fieldset>
        <legend>Inscription</legend>

        <div class="form-group">
            <label for="username" class="col-md-1 control-label">Username</label>
            <div class="col-md-5">
                <input name="username" type="text" class="form-control" id="username" placeholder="Username">
            </div>
        </div>


        <div class="form-group">
            <label for="inputEmail" class="col-md-1 control-label">Email</label>
            <div class="col-md-5">
                <input name="email" type="text" class="form-control" id="inputEmail" placeholder="Email">
            </div>
        </div>

        <div class="form-group">
            <label for="inputPassword" class="col-md-1 control-label">Password</label>
            <div class="col-md-5">
                <input name="password" type="password" class="form-control" id="inputPassword" placeholder="Password">
            </div>
        </div>

        <div class="form-group">
            <label for="inputPassword" class="col-md-1 control-label">Confirm Password</label>
            <div class="col-md-5">
                <input name="password_confirm" type="password" class="form-control" id="inputPassword" placeholder="Confirm Password">
            </div>
        </div>

         <div class="form-group">
            <div class="col-md-5 col-md-offset-2">
                <button type="reset" class="btn btn-default">Annuler</button>
                <button type="submit" class="btn btn-primary">M'inscrire</button>
            </div>
        </div>
    </fieldset>
</form>
