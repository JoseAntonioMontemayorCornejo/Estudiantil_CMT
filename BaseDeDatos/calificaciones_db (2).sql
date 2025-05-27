-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 27-05-2025 a las 05:47:39
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
-- Estructura de tabla para la tabla `alumnos`
--

CREATE TABLE `alumnos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `correo` varchar(100) DEFAULT NULL,
  `contrasena` varchar(255) DEFAULT NULL,
  `semestre` int(11) DEFAULT NULL,
  `curso` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `alumnos`
--

INSERT INTO `alumnos` (`id`, `nombre`, `correo`, `contrasena`, `semestre`, `curso`) VALUES
(2, 'Alvaro', 'jose.montemayor.22isc@tecsanpedro.edu.mx', '18204', 2, 1),
(3, 'Jorge Monsivais', 'tonymontemayor037@gmail.com', '424212', 1, 5),
(6, 'Marco Manuel', 'marco.manuel.22isc@tecsanpedro.edu.mx', '424212', 1, 2),
(7, 'Jose Mauel Montemayor Cornejo', 'jose.manuel.22isc@tecsanpedro.edu.mx', '424212', 1, 4),
(8, 'Alexis Quistian', 'Alexis@gmail.com', '424212', 4, 2),
(9, 'Alejandro Juarez', 'ale@gmail.com', '424212', 4, 5),
(10, 'Odalys Castro', 'Odalys@gmail.com', '424212', 3, 3),
(11, 'Luis Mendoza', 'luis.mendoza@tecsanpedro.edu.mx', '1234', 3, 5),
(12, 'Sofia Ruiz', 'sofia.ruiz@tecsanpedro.edu.mx', '1234', 2, 1),
(13, 'Carlos Torres', 'carlos.torres@tecsanpedro.edu.mx', '1234', 4, 3),
(14, 'Daniela Rios', 'daniela.rios@tecsanpedro.edu.mx', '1234', 1, 2),
(15, 'Javier Soto', 'javier.soto@tecsanpedro.edu.mx', '1234', 3, 4),
(16, 'Ana Lucia', 'ana.lucia@tecsanpedro.edu.mx', '1234', 1, 1),
(17, 'Fernando Lopez', 'fernando.lopez@tecsanpedro.edu.mx', '1234', 2, 5),
(18, 'Isabella Garcia', 'isabella.garcia@tecsanpedro.edu.mx', '1234', 4, 2),
(19, 'Bruno Martinez', 'bruno.martinez@tecsanpedro.edu.mx', '1234', 3, 3),
(20, 'Valeria Chavez', 'valeria.chavez@tecsanpedro.edu.mx', '1234', 1, 4),
(21, 'Emilio Ramos', 'emilio.ramos@tecsanpedro.edu.mx', '1234', 2, 2),
(22, 'Lucia Navarro', 'lucia.navarro@tecsanpedro.edu.mx', '1234', 1, 1),
(23, 'Mateo Gil', 'mateo.gil@tecsanpedro.edu.mx', '1234', 3, 2),
(24, 'Regina Herrera', 'regina.herrera@tecsanpedro.edu.mx', '1234', 4, 3),
(25, 'Ivan Castro', 'ivan.castro@tecsanpedro.edu.mx', '1234', 2, 1),
(26, 'Camila Gomez', 'camila.gomez@tecsanpedro.edu.mx', '1234', 1, 5),
(27, 'Sebastian Salas', 'sebastian.salas@tecsanpedro.edu.mx', '1234', 4, 4),
(28, 'Paula Cantu', 'paula.cantu@tecsanpedro.edu.mx', '1234', 3, 3),
(29, 'Diego Luna', 'diego.luna@tecsanpedro.edu.mx', '1234', 2, 2),
(30, 'Andrea Ibarra', 'andrea.ibarra@tecsanpedro.edu.mx', '1234', 1, 3),
(31, 'Mario Treviño', 'mario.trevino@tecsanpedro.edu.mx', '1234', 4, 1),
(32, 'Fernanda Moya', 'fernanda.moya@tecsanpedro.edu.mx', '1234', 3, 5),
(33, 'Alejandro Peña', 'alejandro.pena@tecsanpedro.edu.mx', '1234', 2, 4),
(34, 'Renata Ortiz', 'renata.ortiz@tecsanpedro.edu.mx', '1234', 1, 2),
(35, 'Adrian Molina', 'adrian.molina@tecsanpedro.edu.mx', '1234', 3, 3),
(36, 'Carla Duran', 'carla.duran@tecsanpedro.edu.mx', '1234', 2, 5),
(37, 'Hector Rivera', 'hector.rivera@tecsanpedro.edu.mx', '1234', 4, 1),
(38, 'Jimena Valdez', 'jimena.valdez@tecsanpedro.edu.mx', '1234', 1, 4),
(39, 'Santiago Leal', 'santiago.leal@tecsanpedro.edu.mx', '1234', 3, 2),
(40, 'Natalia Zamora', 'natalia.zamora@tecsanpedro.edu.mx', '1234', 4, 3),
(41, 'Lucas Rangel', 'lucas.rangel@tecsanpedro.edu.mx', '1234', 2, 1),
(42, 'Maite Estrada', 'maite.estrada@tecsanpedro.edu.mx', '1234', 1, 5),
(43, 'Esteban Cano', 'esteban.cano@tecsanpedro.edu.mx', '1234', 3, 4),
(44, 'Andrea Sepulveda', 'andrea.sepulveda@tecsanpedro.edu.mx', '1234', 2, 3),
(45, 'Victor Ayala', 'victor.ayala@tecsanpedro.edu.mx', '1234', 4, 5),
(46, 'Daniel Guerrero', 'daniel.guerrero@tecsanpedro.edu.mx', '1234', 1, 2),
(47, 'Sara Solis', 'sara.solis@tecsanpedro.edu.mx', '1234', 3, 1),
(48, 'Leonardo Rios', 'leonardo.rios@tecsanpedro.edu.mx', '1234', 2, 3),
(49, 'Gabriela Vega', 'gabriela.vega@tecsanpedro.edu.mx', '1234', 1, 4),
(50, 'Rodrigo Mendez', 'rodrigo.mendez@tecsanpedro.edu.mx', '1234', 4, 2),
(192, 'Camila Cruz', 'camila.cruz@tecsanpedro.edu.mx', '1234', 1, 1),
(193, 'Jorge Ruiz', 'jorge.ruiz@tecsanpedro.edu.mx', '1234', 1, 1),
(194, 'Esteban Molina', 'esteban.molina@tecsanpedro.edu.mx', '1234', 1, 1),
(195, 'Natalia Castillo', 'natalia.castillo@tecsanpedro.edu.mx', '1234', 1, 1),
(196, 'Pablo Rivas', 'pablo.rivas@tecsanpedro.edu.mx', '1234', 1, 1),
(197, 'Hugo Medina', 'hugo.medina@tecsanpedro.edu.mx', '1234', 1, 2),
(198, 'Julieta Vargas', 'julieta.vargas@tecsanpedro.edu.mx', '1234', 1, 2),
(199, 'Samuel Rojas', 'samuel.rojas@tecsanpedro.edu.mx', '1234', 1, 2),
(200, 'Pamela Soto', 'pamela.soto@tecsanpedro.edu.mx', '1234', 1, 2),
(201, 'Ricardo Peña', 'ricardo.pena@tecsanpedro.edu.mx', '1234', 1, 2),
(202, 'Florencia Luna', 'florencia.luna@tecsanpedro.edu.mx', '1234', 1, 2),
(203, 'Erick Ayala', 'erick.ayala@tecsanpedro.edu.mx', '1234', 1, 2),
(204, 'Daniela Duran', 'daniela.duran@tecsanpedro.edu.mx', '1234', 1, 2),
(205, 'Ivan Espinoza', 'ivan.espinoza@tecsanpedro.edu.mx', '1234', 1, 2),
(206, 'Melanie Vargas', 'melanie.vargas@tecsanpedro.edu.mx', '1234', 1, 2),
(207, 'Cristina Torres', 'cristina.torres@tecsanpedro.edu.mx', '1234', 1, 2),
(208, 'Kevin Reyes', 'kevin.reyes@tecsanpedro.edu.mx', '1234', 1, 2),
(209, 'Monica Diaz', 'monica.diaz@tecsanpedro.edu.mx', '1234', 1, 2),
(210, 'Victor Cano', 'victor.cano@tecsanpedro.edu.mx', '1234', 1, 2),
(211, 'Emma Jimenez', 'emma.jimenez@tecsanpedro.edu.mx', '1234', 1, 2),
(212, 'Dario Beltran', 'dario.beltran@tecsanpedro.edu.mx', '1234', 1, 2),
(213, 'Laura Castañeda', 'laura.castaneda@tecsanpedro.edu.mx', '1234', 1, 2),
(214, 'Gustavo Romero', 'gustavo.romero@tecsanpedro.edu.mx', '1234', 1, 2),
(215, 'Mia Bravo', 'mia.bravo@tecsanpedro.edu.mx', '1234', 1, 2);

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
  `comentario_u3` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `calificaciones`
--

INSERT INTO `calificaciones` (`id`, `alumno_id`, `unidad1`, `unidad2`, `unidad3`, `promedio`, `comentario`, `comentario_u1`, `comentario_u2`, `comentario_u3`) VALUES
(2, 2, 100, 100, 100, 100, 'Buen alumno', 'Exelente1', 'Exelente23', 'Exelente34'),
(3, 3, 100, 100, 100, 100, 'Puede mejorar en unidad 10', 'Exelente3', 'Exelente4', 'Exelente5'),
(6, 6, 90, 90, 90, 90, 'Regulare', '', '', ''),
(7, 7, 100, 100, 95, 98, 'Excelente trabajos', '', '', ''),
(8, 8, 50, 55, 60, 55, 'Debe esforzarse más', '', '', ''),
(9, 9, 90, 85, 90, 88, 'Buen rendimiento general', '', '', ''),
(10, 10, 100, 100, 100, 100, 'hola', 'si', 'os', 'ksk'),
(11, 11, 96, 99, 99, 98, 'siuuuu', 'buen alumno', 'Exelente', 'Exelentee'),
(12, 12, 75, 78, 72, 75, 'Constante en sus entregas', '', '', ''),
(13, 13, 40, 45, 50, 45, 'Debe mejorar bastante', '', '', ''),
(14, 14, 95, 90, 88, 91, 'Muy buen trabajo', '', '', ''),
(15, 15, 100, 100, 100, 100, 'Buen progresox', '1', '2', '3'),
(16, 16, 67, 60, 63, 63, 'Le falta repasar teoría', '', '', ''),
(17, 17, 91, 94, 89, 91, 'Excelente participación', '', '', ''),
(18, 18, 55, 50, 52, 52, 'Debe asistir más a clase', '', '', ''),
(19, 19, 73, 75, 78, 75, 'Buen avance', '', '', ''),
(20, 20, 89, 85, 87, 87, 'Responsable y puntual', '', '', ''),
(21, 21, 60, 65, 60, 62, 'Rinde mejor en práctica', '', '', ''),
(22, 22, 70, 68, 75, 71, 'Mejoró en unidad 3', '', '', ''),
(23, 23, 95, 93, 97, 95, 'Trabajo excelente', '', '', ''),
(24, 24, 100, 100, 100, 100, 'r', 'e', 'g', 'i'),
(25, 25, 65, 60, 58, 61, 'Debe entregar tareas', '', '', ''),
(26, 26, 88, 84, 85, 86, 'Buen manejo del contenido', '', '', ''),
(27, 27, 90, 90, 90, 90, 'Muy buen nivel', '', '', ''),
(28, 28, 100, 78, 98, 92, 'Siu', 'Exelente', 'Regualar', 'Mejor denuevo');

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
(1, 'Ulises Martinez', 'ulisesMartines@tecsanpedro.edu.mx', '1234567890'),
(2, 'Gaspar', 'Gaspar@tecsanpedro.edu.mx', '$2y$10$9HhM1cKOgubU0d1at8LMfuANdcLBIrghihCOhfjm30XPfoVf09MLi');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `alumnos`
--
ALTER TABLE `alumnos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `correo` (`correo`);

--
-- Indices de la tabla `calificaciones`
--
ALTER TABLE `calificaciones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `alumno_id` (`alumno_id`);

--
-- Indices de la tabla `docentes`
--
ALTER TABLE `docentes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `correo` (`correo`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `alumnos`
--
ALTER TABLE `alumnos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=216;

--
-- AUTO_INCREMENT de la tabla `calificaciones`
--
ALTER TABLE `calificaciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT de la tabla `docentes`
--
ALTER TABLE `docentes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `calificaciones`
--
ALTER TABLE `calificaciones`
  ADD CONSTRAINT `calificaciones_ibfk_1` FOREIGN KEY (`alumno_id`) REFERENCES `alumnos` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
