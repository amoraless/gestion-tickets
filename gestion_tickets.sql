-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 15-08-2016 a las 18:21:16
-- Versión del servidor: 10.1.13-MariaDB
-- Versión de PHP: 5.6.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `gestion_tickets`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_level_significance`
--

CREATE TABLE `tbl_level_significance` (
  `ls_id` int(11) NOT NULL,
  `ls_name` varchar(50) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tbl_level_significance`
--

INSERT INTO `tbl_level_significance` (`ls_id`, `ls_name`) VALUES
(1, 'Urgente'),
(2, 'Medio'),
(3, 'Bajo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_tickets`
--

CREATE TABLE `tbl_tickets` (
  `tic_id` int(11) NOT NULL,
  `ls_id` int(11) NOT NULL,
  `tic_name` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `tic_description` text COLLATE utf8_spanish_ci NOT NULL,
  `tic_registration_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tbl_tickets`
--

INSERT INTO `tbl_tickets` (`tic_id`, `ls_id`, `tic_name`, `tic_description`, `tic_registration_date`) VALUES
(33, 1, 'xbt-0500', 'descripcion editato', '2016-08-15 16:11:59'),
(34, 2, 'drt-3610', 'otra descripcion', '2016-08-15 16:12:17');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `tbl_level_significance`
--
ALTER TABLE `tbl_level_significance`
  ADD PRIMARY KEY (`ls_id`);

--
-- Indices de la tabla `tbl_tickets`
--
ALTER TABLE `tbl_tickets`
  ADD PRIMARY KEY (`tic_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `tbl_level_significance`
--
ALTER TABLE `tbl_level_significance`
  MODIFY `ls_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `tbl_tickets`
--
ALTER TABLE `tbl_tickets`
  MODIFY `tic_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
