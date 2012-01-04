DROP DATABASE IF EXISTS sotneve;
CREATE DATABASE IF NOT EXISTS sotneve
	COLLATE utf8_spanish_ci;

USE sotneve;
-- phpMyAdmin SQL Dump
-- version 3.4.8
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 01-01-2012 a las 11:16:17
-- Versión del servidor: 5.5.18
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

--
-- Volcado de datos para la tabla `afiliaciones`
--

INSERT INTO `afiliaciones` (`idUsuario`, `idEvento`) VALUES
(1, 18),
(4, 19),
(3, 20),
(3, 22);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `eventos`
--

CREATE TABLE IF NOT EXISTS `eventos` (
  `idEvento` int(11) NOT NULL AUTO_INCREMENT,
  `idTipo` int(11) NOT NULL,
  `titulo` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `maxPersonas` int(11) NOT NULL,
  `fechaCreacion` datetime NOT NULL,
  `descripcion` varchar(250) COLLATE utf8_spanish_ci DEFAULT NULL,
  `fechaEvento` datetime DEFAULT NULL,
  `idProvincia` int(11) DEFAULT NULL,
  `lugar` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `propietario` int(11) NOT NULL,
  PRIMARY KEY (`idEvento`),
  KEY `idProvincia` (`idProvincia`),
  KEY `propietario` (`propietario`),
  KEY `idTipo` (`idTipo`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=23 ;

--
-- Volcado de datos para la tabla `eventos`
--

INSERT INTO `eventos` (`idEvento`, `idTipo`, `titulo`, `maxPersonas`, `fechaCreacion`, `descripcion`, `fechaEvento`, `idProvincia`, `lugar`, `propietario`) VALUES
(18, 4, 'Partidito de tenis', 4, '2012-01-01 11:02:01', 'Un partidito de tenis amateur', '2012-01-07 16:00:00', 41, 'La pista de tenis del SADUS', 1),
(19, 7, 'Discoteca Bandaway', 666, '2012-01-02 16:23:50', 'Vamos de fiesta!!', '2012-01-13 23:30:00', 14, 'Discoteca Bandaway', 4),
(20, 5, 'Partido de ping-pong', 2, '2012-01-01 00:00:00', 'Partido de ping-pong profesional', NULL, 17, 'Donde cristo perdió el mechero y luego a la derech', 3),
(22, 1, 'Escalada', 2, '2012-01-01 00:00:00', 'Escalar el Everest dos veces y merendola en el mirador.', NULL, 24, 'Pico monte Everest', 3);

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
(2, 1),
(1, 2),
(3, 2),
(1, 3),
(2, 3),
(1, 4),
(2, 4),
(3, 4),
(1, 5),
(1, 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `provincias`
--

CREATE TABLE IF NOT EXISTS `provincias` (
  `idProvincia` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`idProvincia`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=53 ;

--
-- Volcado de datos para la tabla `provincias`
--

INSERT INTO `provincias` (`idProvincia`, `nombre`) VALUES
(1, 'Alava'),
(2, 'Albacete'),
(3, 'Alicante'),
(4, 'Almería'),
(5, 'Avila'),
(6, 'Badajoz'),
(7, 'Illes Baleares'),
(8, 'Barcelona'),
(9, 'Burgos'),
(10, 'Cáceres'),
(11, 'Cádiz'),
(12, 'Cástellón'),
(13, 'Ciudad Real'),
(14, 'Córdoba'),
(15, 'Coruña, A'),
(16, 'Cuenca'),
(17, 'Girona'),
(18, 'Granada'),
(19, 'Guadalajara'),
(20, 'Guipuzcoa'),
(21, 'Huelve'),
(22, 'Huesca'),
(23, 'Jaén'),
(24, 'León'),
(25, 'Lleida'),
(26, 'Rioja, La'),
(27, 'Lugo'),
(28, 'Madrid'),
(29, 'Málaga'),
(30, 'Murcia'),
(31, 'Navarra'),
(32, 'Ourense'),
(33, 'Asturias'),
(34, 'Palencia'),
(35, 'Palmas, Las'),
(36, 'Pontevedra'),
(37, 'Salamanca'),
(38, 'Santa Cruz de Tenerife'),
(39, 'Cantabria'),
(40, 'Segovia'),
(41, 'Sevilla'),
(42, 'Soria'),
(43, 'Tarragona'),
(44, 'Teruel'),
(45, 'Toledo'),
(46, 'Valencia'),
(47, 'Valladolid'),
(48, 'Vizcaya'),
(49, 'Zamora'),
(50, 'Zaragoza'),
(51, 'Ceuta'),
(52, 'Melilla');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipos`
--

CREATE TABLE IF NOT EXISTS `tipos` (
  `idTipo` int(11) NOT NULL AUTO_INCREMENT,
  `idPadre` int(11) DEFAULT NULL,
  `nombre` varchar(60) COLLATE utf8_spanish_ci DEFAULT NULL,
  `externo` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`idTipo`),
  KEY `idPadre` (`idPadre`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=9 ;

--
-- Volcado de datos para la tabla `tipos`
--

INSERT INTO `tipos` (`idTipo`, `idPadre`, `nombre`, `externo`) VALUES
(1, NULL, 'Deportes', 0),
(2, NULL, 'Ocio', 0),
(3, 1, 'Raqueta', 0),
(4, 3, 'Tenis', 0),
(5, 3, 'Ping-Pong', 0),
(7, 2, 'Discoteca', 0),
(8, 2, 'ba$ur4', 1);

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
  `idProvincia` int(11) NOT NULL,
  `visibilidad` int(2) NOT NULL COMMENT 'fechaNac, sexo, email, nombre, apellidos',
  PRIMARY KEY (`idUsuario`),
  UNIQUE KEY `email` (`email`),
  KEY `idProvincia` (`idProvincia`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=16 ;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`idUsuario`, `fechaNac`, `sexo`, `email`, `alias`, `pass`, `nombre`, `apellidos`, `idProvincia`, `visibilidad`) VALUES
(1, '1990-10-19', 1, 'rafaespillaque@gmail.com', 'Rafaesp', '688787d8ff144c502c7f5cffaafe2cc588d86079f9de88304c26b0cb99ce91c6', 'Rafael', 'Espillaque Espinosa', 2, 1),
(2, '2000-01-01', 0, 'asd@asd.com', 'kiki', '5fd924625f6ab16a19cc9807c7c506ae1813490e4ba675f843d5a10e0baacdb8', 'Carmen', 'Delgado', 2, 31),
(3, '1990-02-11', 1, 'xusty_alex@hotmail.com', 'alexmacan', '5fd924625f6ab16a19cc9807c7c506ae1813490e4ba675f843d5a10e0baacdb8', 'Ale', 'Molina', 1, 0),
(4, '1980-12-11', 1, 'zp_y_yo@gaymail.com', 'rajoy', '5fd924625f6ab16a19cc9807c7c506ae1813490e4ba675f843d5a10e0baacdb8', 'Mari4no', 'Rajoy', 1, 0),
(5, '2010-11-11', 1, 'email1@dominio.com', 'fargueras', '5fd924625f6ab16a19cc9807c7c506ae1813490e4ba675f843d5a10e0baacdb8', 'nombre1', 'apellidos1', 30, 0),
(6, '1990-02-11', 1, 'email2@dominio.com', 'rafaé', '5fd924625f6ab16a19cc9807c7c506ae1813490e4ba675f843d5a10e0baacdb8', 'nombre2', 'apellidos2', 1, 0),
(7, '1989-12-10', 0, 'email3@dominio.com', 'vaquilla', '5fd924625f6ab16a19cc9807c7c506ae1813490e4ba675f843d5a10e0baacdb8', 'nombre3', 'apellidos3', 30, 0),
(8, '1990-10-19', 0, 'email4@dominio.com', 'antonio', '5fd924625f6ab16a19cc9807c7c506ae1813490e4ba675f843d5a10e0baacdb8', 'nombre4', 'apellidos4', 2, 0),
(9, '1990-10-19', 1, 'email5@dominio.com', 'bendi', '5fd924625f6ab16a19cc9807c7c506ae1813490e4ba675f843d5a10e0baacdb8', 'nombre5', 'apellidos5', 1, 0),
(10, '1990-10-19', 1, 'email6@dominio.com', 'sandra', '5fd924625f6ab16a19cc9807c7c506ae1813490e4ba675f843d5a10e0baacdb8', 'nombre7', 'apellidos6', 2, 0),
(11, '1989-12-10', 1, 'email8@dominio.com', 'alias8', '5fd924625f6ab16a19cc9807c7c506ae1813490e4ba675f843d5a10e0baacdb8', 'nombre8', 'apellidos8', 2, 0),
(12, '1990-11-11', 1, 'email9@dominio.com', 'alias9', '5fd924625f6ab16a19cc9807c7c506ae1813490e4ba675f843d5a10e0baacdb8', 'nombre9', 'apellidos9', 30, 0),
(14, '1989-12-10', 1, 'email10@dominio.com', 'alias10', '5fd924625f6ab16a19cc9807c7c506ae1813490e4ba675f843d5a10e0baacdb8', 'nombre10', 'apellidos10', 1, 0),
(15, '1989-12-10', 1, 'email11@dominio.com', 'alias11', '5fd924625f6ab16a19cc9807c7c506ae1813490e4ba675f843d5a10e0baacdb8', 'nombre11', 'apellidos11', 1, 0);

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
  ADD CONSTRAINT `afiliaciones_ibfk_1` FOREIGN KEY (`idUsuario`) REFERENCES `usuarios` (`idUsuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `afiliaciones_ibfk_2` FOREIGN KEY (`idEvento`) REFERENCES `eventos` (`idEvento`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `eventos`
--
ALTER TABLE `eventos`
  ADD CONSTRAINT `eventos_ibfk_8` FOREIGN KEY (`idTipo`) REFERENCES `tipos` (`idTipo`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `eventos_ibfk_6` FOREIGN KEY (`propietario`) REFERENCES `usuarios` (`idUsuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `eventos_ibfk_7` FOREIGN KEY (`idProvincia`) REFERENCES `provincias` (`idProvincia`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `favoritos`
--
ALTER TABLE `favoritos`
  ADD CONSTRAINT `favoritos_ibfk_1` FOREIGN KEY (`idUsuario1`) REFERENCES `usuarios` (`idUsuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `favoritos_ibfk_2` FOREIGN KEY (`idUsuario2`) REFERENCES `usuarios` (`idUsuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `tipos`
--
ALTER TABLE `tipos`
  ADD CONSTRAINT `tipos_ibfk_1` FOREIGN KEY (`idPadre`) REFERENCES `tipos` (`idTipo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`idProvincia`) REFERENCES `provincias` (`idProvincia`) ON DELETE CASCADE ON UPDATE CASCADE;

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