# Plataforma de Seguimiento del Desempeño Estudiantil

Esta aplicación web tiene como objetivo facilitar el monitoreo del rendimiento académico de los estudiantes a través de diferentes roles: **administrador**, **docente** y **alumno**.  
Ofrece funcionalidades como registro de usuarios, inicio de sesión y acceso a interfaces específicas según el tipo de usuario.

---

#Vista general

Este proyecto está compuesto por páginas web en HTML, estilos en CSS, lógica en JavaScript, backend en PHP y un script SQL para la creación de la base de datos.  
Puede ser usado como prototipo o integrado con un backend más robusto si se requiere funcionalidad completa de autenticación, sesiones y gestión de datos.

---

# Estructura del Proyecto

PlataformadeSeguimientodelDesempeñoEstudiantil/
│
├── BaseDeDatos/
│ └── calificaciones_db.sql # Script para crear la base de datos
│
├── assets/
│ ├── css/
│ │ └── estilos.css # Estilos generales
│ ├── js/
│ │ └── scripts.js # Funciones JavaScript
│ └── img/
│ ├── LeonAdmin.png
│ ├── LeonAlumno.png
│ ├── LeonDocente.png
│ ├── LeonAdministrativo.png
│ ├── LeonMascota.png
│ └── LogoTec.png
│
├── includes/
│ ├── cerrarSesion.php # Cierra la sesión actual
│ ├── Conexion.php # Conexión a la base de datos
│ └── obtener_materias.php # Carga materias por usuario
│
├── php/
│ ├── calificaciones/
│ │ ├── actualizar_calificacion.php
│ │ ├── actualizar_comentario.php
│ │ ├── actualizar.php
│ │ ├── CalificacionesAlumno.php
│ │ └── calificacionesDocente.php
│ ├── login/
│ │ ├── loginAdminUsuario.php
│ │ ├── loginAlumno.php
│ │ └── loginDocente.php
│ └── registro/
│ ├── registroAlumnoConexion.php
│ └── RegistroDocente.php
│
├── index.html # Página principal
├── InicioSesionAlumno.html # Login para alumnos
├── InicioSesionDocente.html # Login para docentes
├── InicioSesionAdminUsuario.html # Login para administradores
├── RegistrarAlumno.html # Registro de alumnos
├── RegistroDocente.html # Registro de docentes
├── inicioAdmin.html # Panel de administrador
└── Nosotros.html # Información institucional

---

## 🛠️ Tecnologías Utilizadas

- HTML5
- CSS
- JavaScript
- PHP
- MySQL
- Git

---

# Instalación y Uso
# Opción 1: Manual

1. Clona el repositorio o descarga los archivos `.zip`.
2. Coloca el proyecto en la carpeta `htdocs` de **XAMPP**, **WAMP** o similar.
3. Inicia los servicios de **Apache** y **MySQL** desde el panel de control.
4. Abre **phpMyAdmin** y crea una base de datos llamada `calificaciones_db`.
5. Importa el archivo `BaseDeDatos/calificaciones_db.sql`.
6. Asegúrate de configurar correctamente el archivo `Conexion.php` con tus credenciales de base de datos.
7. Accede a la plataforma desde tu navegador:  http://localhost/PlataformadeSeguimientodelDesempeñoEstudiantil/

---

# Opción 2: Desde Git Bash
Abrimos git bash desde la carpeta seleccionada para guardar archivos
git clone https://github.com/tuusuario/seguimiento-estudiantil.git
cd seguimiento-estudiantil
Luego, sigue los pasos del apartado anterior nuemero 2.

---

# Requisitos
-Navegador web moderno (Chrome, Firefox, Edge).
-Servidor web local (XAMPP, WAMP, MAMP).
-Servidor de base de datos MySQL o MariaDB.
-Editor de código (Visual Studio Code, Sublime, etc.).

---

# Estado del Proyecto: Prototipo funcional. Puede ampliarse con:
Validación de formularios y seguridad (hash de contraseñas, SQL injections).
Backend más robusto con autenticación segura.
Panel de administración más completo.
Reportes mas dinámicos.

---

# Autores y Contacto
José Antonio Montemayor
📧 jose.montemayor.22isc@tecsanpedro.edu.mx
Gerardo Daniel Rodallegas
📧 gerardo.rodallegas.22isc@tecsanpedro.edu.mx
Iván José Escobar
📧 ivan.escobar.22isc@tecsanpedro.edu.mx
Juan Ángel García
📧 juan.garcia.22isc@tecsanpedro.edu.mx