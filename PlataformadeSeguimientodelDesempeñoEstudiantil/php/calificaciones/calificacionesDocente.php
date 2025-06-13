<?php

session_start();

if (!isset($_SESSION['docente_id'])) {
    header("Location: ../login/login_docente.php");
    exit();
}

$nombre = $_SESSION['nombre']; 

$conexion = new mysqli("localhost", "root", "", "calificaciones_db");

$materia_id = $_GET['materia_id'] ?? null;

// Obtener materias asignadas al docente
$docente_id = $_SESSION['docente_id'];

$materiasQuery = "SELECT m.id, m.nombre 
                  FROM materias m 
                  INNER JOIN docente_materia dm ON m.id = dm.materia_id 
                  WHERE dm.docente_id = ?";
$stmtMaterias = $conexion->prepare($materiasQuery);
$stmtMaterias->bind_param("i", $docente_id);
$stmtMaterias->execute();
$materiasResult = $stmtMaterias->get_result();

// Si no hay materia seleccionada, redirige a la primera materia asignada
if (!$materia_id && $materiasResult->num_rows > 0) {
    $primeraMateria = $materiasResult->fetch_assoc();
    header("Location: ../calificaciones/calificacionesDocente.php?materia_id=" . $primeraMateria['id']);
    exit;
}

// Si no hay materias asignadas, muestra mensaje
if (!$materia_id) {
    echo "<div class='container text-center text-warning mt-4'>No tienes materias asignadas.</div>";
    exit;
}


$sql = "SELECT a.id, a.nombre, c.unidad1, c.unidad2, c.unidad3, 
               c.promedio, c.comentario, c.comentario_u1, c.comentario_u2, c.comentario_u3
        FROM alumnos a
        JOIN calificaciones c ON a.id = c.alumno_id
        WHERE c.materia_id = ?";

$stmt = $conexion->prepare($sql);
$stmt->bind_param("i", $materia_id);
$stmt->execute();
$resultado = $stmt->get_result();


$docente_id = $_SESSION['docente_id'];
?>


<!DOCTYPE html>
<html lang="es">
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta charset="UTF-8">
  <title>Gestión de Calificaciones</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="../../assets/css/estilos.css">
  <!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <header>
    <div class="logo">CMT</div>
    <nav class="nav-links">
      <a href="../../index.html">Cerrar Sesion</a>
      <a href="../../Nosotros.html">Nosotros</a>
      <a href="https://moodle.tecsanpedro.edu.mx/login/index.php">Moodle</a>
    </nav>
    <div class="menu-icon">☰</div>
  </header>
<div class="container py-5">
    <h1>Bienvenido, <?= htmlspecialchars($nombre) ?></h1>
  <h2 class="mb-4">Calificaciones</h2>
  <div class="action-buttons">
            <button class="btn btn-secondary" id="export-btn">
                <i class="fas fa-file-export"></i> Exportar PDF

            </button>
             </div>
    </div>

    
    

    <div class="select-container">
    <label for="materias-select" class="select-label">Materia:</label>
    <select id="materias-select" class="select-input">
        <?php
if ($materiasResult->num_rows > 0) {
    echo '<option value="">Seleccionar materia</option>';
    while ($materia = $materiasResult->fetch_assoc()) {
        $selected = ($materia_id == $materia['id']) ? 'selected' : '';
        echo "<option value='{$materia['id']}' $selected>{$materia['nombre']}</option>";
    }
} else {
    echo '<option value="">No tienes materias asignadas</option>';
}
?>
    </select>
            <label for="status-select" class="select-label">Estado:</label>
            <select id="status-select" class="select-input">
                <option value="all" selected>Todos</option>
                <option value="passed">Aprobados</option>
                <option value="failed">Reprobados</option>
            </select>
        </div>
    </div>
</div>

  <table class="table table-dark table-bordered">
    <thead>
      <tr>
        <th>Estudiante</th>
        <th>Unidad 1</th>
        <th>Unidad 2</th>
        <th>Unidad 3</th>
        <th>Promedio</th>
        <th>Comentario</th>
        <th>Acciones</th>
      </tr>
    </thead>
    <tbody id="grades-body">
    <?php
