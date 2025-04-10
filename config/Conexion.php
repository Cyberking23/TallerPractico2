<?php

class Conexion {
    private $host = 'localhost';
    private $db_user = 'root';
    private $db_pass = 'root';
    private $db_port = '3306';
    private $db_name = 'sistema_tesis';
    private $pdo;

    public function __construct() {
        try {
            $dsn = "mysql:host=$this->host;port=$this->db_port;dbname=$this->db_name;charset=utf8";
            $this->pdo = new PDO($dsn, $this->db_user, $this->db_pass);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Error de conexión a la base de datos: " . $e->getMessage());
        }
    }

    public function getConnection() {
        return $this->pdo;
    }
}

?>