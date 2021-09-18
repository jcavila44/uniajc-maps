-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 18-09-2021 a las 22:38:27
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
-- Base de datos: `uniajc_maps`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `archivogeojson`
--

CREATE TABLE `archivogeojson` (
  `arch_id` int(11) NOT NULL,
  `arch_caracteristicas` varchar(200) NOT NULL,
  `arch_tipo` varchar(200) NOT NULL,
  `arch_geometria` varchar(200) NOT NULL,
  `arch_coordenadas` varchar(200) NOT NULL,
  `arch_propiedades` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `autor_mapa`
--

CREATE TABLE `autor_mapa` (
  `autor_mapa_id` int(11) NOT NULL,
  `mapa_id` int(11) NOT NULL,
  `usu_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `capa`
--

CREATE TABLE `capa` (
  `capa_id` int(11) NOT NULL,
  `capa_propiedades` varchar(200) NOT NULL,
  `capa_geometria` varchar(200) NOT NULL,
  `capa_tipo` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
(12, 'capa inactiva', 3);

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
(3, 'estado capas');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mapa`
--

CREATE TABLE `mapa` (
  `mapa_id` int(11) NOT NULL,
  `mapa_nombre` varchar(50) NOT NULL,
  `mapa_descripcion` varchar(200) DEFAULT NULL,
  `est_id` int(11) NOT NULL,
  `arch_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `menu_capa_mapa`
--

CREATE TABLE `menu_capa_mapa` (
  `menu_id` int(11) NOT NULL,
  `menu_capa_id` int(11) NOT NULL,
  `menu_mapa_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `menu_rol_permiso`
--

CREATE TABLE `menu_rol_permiso` (
  `menu_rol_per_id` int(11) NOT NULL,
  `menu_rol_id` int(11) NOT NULL,
  `menu_per_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permiso`
--

CREATE TABLE `permiso` (
  `per_id` int(11) NOT NULL,
  `per_descripción` varchar(200) NOT NULL
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
-- Estructura de tabla para la tabla `rol_mapa`
--

CREATE TABLE `rol_mapa` (
  `rol_mapa_id` int(11) NOT NULL,
  `mapa_id` int(11) NOT NULL,
  `rol_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `token`
--

CREATE TABLE `token` (
  `token_id` int(11) NOT NULL,
  `token_fecha` date NOT NULL,
  `token_vencido` tinyint(1) NOT NULL,
  `usu_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `usu_id` int(11) NOT NULL,
  `usu_correo` varchar(50) NOT NULL,
  `usu_nombre` varchar(50) NOT NULL,
  `usu_password` text NOT NULL,
  `rol_id` int(11) NOT NULL,
  `est_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`usu_id`, `usu_correo`, `usu_nombre`, `usu_password`, `rol_id`, `est_id`) VALUES
(1, 'jcavila@estudiante.uniajc.edu.co', 'jose carlos avila', 'prueba', 1, 7),
(2, 'jjosecastro@estudiante.uniajc.edu.co', 'juan jose castro', 'prueba', 1, 7);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `archivogeojson`
--
ALTER TABLE `archivogeojson`
  ADD PRIMARY KEY (`arch_id`);

--
-- Indices de la tabla `autor_mapa`
--
ALTER TABLE `autor_mapa`
  ADD PRIMARY KEY (`autor_mapa_id`),
  ADD KEY `mapa_id` (`mapa_id`),
  ADD KEY `usu_id` (`usu_id`);

--
-- Indices de la tabla `capa`
--
ALTER TABLE `capa`
  ADD PRIMARY KEY (`capa_id`);

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
  ADD KEY `arch_id` (`arch_id`),
  ADD KEY `est_id` (`est_id`);

--
-- Indices de la tabla `menu_capa_mapa`
--
ALTER TABLE `menu_capa_mapa`
  ADD PRIMARY KEY (`menu_id`),
  ADD KEY `menu_capa_id` (`menu_capa_id`),
  ADD KEY `menu_mapa_id` (`menu_mapa_id`);

--
-- Indices de la tabla `menu_rol_permiso`
--
ALTER TABLE `menu_rol_permiso`
  ADD PRIMARY KEY (`menu_rol_per_id`),
  ADD KEY `menu_rol_id` (`menu_rol_id`),
  ADD KEY `menu_per_id` (`menu_per_id`);

--
-- Indices de la tabla `permiso`
--
ALTER TABLE `permiso`
  ADD PRIMARY KEY (`per_id`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`rol_id`);

--
-- Indices de la tabla `rol_mapa`
--
ALTER TABLE `rol_mapa`
  ADD PRIMARY KEY (`rol_mapa_id`),
  ADD KEY `mapa_id` (`mapa_id`),
  ADD KEY `rol_id` (`rol_id`);

--
-- Indices de la tabla `token`
--
ALTER TABLE `token`
  ADD PRIMARY KEY (`token_id`),
  ADD KEY `usu_id` (`usu_id`);

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
-- AUTO_INCREMENT de la tabla `archivogeojson`
--
ALTER TABLE `archivogeojson`
  MODIFY `arch_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `autor_mapa`
--
ALTER TABLE `autor_mapa`
  MODIFY `autor_mapa_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `capa`
--
ALTER TABLE `capa`
  MODIFY `capa_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `estado`
--
ALTER TABLE `estado`
  MODIFY `estado_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `estado_tipo`
--
ALTER TABLE `estado_tipo`
  MODIFY `est_tip_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `mapa`
--
ALTER TABLE `mapa`
  MODIFY `mapa_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `menu_capa_mapa`
--
ALTER TABLE `menu_capa_mapa`
  MODIFY `menu_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `menu_rol_permiso`
--
ALTER TABLE `menu_rol_permiso`
  MODIFY `menu_rol_per_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `permiso`
--
ALTER TABLE `permiso`
  MODIFY `per_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `rol_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `rol_mapa`
--
ALTER TABLE `rol_mapa`
  MODIFY `rol_mapa_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `token`
--
ALTER TABLE `token`
  MODIFY `token_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `usu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `autor_mapa`
--
ALTER TABLE `autor_mapa`
  ADD CONSTRAINT `autor_mapa_ibfk_1` FOREIGN KEY (`mapa_id`) REFERENCES `mapa` (`mapa_id`),
  ADD CONSTRAINT `autor_mapa_ibfk_2` FOREIGN KEY (`usu_id`) REFERENCES `usuario` (`usu_id`);

--
-- Filtros para la tabla `estado`
--
ALTER TABLE `estado`
  ADD CONSTRAINT `estado_tipo_fk_1` FOREIGN KEY (`est_tip_id`) REFERENCES `estado_tipo` (`est_tip_id`);

--
-- Filtros para la tabla `mapa`
--
ALTER TABLE `mapa`
  ADD CONSTRAINT `mapa_ibfk_1` FOREIGN KEY (`arch_id`) REFERENCES `archivogeojson` (`arch_id`),
  ADD CONSTRAINT `mapa_ibfk_2` FOREIGN KEY (`est_id`) REFERENCES `estado` (`estado_id`);

--
-- Filtros para la tabla `menu_capa_mapa`
--
ALTER TABLE `menu_capa_mapa`
  ADD CONSTRAINT `menu_capa_mapa_ibfk_1` FOREIGN KEY (`menu_capa_id`) REFERENCES `capa` (`capa_id`),
  ADD CONSTRAINT `menu_capa_mapa_ibfk_2` FOREIGN KEY (`menu_mapa_id`) REFERENCES `mapa` (`mapa_id`);

--
-- Filtros para la tabla `menu_rol_permiso`
--
ALTER TABLE `menu_rol_permiso`
  ADD CONSTRAINT `menu_rol_permiso_ibfk_1` FOREIGN KEY (`menu_rol_id`) REFERENCES `rol` (`rol_id`),
  ADD CONSTRAINT `menu_rol_permiso_ibfk_2` FOREIGN KEY (`menu_per_id`) REFERENCES `permiso` (`per_id`);

--
-- Filtros para la tabla `rol_mapa`
--
ALTER TABLE `rol_mapa`
  ADD CONSTRAINT `rol_mapa_ibfk_1` FOREIGN KEY (`mapa_id`) REFERENCES `mapa` (`mapa_id`),
  ADD CONSTRAINT `rol_mapa_ibfk_2` FOREIGN KEY (`rol_id`) REFERENCES `rol` (`rol_id`);

--
-- Filtros para la tabla `token`
--
ALTER TABLE `token`
  ADD CONSTRAINT `token_ibfk_1` FOREIGN KEY (`usu_id`) REFERENCES `usuario` (`usu_id`);

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
