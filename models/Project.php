<?php

class Project
{
    public $id;
    public $titulo;
    public $descripcion;
    public $etapa; // Etapa del proyecto (ej. "En progreso", "Finalizado")
    public $id_user_owner; // ID del usuario propietario
    public $files = []; // Lista de archivos asociados

    // Constructor que acepta un array asociativo
    public function __construct($data = [])
    {
        $this->id = $data['id'] ?? null;
        $this->titulo = $data['titulo'] ?? null;
        $this->descripcion = $data['descripcion'] ?? null;
        $this->etapa = $data['etapa'] ?? 'Propuesta de tema'; // Valor predeterminado: "Inicial"
        $this->id_user_owner = $data['id_user_owner'] ?? null;
        $this->files = $data['files'] ?? [];
    }

    // Guardar un nuevo proyecto
    public function save()
    {
        try {
            $query = "INSERT INTO projects (titulo, descripcion, etapa, id_user_owner) 
                      VALUES ('{$this->titulo}', '{$this->descripcion}', '{$this->etapa}', '{$this->id_user_owner}')";
            Conexion::query($query);
            return ["success" => "Proyecto guardado exitosamente."];
        } catch (PDOException $e) {
            return ["error" => "Error al guardar el proyecto: " . $e->getMessage()];
        }
    }

    // Obtener todos los proyectos
    public static function getAll()
    {
        try {
            $query = "SELECT 
                          p.*, 
                          f.id AS file_id, f.nombre_archivo, f.tipo_archivo, f.ruta,
                          u.id AS collaborator_id, u.nombre AS collaborator_name, u.email AS collaborator_email
                      FROM projects p
                      LEFT JOIN files f ON p.id = f.id_project
                      LEFT JOIN project_users pu ON p.id = pu.id_project
                      LEFT JOIN users u ON pu.id_user = u.id";
            $results = Conexion::query_array_assoc($query);
            

            // Agrupar archivos y colaboradores por proyecto
            $projects = [];
            foreach ($results as $row) {
                $project_id = $row['id'];
                if (!isset($projects[$project_id])) {
                    $projects[$project_id] = [
                        'id' => $row['id'],
                        'titulo' => $row['titulo'],
                        'descripcion' => $row['descripcion'],
                        'etapa' => $row['etapa'],
                        'id_user_owner' => $row['id_user_owner'],
                        'files' => [],
                        'collaborators' => []
                    ];
                }

                // Agregar archivo si existe
                if ($row['file_id']) {
                    $projects[$project_id]['files'][] = [
                        'id' => $row['file_id'],
                        'nombre_archivo' => $row['nombre_archivo'],
                        'tipo_archivo' => $row['tipo_archivo'],
                        'ruta' => $row['ruta']
                    ];
                }

                // Agregar colaborador si existe
                if ($row['collaborator_id']) {
                    $projects[$project_id]['collaborators'][] = [
                        'id' => $row['collaborator_id'],
                        'nombre' => $row['collaborator_name'],
                        'email' => $row['collaborator_email']
                    ];
                }
            }

            return array_values($projects); // Retornar como un array indexado
        } catch (PDOException $e) {
            die("Error al obtener los proyectos: " . $e->getMessage());
        }
    }

