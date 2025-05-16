<?php
include("conexion.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $correo = $_POST['correo'];
    $contrasena = password_hash($_POST['contrasena'], PASSWORD_DEFAULT); // Encriptar contraseña

    $sql = "INSERT INTO docentes (nombre, correo, contrasena) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $nombre, $correo, $contrasena);

    if ($stmt->execute()) {
        echo "✅ Docente registrado correctamente.";
    } else {
        echo "❌ Error al registrar docente: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>

<!-- HTML del formulario -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro de Docente</title>
</head>
<body>
    <h2>Registrar Docente</h2>
    <form action="registroDocente.php" method="POST">
        <label>Nombre:</label><br>
        <input type="text" name="nombre" required><br><br>

        <label>Correo:</label><br>
        <input type="email" name="correo" required><br><br>

        <label>Contraseña:</label><br>
        <input type="password" name="contrasena" required><br><br>

        <button type="submit">Registrar</button>
    </form>
</body>
</html>
