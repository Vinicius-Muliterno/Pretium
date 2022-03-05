<?php

require __DIR__ . "/../../vendor/autoload.php";

use Source\Models\Quotes;

if (isset($_POST['id'])) {

    $quote = (new Quotes())->findById($_POST['id']);
    $user = (new \Source\Models\User())->findById($quote->user_id);
    $provider = (new \Source\Models\Provider())->findById($quote->provider_id);
    $status = (new \Source\Models\Status())->findById($quote->status_id);
}
?>

<div class="row mb-3">
    <div class="col-6">
        <label for="">Data de abertura</label>
        <input type="date" class="form-control" value="<?= substr($quote->created_at, 0, 10); ?>" disabled>
    </div>
    <div class="col-6">
        <label for="">Data de fechamento</label>
        <input type="date" class="form-control"
               value="<?= substr($quote->closure_at, 0, 10); ?>" disabled>
    </div>
</div>

<label for="">Fornecedor</label>
<input type="text" class="form-control"
       value="<?= $provider->social_reason; ?>" disabled>

<p class="my-2">Status: <span class="text-info"><?= $status->name; ?></span></p>

<div class="row mt-3">
    <div class="table-responsive">
        <table id="tableProductsQuote" class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Descrição</th>
                <th scope="col">Marca</th>
                <th scope="col">Qtd</th>
            </thead>
            <tbody>
            <?php
            $products = (new \Source\Models\QuoteProduct())->find("quote_id={$quote->id}")->fetch(true);
            foreach ($products as $product): ?>
                <tr>
                    <th scope='row'>#</th>
                    <td class="w-50"><?= $product->product()->product_name; ?></td>
                    <td><?= $product->product()->brand; ?></td>
                    <td><?= $product->qtd; ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>