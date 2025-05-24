<?php
header("Location: front-end/index.html");
exit;
header("Content-Type: application/json");

echo json_encode([
    "status" => "API de Veículos Online",
    "endpoints" => [
        "GET /api/read.php" => "Lista todos os veículos",
        "POST /api/create.php" => "Cadastra um novo veículo",
        "PUT /api/update.php" => "Atualiza um veículo existente",
        "DELETE /api/delete.php" => "Exclui um veículo",
    ]
]);
