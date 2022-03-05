<?php

require __DIR__ . "/../../vendor/autoload.php";

if (isset($_POST["provider"]) && isset($_POST["product_name"])) {

    $provider = (new \Source\Models\Provider())->find("social_reason LIKE '%{$_POST["provider"]}%'")->fetch();
    $product = (new \Source\Models\Products())->find("provider_id=:provider_id AND product_name=:product_name",
        "provider_id={$provider->id}&product_name={$_POST["product_name"]}")->fetch();

    echo json_encode([
        "product_name" => $product->product_name,
        "brand" => $product->brand
    ]);
}