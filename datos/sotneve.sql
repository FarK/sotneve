-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 15-01-2012 a las 17:24:35
-- Versión del servidor: 5.5.16
-- Versión de PHP: 5.3.8
DROP DATABASE IF EXISTS sotneve;
CREATE DATABASE IF NOT EXISTS sotneve
	COLLATE utf8_spanish_ci;

USE sotneve;

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
(20, 24),
(21, 24),
(17, 25),
(20, 25),
(21, 25),
(18, 26),
(20, 26),
(19, 27),
(21, 27),
(19, 28),
(21, 28),
(18, 29),
(19, 29),
(19, 30),
(20, 30),
(19, 31),
(17, 32),
(20, 32),
(17, 33),
(19, 33),
(18, 34),
(20, 34),
(18, 35),
(20, 35),
(17, 36),
(20, 36),
(19, 37),
(20, 37),
(17, 38),
(19, 38),
(20, 38),
(17, 39),
(19, 39),
(18, 40),
(19, 40),
(17, 41),
(18, 41),
(17, 42),
(18, 42),
(18, 43),
(21, 43),
(18, 44),
(21, 44),
(20, 45),
(21, 45),
(21, 46);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=47 ;

--
-- Volcado de datos para la tabla `eventos`
--

INSERT INTO `eventos` (`idEvento`, `idTipo`, `titulo`, `maxPersonas`, `fechaCreacion`, `descripcion`, `fechaEvento`, `idProvincia`, `lugar`, `propietario`) VALUES
(24, 2, 'Partida de ping pong', 2, '2012-01-07 13:13:58', 'Quiero echar una partida al pingpong, nivel medio', '2012-02-05 11:00:00', 41, 'Calle falsa numero 123', 20),
(25, 2, 'Ir a ver Saw 8', 8, '2012-01-07 13:16:07', 'Quiero ver Saw 8 con personas que le gusten este tipo de peliculas', '2012-02-10 00:00:00', 41, 'Nervion', 20),
(26, 2, 'Partido de futboll!!!', 12, '2012-01-07 13:17:55', 'Partido 6 contra 6', '2012-02-15 19:00:00', 41, 'Campo del Valle', 20),
(27, 2, 'Padel en parejas', 4, '2012-01-07 13:21:38', 'Quiero echar un partido por parejas', '2012-02-15 20:00:00', 41, 'Calle mentira n231', 21),
(28, 2, 'Partido de futbol ya!', 10, '2012-01-07 13:23:44', 'Partido de 5 vs 5 hay que poner 1,20€ cada uno para el alquiler de la pista', '2012-02-15 20:00:00', 41, 'Pistas de cavaleri', 21),
(29, 2, 'jugar al padel o al tenis', 2, '2012-01-07 13:28:24', 'Me gustaria jugar al padel o al tenis, mi nivel es bajo', '2012-02-19 00:00:00', 41, 'SATOS Sport', 19),
(30, 2, 'Ver alguna pelicula', 4, '2012-01-07 13:37:39', 'Me gustaria ir al cine a ver una pelicula', '2012-02-05 00:00:00', 41, 'Los Arcos', 19),
(31, 2, 'natacion o buceo', 4, '2012-01-07 13:49:33', 'Algo de deporte en el mar, quedariamos en sevilla en plaza de armas para echar el dia, vamos en mi coche', '2012-02-11 09:00:00', 41, 'Playa la costilla', 19),
(32, 2, 'Baloncesto', 10, '2012-01-07 14:28:54', 'jugar al baloncesto', '2012-02-12 00:00:00', 41, 'Polideportivo San Pablo', 17),
(33, 2, 'Ir al cine', 4, '2012-01-07 14:39:09', 'Quiero ver alguna pelicula de comedia', '2012-02-19 00:00:00', 41, 'PLaza de Armas', 17),
(34, 2, 'Remar por el Guadalquivir', 4, '2012-01-07 14:41:32', 'vamos a remar un poco!', '2012-02-14 19:00:00', 41, 'Rio', 18),
(35, 2, 'remo o buceo', 6, '2012-01-07 14:42:30', 'vamos a remar o a bucear!!', '2012-02-18 19:00:00', 41, 'Cualquier sitio', 18),
(36, 16, 'Jugar al golf', 2, '2012-01-15 15:40:04', 'xDD', '2012-02-09 00:00:00', 40, 'en el minigolf', 20),
(37, 15, 'jugarmos al baloncesto', 10, '2012-01-15 15:41:09', 'descripcion', '2012-02-14 07:00:00', 40, 'Pista del polideportivo', 20),
(38, 18, 'nadar', 4, '2012-01-15 15:46:55', 'adasd', '2012-02-02 06:00:00', 40, 'lago de la esquina', 20),
(39, 5, 'jugar al pingpong', 2, '2012-01-15 16:15:56', 'amo ar pizo a jugar al pinpong', '2012-02-06 16:00:00', 40, 'en el pizo', 19),
(40, 5, 'si seÃ±or remo', 3, '2012-01-15 16:19:43', 'illo illo amo ar pizo a juga ar pingpoong', '2012-02-08 17:00:00', 40, 'en el pizo', 19),
(41, 14, 'futbol', 22, '2012-01-15 16:23:44', 'he alquilado la pista. vamos a jugar, llevarse 1.30â‚¬ cada uno para pagar el alquiler', '2012-02-14 14:00:00', 40, 'las pistas (pista B)', 17),
(42, 4, 'tenis rapido', 4, '2012-01-15 16:24:43', 'vamos a jugar al tenis', '2012-02-16 19:00:00', 40, 'calle tenista', 17),
(43, 11, 'obra de teatro Don Tenorio', 2, '2012-01-15 16:27:20', 'tengo dos entradas para la obra Don Tenorio, quien viene conmigo', '2012-02-18 18:00:00', 40, 'Teatro de la avenida', 18),
(44, 12, 'pelicula', 2, '2012-01-15 16:29:02', 'vamos a ver  una pelicula de terror', '2012-02-12 16:00:00', 40, 'cine de segovia2', 18),
(45, 4, 'tenis doble', 4, '2012-01-15 16:31:16', 'alquilemos una pista para echar un partido, 18â‚¬/h el alquiler de pista entre todos', '2012-02-16 19:00:00', 40, 'Gimnasio "el gordo"', 21),
(46, 10, 'ver peli', 4, '2012-01-15 16:33:05', 'tengo descuento del 50% para las entradas, vamos a ir a ver alguna pelicula', '2012-02-16 14:00:00', 40, 'centro comercial', 21);

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
(20, 17),
(20, 18),
(17, 19),
(21, 19),
(18, 20),
(19, 20),
(21, 20),
(17, 21),
(19, 21),
(20, 21);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=21 ;

