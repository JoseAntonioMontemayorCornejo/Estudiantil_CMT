<?php include("conexion.php"); ?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calificaciones Docente - CMT</title>
    <link rel="stylesheet" href="calificacionesDocente.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <header>
        <a href="index.html" class="logo">CMT</a>
        <nav>
            <ul>
                <li><a href="index.html">Inicio</a></li>
                <li><a href="InicioSesionDocente.html">Cerrar Sesión</a></li>
            </ul>
        </nav>
    </header>

    <section class="grades-section">
        <div class="grades-header">
            <h1 class="grades-title">Calificaciones</h1>
            <div class="action-buttons">
                <button class="btn btn-secondary" id="export-btn">
                    <i class="fas fa-file-export"></i> Exportar PDF
                </button>
            </div>
        </div>

        <div class="filters">
            <div class="select-container">
                <label for="semester-select" class="select-label">Semestre:</label>
                <select id="semester-select" class="select-input">
                    <option value="">Seleccionar semestre</option>
                    <option value="1" selected>Primer Semestre</option>
                    <option value="2">Tercer Semestre</option>
                    <option value="3">Quinto Semestre</option>
                    <option value="4">Séptimo Semestre</option>
                </select>
            </div>
            <div class="select-container">
                <label for="course-select" class="select-label">Curso:</label>
                <select id="course-select" class="select-input">
                    <option value="">Seleccionar curso</option>
                    <option value="1" selected>Lenguajes de interfaz 6C</option>
                    <option value="2">Programación de base de datos</option>
                    <option value="3">Graficación</option>
                    <option value="4">Lenguajes autómatas I</option>
                    <option value="5">Taller de investigación</option>
                </select>
            </div>
            <div class="select-container">
                <label for="status-select" class="select-label">Estado:</label>
                <select id="status-select" class="select-input">
                    <option value="all" selected>Todos</option>
                    <option value="passed">Aprobados</option>
                    <option value="failed">Reprobados</option>
                </select>
            </div>
        </div>

        <table class="grades-table">
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
                $sql = "SELECT * FROM estudiantes";
                $result = $conn->query($sql);

                function colorClass($nota) {
                    if (is_null($nota)) return '';
                    return $nota >= 70 ? 'green' : 'red';
                }

                while($row = $result->fetch_assoc()):
                ?>
                <tr>
                    <td><?= $row['nombre'] ?></td>
                    <td class="<?= colorClass($row['unidad1']) ?>"><?= $row['unidad1'] ?? '—' ?></td>
                    <td class="<?= colorClass($row['unidad2']) ?>"><?= $row['unidad2'] ?? '—' ?></td>
                    <td class="<?= colorClass($row['unidad3']) ?>"><?= $row['unidad3'] ?? '—' ?></td>
                    <td class="<?= colorClass($row['promedio']) ?>"><?= $row['promedio'] ?? '—' ?></td>
                    <td><?= $row['comentario'] ?></td>
                    <td class="action-cell">
                        <button class="edit-comment-btn" data-id="<?= $row['id'] ?>" data-name="<?= $row['nombre'] ?>" data-comment="<?= $row['comentario'] ?>">
                            <i class="fas fa-comment"></i>
                        </button>
                        <button class="edit-grade-btn" data-id="<?= $row['id'] ?>" data-name="<?= $row['nombre'] ?>">
                            <i class="fas fa-edit"></i>
                        </button>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </section>

    <!-- Modal Comentario -->
    <div class="modal" id="comment-modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2>Agregar comentario para <span id="student-name"></span></h2>
                <button class="close-btn">&times;</button>
            </div>
            <form id="comment-form">
                <input type="hidden" id="student-id">
                <textarea id="comment" class="form-input" rows="4" placeholder="Escribe un comentario..."></textarea>
                <div class="modal-footer">
                    <button type="button" class="btn close-modal-btn">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Calificación -->
    <div class="modal" id="grade-modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2>Modificar calificación para <span id="grade-student-name"></span></h2>
                <button class="close-btn">&times;</button>
            </div>
            <form id="grade-form">
                <input type="hidden" id="grade-student-id">
                <label for="unit-select">Unidad:</label>
                <select id="unit-select" class="form-input">
                    <option value="1">Unidad 1</option>
                    <option value="2">Unidad 2</option>
                    <option value="3">Unidad 3</option>
                </select>
                <label for="new-grade">Nueva calificación:</label>
                <input type="number" id="new-grade" class="form-input" min="0" max="100" required>
                <label for="grade-comment">Comentario:</label>
                <textarea id="grade-comment" class="form-input" rows="3"></textarea>
                <div class="modal-footer">
                    <button type="button" class="btn close-modal-btn">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </form>
        </div>
    </div>

    <footer>
        <div class="copyright">
            &copy; 2023 CMT. Todos los derechos reservados.
        </div>
    </footer>

    <script>
    document.querySelectorAll('.edit-comment-btn').forEach(btn => {
        btn.addEventListener('click', () => {
            document.getElementById('student-id').value = btn.dataset.id;
            document.getElementById('student-name').textContent = btn.dataset.name;
            document.getElementById('comment').value = btn.dataset.comment || '';
            document.getElementById('comment-modal').style.display = 'flex';
        });
    });

    document.querySelectorAll('.edit-grade-btn').forEach(btn => {
        btn.addEventListener('click', () => {
            document.getElementById('grade-student-id').value = btn.dataset.id;
            document.getElementById('grade-student-name').textContent = btn.dataset.name;
            document.getElementById('grade-modal').style.display = 'flex';
        });
    });

    document.querySelectorAll('.close-btn, .close-modal-btn').forEach(btn => {
        btn.addEventListener('click', () => {
            document.getElementById('comment-modal').style.display = 'none';
            document.getElementById('grade-modal').style.display = 'none';
        });
    });

    document.getElementById('export-btn').addEventListener('click', () => {
        alert('Exportando a PDF... (implementar con jsPDF)');
    });
    </script>
    <script src="scripts.js"></script>
</body>
</html>
