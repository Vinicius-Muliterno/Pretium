<?php

require __DIR__ . "/../../vendor/autoload.php";

session_start();

$requestData = $_REQUEST;

$columns = [
    0 => 'id',
    1 => 'product_name',
];

$user = (new \Source\Models\User())->find("id=:id", "id={$_SESSION['user']}", "provider_id")->fetch();
$recordsTotal = (new \Source\Models\Products())->find("provider_id=:provider_id", "provider_id={$user->provider_id}")->count();

if (!empty($requestData['search']['value'])) {
   // $products = (new \Source\Models\Products())->find("social_reason LIKE '%{$requestData['search']['value']}%' OR cnpj LIKE '%{$requestData['search']['value']}%' OR address LIKE '%{$requestData['search']['value']}%' OR email LIKE '%{$requestData['search']['value']}%' OR phonenumber LIKE '%{$requestData['search']['value']}%'")->limit(intval($requestData['start']))->offset(intval($requestData['length']))->order($columns[$requestData['order'][0]['column']] . " " . $requestData['order'][0]['dir'])->fetch(true);
    //$recordsFiltered = (new \Source\Models\Products())->find("social_reason LIKE '%{$requestData['search']['value']}%' OR cnpj LIKE '%{$requestData['search']['value']}%' OR address LIKE '%{$requestData['search']['value']}%' OR email LIKE '%{$requestData['search']['value']}%' OR phonenumber LIKE '%{$requestData['search']['value']}%'")->count();
} else {
    $products = (new \Source\Models\Products())->find()->limit(intval($requestData['start']))->offset(intval($requestData['length']))->order($columns[$requestData['order'][0]['column']] . " " . $requestData['order'][0]['dir'])->fetch(true);
    $recordsFiltered = $recordsTotal;
}

$dados = [];

if ($products) {
    foreach ($products as $product) {
        $dado = [];
        $dado[] = $product->id;
        $dado[] = $product->product_name;
        $dado[] = $product->measurementUnit()->unity;
        $dado[] = $product->measurementUnit()->symbol;
        $dados[] = $dado;
    }
}

$jsonData = [
    "draw" => intval($requestData['draw']),
    "recordsTotal" => $recordsTotal,
    "recordsFiltered" => $recordsFiltered,
    "data" => $dados,
];

echo json_encode($jsonData);