// Abrir modal de comentario
document.querySelectorAll('.edit-comment-btn').forEach(btn => {
    btn.addEventListener('click', () => {
        document.getElementById('student-id').value = btn.dataset.id;
        document.getElementById('student-name').textContent = btn.dataset.name;
        document.getElementById('comment').value = btn.dataset.comment || '';
        document.getElementById('comment-modal').style.display = 'flex';
    });
});

// Abrir modal de calificación
document.querySelectorAll('.edit-grade-btn').forEach(btn => {
    btn.addEventListener('click', () => {
        document.getElementById('grade-student-id').value = btn.dataset.id;
        document.getElementById('grade-student-name').textContent = btn.dataset.name;
        document.getElementById('grade-modal').style.display = 'flex';
    });
});

// Cerrar modales
document.querySelectorAll('.close-btn, .close-modal-btn').forEach(btn => {
    btn.addEventListener('click', () => {
        document.getElementById('comment-modal').style.display = 'none';
        document.getElementById('grade-modal').style.display = 'none';
    });
});

// Enviar comentario
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

// Enviar calificación
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

// Botón de exportar PDF (a futuro)
document.getElementById('export-btn').addEventListener('click', () => {
    alert('Exportando a PDF... (falta implementación con jsPDF)');
});
