<?php
session_start(); // Inicia sesión para acceder a variables de sesión

// Verifica que el alumno haya iniciado sesión
if (!isset($_SESSION['alumno_id'])) {
    header("Location:InicioSesionAlumno.html"); // Redirige al login si no hay sesión activa
    exit();
}

include_once(__DIR__ . "/../../includes/conexion.php"); // Incluye el archivo de conexión a la base de datos

// Obtiene el ID y nombre del alumno desde la sesión
$alumnoId = $_SESSION['alumno_id'];
$nombre = $_SESSION['nombre'];

// Prepara y ejecuta una consulta para obtener las calificaciones del alumno
$sql = "SELECT c.*, m.nombre AS materia 
        FROM calificaciones c 
        JOIN materias m ON c.materia_id = m.id 
        WHERE c.alumno_id = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $alumnoId); // "i" indica que el parámetro es un entero
$stmt->execute();
$result = $stmt->get_result();

// Obtiene la primera fila de resultados (se espera una por alumno)
$calificaciones = $result->fetch_assoc();
?>




<!DOCTYPE html>
<html lang="es">
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <title>Calificaciones del Alumno</title>
    <link rel="stylesheet" href="../../assets/css/estilos.css"> <!-- Estilos compartidos -->
</head>
<body>
    <header>
        <div class="logo">CMT</div>
        <nav>
            <a href="../../index.html">Cerrar Sesion</a>
      <a href="../../Nosotros.html">Nosotros</a>
      <a href="https://moodle.tecsanpedro.edu.mx/login/index.php">Moodle</a>
        </nav>
    </header>

    <section class="grades-section">
        <h1>Bienvenido, <?= htmlspecialchars($nombre) ?></h1> <!-- Muestra el nombre del alumno -->
        <h2>Materia: <?= htmlspecialchars($calificaciones['materia']) ?></h2>

        <h2>Calificaciones</h2>

        <!-- Verifica si hay calificaciones registradas -->
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
                <!-- Unidad 1 -->
                <tr>
                    <td>Unidad 1</td>
                    <td><?= $calificaciones['unidad1'] ?></td>
                    <td><?= htmlspecialchars($calificaciones['comentario_u1']) ?></td>
                </tr>
                <!-- Unidad 2 -->
                <tr>
                    <td>Unidad 2</td>
                    <td><?= $calificaciones['unidad2'] ?></td>
                    <td><?= htmlspecialchars($calificaciones['comentario_u2']) ?></td>
                </tr>
                <!-- Unidad 3 -->
                <tr>
                    <td>Unidad 3</td>
                    <td><?= $calificaciones['unidad3'] ?></td>
                    <td><?= htmlspecialchars($calificaciones['comentario_u3']) ?></td>
                </tr>
                <!-- Promedio final -->
                <tr>
                    <td><strong>Promedio</strong></td>
                    <td><?= $calificaciones['promedio'] ?></td>
                    <td><?= htmlspecialchars($calificaciones['comentario']) ?></td>
                </tr>
            </tbody>
        </table>
        <?php else: ?>
            <!-- Si no hay calificaciones -->
            <p>No hay calificaciones registradas aún.</p>
        <?php endif; ?>
    </section>
</body>
</html>
