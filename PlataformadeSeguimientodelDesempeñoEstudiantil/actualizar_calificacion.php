<?php
include("conexion.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id = $_POST["id"];
    $unidad = $_POST["unidad"];
    $nota = $_POST["nota"];
    $comentario = $_POST["comentario"];

    // Actualiza la unidad correspondiente
    $columna = "unidad" . $unidad;
    $sql = "UPDATE estudiantes SET $columna = ?, comentario = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("isi", $nota, $comentario, $id);
    $stmt->execute();

    // Recalcula el promedio
    $sqlProm = "SELECT unidad1, unidad2, unidad3 FROM estudiantes WHERE id = ?";
    $stmt2 = $conn->prepare($sqlProm);
    $stmt2->bind_param("i", $id);
    $stmt2->execute();
    $result = $stmt2->get_result();
    $row = $result->fetch_assoc();

    $sum = 0;
    $count = 0;
    foreach (['unidad1', 'unidad2', 'unidad3'] as $u) {
        if (!is_null($row[$u])) {
            $sum += $row[$u];
            $count++;
        }
    }
    $promedio = $count > 0 ? round($sum / $count) : null;

    $sqlUpdate = "UPDATE estudiantes SET promedio = ? WHERE id = ?";
    $stmt3 = $conn->prepare($sqlUpdate);
    $stmt3->bind_param("ii", $promedio, $id);
    $stmt3->execute();

    echo "Calificación actualizada correctamente.";

    $stmt->close();
    $stmt2->close();
    $stmt3->close();
    $conn->close();
}

