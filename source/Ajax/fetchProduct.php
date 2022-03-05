<?php

require __DIR__ . "/../../vendor/autoload.php";

use Source\Models\Products;

if(isset($_POST['id'])){

    $product = (new Products())->findById($_POST['id']);
    echo json_encode([
        "product_name" => $product->product_name,
        "brand" => $product->brand,
        "code" => $product->code,
        "measurement_unit" => $product->measurement_units_id,
    ]);
}