function getGradeClass($grade) {
    if ($grade === null || $grade === '') return '';
    if ($grade >= 70) return 'grade-high';
    if ($grade >= 60) return 'grade-mid';
    return 'grade-low';
}

while ($row = $resultado->fetch_assoc()) {
    $unidad1Class = getGradeClass($row['unidad1']);
    $unidad2Class = getGradeClass($row['unidad2']);
    $unidad3Class = getGradeClass($row['unidad3']);
    $promedioClass = getGradeClass($row['promedio']);

    $promedio = $row['promedio'];
    $circleHTML = '';

    // Aquí va tu código del círculo por color
    if ($promedio !== null) {
        if ($promedio >= 70) {
            $circleHTML = '<span class="grade-circle green"></span>';
        } elseif ($promedio >= 60) {
            $circleHTML = '<span class="grade-circle yellow"></span>';
        } else {
            $circleHTML = '<span class="grade-circle red"></span>';
        }
    }

    echo "<tr>
    <td>{$row['nombre']}</td>
    <td><span class='grade-box {$unidad1Class}'>{$row['unidad1']}</span></td>
    <td><span class='grade-box {$unidad2Class}'>{$row['unidad2']}</span></td>
    <td><span class='grade-box {$unidad3Class}'>{$row['unidad3']}</span></td>
    <td class='{$promedioClass}'>{$circleHTML}{$promedio}</td>
    <td>{$row['comentario']}</td>
    <td>
      <button class='btn btn-sm btn-warning' onclick='abrirModal(" . json_encode($row) . ")'>✏️</button>
    </td>
  </tr>";

}


?>

    </tbody>
  </table>
</div>

<!-- Modal -->
<div class="modal fade" id="modalEditar" tabindex="-1">
  <div class="modal-dialog">
    <form class="modal-content" method="POST" action="actualizar_calificacion.php">
      <div class="modal-header">
        <h5 class="modal-title">Editar Calificaciones</h5>
        <input type="hidden" name="id" id="inputId">
<input type="hidden" name="materia_id" value="<?= htmlspecialchars($_GET['materia_id'] ?? '') ?>">

        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <div class="mb-2">
          <label>Unidad 1</label>
          <input type="number" name="unidad1" id="inputUnidad1" class="form-control">
        </div>
        <div class="mb-2">
          <label>Unidad 2</label>
          <input type="number" name="unidad2" id="inputUnidad2" class="form-control">
        </div>
        <div class="mb-2">
          <label>Unidad 3</label>
          <input type="number" name="unidad3" id="inputUnidad3" class="form-control">
        </div>
        <div class="mb-2">
          <label>Comentario</label>
          <textarea name="comentario" id="inputComentario" class="form-control"></textarea>
        </div>
        <div class="mb-2">
  <label>Comentario Unidad 1</label>
  <textarea name="comentario_u1" id="inputComentarioU1" class="form-control"></textarea>
</div>
<div class="mb-2">
  <label>Comentario Unidad 2</label>
  <textarea name="comentario_u2" id="inputComentarioU2" class="form-control"></textarea>
</div>
<div class="mb-2">
  <label>Comentario Unidad 3</label>
  <textarea name="comentario_u3" id="inputComentarioU3" class="form-control"></textarea>
</div>

      </div>
      <div class="modal-footer">
        <button class="btn btn-primary" type="submit">Guardar</button>
        <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Cancelar</button>
      </div>
    </form>
  </div>
</div>


<!-- Al final del body, ANTES de cargar scripts.js -->
<script>
// Convertir datos PHP a JSON de forma segura
window.studentsData = <?php
    $data = [];
    $resultado->data_seek(0); // Reiniciar puntero si es necesario
    while ($row = $resultado->fetch_assoc()) {
        $data[] = [
    'id' => (int)$row['id'],
    'name' => htmlspecialchars($row['nombre'], ENT_QUOTES),
    'unit1' => $row['unidad1'] !== null ? (float)$row['unidad1'] : null,
    'unit2' => $row['unidad2'] !== null ? (float)$row['unidad2'] : null,
    'unit3' => $row['unidad3'] !== null ? (float)$row['unidad3'] : null,
    'average' => $row['promedio'] !== null ? (float)$row['promedio'] : null,
    'comment' => htmlspecialchars($row['comentario'] ?? '', ENT_QUOTES),
    'comentario_u1' => htmlspecialchars($row['comentario_u1'] ?? '', ENT_QUOTES),
    'comentario_u2' => htmlspecialchars($row['comentario_u2'] ?? '', ENT_QUOTES),
    'comentario_u3' => htmlspecialchars($row['comentario_u3'] ?? '', ENT_QUOTES)
];
    }
    echo json_encode($data);
