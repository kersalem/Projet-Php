<?php
$title = $titre;

include ('View/base.php');
?>


<body>
    <div class="container">
        <?php echo "<h1>$titre</h1>"; ?>
        <form method="post" action="" name="formStructure">
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

            <div class="form-check">
                <input type="checkbox" class="form-check-input" name="estAsso" id="estAsso">
                <label for="estAsso" class="form-check-label">Je suis une asso</label>
            </div>

            <div class="form-check">
                <label for="nbDonnateurs">Nombre de donnateurs</label>
                <input type="number" size="100" name ="nbDonnateurs" id="nbDonnateurs" value="<?php
                if(isset($_POST['nbDonnateurs'])) Echo htmlspecialchars($_POST['nbDonnateurs']); ?>" /><br/>
            </div>

            <label for="nbActionnaires" style="display:block; float:left; width:100px">Nombre de actionnaires</label>
            <input type="number" size="100" name ="nbActionnaires" id="nbActionnaires" value="<?php
            if(isset($_POST['nbActionnaires'])) Echo htmlspecialchars($_POST['nbActionnaires']); ?>" /><br/>


            <input type="submit" name="bSubmit" value="Valider">

        </form><br/>
    </div>
</body>
</html>