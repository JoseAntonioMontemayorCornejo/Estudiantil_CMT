<?php
session_start();
$conexion = new mysqli("localhost", "root", "", "calificaciones_db");

if (!isset($_SESSION['docente_id'])) {
    http_response_code(401);
    echo json_encode(["error" => "No autorizado"]);
    exit;
}

$docente_id = $_SESSION['docente_id'];

$sql = "SELECT m.id, m.nombre
        FROM materias m
        JOIN docente_materia dm ON m.id = dm.materia_id
        WHERE dm.docente_id = ?";

$stmt = $conexion->prepare($sql);
$stmt->bind_param("i", $docente_id);
$stmt->execute();
$result = $stmt->get_result();

$materias = [];
while ($row = $result->fetch_assoc()) {
    $materias[] = $row;
}

header('Content-Type: application/json');
echo json_encode($materias);
?>
