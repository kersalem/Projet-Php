<?php

$title = "Les secteurs";
include('View/base.php');
require_once('Model/Entity/Secteur.php')

?>

<body>
<?php include('View/navBar.php'); ?>
<div class="container">
    <h1 class="text-center mt-4">Les secteurs</h1>
    <a href="/admin/secteur/create" class="btn btn-success">
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
                        <a href="/admin/secteur/edit/<?= $secteur->getId() ?>" class="btn btn-primary"><i class="fa fa-edit"></i></a>
                        <a href="/admin/secteur/delete/<?= $secteur->getId() ?>" class="btn btn-danger"><i class="fa fa-remove"></i></a>
                    </td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>

</div>
</body>
