-- phpMyAdmin SQL Dump
-- version 4.0.10.7
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 13-12-2015 a las 20:15:55
-- Versión del servidor: 5.5.45-cll-lve
-- Versión de PHP: 5.4.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `yoloofpp_hidrantes`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Hidrantes`
--

CREATE TABLE IF NOT EXISTS `Hidrantes` (
  `_id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` text NOT NULL,
  `posicion` text NOT NULL,
  `estado` char(1) NOT NULL DEFAULT 'A',
  `psi` int(11) NOT NULL DEFAULT '0',
  `t4` int(11) NOT NULL DEFAULT '0',
  `t25` int(11) NOT NULL DEFAULT '0',
  `acople` text NOT NULL,
  `foto` blob,
  `obs` text NOT NULL,
  `fecha_crea` text NOT NULL,
  `fecha_mod` text,
  `fecha_insp` text,
  `fecha_man` text,
  `usuario_crea` varchar(10) NOT NULL,
  `usuario_mod` varchar(10) NOT NULL,
  PRIMARY KEY (`_id`),
  KEY `usuario_crea` (`usuario_crea`,`usuario_mod`),
  KEY `usuario_mod` (`usuario_mod`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `Hidrantes`
--

INSERT INTO `Hidrantes` (`_id`, `nombre`, `posicion`, `estado`, `psi`, `t4`, `t25`, `acople`, `foto`, `obs`, `fecha_crea`, `fecha_mod`, `fecha_insp`, `fecha_man`, `usuario_crea`, `usuario_mod`) VALUES
(1, 'Pharmacy''s Entre Ríos', '-2.145771,-79.864299', 'A', 30, 0, 2, 'Estandar', NULL, '', '06/Dic/2015', '06/Dic/2015', '06/Dic/2015', '06/Dic/2015', '0924102270', '0924102270');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Usuario`
--

CREATE TABLE IF NOT EXISTS `Usuario` (
  `id_cedula` char(10) NOT NULL,
  `nombre` text NOT NULL,
  `apellido` text NOT NULL,
  `tipo` int(11) NOT NULL,
  `institucion` text NOT NULL,
  `cargo` text NOT NULL,
  `password` text NOT NULL,
  `estado` char(1) NOT NULL,
  `email` text NOT NULL,
  PRIMARY KEY (`id_cedula`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `Usuario`
--

INSERT INTO `Usuario` (`id_cedula`, `nombre`, `apellido`, `tipo`, `institucion`, `cargo`, `password`, `estado`, `email`) VALUES
('0924102270', 'Jaime', 'Moscoso', 1, 'CBS', 'Voluntario', 'password', 'A', 'jaime.r.moscoso@gmail.com');

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `Hidrantes`
--
ALTER TABLE `Hidrantes`
  ADD CONSTRAINT `usuario_mod` FOREIGN KEY (`usuario_mod`) REFERENCES `Usuario` (`id_cedula`),
  ADD CONSTRAINT `usuario_crea` FOREIGN KEY (`usuario_crea`) REFERENCES `Usuario` (`id_cedula`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