    // Obtener todos los proyectos de un usuario específico
    public static function getAllByUserId($userId) {
        try {
            $query = "SELECT 
                          p.*, 
                          f.id AS file_id, f.nombre_archivo, f.tipo_archivo, f.ruta,
                          u.id AS collaborator_id, u.nombre AS collaborator_name, u.email AS collaborator_email
                      FROM projects p
                      LEFT JOIN files f ON p.id = f.id_project
                      LEFT JOIN project_users pu ON p.id = pu.id_project
                      LEFT JOIN users u ON pu.id_user = u.id
                      WHERE p.id_user_owner = {$userId} OR pu.id_user = {$userId}";
            $results = Conexion::query_array_assoc($query);
    
            // Agrupar archivos y colaboradores por proyecto
            $projects = [];
            foreach ($results as $row) {
                $project_id = $row['id'];
                if (!isset($projects[$project_id])) {
                    $projects[$project_id] = [
                        'id' => $row['id'],
                        'titulo' => $row['titulo'],
                        'descripcion' => $row['descripcion'],
                        'etapa' => $row['etapa'],
                        'id_user_owner' => $row['id_user_owner'],
                        'files' => [],
                        'collaborators' => []
                    ];
                }
    
                // Agregar archivo si existe
                if ($row['file_id']) {
                    $projects[$project_id]['files'][] = [
                        'id' => $row['file_id'],
                        'nombre_archivo' => $row['nombre_archivo'],
                        'tipo_archivo' => $row['tipo_archivo'],
                        'ruta' => $row['ruta']
                    ];
                }
    
                // Agregar colaborador si existe
                if ($row['collaborator_id']) {
                    // Verificar si el colaborador ya existe en el array
                    $exists = false;
                    foreach ($projects[$project_id]['collaborators'] as $collaborator) {
                        if ($collaborator['id'] === $row['collaborator_id']) {
                            $exists = true;
                            break;
                        }
                    }
                
                    // Si no existe, agregarlo
                    if (!$exists) {
                        $projects[$project_id]['collaborators'][] = [
                            'id' => $row['collaborator_id'],
                            'nombre' => $row['collaborator_name'],
                            'email' => $row['collaborator_email']
                        ];
                    }
                }
            }
    
            return array_values($projects); // Retornar como un array indexado
        } catch (PDOException $e) {
            die("Error al obtener los proyectos: " . $e->getMessage());
        }
    }

    // Obtener un proyecto por ID
    public static function getById($id)
    {
        try {
            $query = "SELECT p.*, 
                             f.id AS file_id, f.nombre_archivo, f.tipo_archivo, f.ruta 
                      FROM projects p
                      LEFT JOIN files f ON p.id = f.id_project
                      WHERE p.id = {$id}";
            $results = Conexion::query_array_assoc($query);

            if (empty($results)) {
                return null; // Retornar null si no hay resultados
            }

            // Construir el proyecto con sus archivos
            $project = [
                'id' => $results[0]['id'],
                'titulo' => $results[0]['titulo'],
                'descripcion' => $results[0]['descripcion'],
                'etapa' => $results[0]['etapa'],
                'id_user_owner' => $results[0]['id_user_owner'],
                'files' => []
            ];

            foreach ($results as $row) {
                if ($row['file_id']) {
                    $project['files'][] = [
                        'id' => $row['file_id'],
                        'nombre_archivo' => $row['nombre_archivo'],
                        'tipo_archivo' => $row['tipo_archivo'],
                        'ruta' => $row['ruta']
                    ];
                }
            }

            return $project;
        } catch (PDOException $e) {
            die("Error al obtener el proyecto: " . $e->getMessage());
        }
    }

    // Actualizar un proyecto
    public function update()
    {
        try {
            $query = "UPDATE projects SET titulo = '{$this->titulo}', descripcion = '{$this->descripcion}', etapa = '{$this->etapa}' 
                      WHERE id = {$this->id}";
            Conexion::query($query);
            return ["success" => "Proyecto actualizado exitosamente."];
        } catch (PDOException $e) {
            return ["error" => "Error al actualizar el proyecto: " . $e->getMessage()];
        }
    }

    // Eliminar un proyecto
    public static function delete($id)
    {
        try {
            $query = "DELETE FROM projects WHERE id = {$id}";
            Conexion::query($query);
            return ["success" => "Proyecto eliminado exitosamente."];
        } catch (PDOException $e) {
            return ["error" => "Error al eliminar el proyecto: " . $e->getMessage()];
        }
    }

    // Obtener el autor del proyecto
    public function getAutor()
    {
        try {
            $query = "SELECT * FROM users WHERE id = {$this->id_user_owner}";
            $result = Conexion::query($query);
            return $result[0] ?? null; // Retorna el autor o null si no existe
        } catch (PDOException $e) {
            die("Error al obtener el autor del proyecto: " . $e->getMessage());
        }
    }

