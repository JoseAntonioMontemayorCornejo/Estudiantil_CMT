<?php
include_once(__DIR__ . "/../../includes/Conexion.php");
header('Content-Type: application/json');

$correo = $_POST['correo'];
$contrasena = $_POST['contrasena'];

$sql = "SELECT * FROM alumnos WHERE correo = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $correo);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $alumno = $result->fetch_assoc();

    if ($contrasena === $alumno['contrasena']) {
        session_start();
        $_SESSION['alumno_id'] = $alumno['id'];
        $_SESSION['nombre'] = $alumno['nombre'];

        echo json_encode([
    'success' => true,
    'redirect' => '../php/calificaciones/CalificacionesAlumno.php'
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
        'message' => 'Correo no registrado.'
    ]);
}
?>
