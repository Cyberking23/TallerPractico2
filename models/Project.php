<?php

    class Project {
        public $db;
        public $id;
        public $titulo;
        public $descripcion;
        public $etapa;
        public $colaboradores;
        public $archivo;
    
        public function __construct($titulo, $descripcion, $etapa, $colaboradores, $archivo = null, $id = null) {
            $conexion = new Conexion();
            $this->db = $conexion->getConnection();
            $this->titulo = $titulo;
            $this->descripcion = $descripcion;
            $this->etapa = $etapa;
            $this->colaboradores = $colaboradores;
            $this->archivo = $archivo;
            $this->id = $id;
        }
    
        public function create() {
            if ($this->archivo && !$this->isValidFile($this->archivo)) {
                throw new Exception("Archivo no válido.");
            }
    
            $archivoData = $this->getFileData($this->archivo); // Obtener los datos del archivo en binario
    
            try {
                $sql = "INSERT INTO tesis (titulo, resumen, etapa, colaboradores, archivo) 
                        VALUES (:titulo, :descripcion, :etapa, :colaboradores, :archivo)";
                $stmt = $this->db->prepare($sql);
                $stmt->bindParam(':titulo', $this->titulo);
                $stmt->bindParam(':descripcion', $this->descripcion);
                $stmt->bindParam(':etapa', $this->etapa);
                $stmt->bindParam(':colaboradores', $this->colaboradores);
                $stmt->bindParam(':archivo', $archivoData, PDO::PARAM_LOB); // Pasar el archivo como BLOB
                return $stmt->execute();
            } catch (Exception $e) {
                return "Error: " . $e->getMessage();
            }
        }
    
        public function getFileData($file) {
            // Lee el archivo y retorna los datos binarios
            if (!file_exists($file['tmp_name'])) {
                throw new Exception("El archivo no existe.");
            }
    
            $fileContent = file_get_contents($file['tmp_name']); // Lee el contenido binario del archivo
            return $fileContent;
        }
    
        public function isValidFile($file) {
            $allowedExtensions = ['pdf', 'doc', 'docx', 'mp4', 'avi', 'jpg', 'jpeg', 'png', 'bmp', 'tiff', 'webp'];
            $fileExtension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
    
            return in_array($fileExtension, $allowedExtensions) && $fileExtension !== 'gif';
        }
    
        // Otros métodos...
    }
    

?>