    // Obtener los estudiantes asociados al proyecto
    public function getEstudiantes()
    {
        try {
            $query = "SELECT u.* FROM users u 
                      INNER JOIN project_users pu ON u.id = pu.id_user 
                      WHERE pu.id_project = {$this->id}";
            return Conexion::query($query);
        } catch (PDOException $e) {
            die("Error al obtener los estudiantes del proyecto: " . $e->getMessage());
        }
    }

    // Agregar un estudiante al proyecto
    public function agregarEstudiante($userId)
    {
        try {
            $query = "INSERT INTO project_users (id_user, id_project) VALUES ({$userId}, {$this->id})";
            Conexion::query($query);
            return ["success" => "Estudiante agregado exitosamente al proyecto."];
        } catch (PDOException $e) {
            return ["error" => "Error al agregar el estudiante al proyecto: " . $e->getMessage()];
        }
    }

    // Obtener los archivos asociados al proyecto
    public function getFiles()
    {
        try {
            $query = "SELECT * FROM files WHERE id_project = {$this->id}";
            return Conexion::query($query);
        } catch (PDOException $e) {
            die("Error al obtener los archivos del proyecto: " . $e->getMessage());
        }
    }

    // Agregar un archivo al proyecto
    public function agregarArchivo($nombreArchivo, $tipoArchivo, $ruta)
    {
        try {
            $query = "INSERT INTO files (nombre_archivo, id_project, tipo_archivo, ruta) 
                      VALUES ('{$nombreArchivo}', {$this->id}, '{$tipoArchivo}', '{$ruta}')";
            Conexion::query($query);
            return ["success" => "Archivo agregado exitosamente al proyecto."];
        } catch (PDOException $e) {
            return ["error" => "Error al agregar el archivo al proyecto: " . $e->getMessage()];
        }
    }

    // Agregar un colaborador al proyecto
    public static function addCollaborator($project_id, $collaborator_id)
    {
        try {
            // Validar que el colaborador sea un estudiante
            $query = "SELECT * FROM users WHERE id = {$collaborator_id} AND rol = 'estudiante'";
            $result = Conexion::query($query);

            if (empty($result)) {
                return ["error" => "El colaborador no es un estudiante válido."];
            }

            // Insertar el colaborador en la tabla project_users
            $query = "INSERT INTO project_users (id_project, id_user) VALUES ({$project_id}, {$collaborator_id})";
            Conexion::query($query);

            return ["success" => "Colaborador agregado exitosamente."];
        } catch (PDOException $e) {
            return ["error" => "Error al agregar colaborador: " . $e->getMessage()];
        }
    }

    // Agregar un archivo al proyecto (método estático)
    public static function addFile($project_id, $file_name, $file_type, $file_path)
    {
        try {
            $query = "INSERT INTO files (id_project, nombre_archivo, tipo_archivo, ruta) 
                      VALUES ({$project_id}, '{$file_name}', '{$file_type}', '{$file_path}')";
            Conexion::query($query);
            return ["success" => "Archivo agregado exitosamente."];
        } catch (PDOException $e) {
            return ["error" => "Error al agregar archivo: " . $e->getMessage()];
        }
    }
    public static function deleteFile($file_id) {
        try {
            // Eliminar el archivo de la base de datos
            $query = "DELETE FROM files WHERE id = {$file_id}";
            Conexion::query($query);
            return ["success" => "Archivo eliminado exitosamente."];
        } catch (PDOException $e) {
            return ["error" => "Error al eliminar el archivo: " . $e->getMessage()];
        }
    }

    public static function deleteCollaborator($project_id, $user_id) {
        try {
            $query = "DELETE FROM project_users WHERE id_project = {$project_id} AND id_user = {$user_id}";
            Conexion::query($query);
            return ["success" => "Colaborador eliminado exitosamente."];
        } catch (PDOException $e) {
            return ["error" => "Error al eliminar el colaborador: " . $e->getMessage()];
        }
    }

    public static function updateStage($project_id, $new_stage) {
        try {
            $query = "UPDATE projects SET etapa = '{$new_stage}' WHERE id = {$project_id}";
            Conexion::query($query);
            return ["success" => "Etapa actualizada exitosamente."];
        } catch (PDOException $e) {
            return ["error" => "Error al actualizar la etapa: " . $e->getMessage()];
        }
    }
}
