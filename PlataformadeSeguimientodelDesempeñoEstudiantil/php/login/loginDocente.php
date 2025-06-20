<?php
include_once(__DIR__ . "/../../includes/Conexion.php");
session_start();

header('Content-Type: application/json');

$correo = trim($_POST['correo']);
$contrasena = trim($_POST['contrasena']);

// Buscar docente por correo
$sql = "SELECT * FROM docentes WHERE correo = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $correo);
$stmt->execute();
$resultado = $stmt->get_result();

if ($resultado->num_rows === 1) {
    $usuario = $resultado->fetch_assoc();

    if ($contrasena === $usuario['contrasena']) {
        $_SESSION['docente_id'] = $usuario['id'];
        $_SESSION['nombre'] = $usuario['nombre'];

        echo json_encode([
            'success' => true,
            'redirect' => '../php/calificaciones/calificacionesDocente.php'
        ]);
    } else {
        echo json_encode([
            'success' => false,
            'message' => 'Contraseña incorrecta.'
        ]);
    }
} else {
    echo json_encode([
        'success' => false,
        'message' => 'Correo no encontrado.'
    ]);
}
?>
