<?php
class Project {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function save($titulo, $descripcion, $etapa, $colaboradores) {
        $query = "INSERT INTO tesis (titulo, Descripcion, etapa, colaboradores, estado_id) 
                  VALUES (:titulo, :descripcion, :etapa, :colaboradores, 1)"; // Estado '1' sería Propuesta

        $stmt = $this->db->getConnection()->prepare($query);
        $stmt->bindParam(':titulo', $titulo);
        $stmt->bindParam(':descripcion', $descripcion);
        $stmt->bindParam(':etapa', $etapa);
        $stmt->bindParam(':colaboradores', $colaboradores);

        return $stmt->execute();
    }

    // Métodos para obtener, actualizar, y eliminar proyectos
    public function getAll() {
        $query = "SELECT * FROM tesis";
        $stmt = $this->db->getConnection()->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id) {
        $query = "SELECT * FROM tesis WHERE id = :id";
        $stmt = $this->db->getConnection()->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update($id, $titulo, $descripcion, $etapa, $colaboradores) {
        $query = "UPDATE tesis SET titulo = :titulo, Descripcion = :descripcion, etapa = :etapa, colaboradores = :colaboradores 
                  WHERE id = :id";

        $stmt = $this->db->getConnection()->prepare($query);
        $stmt->bindParam(':titulo', $titulo);
        $stmt->bindParam(':descripcion', $descripcion);
        $stmt->bindParam(':etapa', $etapa);
        $stmt->bindParam(':colaboradores', $colaboradores);
        $stmt->bindParam(':id', $id);

        return $stmt->execute();
    }

    public function delete($id) {
        $query = "DELETE FROM tesis WHERE id = :id";
        $stmt = $this->db->getConnection()->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}
?>
