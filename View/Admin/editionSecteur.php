<?php

$title = $titre;
include('View/base.php');

?>

<body>
<div class="container">
    <h1><?= $titre ?></h1>
    <form method="post" action="/admin/secteur/create">
        <form>
            <div class="form-group">
                <label for="nomSecteur">Libelle</label>
                <input type="text" class="form-control" id="nomSecteur"
                       name="nomSecteur" value="<?= (isset($_POST['nomSecteur'])) ? htmlspecialchars($_POST['nomSecteur']) : false; ?>">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </form>
</div>
</body>
</html>

