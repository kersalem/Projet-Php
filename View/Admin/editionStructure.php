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

            <div class="form-check">
                <input type="checkbox" class="form-check-input" name="estAsso" id="estAsso">
                <label for="estAsso" class="form-check-label">C'est une association</label>
            </div>

            <div class="form-group">
                <label for="nomStructure">Nom</label>
                <input type="text" class="form-control" name ="nomStructure" id="nomStructure" value="<?php
                if(isset($_POST['nomStructure'])) Echo htmlspecialchars($_POST['nomStructure']); ?>" />
            </div>

            <div class="row">
                <div class="form-group col-md-5">
                    <label for="rueStructure">Rue</label>
                    <input type="text" class="form-control" name ="rueStructure" id="rueStructure" value="<?php
                    if(isset($_POST['rueStructure'])) Echo htmlspecialchars($_POST['rueStructure']); ?>" />
                </div>

                <div class="form-group col-md-2">
                    <label for="cpStructure" style="display:block; float:left; width:100px">Code postal</label>
                    <input type="text" class="form-control" name ="cpStructure" id="cpStructure" value="<?php
                    if(isset($_POST['cpStructure'])) Echo htmlspecialchars($_POST['cpStructure']); ?>" />
                </div>

                <div class="form-group col-md-5">
                    <label for="villeStructure" style="display:block; float:left; width:100px">Ville</label>
                    <input type="text" class="form-control" name ="villeStructure" id="villeStructure" value="<?php
                    if(isset($_POST['villeStructure'])) Echo htmlspecialchars($_POST['villeStructure']); ?>" />
                </div>
            </div>

            <div class="row">
                <div class="form-group col-md-6">
                    <label for="nbDonOrAct" id="labelNbDonOrAct">Nombre d'actionnaires</label>
                    <input type="number" class="form-control" name ="nbDonOrAct" id="nbDonOrAct" value="<?php
                    if(isset($_POST['nbDonOrAct'])) Echo htmlspecialchars($_POST['nbDonOrAct']); ?>" />
                </div>
            </div>

            <input type="submit" name="bSubmit" class="btn btn-success">

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