<?php $v->layout("theme"); ?>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Dashboard</h1>
</div>
<h2>Olá, <?= $user->username; ?></h2>

<h3 class="mt-4">Informações sobre sua empresa:</h3>
<h6><?= $user->provider()->social_reason; ?></h6>
<h6>CNPJ: <?= mask("cnpj", $user->provider()->cnpj); ?></h6>
<h6>Endereço: <?= $user->provider()->address; ?></h6>
<h3>Contatos:</h3>
<h6>Email: <?= $user->provider()->email; ?></h6>
<h6>Telefone: <?= mask("telephone", $user->provider()->phonenumber); ?></h6>