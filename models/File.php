<?php  

class File {
    // Agregar un archivo al proyecto
    public static function addFile($project_id, $file_name, $file_type, $file_path) {
        try {
            $query = "INSERT INTO files (id_project, nombre_archivo, tipo_archivo, ruta) 
                      VALUES ({$project_id}, '{$file_name}', '{$file_type}', '{$file_path}')";
            Conexion::query($query);
            return ["success" => "Archivo agregado exitosamente."];
        } catch (PDOException $e) {
            return ["error" => "Error al agregar archivo: " . $e->getMessage()];
        }
    }

    // Eliminar un archivo por ID
    public static function deleteFile($file_id) {
        try {
            $query = "DELETE FROM files WHERE id = {$file_id}";
            Conexion::query($query);
            return ["success" => "Archivo eliminado exitosamente."];
        } catch (PDOException $e) {
            return ["error" => "Error al eliminar el archivo: " . $e->getMessage()];
        }
    }
}
?>