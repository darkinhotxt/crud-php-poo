<?php
header("Content-Type: application/json");
include_once "../conf/Database.php";
include_once "../model/Veiculo.php";

$db = (new Database())->getConnection();
$veiculo = new Veiculo($db);

$stmt = $veiculo->read();
$veiculos = [];

while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    extract($row);
    $veiculos[] = compact("renavam", "placa", "chassi", "modelo", "marca", "ano");
}

echo json_encode($veiculos);
