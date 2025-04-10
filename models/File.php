<?php
class File {
    private $file;
    private $uploadDir;
    private $allowedTypes;
    private $maxSize;

    // Constructor para la clase File
    public function __construct($file, $uploadDir = '../public/uploads', $allowedTypes = ['pdf', 'docx', 'mp4', 'avi', 'jpg', 'jpeg', 'png', 'bmp'], $maxSize = 10485760) {
        $this->file = $file;
        $this->uploadDir = $uploadDir;
        $this->allowedTypes = $allowedTypes;
        $this->maxSize = $maxSize;
    }

    // Verifica si el archivo es válido
    public function isValid() {
        // Verificar si no hubo errores en la carga
        if ($this->file['error'] !== UPLOAD_ERR_OK) {
            return false;
        }

        // Verificar el tamaño del archivo
        if ($this->file['size'] > $this->maxSize) {
            return false;
        }

        // Verificar el tipo de archivo
        $fileType = pathinfo($this->file['name'], PATHINFO_EXTENSION);
        if (!in_array(strtolower($fileType), $this->allowedTypes)) {
            return false;
        }

        return true;
    }

    // Mueve el archivo a la carpeta de destino
    public function moveFile() {
        if (!$this->isValid()) {
            return false;
        }

        // Crear la ruta de destino de manera absoluta
        $fileName = basename($this->file['name']);
        $filePath = __DIR__ . '/../public/uploads/' . $fileName;  // Ruta absoluta usando __DIR__

        // Mover el archivo
        if (move_uploaded_file($this->file['tmp_name'], $filePath)) {
            return $filePath;
        }

        return false;
    }

    // Guarda el archivo en la base de datos
    public function saveToDatabase($project_id, $conexion) {
        // Verificar si hay errores en la carga
        if ($this->file['error'] !== UPLOAD_ERR_OK) {
            echo "Error al subir el archivo.";
            return false;
        }

        // Obtener el nombre del archivo y asegurarse de que no haya espacios
        $nombreArchivo = str_replace(' ', '_', $this->file['name']);  // Reemplazar espacios
        $tmp_name = $this->file['tmp_name'];  // Ruta temporal del archivo

        // Usar __DIR__ para obtener la ruta absoluta
        $uploadDir = __DIR__ . '/../public/uploads/';
        $targetFile = $uploadDir . basename($nombreArchivo);  // Ruta completa de destino

        // Verificar que el directorio existe, si no, crearlo
        if (!is_dir($uploadDir)) {
            if (!mkdir($uploadDir, 0777, true)) {
                echo "No se pudo crear el directorio: " . $uploadDir;
                return false;
            }
        }

        // Mover el archivo al directorio deseado
        if (move_uploaded_file($tmp_name, $targetFile)) {
            // Usar PDO para insertar los datos en la base de datos
            try {
                $pdo = $conexion->getConnection();
                $sql = "INSERT INTO files (project_id, file_path) VALUES (?, ?)";
                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(1, $project_id, PDO::PARAM_INT);
                $stmt->bindParam(2, $targetFile, PDO::PARAM_STR);
                return $stmt->execute();
            } catch (PDOException $e) {
                echo "Error al guardar el archivo en la base de datos: " . $e->getMessage();
                return false;
            }
        } else {
            echo "El archivo no se pudo mover al directorio.";
            return false;
        }
    }
}
?>

