<?php

require __DIR__ . "/../../vendor/autoload.php";

use Source\Models\Products;

if(isset($_POST['id'])){

    $product = (new Products())->findById($_POST['id']);
    $product->destroy();
}