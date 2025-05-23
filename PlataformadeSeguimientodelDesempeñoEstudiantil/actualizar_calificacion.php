<?php
header('Content-Type: application/json');
include("conexion.php");

// Validar datos
if (!isset($_POST['id'], $_POST['unidad'], $_POST['nota'])) {
    echo json_encode(['success' => false, 'message' => 'Datos incompletos.']);
    exit();
}

$alumnoId = intval($_POST['id']);
$unidad = intval($_POST['unidad']);
$nota = intval($_POST['nota']);
$comentario = isset($_POST['comentario']) ? $_POST['comentario'] : null;

// Determinar unidad
$columnaUnidad = match($unidad) {
    1 => 'unidad1',
    2 => 'unidad2',
    3 => 'unidad3',
    default => null
};

if (!$columnaUnidad) {
    echo json_encode(['success' => false, 'message' => 'Unidad inválida.']);
    exit();
}

// Actualizar unidad
$stmt = $conn->prepare("UPDATE calificaciones SET $columnaUnidad = ? WHERE alumno_id = ?");
$stmt->bind_param("ii", $nota, $alumnoId);
$ok1 = $stmt->execute();

// Actualizar comentario si viene
$ok2 = true;
if (!is_null($comentario) && $comentario !== "") {
    $stmt = $conn->prepare("UPDATE calificaciones SET comentario = ? WHERE alumno_id = ?");
    $stmt->bind_param("si", $comentario, $alumnoId);
    $ok2 = $stmt->execute();
}

// Recalcular promedio
$stmt = $conn->prepare("SELECT unidad1, unidad2, unidad3 FROM calificaciones WHERE alumno_id = ?");
$stmt->bind_param("i", $alumnoId);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

$promedio = round(($row['unidad1'] + $row['unidad2'] + $row['unidad3']) / 3);

// Actualizar promedio
$stmt = $conn->prepare("UPDATE calificaciones SET promedio = ? WHERE alumno_id = ?");
$stmt->bind_param("ii", $promedio, $alumnoId);
$ok3 = $stmt->execute();

if ($ok1 && $ok2 && $ok3) {
    echo json_encode(['success' => true, 'message' => 'Calificación actualizada correctamente.']);
} else {
    echo json_encode(['success' => false, 'message' => 'Error al actualizar.']);
}
?>
