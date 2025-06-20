<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../../PHPMailer-master/src/PHPMailer.php';
require '../../PHPMailer-master/src/SMTP.php';
require '../../PHPMailer-master/src/Exception.php';

$conexion = new mysqli("localhost", "root", "", "calificaciones_db");

if ($conexion->connect_error) {
    file_put_contents("log_envio.txt", "Error DB: " . $conexion->connect_error . "\n", FILE_APPEND);
    exit("DB error");
}

$query = "SELECT a.nombre, a.correo, c.promedio, m.nombre AS materia
          FROM alumnos a
          JOIN calificaciones c ON a.id = c.alumno_id
          JOIN materias m ON c.materia_id = m.id
          WHERE c.promedio < 70 AND a.correo IS NOT NULL AND a.correo != ''";

$resultado = $conexion->query($query);

if (!$resultado) {
    file_put_contents("log_envio.txt", "Error SQL: " . $conexion->error . "\n", FILE_APPEND);
    exit("Query error");
}

while ($alumno = $resultado->fetch_assoc()) {
    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'tonymontemayor037@gmail.com';  // Tu correo
        $mail->Password = 'plis vcdc nepx pxfo';             // Contraseña de aplicación Gmail
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        $mail->setFrom('tonymontemayor037@gmail.com', 'Sistema de Calificaciones');
        $mail->addAddress($alumno['correo'], $alumno['nombre']);

        $mail->isHTML(true);
        $mail->Subject = "⚠️ Alerta de Bajo Promedio";
        $mail->Body = "
            <p>Hola <strong>{$alumno['nombre']}</strong>,</p>
            <p>Tu promedio actual en la materia <strong>{$alumno['materia']}</strong> es de <strong>{$alumno['promedio']}</strong>.</p>
            <p>Te recomendamos hablar con tu docente y mejorar tu rendimiento.</p>
            <p>Atentamente,<br>Coordinación Académica</p>
        ";

        $mail->send();
        file_put_contents("log_envio.txt", "Correo enviado a: {$alumno['correo']}\n", FILE_APPEND);
    } catch (Exception $e) {
        file_put_contents("log_envio.txt", "Error al enviar a {$alumno['correo']}: {$mail->ErrorInfo}\n", FILE_APPEND);
    }
}
echo "Proceso finalizado.";
?>
