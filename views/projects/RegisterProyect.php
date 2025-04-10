<?php
include '../../config/Conexion.php';
require_once '../../models/Project.php';  

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recoger los datos del formulario
    $titulo = trim($_POST['titulo']);
    $descripcion = trim($_POST['descripcion']);
    $etapa = trim($_POST['etapa']);
    $colaboradores = isset($_POST['colaboradores']) ? trim($_POST['colaboradores']) : '';

    if (empty($titulo) || empty($descripcion) || empty($etapa)) {
        echo "Todos los campos son obligatorios.";
        exit;
    }

    $conexion = new Conexion(); 

 
    $project = new Project($conexion);  

    $result = $project->save($titulo, $descripcion, $etapa, $colaboradores);

    // Verificar el resultado de la operación
    if ($result) {
        echo "Proyecto registrado con éxito. Redirigiendo...";
        // Esperar 3 segundos antes de redirigir a otra página
        header("refresh:3;url=/views/dashboard.php"); 
    } else {
        echo "Hubo un error al registrar el proyecto.";
    }
    exit;
}
?>
