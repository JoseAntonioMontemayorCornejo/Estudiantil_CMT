// ===============================
// 1. VARIABLES DE FILTRO Y TABLA
// ===============================
const semesterSelect = document.getElementById('semester-select');
const courseSelect = document.getElementById('course-select');
const statusSelect = document.getElementById('status-select');
const gradesBody = document.getElementById('grades-body');

// ===============================
// 2. RENDERIZAR TABLA
// ===============================
function renderTable(data) {
    gradesBody.innerHTML = ''; // Limpiar tabla

    data.forEach(est => {
        const row = document.createElement('tr');

        row.innerHTML = `
            <td>${est.name}</td>
            <td class="${getColor(est.unit1)}">${est.unit1 || '—'}</td>
            <td class="${getColor(est.unit2)}">${est.unit2 || '—'}</td>
            <td class="${getColor(est.unit3)}">${est.unit3 || '—'}</td>
            <td class="${getColor(est.average)}">${est.average || '—'}</td>
            <td>${est.comment}</td>
            <td class="action-cell">
                <button class="edit-comment-btn" data-id="${est.id}" data-name="${est.name}" data-comment="${est.comment}">
                    <i class="fas fa-comment"></i>
                </button>
                <button class="edit-grade-btn" data-id="${est.id}" data-name="${est.name}">
                    <i class="fas fa-edit"></i>
                </button>
            </td>
        `;
        gradesBody.appendChild(row);
    });

    // Volver a asignar eventos a los nuevos botones
    assignModalButtons();
}

// ===============================
// 3. COLORES DE CALIFICACIÓN
// ===============================
function getColor(nota) {
    if (nota === null || nota === 0) return '';
    return nota >= 70 ? 'green' : 'red';
}

// ===============================
// 4. FILTRAR ESTUDIANTES
// ===============================
function applyFilters() {
    const semester = parseInt(semesterSelect.value);
    const course = parseInt(courseSelect.value);
    const status = statusSelect.value;

    const filtered = studentsData.filter(est => {
        const bySemester = !semester || est.semestre === semester;
        const byCourse = !course || est.curso === course;

        let byStatus = true;
        if (status === 'passed') byStatus = est.average >= 70;
        else if (status === 'failed') byStatus = est.average < 70;

        return bySemester && byCourse && byStatus;
    });

    renderTable(filtered);
}

// ===============================
// 5. EVENTOS DE LOS FILTROS
// ===============================
semesterSelect.addEventListener('change', applyFilters);
courseSelect.addEventListener('change', applyFilters);
statusSelect.addEventListener('change', applyFilters);

// ===============================
// 6. ABRIR Y CERRAR MODALES
// ===============================
function assignModalButtons() {
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
}

// ===============================
// 7. BOTONES DE CIERRE DE MODAL
// ===============================
document.querySelectorAll('.close-btn, .close-modal-btn').forEach(btn => {
    btn.addEventListener('click', () => {
        document.getElementById('comment-modal').style.display = 'none';
        document.getElementById('grade-modal').style.display = 'none';
    });
});

// ===============================
// 8. ENVIAR FORMULARIO DE COMENTARIO
// ===============================
document.getElementById('comment-form').addEventListener('submit', async function(e) {
    e.preventDefault();

    const studentId = document.getElementById('student-id').value;
    const comment = document.getElementById('comment').value;

    const formData = new FormData();
    formData.append('id', studentId);
    formData.append('comentario', comment);

    const response = await fetch('actualizar_comentario.php', {
        method: 'POST',
        body: formData
    });

    const result = await response.json();
    if (result.success) {
        alert('Comentario actualizado');
        location.reload();
    } else {
        alert('Error al actualizar el comentario');
    }
});

// ===============================
// 9. ENVIAR FORMULARIO DE CALIFICACIÓN
// ===============================
document.getElementById('grade-form').addEventListener('submit', async function(e) {
    e.preventDefault();

    const studentId = document.getElementById('grade-student-id').value;
    const unidad = document.getElementById('unit-select').value;
    const nota = document.getElementById('new-grade').value;
    const comentario = document.getElementById('grade-comment').value;

    const formData = new FormData();
    formData.append('id', studentId);
    formData.append('unidad', unidad);
    formData.append('nota', nota);
    formData.append('comentario', comentario);

    const response = await fetch('actualizar_calificacion.php', {
        method: 'POST',
        body: formData
    });

    const result = await response.json();
    if (result.success) {
        alert('Calificación actualizada');
        location.reload();
    } else {
        alert('Error al actualizar la calificación');
    }
});

// ===============================
// 10. EXPORTAR PDF (A FUTURO)
// ===============================
document.getElementById('export-btn').addEventListener('click', () => {
    alert('Exportando a PDF... (falta implementación con jsPDF)');
});

// ===============================
// 11. INICIALIZAR TABLA Y APLICAR FILTROS
// ===============================
// Asegúrate de que `studentsData` esté definido en el HTML como un array válido
console.log('Estudiantes cargados:', studentsData); // Verifica que existe

renderTable(studentsData); // Cargar todos los estudiantes al iniciar
applyFilters(); // Aplicar filtros si alguno está seleccionado
