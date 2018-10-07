
<form class="form-horizontal" action="../pages/contr_newForum.php" method="post">
    <fieldset>
        <legend>Créer un nouveau Forum</legend>

        <div class="form-group">
            <label for="nom" class="col-md-3 control-label">Nom du Forum</label>
            <div class="col-md-5">
                <input name="nomNewForum" type="text" class="form-control" id="nom" placeholder="Nom du Forum">
                <input name="idCreator" type="hidden" value="<?php echo $_SESSION['auth']?>">
            </div>
        </div>


        <div class="form-group">
            <label for="description" class="col-md-3 control-label">Description du Forum</label>
            <div class="col-md-5">
                <input name="descriptionNewForum" type="text" class="form-control" id="description" placeholder="Description du Forum">
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-8">
                <button type="submit" class="btn btn-primary pull-right">Enregistrer</button>
            </div>
        </div>
    </fieldset>
</form>
