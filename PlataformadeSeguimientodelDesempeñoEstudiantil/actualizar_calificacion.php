
<?php
session_start();

if (!isset($_SESSION['docente_id'])) {
    header("Location: login_docente.php");
    exit();
}

$conexion = new mysqli("localhost", "root", "", "calificaciones_db");

$id = $_POST['id'];
$materia_id = $_POST['materia_id'];
$unidad1 = $_POST['unidad1'];
$unidad2 = $_POST['unidad2'];
$unidad3 = $_POST['unidad3'];
$comentario = $_POST['comentario'];
$comentario_u1 = $_POST['comentario_u1'];
$comentario_u2 = $_POST['comentario_u2'];
$comentario_u3 = $_POST['comentario_u3'];

$promedio = round(($unidad1 + $unidad2 + $unidad3) / 3);

// ✅ Actualiza la calificación incluyendo la materia
$sql = "UPDATE calificaciones SET 
    unidad1 = ?, 
    unidad2 = ?, 
    unidad3 = ?, 
    promedio = ?, 
    comentario = ?, 
    comentario_u1 = ?, 
    comentario_u2 = ?, 
    comentario_u3 = ?, 
    materia_id = ?
WHERE id = ?";

$stmt = $conexion->prepare($sql);
$stmt->bind_param("iiiissssii", 
    $unidad1, $unidad2, $unidad3, $promedio, 
    $comentario, $comentario_u1, $comentario_u2, $comentario_u3, 
    $materia_id, $id
);

if ($stmt->execute()) {
    header("Location: calificacionesDocente.php"); // Redirige de regreso manteniendo la materia seleccionada
    exit();
} else {
    echo "Error al actualizar: " . $stmt->error;
}
?>
