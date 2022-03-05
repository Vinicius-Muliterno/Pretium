<!doctype html>
<html lang="pt-br">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="<?= asset("css/bootstrap.min.css"); ?>" rel="stylesheet">
    <link href="<?= asset("css/style.css"); ?>" rel="stylesheet">
    <link href="<?= url("vendor/fortawesome/font-awesome/css/all.min.css"); ?>" rel="stylesheet">
    <?php
    if ($v->section('style')):
        echo $v->section("style");
    endif;
    ?>
    <title><?= $title; ?></title>
</head>
<body>

<header class="navbar navbar-dark bg-info sticky-top flex-md-nowrap shadow">
    <a href="<?= url(""); ?>" class="navbar-brand col-md-3 col-lg-2 me-0 px-3"><?= SITENAME; ?></a>
    <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="dropdown me-5">

        <a class="link-secondary" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="fas fa-bell fs-5"></i>
        </a>
        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton1">
            <li class="d-flex justify-content-between"><h6 class="dropdown-header">Notificações (0)</h6><h6 class="dropdown-header link-primary">Marcar todas como lida</h6></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#">Nova Solicitação de Cotação</a></li>
        </ul>
    </div>
</header>

<div class="container-fluid">
    <div class="row">
        <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
            <div class="position-sticky pt-3">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="<?= $router->route("app.home"); ?>">
                            <i class="fas fa-tachometer-alt"></i>
                            Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= $router->route("app.providers"); ?>">
                            <i class="fas fa-user-friends"></i>
                            Fornecedores
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="<?= $router->route("app.products"); ?>">
                            <i class="fas fa-shopping-cart"></i>
                            Produtos
                        </a>
                    </li>
                </ul>

                <h6 class="sidebar-heading align-items-center px-3 mt-4 mb-1 text-muted">
                    <span>Cotações</span>
                </h6>
                <ul class="nav flex-column mb-2">
                    <li class="nav-item">
                        <a class="nav-link" href="<?= $router->route("app.myquotes"); ?>">
                            <i class="fas fa-layer-group"></i>
                            Minhas cotações
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= $router->route("app.quotesreceived"); ?>">
                            <i class="fas fa-layer-group"></i>
                            Cotações recebidas
                        </a>
                    </li>
                </ul>

                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link" href="<?= $router->route("app.logout"); ?>">
                            <i class="fas fa-sign-out-alt"></i>
                            Sair
                        </a>
                    </li>
                </ul>
            </div>
        </nav>

        <main class="col-md-9 col-lg-10 ms-sm-auto px-md-4">
            <?= $v->section('content'); ?>
        </main>
    </div>
</div>


<!-- Modals -->
<?php
if ($v->section('modal')):
    echo $v->section("modal");
endif;
?>

<!-- Scripts -->
<script src="<?= asset("js/jquery-3.6.0.min.js"); ?>"></script>
<script src="<?= asset("js/bootstrap.min.js"); ?>"></script>

<?php
if ($v->section('script')):
    echo $v->section("script");
endif;
?>

</body>
</html>