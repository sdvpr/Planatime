-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 14-12-2020 a las 22:35:46
-- Versión del servidor: 5.7.14
-- Versión de PHP: 7.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bdplanatime`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lista`
--

CREATE TABLE `lista` (
  `cod` int(2) NOT NULL,
  `titulo` varchar(255) COLLATE latin1_spanish_ci NOT NULL,
  `date_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `checked` tinyint(1) NOT NULL DEFAULT '0',
  `importante` tinyint(1) DEFAULT NULL,
  `urgente` tinyint(1) DEFAULT NULL,
  `usuario_cod` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `lista`
--

INSERT INTO `lista` (`cod`, `titulo`, `date_time`, `checked`, `importante`, `urgente`, `usuario_cod`) VALUES
(1, 'esto es un elemento de la lista', '2020-11-26 22:27:21', 0, NULL, NULL, 95),
(37, 'esto es otro elemento', '2020-11-30 20:22:49', 0, NULL, 0, 95),
(80, 'comprar un ferrari', '2020-12-14 19:08:49', 1, NULL, NULL, 95),
(81, 'hacer ejercicio', '2020-12-14 19:08:58', 1, 1, NULL, 95),
(82, 'terminar el proyecto', '2020-12-14 19:10:05', 1, 1, 1, 95),
(83, 'ordenar el armario', '2020-12-14 19:11:35', 1, NULL, 1, 95);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reto`
--

CREATE TABLE `reto` (
  `id` int(2) NOT NULL,
  `title` varchar(45) COLLATE latin1_spanish_ci NOT NULL,
  `descripcion` varchar(150) COLLATE latin1_spanish_ci NOT NULL,
  `color` varchar(255) COLLATE latin1_spanish_ci NOT NULL,
  `textColor` varchar(255) COLLATE latin1_spanish_ci NOT NULL,
  `start` datetime NOT NULL,
  `end` datetime NOT NULL,
  `usuario_cod` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `reto`
--

INSERT INTO `reto` (`id`, `title`, `descripcion`, `color`, `textColor`, `start`, `end`, `usuario_cod`) VALUES
(83, 'RETO ADMIN', 'Este reto lo pone el Admin, y no puede ser editado ni eliminado por los demÃ¡s usuarios\n', '#e400f5', '#FFFFFF', '2020-12-09 10:10:00', '2020-12-12 13:30:00', 100),
(89, 'Repaso', 'en repasar la presentation', '#c41c7e', '#FFFFFF', '2020-12-17 08:30:00', '2020-12-18 15:00:00', 102),
(93, '7 dÃ­as de abdominales', 'Hacer 25 abdominales cada dÃ­a e incrementar 5 ', '#215e28', '#FFFFFF', '2020-12-21 10:30:00', '2020-12-27 14:30:00', 95);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `cod` int(2) NOT NULL,
  `nombre` varchar(20) COLLATE latin1_spanish_ci NOT NULL,
  `apellido` varchar(20) COLLATE latin1_spanish_ci NOT NULL,
  `email` varchar(45) COLLATE latin1_spanish_ci NOT NULL,
  `contrasena` varchar(60) COLLATE latin1_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`cod`, `nombre`, `apellido`, `email`, `contrasena`) VALUES
(95, 'Sali', 'Aa', 'sali@gmail.com', '$2y$10$V0Nw3XpRbbnCVuLyKVE1Nu8qrtcxKPvPi80a1C7UhYGzWc2sAEm4u'),
(100, 'Admin', 'Istrador', 'admin@gmail.com', '$2y$10$pe/IYo5BQVzS6UkqOjbZr.3bN5Ze5mlbK66LTcdZKRooC8iRElA86'),
(102, 'lala', 'lalala', 'lala@gmail.com', '$2y$10$spAJbnbjyEMtpukCVbfDOuXNzIHX0zgy4ziod//wkj95DMtysCHQe');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `lista`
--
ALTER TABLE `lista`
  ADD PRIMARY KEY (`cod`),
  ADD KEY `fk_lista_usuario_idx` (`usuario_cod`);

--
-- Indices de la tabla `reto`
--
ALTER TABLE `reto`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_reto_usuario1_idx` (`usuario_cod`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`cod`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `lista`
--
ALTER TABLE `lista`
  MODIFY `cod` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;
--
-- AUTO_INCREMENT de la tabla `reto`
--
ALTER TABLE `reto`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=94;
--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `cod` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=106;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `lista`
--
ALTER TABLE `lista`
  ADD CONSTRAINT `fk_lista_usuario` FOREIGN KEY (`usuario_cod`) REFERENCES `usuario` (`cod`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `reto`
--
ALTER TABLE `reto`
  ADD CONSTRAINT `fk_reto_usuario1` FOREIGN KEY (`usuario_cod`) REFERENCES `usuario` (`cod`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