?>;
</script>
<script src="scripts.js" defer></script>



<!-- Agrega esto en el <head> o antes de cerrar el <body> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="assets/js/scripts.js"></script>
<script>

function abrirModal(data) {
  document.getElementById('inputId').value = data.id;
  document.getElementById('inputUnidad1').value = data.unidad1 ?? '';
  document.getElementById('inputUnidad2').value = data.unidad2 ?? '';
  document.getElementById('inputUnidad3').value = data.unidad3 ?? '';
  document.getElementById('inputComentario').value = data.comentario ?? '';
  document.getElementById('inputComentarioU1').value = data.comentario_u1 ?? '';
  document.getElementById('inputComentarioU2').value = data.comentario_u2 ?? '';
  document.getElementById('inputComentarioU3').value = data.comentario_u3 ?? '';

  const modal = new bootstrap.Modal(document.getElementById('modalEditar'));
  modal.show();
}








</script>
<script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.28/jspdf.plugin.autotable.min.js"></script>
<script>
  document.getElementById('export-btn').addEventListener('click', () => {
    const { jsPDF } = window.jspdf;
    const doc = new jsPDF('l', 'mm', 'a4'); // Horizontal A4

    doc.setFontSize(18);
    doc.text('Reporte de Calificaciones', 14, 20);

    // Obtiene la tabla desde el DOM
    const table = document.querySelector('.table');

    // Formatea y exporta usando autoTable
    doc.autoTable({
      html: table,
      startY: 30,
      headStyles: { fillColor: [198, 40, 40], textColor: 255, halign: 'center' },
      bodyStyles: { halign: 'center', valign: 'middle' },
      theme: 'grid',
      styles: {
        cellPadding: 3,
        fontSize: 9,
        overflow: 'linebreak',
        minCellHeight: 10
      },
      didDrawPage: function (data) {
        doc.setFontSize(10);
        doc.text(`Docente: <?= htmlspecialchars($nombre) ?>`, 14, doc.internal.pageSize.height - 10);
        doc.text(`Fecha: ${new Date().toLocaleDateString()}`, 230, doc.internal.pageSize.height - 10);
      }
    });

    doc.save('calificaciones.pdf');
  });
</script>



</script>

<script>
  //exportar pdf

document.addEventListener("DOMContentLoaded", () => {
  const materiaSelect = document.getElementById('materias-select');
  if (materiaSelect) {
    materiaSelect.addEventListener('change', function () {
      const materia_id = this.value;
      if (materia_id) {
        const url = new URL(window.location.href);
        url.searchParams.set('materia_id', materia_id);
        window.location.href = url;
      }
    });
  }
});


//Para el filtrado de aprobados y reprobados
document.getElementById('status-select').addEventListener('change', function () {
    const estado = this.value;
    const rows = document.querySelectorAll('#grades-body tr');

    rows.forEach(row => {
        const promedioCell = row.cells[4]; // columna del promedio
        const promedio = parseFloat(promedioCell.textContent) || 0;

        if (estado === 'passed' && promedio >= 70) {
            row.style.display = '';
        } else if (estado === 'failed' && promedio < 70) {
            row.style.display = '';
        } else if (estado === 'all') {
            row.style.display = '';
        } else {
            row.style.display = 'none';
        }
    });
});




function getGradeCircleHTML(grade) {
  let colorClass = "gray";
  let display = "N/E";

  if (grade !== null && grade !== undefined && grade !== "") {
    const num = parseFloat(grade);
    if (!isNaN(num)) {
      if (num >= 13) colorClass = "green";
      else if (num >= 10) colorClass = "yellow";
      else colorClass = "red";
      display = num;
    }
  }

  return `
    <span class="grade-indicator">
      <span class="grade-circle ${colorClass}"></span> ${display}
    </span>
  `;
}


