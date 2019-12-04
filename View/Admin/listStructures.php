<?php
$title = "Les structures";
include ('View/base.php');
require_once ('Model/Entity/Structure.php');
?>

<body>
<div class="container">
    <h1 class="text-center mt-4">Les structures</h1>
    <a href="/admin/structure/create" class="btn btn-success"><span class="fa fa-plus mr-2 "></span>Créer une structure</a>
    <div class="row">
        <?php foreach ($structures as $structure) { ?>
        <div class="col-md-4 mt-4">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title"><?= $structure->getNom() ?></h4>
                    <h6 class="card-subtitle mb-2 text-muted"><?= $structure->getRue(). ", " .$structure->getCp(). ", " .$structure->getVille() ?></h6>
                    <p class="card-text">Nombre de donateurs : <?= $structure->getNbDonateurs()?></p>
                    <p class="card-text">Nomnbre d'actionnaires : <?= $structure->getNbActionnaires()?></p>
                    <p class="card-text">Secteur(s) d'activité : <?= implode(", ", $structure->getSecteurs()) ?></p>
                    <a href="/admin/structure/edit" class="btn btn-primary">Modifier</a>
                    <a href="/admin/structure/delete" class="btn btn-danger">Supprimer</a>
                </div>
                <div class="card-footer text-muted">
                    <?= $structure->isEstAsso() ? "Association" : "Entreprise" ?>
                </div>
            </div>
        </div>
        <?php } ?>
    </div>

</div>
</body>
