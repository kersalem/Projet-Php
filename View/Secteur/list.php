<!DOCTYPE html>
<html lang="fr">
<?php
$headTitle = "Les secteurs";
include('View/head.php');
?>

<body>
<?php include('View/navBar.php'); ?>
<div class="container">
    <h1 class="text-center mt-4">Les secteurs</h1>
    <a href="<?= $router->path('secteur.add') ?>" class="btn btn-success">
        <span class="fa fa-plus mr-2 "></span>
        Créer un secteur
    </a>
    <div class="row">
        <table class="table mt-4">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Libelle</th>
                <th scope="col">Modifications</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($secteurs as $secteur) { ?>
                <tr>
                    <th scope="row"><?= $secteur->getId() ?></th>
                    <td><?= $secteur->getLibelle() ?></td>
                    <td>
                        <a href="<?= $router->path('secteur.edit', ['id' => $secteur->getId()]) ?>" class="btn btn-primary"><i class="fa fa-edit"></i></a>
                        <a href="<?= $router->path('secteur.delete', ['id' => $secteur->getId()]) ?>" class="btn btn-danger"><i class="fa fa-remove"></i></a>
                    </td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>

</div>
</body>
</html>