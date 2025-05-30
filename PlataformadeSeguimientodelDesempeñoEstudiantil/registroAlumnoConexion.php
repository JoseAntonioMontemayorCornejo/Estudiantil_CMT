<?php
include("conexion.php"); // Conexión a la base de datos

// Recibir datos del formulario
$nombre = $_POST['nombre'];
$correo = trim($_POST['correo']);
$contrasena = trim($_POST['contrasena']);
$materia_id = $_POST['materia_id'];

// Insertar nuevo alumno en la tabla 'alumnos'
$sql = "INSERT INTO alumnos (nombre, correo, contrasena) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sss", $nombre, $correo, $contrasena);
$stmt->execute();

// Obtener el ID del alumno recién registrado
$alumno_id = $stmt->insert_id;

// Crear una fila en la tabla 'calificaciones' para ese alumno y materia
$sql2 = "INSERT INTO calificaciones (alumno_id, materia_id) VALUES (?, ?)";
$stmt2 = $conn->prepare($sql2);
$stmt2->bind_param("ii", $alumno_id, $materia_id);
$stmt2->execute();

// Confirmación
echo "Alumno registrado con calificaciones iniciales.";
?>



