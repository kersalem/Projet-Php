<?php

$title = "Les secteurs";
include('View/base.php');
require_once('Model/Entity/Secteur.php')

?>

<body>
<div class="container">
    <h1 class="text-center mt-4">Les secteurs</h1>
    <a href="/admin/structure/create" class="btn btn-success">
        <span class="fa fa-plus mr-2 "></span>
        Créer un secteur
    </a>
    <div class="row">
        <?php var_dump($secteurs); ?>
    </div>

</div>
</body>
