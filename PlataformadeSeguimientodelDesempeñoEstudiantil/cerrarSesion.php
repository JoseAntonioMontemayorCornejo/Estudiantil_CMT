<?php
session_start();
session_destroy();
header("Location: InicioSesionAlumno.html");
exit();
