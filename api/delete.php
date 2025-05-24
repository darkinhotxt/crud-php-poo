<?php
header("Content-Type: application/json");
include_once "../conf/Database.php";
include_once "../model/Veiculo.php";

$data = json_decode(file_get_contents("php://input"));

$db = (new Database())->getConnection();
$veiculo = new Veiculo($db);
$veiculo->renavam = $data->renavam;

if($veiculo->delete()) {
    echo json_encode(["message" => "Veículo deletado com sucesso."]);
} else {
    echo json_encode(["message" => "Erro ao deletar veículo."]);
}
