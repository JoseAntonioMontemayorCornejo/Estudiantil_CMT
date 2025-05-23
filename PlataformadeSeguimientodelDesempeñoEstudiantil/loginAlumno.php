<?php
include("conexion.php");

$correo = $_POST['correo'];
$contrasena = $_POST['contrasena'];

// Buscar alumno por correo
$sql = "SELECT * FROM alumnos WHERE correo = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $correo);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $alumno = $result->fetch_assoc();

    // Verifica la contraseña SIN encriptar (texto plano)
    if ($contrasena === $alumno['contrasena']) {
        // Iniciar sesión
        session_start();
        $_SESSION['alumno_id'] = $alumno['id'];
        $_SESSION['nombre'] = $alumno['nombre'];

        // Redireccionar al panel del alumno
        header("Location: CalificacionesAlumno.php");
        exit();
    } else {
        echo "Contraseña incorrecta.";
    }
} else {
    echo "Correo no registrado.";
}
?>
