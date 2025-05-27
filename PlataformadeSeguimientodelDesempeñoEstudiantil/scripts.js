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
    if (!data || data.length === 0) {
        gradesBody.innerHTML = '<tr><td colspan="7" class="text-center">No hay estudiantes que coincidan con los filtros</td></tr>';
        return;
    }

    gradesBody.innerHTML = ''; // Limpiar tabla

    data.forEach(est => {
        const row = document.createElement('tr');

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
        gradesBody.appendChild(row);
    });
}




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
// 10. EXPORTAR PDF (VERSIÓN MEJORADA)
// ===============================
document.getElementById('export-btn').addEventListener('click', exportToPDF);



// ===============================
// 10. EXPORTAR PDF (IMPLEMENTADO)
// ===============================
document.getElementById('export-btn').addEventListener('click', exportToPDF);

function exportToPDF() {
  // Configuración del PDF
  const doc = new jsPDF({
    orientation: 'landscape', // Horizontal para mejor ajuste de la tabla
    unit: 'mm'
  });

  // Título del PDF
  const title = "Reporte de Calificaciones";
  const semester = semesterSelect.options[semesterSelect.selectedIndex].text;
  const course = courseSelect.options[courseSelect.selectedIndex].text;
  
  // Captura la tabla con html2canvas
  const element = document.querySelector('.table');
  
  html2canvas(element).then(canvas => {
    const imgData = canvas.toDataURL('image/png');
    const imgWidth = 280; // Ancho máximo en mm (A4 landscape)
    const imgHeight = (canvas.height * imgWidth) / canvas.width;
    
    // Agrega metadatos y título
    doc.setProperties({
      title: title,
      subject: `Semestre: ${semester} | Curso: ${course}`,
      author: 'Sistema de Calificaciones'
    });
    
    doc.text(title, 14, 15);
    doc.text(`Semestre: ${semester} | Curso: ${course}`, 14, 20);
    doc.addImage(imgData, 'PNG', 10, 25, imgWidth, imgHeight);
    
    // Guarda el PDF
    doc.save(`Calificaciones_${semester}_${course}.pdf`);
  });
}






