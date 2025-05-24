<?php 
class Database {
    // Propriedades privadas com as informações da conexão
    private $host = "localhost";       // Onde está o banco (geralmente "localhost")
    private $db_name = "db_veiculos"; // Nome do banco de dados
    private $username = "root";        // Nome de usuário do MySQL
    private $password = "";            // Senha do MySQL (vazia no XAMPP por padrão)
    public $conn;                      // Aqui vamos guardar a conexão ativa

    // Função pública para obter a conexão
    public function getConnection() {
        $this->conn = null;  // Inicializa a variável como nula

        try {
            // Tenta criar uma nova conexão PDO
            $this->conn = new PDO(
                "mysql:host=" . $this->host . ";dbname=" . $this->db_name,  // URL de conexão
                $this->username,
                $this->password
            );
            // Define o charset para UTF-8 (suporte a acentos)
            $this->conn->exec("set names utf8");
        } catch(PDOException $exception) {
            // Se der erro, mostra mensagem (evite mostrar isso em produção!)
            echo "Erro de conexão: " . $exception->getMessage();
        }

        return $this->conn; // Retorna a conexão para ser usada em outros arquivos
    }
}