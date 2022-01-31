-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 31-01-2022 a las 05:50:35
-- Versión del servidor: 10.4.14-MariaDB
-- Versión de PHP: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `uniajc_maps_testing_2`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado`
--

CREATE TABLE `estado` (
  `estado_id` int(11) NOT NULL,
  `estado_descripcion` varchar(200) NOT NULL,
  `est_tip_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `estado`
--

INSERT INTO `estado` (`estado_id`, `estado_descripcion`, `est_tip_id`) VALUES
(7, 'usuario activo', 1),
(8, 'usuario inactivo', 1),
(9, 'mapa activo', 2),
(10, 'mapa inactivo', 2),
(11, 'capa activa', 3),
(12, 'capa inactiva', 3),
(13, 'token vigente', 4),
(14, 'token vencido', 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado_tipo`
--

CREATE TABLE `estado_tipo` (
  `est_tip_id` int(11) NOT NULL,
  `est_tip_descripcion` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `estado_tipo`
--

INSERT INTO `estado_tipo` (`est_tip_id`, `est_tip_descripcion`) VALUES
(1, 'estado usuarios'),
(2, 'estado mapas'),
(3, 'estado capas'),
(4, 'estado token');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mapa`
--

CREATE TABLE `mapa` (
  `mapa_id` int(11) NOT NULL,
  `mapa_nombre` varchar(50) NOT NULL,
  `mapa_descripcion` varchar(200) DEFAULT NULL,
  `mapa_ruta` longtext DEFAULT NULL,
  `est_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mapa_usuario`
--

CREATE TABLE `mapa_usuario` (
  `mapa_user_id` int(11) NOT NULL,
  `mapa_id` int(11) NOT NULL,
  `usu_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `rol_id` int(11) NOT NULL,
  `rol_descripcion` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`rol_id`, `rol_descripcion`) VALUES
(1, 'administrador'),
(2, 'investigador'),
(3, 'invitado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `token`
--

CREATE TABLE `token` (
  `token_id` int(11) NOT NULL,
  `token` varchar(100) NOT NULL,
  `token_fecha` date NOT NULL,
  `token_fecha_vencido` datetime NOT NULL,
  `usu_id` int(11) NOT NULL,
  `est_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `usu_id` int(11) NOT NULL,
  `usu_cedula` varchar(255) DEFAULT NULL,
  `usu_correo` varchar(50) NOT NULL,
  `usu_nombre` varchar(50) NOT NULL,
  `usu_password` text NOT NULL,
  `rol_id` int(11) NOT NULL,
  `est_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`usu_id`, `usu_cedula`, `usu_correo`, `usu_nombre`, `usu_password`, `rol_id`, `est_id`) VALUES
(2, '1143879187', 'jjosecastro@estudiante.uniajc.edu.co', 'Juan Jose Castro', '4cuxs7nCUchVE', 1, 7);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `estado`
--
ALTER TABLE `estado`
  ADD PRIMARY KEY (`estado_id`),
  ADD KEY `estado_tipo_fk_1` (`est_tip_id`);

--
-- Indices de la tabla `estado_tipo`
--
ALTER TABLE `estado_tipo`
  ADD PRIMARY KEY (`est_tip_id`);

--
-- Indices de la tabla `mapa`
--
ALTER TABLE `mapa`
  ADD PRIMARY KEY (`mapa_id`),
  ADD KEY `est_id` (`est_id`);

--
-- Indices de la tabla `mapa_usuario`
--
ALTER TABLE `mapa_usuario`
  ADD PRIMARY KEY (`mapa_user_id`),
  ADD KEY `ForeignMapa` (`mapa_id`),
  ADD KEY `ForeignUser` (`usu_id`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`rol_id`);

--
-- Indices de la tabla `token`
--
ALTER TABLE `token`
  ADD PRIMARY KEY (`token_id`),
  ADD KEY `usu_id` (`usu_id`),
  ADD KEY `est_token` (`est_id`) USING BTREE;

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`usu_id`),
  ADD KEY `est_id` (`est_id`),
  ADD KEY `rol_id` (`rol_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `estado`
--
ALTER TABLE `estado`
  MODIFY `estado_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `estado_tipo`
--
ALTER TABLE `estado_tipo`
  MODIFY `est_tip_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `mapa`
--
ALTER TABLE `mapa`
  MODIFY `mapa_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `mapa_usuario`
--
ALTER TABLE `mapa_usuario`
  MODIFY `mapa_user_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `rol_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `token`
--
ALTER TABLE `token`
  MODIFY `token_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `usu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `estado`
--
ALTER TABLE `estado`
  ADD CONSTRAINT `estado_tipo_fk_1` FOREIGN KEY (`est_tip_id`) REFERENCES `estado_tipo` (`est_tip_id`);

--
-- Filtros para la tabla `mapa`
--
ALTER TABLE `mapa`
  ADD CONSTRAINT `mapa_ibfk_2` FOREIGN KEY (`est_id`) REFERENCES `estado` (`estado_id`);

--
-- Filtros para la tabla `mapa_usuario`
--
ALTER TABLE `mapa_usuario`
  ADD CONSTRAINT `ForeignMapa` FOREIGN KEY (`mapa_id`) REFERENCES `mapa` (`mapa_id`),
  ADD CONSTRAINT `ForeignUser` FOREIGN KEY (`usu_id`) REFERENCES `usuario` (`usu_id`);

--
-- Filtros para la tabla `token`
--
ALTER TABLE `token`
  ADD CONSTRAINT `token_ibfk_1` FOREIGN KEY (`usu_id`) REFERENCES `usuario` (`usu_id`),
  ADD CONSTRAINT `token_ibfk_2` FOREIGN KEY (`est_id`) REFERENCES `estado` (`estado_id`);

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`est_id`) REFERENCES `estado` (`estado_id`),
  ADD CONSTRAINT `usuario_ibfk_2` FOREIGN KEY (`rol_id`) REFERENCES `rol` (`rol_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
