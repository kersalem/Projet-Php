
<html>
<head>
    <meta charset="UTF-8">
</head>

<body>
<form method="post" action="">
    <label for="nomSecteur" style="display:block; float:left; width:100px">Nom secteur</label>
    <input type="text" size="100" name ="nomSecteur" id="nomSecteur" value="<?php
    if(isset($_POST['nomSecteur'])) Echo htmlspecialchars($_POST['nomSecteur']); ?>" /><br/>

    <input type="submit" name="bSubmit" value="Valider">

</form><br/>
</body>
</html>

