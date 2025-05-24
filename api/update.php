<?php
header("Content-Type: application/json");
include_once "../conf/Database.php";
include_once "../model/Veiculo.php";

$data = json_decode(file_get_contents("php://input"));

$db = (new Database())->getConnection();
$veiculo = new Veiculo($db);

$veiculo->renavam = $data->renavam;
$veiculo->placa = $data->placa;
$veiculo->chassi = $data->chassi;
$veiculo->modelo = $data->modelo;
$veiculo->marca = $data->marca;
$veiculo->ano = $data->ano;

if($veiculo->update()) {
    echo json_encode(["message" => "Veículo atualizado com sucesso."]);
} else {
    echo json_encode(["message" => "Erro ao atualizar veículo."]);
}
