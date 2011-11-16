DROP DATABASE IF EXISTS sotneve;
CREATE DATABASE IF NOT EXISTS sotneve
	COLLATE utf8_spanish_ci;

USE sotneve;
-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 14-11-2011 a las 21:00:42
-- Versión del servidor: 5.5.16
-- Versión de PHP: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `sotneve`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `afiliaciones`
--

CREATE TABLE IF NOT EXISTS `afiliaciones` (
  `idUsuario` int(11) NOT NULL,
  `idEvento` int(11) NOT NULL,
  PRIMARY KEY (`idUsuario`,`idEvento`),
  KEY `idEvento` (`idEvento`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `eventos`
--

CREATE TABLE IF NOT EXISTS `eventos` (
  `idEvento` int(11) NOT NULL AUTO_INCREMENT,
  `idSubtipo` int(11) NOT NULL,
  `titulo` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `maxPersonas` int(11) NOT NULL,
  `fechaCreacion` datetime NOT NULL,
  `descripcion` varchar(250) COLLATE utf8_spanish_ci DEFAULT NULL,
  `fechaEvento` datetime DEFAULT NULL,
  `idProvincia` int(11) DEFAULT NULL,
  `lugar` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `propietario` int(11) NOT NULL,
  PRIMARY KEY (`idEvento`),
  KEY `idSubtipo` (`idSubtipo`),
  KEY `idProvincia` (`idProvincia`),
  KEY `propietario` (`propietario`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=8 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `favoritos`
--

CREATE TABLE IF NOT EXISTS `favoritos` (
  `idUsuario1` int(11) NOT NULL,
  `idUsuario2` int(11) NOT NULL,
  PRIMARY KEY (`idUsuario1`,`idUsuario2`),
  KEY `idUsuario2` (`idUsuario2`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `favoritos`
--

INSERT INTO `favoritos` (`idUsuario1`, `idUsuario2`) VALUES
(1, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `provincias`
--

CREATE TABLE IF NOT EXISTS `provincias` (
  `idProvincia` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`idProvincia`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `provincias`
--

INSERT INTO `provincias` (`idProvincia`, `nombre`) VALUES
(1, 'Sevilla'),
(2, 'Huelva');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `subtipos`
--

CREATE TABLE IF NOT EXISTS `subtipos` (
  `idSubTipo` int(11) NOT NULL AUTO_INCREMENT,
  `idTipo` int(11) NOT NULL,
  `nombre` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `externo` tinyint(1) NOT NULL,
  PRIMARY KEY (`idSubTipo`),
  KEY `idTipo` (`idTipo`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `subtipos`
--

INSERT INTO `subtipos` (`idSubTipo`, `idTipo`, `nombre`, `externo`) VALUES
(2, 1, 'Futbol', 0),
(3, 2, 'Ir a ver', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipos`
--

CREATE TABLE IF NOT EXISTS `tipos` (
  `idTipo` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(60) COLLATE utf8_spanish_ci NOT NULL,
  `externo` tinyint(1) NOT NULL,
  PRIMARY KEY (`idTipo`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `tipos`
--

INSERT INTO `tipos` (`idTipo`, `nombre`, `externo`) VALUES
(1, 'Deportes', 0),
(2, 'Espectaculos', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE IF NOT EXISTS `usuarios` (
  `idUsuario` int(11) NOT NULL AUTO_INCREMENT,
  `fechaNac` date NOT NULL,
  `sexo` tinyint(1) NOT NULL,
  `email` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `alias` varchar(60) COLLATE utf8_spanish_ci NOT NULL,
  `pass` char(64) COLLATE utf8_spanish_ci NOT NULL,
  `nombre` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `apellidos` varchar(60) COLLATE utf8_spanish_ci NOT NULL,
  `provincia` varchar(60) COLLATE utf8_spanish_ci NOT NULL,
  `visibilidad` binary(2) NOT NULL COMMENT 'fechaNac, sexo, email, nombre, apellidos',
  PRIMARY KEY (`idUsuario`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`idUsuario`, `fechaNac`, `sexo`, `email`, `alias`, `pass`, `nombre`, `apellidos`, `provincia`, `visibilidad`) VALUES
(1, '1990-10-19', 1, 'rafaespillaque@gmail.com', 'Rafaesp', '688787d8ff144c502c7f5cffaafe2cc588d86079f9de88304c26b0cb99ce91c6', 'Rafael', 'Espillaque Espinosa', 'Sevilla', '11'),
(2, '2000-01-01', 0, 'asd@asd.com', 'kiki', '5fd924625f6ab16a19cc9807c7c506ae1813490e4ba675f843d5a10e0baacdb8', 'Carmen', 'Delgado', 'Sevilla', '11'),
(3, '1990-02-11', 1, 'xusty_alex@hotmail.com', 'alexmacan', '5fd924625f6ab16a19cc9807c7c506ae1813490e4ba675f843d5a10e0baacdb8', 'Ale', 'Molina', 'Sevilla', '0\0'),
(4, '1980-12-11', 1, 'zp_y_yo@gaymail.com', 'rajoy', '5fd924625f6ab16a19cc9807c7c506ae1813490e4ba675f843d5a10e0baacdb8', 'Mari4no', 'Rajoy', 'Sevilla', '0\0');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `valoraciones`
--

CREATE TABLE IF NOT EXISTS `valoraciones` (
  `idUsuario1` int(11) NOT NULL,
  `idUsuario2` int(11) NOT NULL,
  `idEvento` int(11) NOT NULL,
  `valoracion` int(1) NOT NULL,
  PRIMARY KEY (`idUsuario1`,`idUsuario2`),
  KEY `idEvento` (`idEvento`),
  KEY `idUsuario2` (`idUsuario2`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `afiliaciones`
--
ALTER TABLE `afiliaciones`
  ADD CONSTRAINT `afiliaciones_ibfk_2` FOREIGN KEY (`idEvento`) REFERENCES `eventos` (`idEvento`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `afiliaciones_ibfk_1` FOREIGN KEY (`idUsuario`) REFERENCES `usuarios` (`idUsuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `eventos`
--
ALTER TABLE `eventos`
  ADD CONSTRAINT `eventos_ibfk_7` FOREIGN KEY (`idProvincia`) REFERENCES `provincias` (`idProvincia`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `eventos_ibfk_5` FOREIGN KEY (`idSubtipo`) REFERENCES `subtipos` (`idSubTipo`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `eventos_ibfk_6` FOREIGN KEY (`propietario`) REFERENCES `usuarios` (`idUsuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `favoritos`
--
ALTER TABLE `favoritos`
  ADD CONSTRAINT `favoritos_ibfk_1` FOREIGN KEY (`idUsuario1`) REFERENCES `usuarios` (`idUsuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `favoritos_ibfk_2` FOREIGN KEY (`idUsuario2`) REFERENCES `usuarios` (`idUsuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `subtipos`
--
ALTER TABLE `subtipos`
  ADD CONSTRAINT `subtipos_ibfk_1` FOREIGN KEY (`idTipo`) REFERENCES `tipos` (`idTipo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `valoraciones`
--
ALTER TABLE `valoraciones`
  ADD CONSTRAINT `valoraciones_ibfk_1` FOREIGN KEY (`idEvento`) REFERENCES `eventos` (`idEvento`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `valoraciones_ibfk_2` FOREIGN KEY (`idUsuario1`) REFERENCES `usuarios` (`idUsuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `valoraciones_ibfk_3` FOREIGN KEY (`idUsuario2`) REFERENCES `usuarios` (`idUsuario`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;