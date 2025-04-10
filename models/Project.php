<?php

class Project {
    public $db;
    public $id;
    public $titulo;
    public $descripcion;
    public $etapa;
    public $colaboradores;
    public $archivo;

    // Constructor para la clase Project
    public function __construct($titulo, $descripcion, $etapa, $colaboradores, $archivo = null, $id = null) {
        // Crear una instancia de la clase Conexion (o inyectar la conexión si es necesario)
        $conexion = new Conexion();
        $this->db = $conexion->getConnection(); // Obtener la conexión
        $this->titulo = $titulo;
        $this->descripcion = $descripcion;
        $this->etapa = $etapa;
        $this->colaboradores = $colaboradores;
        $this->archivo = $archivo;
        $this->id = $id;
    }

    // Crear proyecto
    public function create() {
        if ($this->archivo && !$this->isValidFile($this->archivo)) {
            throw new Exception("Archivo no válido.");
        }

        $archivo_binario = $this->archivo ? $this->getFileBinary($this->archivo) : null;

        // Insertar en la base de datos
        try {
            $sql = "INSERT INTO tesis (titulo, resumen, etapa, colaboradores, archivo) 
                    VALUES (:titulo, :descripcion, :etapa, :colaboradores, :archivo)";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':titulo', $this->titulo);
            $stmt->bindParam(':descripcion', $this->descripcion);
            $stmt->bindParam(':etapa', $this->etapa);
            $stmt->bindParam(':colaboradores', $this->colaboradores);
            $stmt->bindParam(':archivo', $archivo_binario, PDO::PARAM_LOB); 
            return $stmt->execute();
        } catch (Exception $e) {
            return "Error: " . $e->getMessage();
        }
    }

    // Verificar si el archivo es válido (por ejemplo, solo permitir PDFs o imágenes)
    public function isValidFile($file) {
        $allowedExtensions = ['pdf', 'jpg', 'png'];
        $fileExtension = pathinfo($file['name'], PATHINFO_EXTENSION);
        return in_array(strtolower($fileExtension), $allowedExtensions);
    }

    // Obtener todos los proyectos
    public function getAll() {
        $sql = "SELECT * FROM tesis";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Obtener un proyecto por su ID
    public function getById($id) {
        $sql = "SELECT * FROM tesis WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Actualizar proyecto
    public function update() {
        // Si se subió un nuevo archivo, actualizar
        $archivo_binario = $this->archivo ? $this->getFileBinary($this->archivo) : $this->getArchivoById($this->id);

        try {
            $sql = "UPDATE tesis 
                    SET titulo = :titulo, resumen = :descripcion, etapa = :etapa, colaboradores = :colaboradores, archivo = :archivo 
                    WHERE id = :id";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':id', $this->id);
            $stmt->bindParam(':titulo', $this->titulo);
            $stmt->bindParam(':descripcion', $this->descripcion);
            $stmt->bindParam(':etapa', $this->etapa);
            $stmt->bindParam(':colaboradores', $this->colaboradores);
            $stmt->bindParam(':archivo', $archivo_binario, PDO::PARAM_LOB); // Guardamos el archivo como BLOB
            return $stmt->execute();
        } catch (Exception $e) {
            // Manejar errores de base de datos
            return "Error: " . $e->getMessage();
        }
    }

    // Eliminar proyecto
    public function delete() {
        try {
            $sql = "DELETE FROM tesis WHERE id = :id";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':id', $this->id);
            return $stmt->execute();
        } catch (Exception $e) {
            // Manejar errores de base de datos
            return "Error: " . $e->getMessage();
        }
    }

    // Obtener el archivo binario
    public function getFileBinary($file) {
        // Abrimos el archivo y lo leemos en formato binario
        return file_get_contents($file["tmp_name"]);
    }

    // Obtener archivo de un proyecto por ID
    public function getArchivoById($id) {
        $sql = "SELECT archivo FROM tesis WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result ? $result['archivo'] : null;
    }
}

?>
