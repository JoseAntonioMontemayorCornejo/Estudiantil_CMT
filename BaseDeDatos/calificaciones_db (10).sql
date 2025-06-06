-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 06-06-2025 a las 16:15:03
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `calificaciones_db`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `adminnoadmin`
--

CREATE TABLE `adminnoadmin` (
  `id` int(11) NOT NULL,
  `correo` varchar(100) DEFAULT NULL,
  `contrasena` varchar(100) DEFAULT NULL,
  `tipo` enum('admin','alumno') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `adminnoadmin`
--

INSERT INTO `adminnoadmin` (`id`, `correo`, `contrasena`, `tipo`) VALUES
(1, 'admin@tecsanpedro.edu.mx', 'admin123', 'admin'),
(3, 'alumno@tecsanpedro.edu.mx', 'alumno123', 'alumno');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumnos`
--

CREATE TABLE `alumnos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `correo` varchar(100) DEFAULT NULL,
  `contrasena` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `alumnos`
--

INSERT INTO `alumnos` (`id`, `nombre`, `correo`, `contrasena`) VALUES
(2, 'Alvaro', 'jose.montemayor.22isc@tecsanpedro.edu.mx', '18204'),
(3, 'Jorge Monsivais', 'tonymontemayor037@gmail.com', '424212'),
(4, 'Marco Manuel', 'marco.manuel.22isc@tecsanpedro.edu.mx', '424212'),
(5, 'Jose Mauel Montemayor Cornejo', 'jose.manuel.22isc@tecsanpedro.edu.mx', '424212'),
(6, 'Alexis Quistian', 'Alexis@gmail.com', '424212'),
(7, 'Alejandro Juarez', 'ale@gmail.com', '424212'),
(8, 'Odalys Castro', 'Odalys@gmail.com', '424212'),
(9, 'Luis Mendoza', 'luis.mendoza@tecsanpedro.edu.mx', '1234'),
(10, 'Sofia Ruiz', 'sofia.ruiz@tecsanpedro.edu.mx', '1234'),
(11, 'Carlos Torres', 'carlos.torres@tecsanpedro.edu.mx', '1234'),
(12, 'Daniela Rios', 'daniela.rios@tecsanpedro.edu.mx', '1234'),
(13, 'Javier Soto', 'javier.soto@tecsanpedro.edu.mx', '1234'),
(14, 'Ana Lucia', 'ana.lucia@tecsanpedro.edu.mx', '1234'),
(15, 'Fernando Lopez', 'fernando.lopez@tecsanpedro.edu.mx', '1234'),
(16, 'Isabella Garcia', 'isabella.garcia@tecsanpedro.edu.mx', '1234'),
(17, 'Bruno Martinez', 'bruno.martinez@tecsanpedro.edu.mx', '1234'),
(18, 'Valeria Chavez', 'valeria.chavez@tecsanpedro.edu.mx', '1234'),
(19, 'Emilio Ramos', 'emilio.ramos@tecsanpedro.edu.mx', '1234'),
(20, 'Lucia Navarro', 'lucia.navarro@tecsanpedro.edu.mx', '1234'),
(21, 'Mateo Gil', 'mateo.gil@tecsanpedro.edu.mx', '1234'),
(22, 'Regina Herrera', 'regina.herrera@tecsanpedro.edu.mx', '1234'),
(23, 'Ivan Castro', 'ivan.castro@tecsanpedro.edu.mx', '1234'),
(24, 'Camila Gomez', 'camila.gomez@tecsanpedro.edu.mx', '1234'),
(25, 'Sebastian Salas', 'sebastian.salas@tecsanpedro.edu.mx', '1234'),
(26, 'Paula Cantu', 'paula.cantu@tecsanpedro.edu.mx', '1234'),
(27, 'Diego Luna', 'diego.luna@tecsanpedro.edu.mx', '1234'),
(28, 'Andrea Ibarra', 'andrea.ibarra@tecsanpedro.edu.mx', '1234'),
(29, 'Mario Treviño', 'mario.trevino@tecsanpedro.edu.mx', '1234'),
(30, 'Fernanda Moya', 'fernanda.moya@tecsanpedro.edu.mx', '1234'),
(31, 'Alejandro Peña', 'alejandro.pena@tecsanpedro.edu.mx', '1234'),
(32, 'Renata Ortiz', 'renata.ortiz@tecsanpedro.edu.mx', '1234'),
(33, 'Adrian Molina', 'adrian.molina@tecsanpedro.edu.mx', '1234'),
(34, 'Carla Duran', 'carla.duran@tecsanpedro.edu.mx', '1234'),
(35, 'Hector Rivera', 'hector.rivera@tecsanpedro.edu.mx', '1234'),
(36, 'Jimena Valdez', 'jimena.valdez@tecsanpedro.edu.mx', '1234'),
(37, 'Santiago Leal', 'santiago.leal@tecsanpedro.edu.mx', '1234'),
(38, 'Natalia Zamora', 'natalia.zamora@tecsanpedro.edu.mx', '1234'),
(39, 'Lucas Rangel', 'lucas.rangel@tecsanpedro.edu.mx', '1234'),
(40, 'Maite Estrada', 'maite.estrada@tecsanpedro.edu.mx', '1234'),
(41, 'Esteban Cano', 'esteban.cano@tecsanpedro.edu.mx', '1234'),
(42, 'Andrea Sepulveda', 'andrea.sepulveda@tecsanpedro.edu.mx', '1234'),
(43, 'Victor Ayala', 'victor.ayala@tecsanpedro.edu.mx', '1234'),
(44, 'Daniel Guerrero', 'daniel.guerrero@tecsanpedro.edu.mx', '1234'),
(45, 'Sara Solis', 'sara.solis@tecsanpedro.edu.mx', '1234'),
(46, 'Leonardo Rios', 'leonardo.rios@tecsanpedro.edu.mx', '1234'),
(47, 'Gabriela Vega', 'gabriela.vega@tecsanpedro.edu.mx', '1234'),
(48, 'Rodrigo Mendez', 'rodrigo.mendez@tecsanpedro.edu.mx', '1234'),
(49, 'Gustavo Romero', 'gustavo.romero@tecsanpedro.edu.mx', '1234'),
(50, 'Camila Cruz', 'camila.cruz@tecsanpedro.edu.mx', '1234'),
(51, 'Jorge Ruiz', 'jorge.ruiz@tecsanpedro.edu.mx', '1234'),
(52, 'Esteban Molina', 'esteban.molina@tecsanpedro.edu.mx', '1234'),
(53, 'Natalia Castillo', 'natalia.castillo@tecsanpedro.edu.mx', '1234'),
(54, 'Pablo Rivas', 'pablo.rivas@tecsanpedro.edu.mx', '1234'),
(55, 'Hugo Medina', 'hugo.medina@tecsanpedro.edu.mx', '1234'),
(56, 'Julieta Vargas', 'julieta.vargas@tecsanpedro.edu.mx', '1234'),
(57, 'Samuel Rojas', 'samuel.rojas@tecsanpedro.edu.mx', '1234'),
(58, 'Pamela Soto', 'pamela.soto@tecsanpedro.edu.mx', '1234'),
(59, 'Ricardo Peña', 'ricardo.pena@tecsanpedro.edu.mx', '1234'),
(60, 'Florencia Luna', 'florencia.luna@tecsanpedro.edu.mx', '1234'),
(61, 'Erick Ayala', 'erick.ayala@tecsanpedro.edu.mx', '1234'),
(62, 'Daniela Duran', 'daniela.duran@tecsanpedro.edu.mx', '1234'),
(63, 'Ivan Espinoza', 'ivan.espinoza@tecsanpedro.edu.mx', '1234'),
(64, 'Melanie Vargas', 'melanie.vargas@tecsanpedro.edu.mx', '1234'),
(65, 'Cristina Torres', 'cristina.torres@tecsanpedro.edu.mx', '1234'),
(66, 'Kevin Reyes', 'kevin.reyes@tecsanpedro.edu.mx', '1234'),
(67, 'Monica Diaz', 'monica.diaz@tecsanpedro.edu.mx', '1234'),
(68, 'Victor Cano', 'victor.cano@tecsanpedro.edu.mx', '1234'),
(69, 'Emma Jimenez', 'emma.jimenez@tecsanpedro.edu.mx', '1234'),
(70, 'Dario Beltran', 'dario.beltran@tecsanpedro.edu.mx', '1234'),
(71, 'Laura Castañeda', 'laura.castaneda@tecsanpedro.edu.mx', '1234'),
(72, 'Mia Bravo', 'mia.bravo@tecsanpedro.edu.mx', '1234'),
(73, 'Jesus Montemayor Cornejo', 'jesus@gmail.com', '1234'),
(74, 'Jhon Nolan', 'Nolan123@tecsanpedro.edu.mx', '1234567890'),
(75, 'Angel Garcia', 'Angel@gmail.com', '1234'),
(76, 'Luis Diego Barajas', 'Luis@gmail.com', '1234'),
(77, 'Pablo Perez', 'perez@gmail.com', '1234'),
(78, 'Cristian Ramirez', 'cristian@tecsanpedro.edu.mx', '1234'),
(79, 'Luis Paredes', 'luis.paredes@tecsanpedro.edu.mx', 'paredes2025'),
(80, 'Camila Robles', 'camila.robles@tecsanpedro.edu.mx', 'camirob01'),
(81, 'Diego Silva', 'diego.silva@tecsanpedro.edu.mx', 'diegopass1'),
(82, 'Andrea Rangel', 'andrea.rangel@tecsanpedro.edu.mx', 'andr1234'),
(83, 'Hugo Salinas', 'hugo.salinas@tecsanpedro.edu.mx', 'hugo2025'),
(84, 'Isabella Marin', 'isabella.marin@tecsanpedro.edu.mx', 'isaeasy9'),
(85, 'Juan Neri', 'juan.neri@tecsanpedro.edu.mx', 'ju4npass'),
(86, 'Mia Ortega', 'mia.ortega@tecsanpedro.edu.mx', 'miafree7'),
(87, 'Carlos Vela', 'carlos.vela@tecsanpedro.edu.mx', 'cv2025go'),
(88, 'Regina Soto', 'regina.soto@tecsanpedro.edu.mx', 'rs123ok'),
(89, 'Pablo Cano', 'pablo.cano@tecsanpedro.edu.mx', 'canoeasy'),
(90, 'Diana Ponce', 'diana.ponce@tecsanpedro.edu.mx', 'dp2024ok'),
(91, 'Samuel Rivas', 'samuel.rivas@tecsanpedro.edu.mx', 'samgo321'),
(92, 'Paula Teran', 'paula.teran@tecsanpedro.edu.mx', 'ptpass98'),
(93, 'Leonardo Sosa', 'leonardo.sosa@tecsanpedro.edu.mx', 'leoqwer1'),
(94, 'Julia Ramos', 'julia.ramos@tecsanpedro.edu.mx', 'julia456'),
(95, 'Eduardo Leal', 'eduardo.leal@tecsanpedro.edu.mx', 'edleal77'),
(96, 'Karen Mejia', 'karen.mejia@tecsanpedro.edu.mx', 'karen22'),
(97, 'Bruno Peña', 'bruno.pena@tecsanpedro.edu.mx', 'bru22pass'),
(98, 'Alexa Guerra', 'alexa.guerra@tecsanpedro.edu.mx', 'alexaok7'),
(99, 'Jose Lozano', 'jose.lozano@tecsanpedro.edu.mx', 'jlo123'),
(100, 'Melissa Beltran', 'melissa.beltran@tecsanpedro.edu.mx', 'melpass5'),
(101, 'Jorge Valdez', 'jorge.valdez@tecsanpedro.edu.mx', 'jvaldez8'),
(102, 'Nataly Esquivel', 'nataly.esquivel@tecsanpedro.edu.mx', 'nesq2025'),
(103, 'Victor Moya', 'victor.moya@tecsanpedro.edu.mx', 'vmoya123'),
(104, 'Ana Villalobos', 'ana.villalobos@tecsanpedro.edu.mx', 'villana7'),
(105, 'Luis Cazares', 'luis.cazares@tecsanpedro.edu.mx', 'cazluis'),
(106, 'Renata Ibarra', 'renata.ibarra@tecsanpedro.edu.mx', 'renib23'),
(107, 'Alan Gonzalez', 'alan.gonzalez@tecsanpedro.edu.mx', 'alanz123'),
(108, 'Ximena Saldaña', 'ximena.saldana@tecsanpedro.edu.mx', 'xim23go'),
(109, 'Esteban Rojas', 'esteban.rojas@tecsanpedro.edu.mx', 'esrojok'),
(110, 'Camila Lara', 'camila.lara@tecsanpedro.edu.mx', 'clara123'),
(111, 'Fernando Molina', 'fernando.molina@tecsanpedro.edu.mx', 'femo321'),
(112, 'Daniela Cordero', 'daniela.cordero@tecsanpedro.edu.mx', 'danico'),
(113, 'Luis Torres', 'luis.torres@tecsanpedro.edu.mx', 'ltorres8');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `calificaciones`
--

CREATE TABLE `calificaciones` (
  `id` int(11) NOT NULL,
  `alumno_id` int(11) DEFAULT NULL,
  `unidad1` int(11) DEFAULT 0,
  `unidad2` int(11) DEFAULT 0,
  `unidad3` int(11) DEFAULT 0,
  `promedio` int(11) DEFAULT 0,
  `comentario` text DEFAULT NULL,
  `comentario_u1` text DEFAULT NULL,
  `comentario_u2` text DEFAULT NULL,
  `comentario_u3` text DEFAULT NULL,
  `materia_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `calificaciones`
--

INSERT INTO `calificaciones` (`id`, `alumno_id`, `unidad1`, `unidad2`, `unidad3`, `promedio`, `comentario`, `comentario_u1`, `comentario_u2`, `comentario_u3`, `materia_id`) VALUES
(1, 101, 59, 61, 68, 63, 'Auto-generado', 'Comentario U1', 'Comentario U2', 'Comentario U3', 1),
(2, 2, 60, 90, 100, 83, 'Mejoro en las ultimas unidades', 'Exelente2', 'Exelente3', 'Exelente4', 4),
(3, 3, 100, 100, 100, 100, 'Puede mejorar en unidad 1', 'Exelente3', 'Exelente4', 'Exelente5', 3),
(4, 104, 90, 90, 88, 89, 'Auto-generado', 'Comentario U1', 'Comentario U2', 'Comentario U3', 1),
(5, 105, 92, 62, 95, 83, 'Auto-generado', 'Comentario U1', 'Comentario U2', 'Comentario U3', 2),
(6, 6, 90, 90, 90, 90, 'Regulare', '', '', '', 1),
(7, 7, 100, 100, 95, 98, 'Excelente trabajos', '', '', '', 2),
(8, 8, 50, 55, 60, 55, 'Debe esforzarse más', '', '', '', 1),
(9, 9, 90, 85, 90, 88, 'Buen rendimiento general', '', '', '', 2),
(10, 10, 100, 100, 100, 100, 'Exelente', 'Buen alumno', 'Entrego todo correctamente', 'Le fue exelente', 3),
(11, 11, 96, 99, 99, 98, 'siuuuu', 'buen alumno', 'Exelente', 'Exelentee', 5),
(12, 12, 75, 78, 72, 75, 'Constante en sus entregas', '', '', '', 2),
(13, 13, 40, 45, 50, 45, 'Debe mejorar bastante', '', '', '', 3),
(14, 14, 95, 90, 88, 91, 'Muy buen trabajo', '', '', '', 1),
(15, 15, 100, 100, 100, 100, 'Buen progresox', '1', '2', '3', 3),
(16, 16, 67, 60, 63, 63, 'Le falta repasar teoría', '', '', '', 2),
(17, 17, 91, 94, 89, 91, 'Excelente participación', '', '', '', 5),
(18, 18, 55, 50, 52, 52, 'Debe asistir más a clase', '', '', '', 3),
(19, 19, 73, 75, 78, 75, 'Buen avance', '', '', '', 1),
(20, 20, 89, 85, 87, 87, 'Responsable y puntual', '', '', '', 3),
(21, 21, 60, 65, 60, 62, 'Rinde mejor en práctica', '', '', '', 1),
(22, 22, 70, 68, 75, 71, 'Mejoró en unidad 3', '', '', '', 2),
(23, 23, 95, 93, 97, 95, 'Trabajo excelente', '', '', '', 3),
(24, 24, 100, 100, 100, 100, 'Exelente alumna', 'e', 'g', 'i', 3),
(25, 25, 65, 60, 58, 61, 'Debe entregar tareas', '', '', '', 5),
(26, 26, 88, 84, 85, 86, 'Buen manejo del contenido', '', '', '', 1),
(27, 27, 90, 90, 90, 90, 'Muy buen nivel', '', '', '', 5),
(28, 28, 100, 78, 98, 92, 'Siu', 'Exelente', 'Regualar', 'Mejor denuevo', 2),
(29, 29, 100, 86, 77, 0, 'Comentario General', 'Comentario1', 'Comentario2', 'Comentario3', 13),
(30, 30, 83, 85, 80, 83, 'Correcta ejecución', 'Entrega puntual', 'Faltó detalle', 'Bien explicado', 3),
(31, 31, 88, 90, 85, 88, 'Rendimiento notable', 'Comprende conceptos', 'Buena aplicación', 'Ejemplos adecuados', 1),
(32, 32, 92, 94, 95, 94, 'Muy participativa', 'Resuelve retos', 'Aplica teoría', 'Bien estructurado', 5),
(33, 33, 75, 78, 80, 78, 'Cumple tareas', 'Asistencia regular', 'Atención buena', 'Refuerzo útil', 4),
(34, 34, 86, 89, 87, 87, 'Buena participación y entrega', 'Responsable', 'Atento', 'Trabajo limpio', 2),
(35, 35, 91, 88, 90, 90, 'Trabajo consistente', 'Buen desarrollo', 'Estructurado', 'Aplica conceptos', 3),
(36, 36, 77, 75, 80, 77, 'Debe participar más en clase', 'Faltan ejemplos', 'Buena base', 'Poco preciso', 5),
(37, 37, 92, 90, 93, 92, 'Muy buen rendimiento', 'Aplica bien la teoría', 'Soluciona con lógica', 'Excelente presentación', 1),
(38, 38, 70, 72, 74, 72, 'Debe mejorar en organización', 'Ideas desordenadas', 'Entrega oportuna', 'Le falta síntesis', 4),
(39, 39, 89, 87, 90, 89, 'Alumno confiable', 'Bien fundamentado', 'Participativo', 'Trabajo en equipo', 2),
(40, 40, 85, 88, 86, 86, 'Cumple con todos los requerimientos', 'Buen enfoque', 'Escrito claro', 'Manejo de recursos', 3),
(41, 41, 78, 80, 82, 80, 'Puede mejorar con más práctica', 'Avanza lento', 'Ejercicios incompletos', 'Aun así entrega', 1),
(42, 42, 91, 93, 95, 93, 'Trabajo excelente', 'Solución rápida', 'Respuestas correctas', 'Dedicación evidente', 5),
(43, 43, 87, 90, 88, 88, 'Actitud positiva', 'Puntualidad destacada', 'Manejo de conceptos', 'Trabajo limpio', 4),
(44, 44, 79, 82, 81, 81, 'Atiende recomendaciones', 'Mejora en unidad 2', 'Constancia', 'Debe reforzar temas previos', 3),
(45, 45, 84, 86, 88, 86, 'Muy comprometido', 'Asistencia perfecta', 'Participa en clase', 'Entrega destacada', 5),
(46, 46, 73, 76, 75, 75, 'Necesita reforzar conceptos', 'Faltó explicación', 'Correcta ejecución', 'En progreso', 2),
(47, 47, 88, 85, 87, 87, 'Buena base lógica', 'Comprende el contenido', 'Correcto', 'Aporta ideas', 1),
(48, 48, 76, 78, 80, 78, 'Le cuesta enfocarse', 'Trabajo justo', 'Esfuerzo visible', 'Se apoya en equipo', 3),
(49, 49, 89, 91, 90, 90, 'Muy buena actitud y entrega', 'Participa siempre', 'Buena disposición', 'Aprende rápido', 4),
(50, 50, 83, 80, 85, 83, 'Rinde mejor en clase práctica', 'Necesita estudio individual', 'Comprende bien en grupo', 'Trabajo aceptable', 2),
(51, 51, 86, 89, 87, 87, 'Buena participación y entrega', 'Responsable', 'Atento', 'Trabajo limpio', 6),
(52, 152, 75, 56, 87, 73, 'Auto-generado', 'Comentario U1', 'Comentario U2', 'Comentario U3', 1),
(53, 153, 66, 59, 99, 75, 'Auto-generado', 'Comentario U1', 'Comentario U2', 'Comentario U3', 5),
(54, 154, 65, 61, 53, 60, 'Auto-generado', 'Comentario U1', 'Comentario U2', 'Comentario U3', 3),
(55, 155, 70, 94, 65, 76, 'Auto-generado', 'Comentario U1', 'Comentario U2', 'Comentario U3', 6),
(56, 156, 89, 89, 90, 89, 'Auto-generado', 'Comentario U1', 'Comentario U2', 'Comentario U3', 2),
(57, 157, 91, 100, 93, 95, 'Auto-generado', 'Comentario U1', 'Comentario U2', 'Comentario U3', 5),
(58, 158, 54, 98, 80, 77, 'Auto-generado', 'Comentario U1', 'Comentario U2', 'Comentario U3', 2),
(59, 159, 62, 83, 73, 73, 'Auto-generado', 'Comentario U1', 'Comentario U2', 'Comentario U3', 6),
(60, 160, 99, 88, 88, 92, 'Auto-generado', 'Comentario U1', 'Comentario U2', 'Comentario U3', 4),
(61, 161, 55, 96, 97, 83, 'Auto-generado', 'Comentario U1', 'Comentario U2', 'Comentario U3', 4),
(62, 162, 85, 74, 74, 78, 'Auto-generado', 'Comentario U1', 'Comentario U2', 'Comentario U3', 6),
(63, 163, 81, 76, 84, 80, 'Auto-generado', 'Comentario U1', 'Comentario U2', 'Comentario U3', 6),
(64, 164, 56, 60, 55, 57, 'Auto-generado', 'Comentario U1', 'Comentario U2', 'Comentario U3', 1),
(65, 165, 68, 98, 90, 85, 'Auto-generado', 'Comentario U1', 'Comentario U2', 'Comentario U3', 4),
(66, 166, 60, 78, 56, 65, 'Auto-generado', 'Comentario U1', 'Comentario U2', 'Comentario U3', 3),
(67, 167, 58, 92, 69, 73, 'Auto-generado', 'Comentario U1', 'Comentario U2', 'Comentario U3', 3),
(68, 168, 76, 99, 77, 84, 'Auto-generado', 'Comentario U1', 'Comentario U2', 'Comentario U3', 2),
(69, 169, 75, 64, 62, 67, 'Auto-generado', 'Comentario U1', 'Comentario U2', 'Comentario U3', 5),
(70, 170, 63, 83, 63, 70, 'Auto-generado', 'Comentario U1', 'Comentario U2', 'Comentario U3', 4),
(71, 171, 100, 91, 96, 96, 'Auto-generado', 'Comentario U1', 'Comentario U2', 'Comentario U3', 1),
(72, 172, 87, 72, 79, 79, 'Auto-generado', 'Comentario U1', 'Comentario U2', 'Comentario U3', 6),
(73, 73, 67, 96, 89, 84, 'Auto-generado', 'Comentario U1', 'Comentario U2', 'Comentario U3', 2),
(74, 174, 95, 71, 95, 87, 'Auto-generado', 'Comentario U1', 'Comentario U2', 'Comentario U3', 3),
(75, 75, 100, 0, 50, 50, 'Bajo su  promedio rapidamente', 'Exelente entrego todo en forma', 'No asistio ni entrego nada', 'No entraba a la mayoria de clases', 3),
(76, 76, 76, 34, 90, 67, 'No entro a ninguna clase', 'Le fue mal en el examen', 'No entrego nada y entro a clases', 'Mejoro mucho', 1),
(77, 77, 100, 70, 40, 70, 'Vale queso', 'Buen estudiante', 'Pasando', 'Se desvió el compañero', 6),
(78, 78, 0, 0, 0, 0, NULL, NULL, NULL, NULL, 14),
(79, 79, 80, 85, 90, 85, 'Buen trabajo en clase', NULL, NULL, NULL, 7),
(80, 80, 75, 78, 74, 76, 'Participación constante', NULL, NULL, NULL, 7),
(81, 81, 88, 90, 87, 88, 'Excelente desempeño', NULL, NULL, NULL, 7),
(82, 82, 60, 65, 70, 65, 'Puede mejorar', NULL, NULL, NULL, 7),
(83, 83, 90, 93, 92, 92, 'Muy aplicado', NULL, NULL, NULL, 8),
(84, 84, 70, 72, 68, 70, 'Entregas puntuales', NULL, NULL, NULL, 8),
(85, 85, 65, 60, 63, 63, 'Debe repasar teoría', NULL, NULL, NULL, 8),
(86, 86, 85, 88, 90, 88, 'Buena comprensión', NULL, NULL, NULL, 8),
(87, 87, 78, 80, 79, 79, 'Buen desarrollo', NULL, NULL, NULL, 9),
(88, 88, 92, 95, 91, 93, 'Excelente rendimiento', NULL, NULL, NULL, 9),
(89, 89, 67, 70, 68, 68, 'Cumple tareas', NULL, NULL, NULL, 9),
(90, 90, 75, 78, 80, 78, 'Asistencia regular', NULL, NULL, NULL, 9),
(91, 91, 82, 80, 85, 82, 'Trabaja bien en equipo', NULL, NULL, NULL, 10),
(92, 92, 70, 74, 72, 72, 'Participa activamente', NULL, NULL, NULL, 10),
(93, 93, 90, 85, 88, 88, 'Muy responsable', NULL, NULL, NULL, 10),
(94, 94, 60, 62, 65, 62, 'Debe practicar más', NULL, NULL, NULL, 11),
(95, 95, 77, 75, 80, 77, 'Atento en clase', NULL, NULL, NULL, 11),
(96, 96, 85, 88, 90, 88, 'Muestra compromiso', NULL, NULL, NULL, 11),
(97, 97, 70, 73, 75, 73, 'Entusiasmo constante', NULL, NULL, NULL, 11),
(98, 98, 95, 97, 94, 95, 'Excelente participación', NULL, NULL, NULL, 12),
(99, 99, 60, 65, 70, 65, 'Esfuerzo notable', NULL, NULL, NULL, 12),
(100, 100, 80, 78, 82, 80, 'Rinde bien', NULL, NULL, NULL, 12),
(101, 101, 67, 70, 68, 68, 'Buena actitud', NULL, NULL, NULL, 12),
(102, 102, 90, 85, 88, 88, 'Buen desempeño', NULL, NULL, NULL, 13),
(103, 103, 75, 78, 80, 78, 'Buen desarrollo', NULL, NULL, NULL, 13),
(104, 104, 85, 88, 85, 86, 'Aplica bien la teoría', NULL, NULL, NULL, 13),
(105, 105, 90, 92, 93, 92, 'Alumno destacado', NULL, NULL, NULL, 13),
(106, 106, 60, 58, 65, 61, 'Debe enfocarse más', NULL, NULL, NULL, 14),
(107, 107, 70, 72, 74, 72, 'Actitud positiva', NULL, NULL, NULL, 14),
(108, 108, 95, 93, 96, 95, 'Muy buen nivel', NULL, NULL, NULL, 14),
(109, 109, 78, 80, 79, 79, 'Entregas completas', NULL, NULL, NULL, 14),
(110, 110, 84, 85, 83, 84, 'Buen manejo del contenido', NULL, NULL, NULL, 14),
(111, 111, 66, 70, 68, 68, 'Asistencia regular', NULL, NULL, NULL, 7),
(112, 112, 90, 90, 90, 90, 'Muy consistente', NULL, NULL, NULL, 8),
(113, 113, 85, 88, 85, 86, 'Entrega destacada', NULL, NULL, NULL, 9);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `docentes`
--

CREATE TABLE `docentes` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `correo` varchar(100) DEFAULT NULL,
  `contrasena` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `docentes`
--

INSERT INTO `docentes` (`id`, `nombre`, `correo`, `contrasena`) VALUES
(1, 'Ulises Martinez', 'ulisesMartines@tecsanpedro.edu.mx', '18204'),
(2, 'Gaspar', 'Gaspar@tecsanpedro.edu.mx', '1234'),
(3, 'Alejandro', 'alejandro@gmail.com', '1234'),
(4, 'Ruth Aivi Chávez Rodríguez', 'Ruth123@gmail.com', '1234'),
(5, 'Omar Elio', 'Omar@gmail.com', '1234'),
(6, 'Oscar Fabian Ramos', 'Oscar@gmail.com', '1234'),
(7, 'Gabriela Camacho', 'Gabriela@gmail.com', '1234'),
(8, 'Niria Gonzalez', 'Niria@gmail.com', '1234'),
(9, 'Pablo Ulises', 'Pablo123@gmail.com', '1234'),
(10, 'Darka Montemayor', 'Darka@tecsanpedro.edu.mx', '1234'),
(11, 'Jesus Morales', 'morales@tecsanpedro.edu.mx', '1234'),
(12, 'Ulises Trujillo', 'trujillo@tecsanpedro.edu.mx', '1234'),
(14, 'Mario Serrato', 'mario@tecsanpedro.edu.mx', '1234'),
(18, 'Oscar Ochoa', 'oscar@tecsanpedro.edu.mx', '1234');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `docente_materia`
--

CREATE TABLE `docente_materia` (
  `docente_id` int(11) NOT NULL,
  `materia_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `docente_materia`
--

INSERT INTO `docente_materia` (`docente_id`, `materia_id`) VALUES
(1, 1),
(2, 9),
(2, 11),
(2, 13),
(3, 2),
(3, 12),
(4, 3),
(4, 6),
(4, 7),
(5, 8),
(5, 10),
(6, 1),
(6, 14),
(7, 4),
(7, 11),
(8, 5),
(8, 13),
(11, 8),
(14, 14),
(15, 14),
(16, 14),
(17, 14),
(18, 13);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `materias`
--

CREATE TABLE `materias` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `materias`
--

INSERT INTO `materias` (`id`, `nombre`) VALUES
(1, 'Fundamentos de Programación'),
(2, 'Métodos Numéricos'),
(3, 'Programación Orientada a Objetos'),
(4, 'Fundamentos de Software'),
(5, 'Graficación'),
(6, 'Lenguajes Autómatas'),
(7, 'Lenguajes Autómatas 2'),
(8, 'Contabilidad'),
(9, 'Simulación'),
(10, 'Redes de Computadora'),
(11, 'Programación de Base de Datos'),
(12, 'Lenguajes de Interfaz'),
(13, 'Cálculo Integral'),
(14, 'Álgebra Lineal');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `adminnoadmin`
--
ALTER TABLE `adminnoadmin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `correo` (`correo`);

--
-- Indices de la tabla `alumnos`
--
ALTER TABLE `alumnos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `calificaciones`
--
ALTER TABLE `calificaciones`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `docentes`
--
ALTER TABLE `docentes`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `adminnoadmin`
--
ALTER TABLE `adminnoadmin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `alumnos`
--
ALTER TABLE `alumnos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=114;

--
-- AUTO_INCREMENT de la tabla `calificaciones`
--
ALTER TABLE `calificaciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=114;

--
-- AUTO_INCREMENT de la tabla `docentes`
--
ALTER TABLE `docentes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
