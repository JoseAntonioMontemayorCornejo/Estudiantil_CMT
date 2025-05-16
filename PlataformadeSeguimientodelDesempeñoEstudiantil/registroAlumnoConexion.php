<?php
include("conexion.php");

$nombre = $_POST['nombre'];
$correo = $_POST['correo'];
$contrasena = password_hash($_POST['contrasena'], PASSWORD_DEFAULT);
$semestre = $_POST['semestre'];
$curso = $_POST['curso'];

// Insertar alumno
$sql = "INSERT INTO alumnos (nombre, correo, contrasena, semestre, curso) VALUES (?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sssii", $nombre, $correo, $contrasena, $semestre, $curso);
$stmt->execute();

$alumno_id = $stmt->insert_id;

// Insertar en calificaciones
$sql2 = "INSERT INTO calificaciones (alumno_id) VALUES (?)";
$stmt2 = $conn->prepare($sql2);
$stmt2->bind_param("i", $alumno_id);
$stmt2->execute();

echo "Alumno registrado con calificaciones iniciales.";
?>


