<?php
$conexion = new mysqli("localhost", "root", "", "calificaciones_db");

$id = $_POST['id'];
$u1 = $_POST['unidad1'];
$u2 = $_POST['unidad2'];
$u3 = $_POST['unidad3'];
$comentario = $_POST['comentario'];
$comentario_u1 = $_POST['comentario_u1'];
$comentario_u2 = $_POST['comentario_u2'];
$comentario_u3 = $_POST['comentario_u3'];

$promedio = round(($u1 + $u2 + $u3) / 3);

$sql = "UPDATE calificaciones 
        SET unidad1 = ?, unidad2 = ?, unidad3 = ?, promedio = ?, comentario = ?, 
            comentario_u1 = ?, comentario_u2 = ?, comentario_u3 = ?
        WHERE alumno_id = ?";

$stmt = $conexion->prepare($sql);
$stmt->bind_param("iiisssssi", $u1, $u2, $u3, $promedio, $comentario,
                                $comentario_u1, $comentario_u2, $comentario_u3, $id);
$stmt->execute();

header("Location: calificacionesDocente.php");
?>

