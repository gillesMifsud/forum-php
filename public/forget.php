<hr>
<div class="container">
    <div class="row">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="text-center">
                            <h3><i class="fa fa-lock fa-4x"></i></h3>
                            <h2 class="text-center">Mot de passe oublié?</h2>
                            <p>Saisissez votre adresse email pour recevoir votre mot de passe</p>
                            <div class="panel-body">

                                <form class="form" method="post" action="../pages/contr_forget.php">
                                    <fieldset>
                                        <div class="form-group">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="glyphicon glyphicon-envelope color-blue"></i></span>

                                                <input name="email" id="emailInput" placeholder="Adresse email" class="form-control" type="email" oninvalid="setCustomValidity('Please enter a valid email address!')" onchange="try{setCustomValidity('')}catch(e){}" required="">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <input class="btn btn-lg btn-primary btn-block" value="Envoyer le mot de passe" type="submit">
                                        </div>
                                    </fieldset>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>