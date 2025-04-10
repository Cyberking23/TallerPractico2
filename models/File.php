<?php

class Files {
    private $id;
    private $nombre_archivo;
    private $tipo_archivo;
    private $ruta;

    public function __construct($id, $nombre_archivo, $tipo_archivo, $ruta) {
        $this->id = $id;
        $this->nombre_archivo = $nombre_archivo;
        $this->tipo_archivo = $tipo_archivo;
        $this->ruta = $ruta;
    }

    public function getFileInfo() {
        return [
            'id' => $this->id,
            'nombre_archivo' => $this->nombre_archivo,
            'tipo_archivo' => $this->tipo_archivo,
            'ruta' => $this->ruta
        ];
    }

    public function updateFileInfo($nombre_archivo = null, $tipo_archivo = null, $ruta = null) {
        if ($nombre_archivo !== null) {
            $this->nombre_archivo = $nombre_archivo;
        }
        if ($tipo_archivo !== null) {
            $this->tipo_archivo = $tipo_archivo;
        }
        if ($ruta !== null) {
            $this->ruta = $ruta;
        }
    }

    public function deleteFileInfo() {
        echo "Archivo con ID {$this->id} eliminado.\n";
    }
}

?>