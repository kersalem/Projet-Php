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
        <div class="form-check">
            <input type="checkbox" class="form-check-input" name="estAsso" id="estAsso">
            <label for="estAsso" class="form-check-label">C'est une association</label>
        </div> <?php } ?>

        <div class="form-group">
            <label for="nomStructure">Nom</label>
            <input type="text" class="form-control" name ="nomStructure" id="nomStructure" value="<?=
            ($structure !== null) ? $structure->getNom() : ((isset($_POST['nomStructure'])) ? htmlspecialchars($_POST['nomStructure']) : false)
            ?>" />
        </div>

        <div class="row">
            <div class="form-group col-md-5">
                <label for="rueStructure">Rue</label>
                <input type="text" class="form-control" name ="rueStructure" id="rueStructure" value="<?=
                ($structure !== null) ? $structure->getRue() : ((isset($_POST['rueStructure'])) ? htmlspecialchars($_POST['rueStructure']) : false)
                ?>" />
            </div>

            <div class="form-group col-md-2">
                <label for="cpStructure" style="display:block; float:left; width:100px">Code postal</label>
                <input type="text" class="form-control" name ="cpStructure" id="cpStructure" value="<?=
                ($structure !== null) ? $structure->getCp() : ((isset($_POST['cpStructure'])) ? htmlspecialchars($_POST['cpStructure']) : false)
                ?>" />
            </div>

            <div class="form-group col-md-5">
                <label for="villeStructure" style="display:block; float:left; width:100px">Ville</label>
                <input type="text" class="form-control" name ="villeStructure" id="villeStructure" value="<?=
                ($structure !== null) ? $structure->getVille() : ((isset($_POST['villeStructure'])) ? htmlspecialchars($_POST['villeStructure']) : false)
                ?>" />
            </div>
        </div>

        <div class="row">
            <div class="form-group col-md-12">
                <label for="nbDonOrAct" id="labelNbDonOrAct">Nombre d'actionnaires</label>
                <input type="number" class="form-control" name ="nbDonOrAct" id="nbDonOrAct" value="<?=
                ($structure !== null) ? (
                    ($structure instanceof \App\Entity\Association) ? $structure->getNbDonateurs()
                    : $structure->getNbActionnaires()
                ) : ((isset($_POST['nbDonOrAct'])) ? htmlspecialchars($_POST['nbDonOrAct']) : false)
                ?>" />
            </div>
        </div>

        <div class="form-group">
            <label for="secteurSelect">Secteurs : </label>
            <select name="secteurs[]" multiple class="form-control"
                    id="secteurSelect">
                <?php foreach ($secteurs as $secteur) {
                    echo "<option value=\"".$secteur->getId()."\""
                         . ($structure && in_array($secteur, $structure->getSecteurs())
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