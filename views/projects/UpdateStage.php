<?php
require_once '../../config/Conexion.php';
require_once '../../models/Project.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $project_id = intval($_POST['project_id']);

    try {
        $result = Project::updateStage($project_id, 'Presentación de tesis');
        if (isset($result['success'])) {
            header("Location: ../dashboard.php");
            exit();
        } else {
            echo $result['error'];
        }
    } catch (PDOException $e) {
        die("Error al actualizar la etapa: " . $e->getMessage());
    }
}
?>