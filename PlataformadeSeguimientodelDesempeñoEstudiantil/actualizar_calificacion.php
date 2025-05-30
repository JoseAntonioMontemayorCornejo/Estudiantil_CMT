<?php
session_start(); // Inicia la sesión para acceder a variables de sesión

// Verifica que el docente haya iniciado sesión
if (!isset($_SESSION['docente_id'])) {
    header("Location: login_docente.php"); // Redirige al login si no está autenticado
    exit();
}

// Conexión a la base de datos MySQL
$conexion = new mysqli("localhost", "root", "", "calificaciones_db");

// Recibe los datos del formulario mediante POST
$id = $_POST['id']; 
$materia_id = $_POST['materia_id']; 
$unidad1 = $_POST['unidad1']; 
$unidad2 = $_POST['unidad2']; 
$unidad3 = $_POST['unidad3'];
$comentario = $_POST['comentario'];
$comentario_u1 = $_POST['comentario_u1']; 
$comentario_u2 = $_POST['comentario_u2']; 
$comentario_u3 = $_POST['comentario_u3']; 

// Calcula el promedio de las tres unidades y lo redondea
$promedio = round(($unidad1 + $unidad2 + $unidad3) / 3);

// Consulta SQL preparada para actualizar la fila en la tabla calificaciones
$sql = "UPDATE calificaciones SET 
    unidad1 = ?, 
    unidad2 = ?, 
    unidad3 = ?, 
    promedio = ?, 
    comentario = ?, 
    comentario_u1 = ?, 
    comentario_u2 = ?, 
    comentario_u3 = ?, 
    materia_id = ?
WHERE id = ?";

// Prepara la consulta para ejecución segura
$stmt = $conexion->prepare($sql);

// Asocia los valores a los marcadores de posición:
// Tipos de datos: i = integer, s = string
$stmt->bind_param("iiiissssii", 
    $unidad1, $unidad2, $unidad3, $promedio, 
    $comentario, $comentario_u1, $comentario_u2, $comentario_u3, 
    $materia_id, $id
);

// Ejecuta la consulta y redirige si tiene éxito
if ($stmt->execute()) {
    header("Location: calificacionesDocente.php"); // Redirige al listado de calificaciones del docente
    exit();
} else {
    // Muestra el error si falla la ejecución
    echo "Error al actualizar: " . $stmt->error;
}
?>