</script>


<script>
  document.getElementById("export-pie-pdf").addEventListener("click", function () {
    const { jsPDF } = window.jspdf;

    // Crear canvas en memoria
    const canvas = document.createElement("canvas");
    canvas.width = 400;
    canvas.height = 400;

    // Crear contexto y gráfico
    const ctx = canvas.getContext("2d");

    // Contar aprobados y reprobados
    const data = window.studentsData || [];
    const aprobados = data.filter(s => s.average >= 70).length;
    const reprobados = data.filter(s => s.average < 70).length;

    new Chart(ctx, {
      type: 'pie',
      data: {
        labels: ['Aprobados', 'Reprobados'],
        datasets: [{
          label: 'Distribución',
          data: [aprobados, reprobados],
          backgroundColor: ['#4CAF50', '#F44336'],
        }]
      },
      options: {
        responsive: false,
        plugins: {
          legend: {
            position: 'bottom'
          }
        }
      }
    });

    // Esperar un poco para renderizar el gráfico
    setTimeout(() => {
      const imageData = canvas.toDataURL("image/png");

      const doc = new jsPDF({
        orientation: "portrait",
        unit: "mm",
        format: "a4"
      });

      doc.setFontSize(18);
      doc.text("Gráfico de Aprobados vs Reprobados", 20, 20);
      doc.addImage(imageData, "PNG", 30, 30, 150, 150); // Ajusta posición y tamaño

      doc.save("grafico_aprobados_reprobados.pdf");
    }, 500); // Tiempo para asegurar renderización
  });
</script>




<div class="container my-4 text-center">
  <canvas id="graficoPastel" width="400" height="400"></canvas>
  <br>
  <button class="btn btn-info mt-3" id="export-pie-pdf">
    📊 Exportar Gráfico de Pastel
  </button>
</div>



<script>
  document.addEventListener("DOMContentLoaded", function () {
    const estudiantes = window.studentsData || [];

    const aprobados = estudiantes.filter(s => s.average >= 70).length;
    const reprobados = estudiantes.filter(s => s.average < 70).length;

    const ctx = document.getElementById('graficoPastel').getContext('2d');

    window.miGraficoPastel = new Chart(ctx, {
      type: 'pie',
      data: {
        labels: ['Aprobados', 'Reprobados'],
        datasets: [{
          data: [aprobados, reprobados],
          backgroundColor: ['#28a745', '#dc3545']
        }]
      },
       options: {
    responsive: true,
    plugins: {
      legend: {
        position: 'bottom',
        labels: {
          font: {
            size: 20  // ⬅️ AUMENTA el tamaño aquí (por defecto suele ser 12)
          }
        }
      },
          title: {
            display: true,
            text: 'Distribución de Calificaciones'
          }
        }
      }
    });
  });
</script>
<script>
 document.getElementById('export-pie-pdf').addEventListener('click', function () {
  const { jsPDF } = window.jspdf;

  // Obtener datos directamente desde el gráfico
  const grafico = Chart.getChart('graficoPastel'); // ID del canvas
  const datos = grafico.data.datasets[0].data;
  const aprobados = datos[0];
  const reprobados = datos[1];

  html2canvas(document.getElementById('graficoPastel')).then(canvas => {
    const imgData = canvas.toDataURL('image/png');

    const pdf = new jsPDF({
      orientation: 'landscape',
      unit: 'mm',
      format: 'a4'
    });

    pdf.setFontSize(18);
    pdf.text('Gráfico de Calificaciones', 15, 15);

    // Imagen del gráfico
    pdf.addImage(imgData, 'PNG', 15, 25, 260, 120);

    // Agrega los números reales
    pdf.setFontSize(14);
    pdf.text(`Aprobados: ${aprobados}`, 15, 155);
    pdf.text(`Reprobados: ${reprobados}`, 15, 165);

    pdf.save('grafico_calificaciones.pdf');
  });
});



</script>


</body>
</html>
