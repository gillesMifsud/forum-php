<?php var_dump($_SESSION['verify']);
$id = $_SESSION['verify'];
?>

<div class="container">
    <div class='row'>
        <div class='col-sm-4 col-md-offset-4'>
            <form  action="../pages/contr_reset_ok.php" class="require-validation" method="post">

                <input type="hidden" value=" <?php echo $id ?>  " name="id">


                <div class='form-row'>
                    <div class='col-xs-12 form-group card required'>
                        <label class='control-label'>Nouveau mot de passe:</label>
                        <input name="password"  class='form-control card-number' size='20' type='text'>
                    </div>
                </div>

                <div class='form-row'>
                    <div class='col-xs-12 form-group card required'>
                        <label class='control-label'>Repeate password</label>
                        <input name="password_confirm" class='form-control' size='20' type='text'>
                    </div>
                </div>

                <div class='form-row'>
                    <div class='col-md-12 form-group'>
                        <button class='form-control btn btn-primary submit-button' type='submit'>Valider</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
