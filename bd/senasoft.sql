-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 21-10-2021 a las 22:56:13
-- Versión del servidor: 10.4.21-MariaDB
-- Versión de PHP: 8.0.12

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
(1, 'No existente'),
(2, 'Doctor'),
(3, 'Enfermera'),
(4, 'Cirujano'),
(5, 'Terapeuta');

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
(1, '1', 'No existente', 'No existente', '1', 'No existente', 'No existente', 1),
(2, '1000126434', 'Francisco', 'Morerira', '3143428541', 'francisco@gmail.com', 'Fusagasugá', 2),
(3, '1020116434', 'Maria Elena', 'Pérez', '3214568973', 'maria@hotmail.com', 'Silvania', 3),
(4, '1890126434', 'Marcos Samuel', 'Castro', '3214568953', 'marcos@gmail.com', 'Bogotá', 4),
(5, '3214523126', 'Pedro', 'Fernández', '6598532145', 'pedro@gmail.com', 'Silvania', 5);

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
(2, 'Empleado'),
(3, 'No existente');

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
(1, 'No existente', 'No existente', 1, 3),
(2, 'francisco', '$2y$10$RCcFIKVnzH/w/Fw0z5IBmegEqIUeH9CECWm35D6BR23QHCI0h5Dou', 2, 2),
(3, 'maria', '$2y$10$Ki86P6IdEvlUjv/S/zm9VuuRgY0r4p5IsDCoTjEbL1oWBLSJaLfOe', 3, 2),
(4, 'marcos', '$2y$10$ZDOXLpwWX58u5JHunGvr/.wb9YAov.Adcd5HMHPrsZykz0fuJp.g.', 4, 2),
(5, 'pedro', '$2y$10$1i4coGCeREXge7Gs9TpuIeY0u3KJR1h4cMAjskFvQlMGg8K0W7Tv6', 5, 1);

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
  MODIFY `idCronogramaActual` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `especialidad`
--
ALTER TABLE `especialidad`
  MODIFY `idEspecialidad` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `persona`
--
ALTER TABLE `persona`
  MODIFY `idPersona` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `idRol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

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
