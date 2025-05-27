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
        echo "<script>alert('✅ Docente registrado correctamente.');</script>";
    } else {
        echo "<script>alert('❌ Error al registrar docente: " . $stmt->error . "');</script>";
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
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="estilos.css"> <!-- Asegúrate de tener este archivo CSS -->
</head>
<body>

    <!-- Header con logo y navegación -->
    <header>
        <div class="logo">Mi Plataforma</div>
        <nav>
            <a href="index.html">Inicio</a>
            <a href="login.html">Iniciar Sesión</a>
            <a href="registroDocente.php">Registrar Docente</a>
        </nav>
        <div class="menu-icon">&#9776;</div>
    </header>

    <!-- Contenedor del formulario -->
    <div class="login-container">
        <div class="form-container">
            <h1>Registro de Docente</h1>
            <form action="registroDocente.php" method="POST">
                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" name="nombre" required>

                <label for="correo">Correo:</label>
                <input type="email" id="correo" name="correo" required>

                <label for="contrasena">Contraseña:</label>
                <input type="password" id="contrasena" name="contrasena" required>

                <button type="submit">Registrar</button>
            </form>
        </div>

        <!-- Imagen decorativa -->
        <div class="lion-image">
            <img src="leon.png" alt="León decorativo">
        </div>
    </div>

</body>
</html>
