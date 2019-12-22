<!DOCTYPE html>
<html lang="fr">
<?php
$headTitle = $titre;
include ('View/head.php');
?>

<body>
<?php include('View/navBar.php'); ?>

<div class="container">
    <?php echo "<h1>$titre</h1>"; ?>
    <form method="post" action="" name="formStructure">

        <?php if (!$edit) { ?>
        <div class="custom-control custom-checkbox">
            <input type="checkbox" class="custom-control-input" name="estAsso" id="estAsso">
            <label for="estAsso" class="custom-control-label">C'est une association</label>
        </div> <?php } ?>

        <div class="form-group">
            <label for="nomStructure">Nom</label>
            <input type="text" class="form-control" name ="nomStructure" id="nomStructure" value="<?=
            (isset($formValues['nomStructure'])) ? htmlspecialchars($formValues['nomStructure']) : false
            ?>" />
        </div>

        <div class="row">
            <div class="form-group col-md-5">
                <label for="rueStructure">Rue</label>
                <input type="text" class="form-control" name ="rueStructure" id="rueStructure" value="<?=
                (isset($formValues['rueStructure'])) ? htmlspecialchars($formValues['rueStructure']) : false
                ?>" />
            </div>

            <div class="form-group col-md-2">
                <label for="cpStructure" style="display:block; float:left; width:100px">Code postal</label>
                <input type="text" size="5" class="form-control" name ="cpStructure" id="cpStructure" value="<?=
                (isset($formValues['cpStructure'])) ? htmlspecialchars($formValues['cpStructure']) : false
                ?>" />
            </div>

            <div class="form-group col-md-5">
                <label for="villeStructure" style="display:block; float:left; width:100px">Ville</label>
                <input type="text" class="form-control" name ="villeStructure" id="villeStructure" value="<?=
                (isset($formValues['villeStructure'])) ? htmlspecialchars($formValues['villeStructure']) : false
                ?>" />
            </div>
        </div>

        <div class="row">
            <div class="form-group col-md-12">
                <label for="nbDonOrAct" id="labelNbDonOrAct"><?= ($edit && $structure instanceof \App\Entity\Association ? "Nombre de donnateurs" : "Nombre d'actionnaires") ?></label>
                <input type="number" class="form-control" name ="nbDonOrAct" id="nbDonOrAct" value="<?=
                (isset($formValues['nbDonOrAct'])) ? htmlspecialchars($formValues['nbDonOrAct']) : false
                ?>" />
            </div>
        </div>

        <div class="form-group">
            <label for="secteurSelect">Secteurs : </label>
            <select name="secteurs[]" multiple class="form-control"
                    id="secteurSelect">
                <?php foreach ($secteurs as $secteur) {
                    echo "<option value=\"".$secteur->getId()."\""
                         . (isset($formValues['secteurs']) && in_array($secteur->getId(), $formValues['secteurs'])
                        ? "selected"
                        : false) . ">" . $secteur->getLibelle() . "</option>";
                } ?>
            </select>
        </div>

        <input type="submit" name="bSubmit" class="btn btn-success">

    </form>
</div>
</body>
<script type="text/javascript" src="/View/js/jquery.js"></script>
<script type="text/javascript" src="/View/js/select2.min.js"></script>
<script type="text/javascript">
    window.addEventListener("load", function () {
        $('#secteurSelect').select2();
        var estAsso = document.getElementById("estAsso");
        var label = document.getElementById("labelNbDonOrAct");
        estAsso.addEventListener("click", function () {
            if (estAsso.checked) {
                label.innerText = "Nombre de donnateurs";
            } else {
                label.innerText = "Nombre d'actionnaires";
            }
        });
    });
</script>
</html>