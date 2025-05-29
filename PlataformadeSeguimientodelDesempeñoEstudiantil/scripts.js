// ===============================
// 1. VARIABLES DE FILTRO Y TABLA
// ===============================

// Referencias a los selectores del DOM para aplicar filtros
const semesterSelect = document.getElementById('semester-select');
const courseSelect = document.getElementById('course-select');
const statusSelect = document.getElementById('status-select');
const gradesBody = document.getElementById('grades-body'); // Cuerpo de la tabla donde se mostrarán los alumnos

// ===============================
// 2. RENDERIZAR TABLA
// ===============================

function renderTable(data) {
    // Si no hay datos, mostrar mensaje en la tabla
    if (!data || data.length === 0) {
        gradesBody.innerHTML = '<tr><td colspan="7" class="text-center">No hay estudiantes que coincidan con los filtros</td></tr>';
        return;
    }

    gradesBody.innerHTML = ''; // Limpiar contenido previo de la tabla

    // Recorrer cada estudiante para crear filas dinámicamente
    data.forEach(est => {
        const row = document.createElement('tr'); // Crear fila de tabla

        // Insertar HTML con datos del estudiante
        row.innerHTML = `
            <td>${est.name}</td>
            <td class="${getColorClass(est.unit1)}">${est.unit1 || '—'}</td>
            <td class="${getColorClass(est.unit2)}">${est.unit2 || '—'}</td>
            <td class="${getColorClass(est.unit3)}">${est.unit3 || '—'}</td>
            <td class="${getColorClass(est.average)}">${est.average || '—'}</td>
            <td>${est.comment || '—'}</td>
            <td class="action-cell">
                <button class="btn btn-sm btn-warning" onclick="abrirModal(${JSON.stringify(est).replace(/"/g, '&quot;')})">
                    ✏️
                </button>
            </td>
        `;
        gradesBody.appendChild(row); // Agregar la fila al cuerpo de la tabla
    });
}

// ===============================
// 6. ABRIR Y CERRAR MODALES
// ===============================

function assignModalButtons() {
    // Asignar función al botón de editar comentario
    document.querySelectorAll('.edit-comment-btn').forEach(btn => {
        btn.addEventListener('click', () => {
            document.getElementById('student-id').value = btn.dataset.id;
            document.getElementById('student-name').textContent = btn.dataset.name;
            document.getElementById('comment').value = btn.dataset.comment || '';
            document.getElementById('comment-modal').style.display = 'flex';
        });
    });

    // Asignar función al botón de editar calificación
    document.querySelectorAll('.edit-grade-btn').forEach(btn => {
        btn.addEventListener('click', () => {
            document.getElementById('grade-student-id').value = btn.dataset.id;
            document.getElementById('grade-student-name').textContent = btn.dataset.name;
            document.getElementById('grade-modal').style.display = 'flex';
        });
    });
}

// ===============================
// 7. BOTONES DE CIERRE DE MODAL
// ===============================

document.querySelectorAll('.close-btn, .close-modal-btn').forEach(btn => {
    btn.addEventListener('click', () => {
        // Ocultar modales al hacer clic en cerrar
        document.getElementById('comment-modal').style.display = 'none';
        document.getElementById('grade-modal').style.display = 'none';
    });
});

// ===============================
// 8. ENVIAR FORMULARIO DE COMENTARIO
// ===============================

document.getElementById('comment-form').addEventListener('submit', async function(e) {
    e.preventDefault(); // Evitar recarga de página

    const studentId = document.getElementById('student-id').value;
    const comment = document.getElementById('comment').value;

    // Crear objeto FormData con los datos a enviar
    const formData = new FormData();
    formData.append('id', studentId);
    formData.append('comentario', comment);

    // Enviar petición al servidor
    const response = await fetch('actualizar_comentario.php', {
        method: 'POST',
        body: formData
    });

    const result = await response.json();

    // Mostrar resultado al usuario
    if (result.success) {
        alert('Comentario actualizado');
        location.reload(); // Recargar página para reflejar cambios
    } else {
        alert('Error al actualizar el comentario');
    }
});

// ===============================
// 10. EXPORTAR PDF (BOTÓN)
// ===============================

// Asignar evento al botón de exportar
document.getElementById('export-btn').addEventListener('click', exportToPDF);

// ===============================
// 10. EXPORTAR PDF (FUNCIÓN)
// ===============================

function exportToPDF() {
    // Crear nuevo documento PDF en orientación horizontal
    const doc = new jsPDF({
        orientation: 'landscape',
        unit: 'mm'
    });

    // Obtener información para el encabezado
    const title = "Reporte de Calificaciones";
    const semester = semesterSelect.options[semesterSelect.selectedIndex].text;
    const course = courseSelect.options[courseSelect.selectedIndex].text;
    
    const element = document.querySelector('.table'); // Elemento a capturar

    // Usar html2canvas para convertir tabla en imagen
    html2canvas(element).then(canvas => {
        const imgData = canvas.toDataURL('image/png');
        const imgWidth = 280;
        const imgHeight = (canvas.height * imgWidth) / canvas.width;

        // Agregar propiedades del PDF
        doc.setProperties({
            title: title,
            subject: `Semestre: ${semester} | Curso: ${course}`,
            author: 'Sistema de Calificaciones'
        });

        // Insertar textos
        doc.text(title, 14, 15);
        doc.text(`Semestre: ${semester} | Curso: ${course}`, 14, 20);
        
        // Insertar imagen de la tabla
        doc.addImage(imgData, 'PNG', 10, 25, imgWidth, imgHeight);

        // Descargar PDF
        doc.save(`Calificaciones_${semester}_${course}.pdf`);
    });
}

// ===============================
// 11. CARGAR MATERIAS AUTOMÁTICAMENTE (SELECT SIMPLE)
// ===============================

fetch('obtener_materias.php')
  .then(response => response.json())
  .then(data => {
    const select = document.getElementById('materias');
    select.innerHTML = ''; // Limpiar opciones anteriores

    // Agregar nuevas opciones al select
    data.forEach(materia => {
        const option = document.createElement('option');
        option.value = materia.id;
        option.textContent = materia.nombre;
        select.appendChild(option);
    });
  });

// ===============================
// 12. CARGAR MATERIAS DEL DOCENTE AL INICIO
// ===============================

window.addEventListener('DOMContentLoaded', () => {
    fetch('obtener_materias.php')
        .then(response => response.json())
        .then(data => {
            const select = document.getElementById('materias-select');
            select.innerHTML = '<option value="">Seleccionar materia</option>'; // Opción por defecto
            data.forEach(materia => {
                const option = document.createElement('option');
                option.value = materia.id;
                option.textContent = materia.nombre;
                select.appendChild(option);
            });
        })
        .catch(error => {
            console.error("Error al cargar materias:", error);
        });
});
