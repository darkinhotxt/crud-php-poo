<?php
class Veiculo {
    private $conn;
    private $table = "veiculos";

    public $renavam;
    public $placa;
    public $chassi;
    public $modelo;
    public $marca;
    public $ano;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function create() {
        $query = "INSERT INTO " . $this->table . " 
                  SET renavam=:renavam, placa=:placa, chassi=:chassi, modelo=:modelo, marca=:marca, ano=:ano";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":renavam", $this->renavam);
        $stmt->bindParam(":placa", $this->placa);
        $stmt->bindParam(":chassi", $this->chassi);
        $stmt->bindParam(":modelo", $this->modelo);
        $stmt->bindParam(":marca", $this->marca);
        $stmt->bindParam(":ano", $this->ano);

        return $stmt->execute();
    }

    public function read() {
        $query = "SELECT * FROM " . $this->table . " ORDER BY ano DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function update() {
        $query = "UPDATE " . $this->table . "
                  SET placa=:placa, chassi=:chassi, modelo=:modelo, marca=:marca, ano=:ano
                  WHERE renavam=:renavam";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":renavam", $this->renavam);
        $stmt->bindParam(":placa", $this->placa);
        $stmt->bindParam(":chassi", $this->chassi);
        $stmt->bindParam(":modelo", $this->modelo);
        $stmt->bindParam(":marca", $this->marca);
        $stmt->bindParam(":ano", $this->ano);

        return $stmt->execute();
    }

    public function delete() {
        $query = "DELETE FROM " . $this->table . " WHERE renavam = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->renavam);
        return $stmt->execute();
    }
}
