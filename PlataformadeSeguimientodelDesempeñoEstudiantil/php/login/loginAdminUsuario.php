<?php
include_once(__DIR__ . "/../../includes/Conexion.php");

session_start();

$correo = trim($_POST['correo']);
$contrasena = trim($_POST['contrasena']);

// Validamos el usuario en la base de datos
$query = "SELECT * FROM adminnoadmin WHERE correo = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $correo);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $usuario = $result->fetch_assoc();
    
    if ($contrasena === $usuario['contrasena']) {
        $_SESSION['usuario_id'] = $usuario['id'];
        $_SESSION['tipo_usuario'] = $usuario['tipo'];

        echo json_encode([
            'success' => true,
            'redirect' => $usuario['tipo'] === 'admin' ? '../Html/inicioAdmin.html' : 'http://localhost/PlataformadeSeguimientodelDesempe%C3%B1oEstudiantil/index.html'
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
