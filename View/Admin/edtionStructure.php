<?php
?>


<html>
    <head>
        <meta charset="UTF-8">
    </head>

    <body>
    <form method="post" action="">
        <label for="nomStructure" style="display:block; float:left; width:100px">Nom</label>
        <input type="text" size="100" name ="nomStructure" id="nomStructure" value="<?php
        if(isset($_POST['nomStructure'])) Echo htmlspecialchars($_POST['nomStructure']); ?>" /><br/>

        <label for="rueStructure" style="display:block; float:left; width:100px">Rue</label>
        <input type="text" size="200" name ="rueStructure" id="rueStructure" value="<?php
        if(isset($_POST['rueStructure'])) Echo htmlspecialchars($_POST['rueStructure']); ?>" /><br/>

        <label for="cpStructure" style="display:block; float:left; width:100px">Code postal</label>
        <input type="text" size="5" name ="cpStructure" id="cpStructure" value="<?php
        if(isset($_POST['cpStructure'])) Echo htmlspecialchars($_POST['cpStructure']); ?>" /><br/>

        <label for="villeStructure" style="display:block; float:left; width:100px">Ville</label>
        <input type="text" size="100" name ="villeStructure" id="villeStructure" value="<?php
        if(isset($_POST['villeStructure'])) Echo htmlspecialchars($_POST['villeStructure']); ?>" /><br/>

        <label for="nbActionnaires" style="display:block; float:left; width:100px">Je suis une asso</label>

        <input type="radio" id="huey" name="drone" value="huey" checked>
        <label for="huey">oui</label>

        <input type="radio" id="dewey" name="drone" value="dewey">
        <label for="dewey">non</label>

        <label for="nbDonnateurs" style="display:block; float:left; width:100px">Nombre de donnateurs</label>
        <input type="number" size="100" name ="nbDonnateurs" id="nbDonnateurs" value="<?php
        if(isset($_POST['nbDonnateurs'])) Echo htmlspecialchars($_POST['nbDonnateurs']); ?>" /><br/>

        <label for="nbActionnaires" style="display:block; float:left; width:100px">Nombre de actionnaires</label>
        <input type="number" size="100" name ="nbActionnaires" id="nbActionnaires" value="<?php
        if(isset($_POST['nbActionnaires'])) Echo htmlspecialchars($_POST['nbActionnaires']); ?>" /><br/>


        <input type="submit" name="bSubmit" value="Valider">

    </form><br/>
    </body>
</html>