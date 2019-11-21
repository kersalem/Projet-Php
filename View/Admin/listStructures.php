<?php
$title = "Les structures";
include ('View/base.php');
?>

<body>
<div class="container">
    <h1 class="text-center">Les structures</h1>
    <a href="/admin/structure/create" class="btn btn-success"><span class="fa fa-plus mr-2 "></span>Créer une structure</a>
    <div class="col-md-4 mt-4">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Veolia</h4>
                <h6 class="card-subtitle mb-2 text-muted">rue Veolia, 75000, Paris</h6>
                <p class="card-text">Nombre de donateurs : 500 000</p>
                <p class="card-text">Nomnbre d'actionnaires : 100 000</p>
                <p class="card-text">Secteur d'activité : Energie, Environnement, Transport</p>
                <a href="/admin/structure/edit" class="btn btn-primary">Modifier</a>
                <a href="/admin/structure/delete" class="btn btn-danger">Supprimer</a>
            </div>
            <div class="card-footer text-muted">
                Entreprise
            </div>
        </div>
    </div>

</div>
</body>
