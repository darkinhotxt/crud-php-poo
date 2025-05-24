<?php
require_once '../conf/Database.php';
require_once '../model/Veiculo.php';

// Cabeçalhos
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Content-Type: application/json; charset=UTF-8");

// Conexão
$database = new Database();
$conn = $database->getConnection();

// Recebe os dados do JSON enviado
$data = json_decode(file_get_contents("php://input"));

// Validação básica de campos obrigatórios
if (
    empty($data->renavam) ||
    empty($data->placa) ||
    empty($data->chassi) ||
    empty($data->modelo) ||
    empty($data->marca) ||
    empty($data->ano)
) {
    http_response_code(400); // Requisição malformada
    echo json_encode(["message" => "Todos os campos são obrigatórios."]);
    exit;
}

// Verifica se renavam, placa ou chassi já existem
$verificaSql = "SELECT id FROM veiculos 
                WHERE renavam = :renavam 
                   OR placa = :placa 
                   OR chassi = :chassi
                LIMIT 1";

$stmt = $conn->prepare($verificaSql);
$stmt->execute([
    ":renavam" => $data->renavam,
    ":placa" => $data->placa,
    ":chassi" => $data->chassi
]);

if ($stmt->rowCount() > 0) {
    http_response_code(409); // Conflito
    echo json_encode(["message" => "Veículo com mesmo RENAVAM, placa ou chassi já cadastrado."]);
    exit;
}

// Continua com o cadastro
$veiculo = new Veiculo($conn);
$veiculo->renavam = $data->renavam;
$veiculo->placa = $data->placa;
$veiculo->chassi = $data->chassi;
$veiculo->modelo = $data->modelo;
$veiculo->marca = $data->marca;
$veiculo->ano = $data->ano;

if ($veiculo->create()) {
    http_response_code(201); // Criado
    echo json_encode(["message" => "Veículo cadastrado com sucesso."]);
} else {
    http_response_code(500); // Erro interno
    echo json_encode(["message" => "Erro ao cadastrar o veículo."]);
}
