<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="<?= $router->path('default.index') ?>">Home</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="<?= $router->path('secteur.list') ?>">Secteurs</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?= $router->path('structure.list') ?>">Structures</a>
            </li>
        </ul>
    </div>
</nav>