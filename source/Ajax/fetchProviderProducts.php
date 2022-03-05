<?php

require __DIR__ . "/../../vendor/autoload.php";

if (isset($_POST["provider"])) {
    $provider = (new \Source\Models\Provider())->find("social_reason LIKE '%{$_POST["provider"]}%'")->fetch();
    $products = (new \Source\Models\Products())->find("provider_id=:provider_id",
        "provider_id={$provider->id}")->fetch(true);
    ?>
    <label for="providerDataList2" class="form-label">Escolha um produto</label>
    <input class="form-control mb-3" list="providerDatalistOptions2" id="providerDataList2"
           placeholder="Escreva para pesquisar...">
    <datalist id="providerDatalistOptions2">

        <?php
        if ($products):
            foreach ($products as $product): ?>
                <?= "<option value=\"$product->product_name\">$product->product_name</option>"; ?>
            <?php
            endforeach;
        endif; ?>

    </datalist>
    <div class="row">
        <div class="table-responsive">
            <table id="tableProductsNewQuote" class="table">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Descrição</th>
                    <th scope="col">Marca</th>
                    <th scope="col">Qtd</th>
                    <th scope="col">Ações</th>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
    </div>
    <?php
}