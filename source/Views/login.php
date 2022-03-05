<!doctype html>
<html lang="pt-br">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="<?= asset("css/bootstrap.min.css"); ?>" rel="stylesheet">
    <link href="<?= asset("fontawesome/css/all.min.css"); ?>" rel="stylesheet">

    <title><?= $title; ?></title>

</head>
<body class="bg-light">
<div class="container">
    <div class="row justify-content-center align-items-center vh-100" >
        <div class="col-12 col-md-5 h-50 p-5 bg-info shadow" style="border-radius: 30px">
            <h2 class="d-flex justify-content-center pb-2 pt-4">Ainda não tem conta?</h2>
            <p class="d-flex justify-content-center h5 text-center text-muted pb-2">Cadastre-se agora e faça compras com
                agilidade!</p>
            <div class="d-flex justify-content-center" >
                <a href="<?= $router->route("web.register"); ?>" class="btn btn-primary btn-lg" style="border-radius: 30px">Cadastre-se</a>
            </div>
        </div>
        <div class="col-12 col-md-5 h-50 p-4 bg-white shadow" style="border-radius: 30px">
            <h1 class="d-flex justify-content-center pb-3"><?= SITENAME; ?></h1>
            <div class="d-flex justify-content-center form_callback">
                <?= flash(); ?>
            </div>
            <form action="<?= $router->route("web.login"); ?>" method="post">
                <div class="input-group mb-3">
                    <span class="input-group-text text-secondary"><i class="fas fa-envelope"></i></i></span>
                    <input type="email" class="form-control" name="email" placeholder="Digite seu email" required>
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text text-secondary"><i class="fas fa-lock"></i></span>
                    <input type="password" class="form-control" name="passwd" placeholder="Digite sua senha" required>
                </div>
                <button class="btn btn-primary w-100" style="border-radius: 30px">Login</button>
            </form>
        </div>
    </div>
</div>
<!-- Optional JavaScript; choose one of the two! -->

<!-- Option 1: Bootstrap Bundle with Popper -->
<script src="<?= asset("js/bootstrap.bundle.min.js"); ?>"></script>
<script src="<?= asset("js/jquery-3.6.0.min.js"); ?>"></script>
<script src="<?= asset("js/form.js"); ?>"></script>

<!-- Option 2: Separate Popper and Bootstrap JS -->
<!--
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
-->
</body>
</html>