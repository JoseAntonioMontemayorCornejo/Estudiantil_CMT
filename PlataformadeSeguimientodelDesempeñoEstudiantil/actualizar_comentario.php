<?php
include("conexion.php");

$id = $_POST['id'];
$comentario = $_POST['comentario'];

$stmt = $conn->prepare("UPDATE estudiantes SET comentario = ? WHERE id = ?");
$stmt->bind_param("si", $comentario, $id);
$stmt->execute();

echo json_encode(['success' => true]);
?>
