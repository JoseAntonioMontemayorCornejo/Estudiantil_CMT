<!-- Este es el codigo de calificacionesAlumno -->
<?php
session_start();
if (!isset($_SESSION['alumno_id'])) {
    header("Location: InicioSesionAlumno.html");
    exit();
}

include("conexion.php");

$alumnoId = $_SESSION['alumno_id'];
$nombre = $_SESSION['nombre'];

// Buscar calificaciones del alumno
$sql = "SELECT * FROM calificaciones WHERE alumno_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $alumnoId);
$stmt->execute();
$result = $stmt->get_result();

$calificaciones = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Calificaciones del Alumno</title>
    <link rel="stylesheet" href="calificacionesDocente.css">
</head>
<body>
    <header>
        <a href="index.html" class="logo">CMT</a>
        <nav>
            <ul>
                <li><a href="index.html">Inicio</a></li>
                <li><a href="cerrarSesion.php">Cerrar Sesión</a></li>
            </ul>
        </nav>
    </header>

    <section class="grades-section">
        <h1>Bienvenido, <?= htmlspecialchars($nombre) ?></h1>
        <h2>Calificaciones</h2>

        <?php if ($calificaciones): ?>
        <table class="grades-table">
            <thead>
                <tr>
                    <th>Unidad</th>
                    <th>Calificación</th>
                    <th>Comentario</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Unidad 1</td>
                    <td><?= $calificaciones['unidad1'] ?></td>
                    <td><?= htmlspecialchars($calificaciones['comentario']) ?></td>
                </tr>
                <tr>
                    <td>Unidad 2</td>
                    <td><?= $calificaciones['unidad2'] ?></td>
                    <td></td>
                </tr>
                <tr>
                    <td>Unidad 3</td>
                    <td><?= $calificaciones['unidad3'] ?></td>
                    <td></td>
                </tr>
                <tr>
                    <td><strong>Promedio</strong></td>
                    <td><?= $calificaciones['promedio'] ?></td>
                    <td></td>
                </tr>
            </tbody>
        </table>
        <?php else: ?>
            <p>No hay calificaciones registradas aún.</p>
        <?php endif; ?>
    </section>
</body>
</html>
