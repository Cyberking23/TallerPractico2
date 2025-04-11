<?php

class Escuela {
    public $id;
    public $nombre;

    // Constructor que acepta un array asociativo
    public function __construct($data = []) {
        $this->id = $data['id'] ?? null;
        $this->nombre = $data['nombre'] ?? null;
    }

    // Crear una nueva escuela
    public function save() {
        try {
            $query = "INSERT INTO escuelas (nombre) VALUES ('{$this->nombre}')";
            Conexion::query($query);
            return ["success" => "Escuela creada exitosamente."];
        } catch (PDOException $e) {
            return ["error" => "Error al crear la escuela: " . $e->getMessage()];
        }
    }

    // Obtener todas las escuelas
    public static function getAll() {
        try {
            $query = "SELECT * FROM escuelas";
            return Conexion::query_array_assoc($query);
        } catch (PDOException $e) {
            die("Error al obtener las escuelas: " . $e->getMessage());
        }
    }

    // Obtener una escuela por ID
    public static function getById($id) {
        try {
            $query = "SELECT * FROM escuelas WHERE id = {$id}";
            $result = Conexion::query_array_assoc($query);
            return $result[0] ?? null; // Retorna el primer resultado o null si no hay resultados
        } catch (PDOException $e) {
            die("Error al obtener la escuela: " . $e->getMessage());
        }
    }
}
?>