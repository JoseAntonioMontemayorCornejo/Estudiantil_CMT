<?php
include("conexion.php");
session_start();

$correo = $_POST['correo'];
$contrasena = $_POST['contrasena'];

// Buscar docente por correo
$sql = "SELECT * FROM docentes WHERE correo = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $correo);
$stmt->execute();
$resultado = $stmt->get_result();

if ($resultado->num_rows === 1) {
    $usuario = $resultado->fetch_assoc();

    // Verificar contraseña encriptada
    if (password_verify($contrasena, $usuario['contrasena'])) {
        $_SESSION['docente_id'] = $usuario['id'];
        $_SESSION['nombre'] = $usuario['nombre'];
        header("Location: calificacionesDocente.php");
        exit();
    } else {
        echo "Contraseña incorrecta.";
    }
} else {
    echo "Correo no encontrado.";
}
?>
