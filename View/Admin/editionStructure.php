<!DOCTYPE html>
<html lang="fr">
<?php
$headTitle = $titre;
include ('View/head.php');

session_start();

if (isset($_POST['estAsso']) && isset($_POST['nomStructure']) && isset($_POST['rueStructure']) && isset($_POST['cpStructure']) && isset($_POST['villeStructure']) && isset($_POST['nbDonOrAct'])) {
    $_SESSION['estAsso'] = $_POST['estAsso'];
    $_SESSION['nomStructure'] = $_POST['nomStructure'];
    $_SESSION['rueStructure'] = $_POST['rueStructure'];
    $_SESSION['cpStructure'] = $_POST['cpStructure'];
    $_SESSION['villeStructure'] = $_POST['villeStructure'];
    $_SESSION['nbDonOrAct'] = $_POST['nbDonOrAct'];
}
?>


<body>
<?php include('View/navBar.php'); ?>

    <div class="container">
        <?php echo "<h1>$titre</h1>"; ?>
        <form method="post" action="" name="formStructure">

            <div class="form-check">
                <input type="checkbox" class="form-check-input" name="estAsso" id="estAsso" <?= $structure->isEstAsso() ? "checked" : "" ?>
                <label for="estAsso" class="form-check-label"> C'est une association</label>
            </div>

            <div class="form-group">
                <label for="nomStructure">Nom</label>
                <input type="text" class="form-control" id="nomStructure"
                       name ="nomStructure"
                       value="<?=
                ($structure !== null) ? $structure->getNom() : false;
                (isset($_SESSION['nomStructure'])) ? htmlspecialchars($_SESSION['nomStructure']) : false; ?>">
            </div>

            <div class="row">
                <div class="form-group col-md-5">
                    <label for="rueStructure">Rue</label>
                    <input type="text" class="form-control" name ="rueStructure" id="rueStructure" value="<?=
                    ($structure !== null) ? $structure->getRue() : false;
                    (isset($_SESSION['rueStructure'])) ? htmlspecialchars($_SESSION['rueStructure']) : false; ?>">
                </div>

                <div class="form-group col-md-2">
                    <label for="cpStructure" style="display:block; float:left; width:100px">Code postal</label>
                    <input type="text" class="form-control" name ="cpStructure" id="cpStructure" value="<?=
                    ($structure !== null) ? $structure->getCp() : false;
                    (isset($_SESSION['cpStructure'])) ? htmlspecialchars($_SESSION['cpStructure']) : false; ?>">
                </div>

                <div class="form-group col-md-5">
                    <label for="villeStructure" style="display:block; float:left; width:100px">Ville</label>
                    <input type="text" class="form-control" name ="villeStructure" id="villeStructure" value="<?=
                    ($structure !== null) ? $structure->getVille() : false;
                    (isset($_SESSION['villeStructure'])) ? htmlspecialchars($_SESSION['villeStructure']) : false; ?>">
                </div>
            </div>

            <div class="row">
                <div class="form-group col-md-6">
                    <label for="nbDonOrAct" id="labelNbDonOrAct">Nombre d'actionnaires</label>
                    <input type="number" class="form-control" name ="nbDonOrAct" id="nbDonOrAct" value="<?=
                    ($structure !== null) ? $structure->getNbActionnaires() : false;
                    (isset($_SESSION['nbDonOrAct'])) ? htmlspecialchars($_SESSION['nbDonOrAct']) : false; ?>">
                </div>
            </div>

            <div class="form-group">
                <label for="exampleFormControlSelect2">Secteurs : </label>
                <select  name="secteurs" multiple class="form-control" id="exampleFormControlSelect2">
                    <?php  foreach ($secteurs as $secteur ){
                        echo "<option value=\"".$secteur->getId()."\">".$secteur->getLibelle()."</option>";
                    } ?>
                </select>
            </div>

            <button type="submit" name="bSubmit" class="btn btn-success">Submit</button>


        </form>
    </div>
</body>
<script type="text/javascript">
    window.addEventListener("load", function () {
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