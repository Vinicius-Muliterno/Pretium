<?php

require __DIR__ . "/../../vendor/autoload.php";

$requestData = $_REQUEST;

$columns = [
    0 => 'id',
    1 => 'social_reason',
    2 => 'cnpj',
    3 => 'address',
    4 => 'email',
    5 => 'phonenumber',
];

$recordsTotal = (new \Source\Models\Provider())->find()->count();

if (!empty($requestData['search']['value'])) {
    $providers = (new \Source\Models\Provider())->find("social_reason LIKE '%{$requestData['search']['value']}%' OR cnpj LIKE '%{$requestData['search']['value']}%' OR address LIKE '%{$requestData['search']['value']}%' OR email LIKE '%{$requestData['search']['value']}%' OR phonenumber LIKE '%{$requestData['search']['value']}%'")->limit(intval($requestData['start']))->offset(intval($requestData['length']))->order($columns[$requestData['order'][0]['column']] . " " . $requestData['order'][0]['dir'])->fetch(true);
    $recordsFiltered = (new \Source\Models\Provider())->find("social_reason LIKE '%{$requestData['search']['value']}%' OR cnpj LIKE '%{$requestData['search']['value']}%' OR address LIKE '%{$requestData['search']['value']}%' OR email LIKE '%{$requestData['search']['value']}%' OR phonenumber LIKE '%{$requestData['search']['value']}%'")->count();
} else {
    $providers = (new \Source\Models\Provider())->find()->limit(intval($requestData['start']))->offset(intval($requestData['length']))->order($columns[$requestData['order'][0]['column']] . " " . $requestData['order'][0]['dir'])->fetch(true);
    $recordsFiltered = $recordsTotal;
}

$dados = [];

if ($providers) {
    foreach ($providers as $provider) {
        $dado = [];
        $dado[] = $provider->id;
        $dado[] = $provider->social_reason;
        $dado[] = mask('cnpj', $provider->cnpj);
        $dado[] = $provider->address;
        $dado[] = $provider->email;
        $dado[] = mask('telephone', $provider->phonenumber);
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