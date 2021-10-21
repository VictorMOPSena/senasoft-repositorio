-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 21-10-2021 a las 04:58:07
-- Versión del servidor: 10.4.20-MariaDB
-- Versión de PHP: 8.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `senasoft`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cronogramaactual`
--

CREATE TABLE `cronogramaactual` (
  `idCronogramaActual` int(11) NOT NULL,
  `idUsuarioCronogramaActual` int(11) NOT NULL,
  `horarioCronogramaActual` int(11) NOT NULL,
  `fechaCronogramaActual` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `cronogramaactual`
--

INSERT INTO `cronogramaactual` (`idCronogramaActual`, `idUsuarioCronogramaActual`, `horarioCronogramaActual`, `fechaCronogramaActual`) VALUES
(16, 2, 1, '2021-10-13'),
(17, 4, 1, '2021-10-13'),
(18, 5, 1, '2021-10-13'),
(24, 6, 2, '2021-10-13'),
(25, 7, 2, '2021-10-13'),
(26, 8, 2, '2021-10-13'),
(27, 2, 1, '2021-10-14'),
(36, 2, 1, '2021-10-17');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `especialidad`
--

CREATE TABLE `especialidad` (
  `idEspecialidad` int(11) NOT NULL,
  `nombreEspecialidad` varchar(50) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `especialidad`
--

INSERT INTO `especialidad` (`idEspecialidad`, `nombreEspecialidad`) VALUES
(2, 'Doctor'),
(11, 'a'),
(12, 'b'),
(13, 'c'),
(14, 'd'),
(15, 'fg'),
(16, 'asdasfsdafasd');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `persona`
--

CREATE TABLE `persona` (
  `idPersona` int(11) NOT NULL,
  `cedulaPersona` varchar(10) COLLATE utf8_spanish_ci NOT NULL,
  `nombresPersona` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `apellidosPersona` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `celularPersona` varchar(10) COLLATE utf8_spanish_ci NOT NULL,
  `correoPersona` varchar(320) COLLATE utf8_spanish_ci NOT NULL,
  `direccionPersona` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `idEspecialidadPersona` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `persona`
--

INSERT INTO `persona` (`idPersona`, `cedulaPersona`, `nombresPersona`, `apellidosPersona`, `celularPersona`, `correoPersona`, `direccionPersona`, `idEspecialidadPersona`) VALUES
(4, '1', 'a', 'a', '1', 'a@gmail.com', 'a', 14),
(7, '2', 'a', 'a', '1', 'a@gmail.com', 'a', 2),
(8, '3', 'a', 'a', '1', 'a@gmail.com', 'a', 2),
(9, '4', 'a', 'a', '1', 'a@gmail.com', 'a', 2),
(10, '5', 'a', 'a', '1', 'a@gmail.com', 'a', 2),
(11, '6', 'a', 'a', '1', 'a@gmail.com', 'a', 2),
(12, '7', 'a', 'a', '1', 'a@gmail.com', 'a', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `idRol` int(11) NOT NULL,
  `nombreRol` varchar(20) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`idRol`, `nombreRol`) VALUES
(1, 'Administrador'),
(2, 'Empleado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `idUsuario` int(11) NOT NULL,
  `nombreUsuario` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `contraUsuario` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `idPersonaUsuario` int(11) NOT NULL,
  `idRolUsuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`idUsuario`, `nombreUsuario`, `contraUsuario`, `idPersonaUsuario`, `idRolUsuario`) VALUES
(2, 'a', '$2y$10$jjEdvf/iRs.RFzCakhz/tOcI0.wjt9jtnsBP3BSrd1P12mvKRi4N6', 4, 1),
(4, 'b', '$2y$10$JdWgyaRbIHX5dVls/wxQSet/FLehwWt5yVL2EOVZeccSTa6IqiybG', 7, 2),
(5, 'c', '$2y$10$h5ijqRUydFXKaj2SXq1kWuNqFDcjyvawbZVgMcbtV2qxlsuxeOlhq', 8, 2),
(6, 'd', '$2y$10$MmtxXTybVoy8L0.g4jyOSOjhDLjZQ0/vb2LD9qR2XLseZ2W0/28wm', 9, 2),
(7, 'e', '$2y$10$WFKBJ6p9/eO.38j3vK9SvujnJFess1YRzFGfMehre2FUxBF/womsW', 10, 2),
(8, 'f', '$2y$10$jYC/S0TUfrQxx0geO8o5meiUHbQBF79WxyR0VeH6jAhZKQm0AW5n6', 11, 2),
(9, 'g', '$2y$10$Ab9tjxTCzWiMoplfq6GWK.TlX3CcaflEMUzdpBhaQM8ezSbv3vNIi', 12, 2);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cronogramaactual`
--
ALTER TABLE `cronogramaactual`
  ADD PRIMARY KEY (`idCronogramaActual`),
  ADD KEY `idUsuarioCronogramaActual` (`idUsuarioCronogramaActual`);

--
-- Indices de la tabla `especialidad`
--
ALTER TABLE `especialidad`
  ADD PRIMARY KEY (`idEspecialidad`);

--
-- Indices de la tabla `persona`
--
ALTER TABLE `persona`
  ADD PRIMARY KEY (`idPersona`),
  ADD KEY `idEspecialidadPersona` (`idEspecialidadPersona`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`idRol`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`idUsuario`),
  ADD KEY `idPersonaUsuario` (`idPersonaUsuario`),
  ADD KEY `idRolUsuario` (`idRolUsuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cronogramaactual`
--
ALTER TABLE `cronogramaactual`
  MODIFY `idCronogramaActual` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT de la tabla `especialidad`
--
ALTER TABLE `especialidad`
  MODIFY `idEspecialidad` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `persona`
--
ALTER TABLE `persona`
  MODIFY `idPersona` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `idRol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `cronogramaactual`
--
ALTER TABLE `cronogramaactual`
  ADD CONSTRAINT `cronogramaactual_ibfk_1` FOREIGN KEY (`idUsuarioCronogramaActual`) REFERENCES `usuario` (`idUsuario`);

--
-- Filtros para la tabla `persona`
--
ALTER TABLE `persona`
  ADD CONSTRAINT `persona_ibfk_1` FOREIGN KEY (`idEspecialidadPersona`) REFERENCES `especialidad` (`idEspecialidad`);

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`idPersonaUsuario`) REFERENCES `persona` (`idPersona`),
  ADD CONSTRAINT `usuario_ibfk_2` FOREIGN KEY (`idRolUsuario`) REFERENCES `rol` (`idRol`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
