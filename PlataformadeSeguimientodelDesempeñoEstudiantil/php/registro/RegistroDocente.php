<?php
include_once(__DIR__ . "/../../includes/conexion.php");

$mensaje = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $correo = $_POST['correo'];
    $contrasena = $_POST['contrasena'];
    $materias = $_POST['materia_id'] ?? [];

    if (empty($materias)) {
        echo "⚠️ Debes seleccionar al menos una materia.";
        exit;
    }

    // Buscar si ya existe un docente con ese correo
    $sql_buscar = "SELECT id FROM docentes WHERE correo = ?";
    $stmt_buscar = $conn->prepare($sql_buscar);
    $stmt_buscar->bind_param("s", $correo);
    $stmt_buscar->execute();
    $stmt_buscar->store_result();

    if ($stmt_buscar->num_rows > 0) {
        // Ya existe el docente
        $stmt_buscar->bind_result($docente_id);
        $stmt_buscar->fetch();
        $nuevo = false;
    } else {
        // No existe, insertar nuevo
        $sql_insert = "INSERT INTO docentes (nombre, correo, contrasena) VALUES (?, ?, ?)";
        $stmt_insert = $conn->prepare($sql_insert);
        $stmt_insert->bind_param("sss", $nombre, $correo, $contrasena);

        if ($stmt_insert->execute()) {
            $docente_id = $stmt_insert->insert_id;
            $nuevo = true;
        } else {
            echo "❌ Error al registrar docente: " . $stmt_insert->error;
            exit;
        }
        $stmt_insert->close();
    }
    $stmt_buscar->close();

    // Insertar materias (evitando duplicados)
    $sql_existente = "SELECT materia_id FROM docente_materia WHERE docente_id = ?";
    $stmt_existente = $conn->prepare($sql_existente);
    $stmt_existente->bind_param("i", $docente_id);
    $stmt_existente->execute();
    $result = $stmt_existente->get_result();

    $materias_existentes = [];
    while ($row = $result->fetch_assoc()) {
        $materias_existentes[] = $row['materia_id'];
    }
    $stmt_existente->close();

    $sql_insert_materia = "INSERT INTO docente_materia (docente_id, materia_id) VALUES (?, ?)";
    $stmt_materia = $conn->prepare($sql_insert_materia);

    $agregadas = [];
    $omitidas = [];
    foreach ($materias as $materia_id) {
        if (!in_array($materia_id, $materias_existentes)) {
            $stmt_materia->bind_param("ii", $docente_id, $materia_id);
            if ($stmt_materia->execute()) {
                $agregadas[] = $materia_id;
            } else {
                $omitidas[] = $materia_id;
            }
        } else {
            $omitidas[] = $materia_id;
        }
    }
    $stmt_materia->close();
    $conn->close();

    // Armar mensaje final
    if ($nuevo) {
        $mensaje = "✅ Docente registrado correctamente.";
    } else {
        $mensaje = "ℹ️ Docente ya existente. Se actualizaron sus materias.";
    }

    if (!empty($agregadas)) {
        $mensaje .= "✔️ Materias asignadas: " . implode(", ", $agregadas);
    }

    if (!empty($omitidas)) {
        $mensaje .= "⚠️ Materias ya asignadas u omitidas: " . implode(", ", $omitidas);
    }

    echo $mensaje;
}
?>
