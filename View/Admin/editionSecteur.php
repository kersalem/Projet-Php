<!DOCTYPE html>
<html lang="fr">
<?php
$headTitle = $titre;
include('View/head.php');
?>

<body>
<?php include('View/navBar.php'); ?>
<div class="container">
    <h1><?= $titre ?></h1>
    <form method="post" action="<?= $_SERVER['REQUEST_URI'] ?>">
        <form>
            <div class="form-group">
                <label for="nomSecteur">Libelle</label>
                <input type="text" class="form-control" id="nomSecteur"
                       name="nomSecteur"
                       value="<?=
                       ($secteur !== null) ? $secteur->getLibelle() : false;
                       (isset($_POST['nomSecteur'])) ? htmlspecialchars($_POST['nomSecteur']) : false; ?>">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </form>
</div>
</body>
</html>

