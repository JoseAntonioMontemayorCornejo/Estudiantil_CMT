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
    <div class="logo">CMT</div>
    <nav>
      <a href="Index.html#">Inicio</a>
      <a href="https://www.tecsanpedro.edu.mx/sobre-nosotros/">Nosotros</a>
      <a href="https://moodle.tecsanpedro.edu.mx/login/index.php">Moodle</a>
    </nav>
    <div class="menu-icon">☰</div>
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
                    <td><?= htmlspecialchars($calificaciones['comentario_u1']) ?></td>
                </tr>
                <tr>
                    <td>Unidad 2</td>
                    <td><?= $calificaciones['unidad2'] ?></td>
                    <td><?= htmlspecialchars($calificaciones['comentario_u2']) ?></td>
                    <td></td>
                </tr>
                <tr>
                    <td>Unidad 3</td>
                    <td><?= $calificaciones['unidad3'] ?></td>
                    <td><?= htmlspecialchars($calificaciones['comentario_u3']) ?></td>
                    <td></td>
                </tr>
                <tr>
                    <td><strong>Promedio</strong></td>
                    <td><?= $calificaciones['promedio'] ?></td>
                    <td><?= htmlspecialchars($calificaciones['comentario']) ?></td>
                    
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
