<?php
include("conexion.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];

    if (isset($_POST['comentario'])) {
        // Actualizar solo comentario
        $comentario = $conn->real_escape_string($_POST['comentario']);
        $sql = "UPDATE estudiantes SET comentario='$comentario' WHERE id=$id";
        $conn->query($sql);
    }

    if (isset($_POST['unidad']) && isset($_POST['calificacion'])) {
        $unidad = $_POST['unidad'];
        $nota = $_POST['calificacion'];
        $campo = "unidad" . $unidad;
        $sql = "UPDATE estudiantes SET $campo=$nota WHERE id=$id";
        $conn->query($sql);

        // Recalcular el promedio
        $res = $conn->query("SELECT unidad1, unidad2, unidad3 FROM estudiantes WHERE id=$id");
        $row = $res->fetch_assoc();
        $prom = 0;
        $count = 0;
        foreach (['unidad1', 'unidad2', 'unidad3'] as $u) {
            if (!is_null($row[$u])) {
                $prom += $row[$u];
                $count++;
            }
        }
        if ($count > 0) {
            $promedio = round($prom / $count);
            $conn->query("UPDATE estudiantes SET promedio=$promedio WHERE id=$id");
        }
    }

    echo "ok";
}
?>
