<?php
include_once(__DIR__ . "/../../includes/conexion.php");

$mensaje = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $correo = $_POST['correo'];
    $contrasena = $_POST['contrasena'];
    $materia_id = $_POST['materia_id'];

    $sql = "INSERT INTO docentes (nombre, correo, contrasena) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $nombre, $correo, $contrasena);

    if ($stmt->execute()) {
        $docente_id = $stmt->insert_id;

        $sql_materia = "INSERT INTO docente_materia (docente_id, materia_id) VALUES (?, ?)";
        $stmt_materia = $conn->prepare($sql_materia);
        $stmt_materia->bind_param("ii", $docente_id, $materia_id);

        if ($stmt_materia->execute()) {
            $mensaje = "✅ Docente registrado correctamente.";
        } else {
            $mensaje = "⚠️ Docente registrado, pero error al asignar materia: " . $stmt_materia->error;
        }

        $stmt_materia->close();
    } else {
        $mensaje = "❌ Error al registrar docente: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}

// Devolver el mensaje para mostrarlo en la página principal
echo $mensaje;
?>