--
-- Volcado de datos para la tabla `tipos`
--

INSERT INTO `tipos` (`idTipo`, `idPadre`, `nombre`, `externo`) VALUES
(1, NULL, 'Deportes', 0),
(2, NULL, 'Ocio', 0),
(3, 1, 'Raqueta', 0),
(4, 3, 'Tenis', 0),
(5, 4, 'Tenis de mesa(Ping Pong)', 0),
(7, 2, 'Discoteca', 0),
(8, 3, 'Padel', 1),
(9, NULL, 'Espectaculo', 0),
(10, 9, 'Cine', 0),
(11, 9, 'Teatro', 0),
(12, 10, 'Terror', 1),
(13, 10, 'Comedia', 1),
(14, 1, 'Futbol', 0),
(15, 1, 'Baloncesto', 0),
(16, 1, 'Golf', 0),
(17, NULL, 'Deportes acuaticos', 0),
(18, 17, 'Natacion', 0),
(19, 17, 'Remo', 0),
(20, 17, 'Buceo', 0);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=22 ;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`idUsuario`, `fechaNac`, `sexo`, `email`, `alias`, `pass`, `nombre`, `apellidos`, `idProvincia`, `visibilidad`) VALUES
(17, '1990-10-19', 1, 'rafaespillaque@gmail.com', 'rafaesp', '5fd924625f6ab16a19cc9807c7c506ae1813490e4ba675f843d5a10e0baacdb8', 'Rafa', 'Espillaque', 41, 37),
(18, '1990-05-24', 1, 'fark.zano@gmail.com', 'fark.zano', '5fd924625f6ab16a19cc9807c7c506ae1813490e4ba675f843d5a10e0baacdb8', 'Carlos', 'Falguera', 41, 2),
(19, '1990-07-09', 1, 'antrodjim@gmail.com', 'sater', '5fd924625f6ab16a19cc9807c7c506ae1813490e4ba675f843d5a10e0baacdb8', 'Antonio', 'Rodriguez', 41, 42),
(20, '1990-02-11', 1, 'xusty_alex@hotmail.com', 'alexmacan', '5fd924625f6ab16a19cc9807c7c506ae1813490e4ba675f843d5a10e0baacdb8', 'Alejandro', 'Molina', 41, 23),
(21, '1989-12-10', 1, 'ervaka@gmail.com', 'ervaka344', '5fd924625f6ab16a19cc9807c7c506ae1813490e4ba675f843d5a10e0baacdb8', 'Jesus', 'Vacas', 41, 53);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `valoraciones`
--

CREATE TABLE IF NOT EXISTS `valoraciones` (
  `idUsuario1` int(11) NOT NULL,
  `idUsuario2` int(11) NOT NULL,
  `valoracion` int(1) NOT NULL,
  PRIMARY KEY (`idUsuario1`,`idUsuario2`),
  KEY `idUsuario2` (`idUsuario2`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `valoraciones`
--

INSERT INTO `valoraciones` (`idUsuario1`, `idUsuario2`, `valoracion`) VALUES
(17, 17, 1),
(17, 18, 3),
(17, 19, 0),
(17, 20, 2),
(17, 21, 2),
(18, 17, 3),
(18, 20, 2),
(19, 17, 2),
(19, 18, 5),
(19, 19, 0),
(19, 20, 0),
(19, 21, 3),
(20, 17, 4),
(20, 18, 4),
(20, 19, 2),
(20, 20, 2),
(20, 21, 3),
(21, 20, 3),
(21, 21, 4);

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
  ADD CONSTRAINT `eventos_ibfk_6` FOREIGN KEY (`propietario`) REFERENCES `usuarios` (`idUsuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `eventos_ibfk_7` FOREIGN KEY (`idProvincia`) REFERENCES `provincias` (`idProvincia`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `eventos_ibfk_8` FOREIGN KEY (`idTipo`) REFERENCES `tipos` (`idTipo`) ON DELETE CASCADE ON UPDATE CASCADE;

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
  ADD CONSTRAINT `valoraciones_ibfk_2` FOREIGN KEY (`idUsuario1`) REFERENCES `usuarios` (`idUsuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `valoraciones_ibfk_3` FOREIGN KEY (`idUsuario2`) REFERENCES `usuarios` (`idUsuario`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
