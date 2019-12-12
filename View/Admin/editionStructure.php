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
                <input type="checkbox" class="form-check-input" name="estAsso" id="estAsso">
                <label for="estAsso" class="form-check-label">C'est une association</label>
            </div>

            <div class="form-group">
                <label for="nomStructure">Nom</label>
                <input type="text" class="form-control" name ="nomStructure" id="nomStructure" value="<?php
                if(isset($_SESSION['nomStructure'])) Echo htmlspecialchars($_SESSION['nomStructure']); ?>" />
            </div>

            <div class="row">
                <div class="form-group col-md-5">
                    <label for="rueStructure">Rue</label>
                    <input type="text" class="form-control" name ="rueStructure" id="rueStructure" value="<?php
                    if(isset($_SESSION['rueStructure'])) Echo htmlspecialchars($_SESSION['rueStructure']); ?>" />
                </div>

                <div class="form-group col-md-2">
                    <label for="cpStructure" style="display:block; float:left; width:100px">Code postal</label>
                    <input type="text" class="form-control" name ="cpStructure" id="cpStructure" value="<?php
                    if(isset($_SESSION['cpStructure'])) Echo htmlspecialchars($_SESSION['cpStructure']); ?>" />
                </div>

                <div class="form-group col-md-5">
                    <label for="villeStructure" style="display:block; float:left; width:100px">Ville</label>
                    <input type="text" class="form-control" name ="villeStructure" id="villeStructure" value="<?php
                    if(isset($_SESSION['villeStructure'])) Echo htmlspecialchars($_SESSION['villeStructure']); ?>" />
                </div>
            </div>

            <div class="row">
                <div class="form-group col-md-6">
                    <label for="nbDonOrAct" id="labelNbDonOrAct">Nombre d'actionnaires</label>
                    <input type="number" class="form-control" name ="nbDonOrAct" id="nbDonOrAct" value="<?php
                    if(isset($_SESSION['nbDonOrAct'])) Echo htmlspecialchars($_SESSION['nbDonOrAct']); ?>" />
                </div>
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