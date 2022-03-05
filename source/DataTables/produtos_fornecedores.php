<?php

require __DIR__ . "/../../vendor/autoload.php";

$requestData = $_REQUEST;

$columns = [
    0 => 'product_name',
];

$recordsTotal = (new \Source\Models\Products())->find()->count();

if (!empty($requestData['search']['value'])) {
    //$Products = (new \Source\Models\Products())->find("social_reason LIKE '%{$requestData['search']['value']}%' OR cnpj LIKE '%{$requestData['search']['value']}%' OR address LIKE '%{$requestData['search']['value']}%' OR email LIKE '%{$requestData['search']['value']}%' OR phonenumber LIKE '%{$requestData['search']['value']}%'")->limit(intval($requestData['start']))->offset(intval($requestData['length']))->order($columns[$requestData['order'][0]['column']] . " " . $requestData['order'][0]['dir'])->fetch(true);
    //$recordsFiltered = (new \Source\Models\Products())->find("social_reason LIKE '%{$requestData['search']['value']}%' OR cnpj LIKE '%{$requestData['search']['value']}%' OR address LIKE '%{$requestData['search']['value']}%' OR email LIKE '%{$requestData['search']['value']}%' OR phonenumber LIKE '%{$requestData['search']['value']}%'")->count();
} else {
    $Products = (new \Source\Models\Products())->find()->limit(intval($requestData['start']))->offset(intval($requestData['length']))->order($columns[$requestData['order'][0]['column']] . " " . $requestData['order'][0]['dir'])->fetch(true);
    $recordsFiltered = $recordsTotal;
}

$dados = [];

if ($Products) {
    foreach ($Products as $product) {
        $dado = [];
        $dado[] = $product->product_name;
        $dado[] = "{$product->measurementUnit()->unity} ({$product->measurementUnit()->symbol})";
        $dado[] = "{$product->provider()->social_reason}";
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