<?php

class Projects {
    private $id;
    private $titulo;
    private $descripcion;
    private $autor; 
    private $estudiantes = []; 
    private $files = [];
    public function __construct($id, $titulo, $descripcion, $autor) {
        $this->id = $id;
        $this->titulo = $titulo;
        $this->descripcion = $descripcion;
        $this->autor = $autor;
    }

    public function getAutor() {
        return $this->autor;
    }

    public function getEstudiantes() {
        return $this->estudiantes;
    }

    public function getFiles() {
        return $this->files;
    }
    
    public function agregarEstudiante($estudianteId) {
        $this->estudiantes[] = $estudianteId;
    }


    public function agregarArchivo($fileId) {
        $this->files[] = $fileId;
    }

    public function getProjectInfo() {
        return [
            'id' => $this->id,
            'titulo' => $this->titulo,
            'descripcion' => $this->descripcion,
            'autor' => $this->autor,
            'estudiantes' => $this->estudiantes,
            'files' => $this->files
        ];
    }

    public function updateProject($titulo = null, $descripcion = null, $autor = null, $estudiantes = null, $files = null) {
        if ($titulo !== null) {
            $this->titulo = $titulo;
        }
        if ($descripcion !== null) {
            $this->descripcion = $descripcion;
        }
        if ($autor !== null) {
            $this->autor = $autor;
        }
        if ($estudiantes !== null && is_array($estudiantes)) {
            $this->estudiantes = $estudiantes;
        }
        if ($files !== null && is_array($files)) {
            $this->files = $files;
        }
    }

    public function deleteProject() {
        echo "Proyecto con ID {$this->id} eliminado.\n";
    }
}

?>