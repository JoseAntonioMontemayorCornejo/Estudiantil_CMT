<?php
header('Content-Type: application/json');
include_once(__DIR__ . "/../../includes/conexion.php");

if (!isset($_POST['id'], $_POST['comentario'])) {
    echo json_encode(['success' => false, 'message' => 'Faltan datos.']);
    exit();
}

$id = intval($_POST['id']);
$comentario = trim($_POST['comentario']);

$sql = "UPDATE calificaciones SET comentario = ? WHERE alumno_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("si", $comentario, $id);

if ($stmt->execute()) {
    echo json_encode(['success' => true, 'message' => 'Comentario actualizado.']);
} else {
    echo json_encode(['success' => false, 'message' => 'Error al actualizar.']);
}
?>
