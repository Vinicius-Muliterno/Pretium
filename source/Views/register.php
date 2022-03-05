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
    <div class="row justify-content-center align-items-center vh-100">
        <!---<div class="col-12 col-md-5  p-5 bg-info shadow" style="height:95%; border-radius: 30px">
            <h2 class="d-flex justify-content-center pb-2 pt-4" style="margin-top: 130px">Bem Vindo ao Pretium</h2>
            <p class="d-flex justify-content-center h5 text-center text-muted pb-2">Já possue uma conta? Faça Login!</p>
            <div class="d-flex justify-content-center">
                <a href="<?= $router->route("web.login"); ?>" class="btn btn-primary btn-lg" style="border-radius: 30px">Login</a>
            </div>
        </div>!-->
        <div class="col-12 col-md-8  p-4 bg-white shadow" style="height:95%; border-radius: 30px">
            <a href="<?= $router->route("web.login"); ?>" title="Voltar" class="link-secondary"><i class="fas fa-arrow-left" style="font-size: 1.3em;"></i></a>
            <h1 class="d-flex justify-content-center pb-3"><?= SITENAME; ?></h1>
            <div class="d-flex justify-content-center form_callback">
                <?= flash(); ?>
            </div>
            <form action="<?= $router->route("web.register"); ?>" method="post">
                
                <span class="text-muted">Seu dados</span>

                <div class="input-group mt-2 mb-2">
                    <input type="text" class="form-control" name="fullName" placeholder="Nome *" required>
                </div>
                <div class="input-group mb-2">
                    <input type="text" class="form-control" name="email" placeholder="E-mail pessoal *" required>
                </div>
                <div class="row mb-2">
                    <div class="col-6">
                        <div class="input-group">
                            <input type="password" class="form-control" name="passwd" placeholder="Senha *" required>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="input-group">
                            <input type="password" class="form-control" name="confirmPasswd" placeholder="Confirmar senha *" required>
                        </div>
                    </div>
                </div>

                <span class="text-muted">Dados da empresa</span>
                <div class="row mt-2">
                    <div class="col-6">
                        <div class="input-group mb-2">
                            <input type="text" class="form-control" name="socialReason" placeholder="Razão Social *"
                                   required>
                            </div>
                    </div>
                    <div class="col-6">
                        <div class="input-group mb-2">
                            <input type="text" class="form-control" id="cnpj" name="cnpj" placeholder="CNPJ *" required>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-2">
                    <input type="text" class="form-control" name="businessEmail" placeholder="E-mail corporativo *" required>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="input-group mb-2">
                            <input type="text" class="form-control" id="phonenumber" name="phoneNumber" placeholder="Telefone *" required>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="input-group mb-2">
                            <input type="text" class="form-control" name="address" placeholder="Endereço *" required>
                        </div>
                    </div>
                </div>
                <!---<div class="row" id="rowClient">
                    <div class="col-6">
                        <div class="input-group mb-2">
                            <input type="text" class="form-control" name="cargo" placeholder="Cargo">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="input-group mb-2">
                            <input type="number" class="form-control" name="ncompradores" placeholder="N° de compradores">
                        </div>
                    </div>
                </div>
                <div class="input-group mb-2">
                    <select name="categoryBusiness" id="categoryBusiness" class="form-control">
                        <option value="">Escolha uma categoria</option>
                        <?php foreach(CATEGORY as $c): ?>
                            <option value="<?= $c; ?>"><?= $c; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>-->

                <span class="d-flex justify-content-end pb-2">(*) CAMPOS OBRIGATORIOS</span>
                <button class="btn btn-primary w-100 " style="border-radius: 30px">Finalizar cadastro</button>
            </form>
        </div>
    </div>
</div>
<!-- Optional JavaScript; choose one of the two! -->

<!-- Option 1: Bootstrap Bundle with Popper -->
<script src="<?= asset("js/bootstrap.bundle.min.js"); ?>"></script>
<script src="<?= asset("js/jquery-3.6.0.min.js"); ?>"></script>
<script src="<?= url("vendor/igorescobar/jquery-mask-plugin/dist/jquery.mask.min.js"); ?>"></script>
<script src="<?= asset("js/form.js"); ?>"></script>

<script>
    $(document).ready(function(){

        $('#phonenumber').mask('(00) 00000-0000');
        $('#cnpj').mask('00.000.000/0000-00', {reverse: true});

        /*$("#categoryBusiness").hide();

        $("#inlineRadio1").change(function(){
            $("#categoryBusiness").hide();
            $("#rowClient").show();
        });
        $("#inlineRadio2").change(function(){
            $("#categoryBusiness").show();
            $("#rowClient").hide();
        });*/
    });
</script>

<!-- Option 2: Separate Popper and Bootstrap JS -->
<!--
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
-->
</body>
</html>