-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 07, 2017 at 11:26 AM
-- Server version: 5.5.54
-- PHP Version: 5.3.10-1ubuntu3.26

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `cifocar`
--

-- --------------------------------------------------------

--
-- Table structure for table `marcas`
--

CREATE TABLE IF NOT EXISTS `marcas` (
  `marca` varchar(32) NOT NULL,
  PRIMARY KEY (`marca`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `marcas`
--

INSERT INTO `marcas` (`marca`) VALUES
('Peugeot1'),
('Toyota');

-- --------------------------------------------------------

--
-- Table structure for table `usuarios`
--

CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` varchar(32) COLLATE utf8_spanish_ci NOT NULL,
  `password` varchar(32) COLLATE utf8_spanish_ci NOT NULL,
  `nombre` varchar(32) COLLATE utf8_spanish_ci NOT NULL,
  `privilegio` int(1) NOT NULL,
  `email` varchar(128) COLLATE utf8_spanish_ci NOT NULL,
  `admin` tinyint(1) NOT NULL,
  `imagen` varchar(512) COLLATE utf8_spanish_ci DEFAULT NULL,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_UNIQUE` (`user`),
  UNIQUE KEY `email_UNIQUE` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=23 ;

--
-- Dumping data for table `usuarios`
--

INSERT INTO `usuarios` (`id`, `user`, `password`, `nombre`, `privilegio`, `email`, `admin`, `imagen`, `fecha`) VALUES
(1, 'ere', 'rere', 'rere1', 1, 'dfs@gmail.com', 1, 'fdfd', '2017-11-07 10:13:17'),
(2, 'jordi', '83d53db77bff97220353e490bf373403', 'jordi2', 1, 'hola@hola.com', 0, 'images/users/59f8577a3aff1yiyoKddG0GfDZIxddnzW.png', '2017-11-03 11:53:10'),
(7, 'dddd', '50f84daf3a6dfd6a9f20c9f8ef428942', 'dddd1', 2, 'ddd@dd.com', 0, 'images/users/user.png', '2017-11-07 10:12:44'),
(8, 'eee', '86871b9b1ab33b0834d455c540d82e89', 'eeeee1', 1, 'eeee@gfdgf.com', 0, 'images/users/user.png', '2017-11-07 10:00:12'),
(9, 'yyy', '21232f297a57a5a743894a0e4a801fc3', 'yyyyy1', 2, 'yyyy@yyy.com', 1, 'images/users/user.png', '2017-11-07 09:53:40'),
(10, 'uuuuuuu', '', 'uuuu1', 1, 'uuuu@uu.com', 0, 'images/users/user.png', '2017-11-07 09:50:34'),
(12, 'vendedor', '0407e8c8285ab85509ac2884025dcf42', 'vendedor', 2, 'vendedor@gfgf.com', 0, 'images/users/user.png', '2017-11-02 09:57:50'),
(21, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin1', 0, 'admin@gmail.com', 1, '\r\nNotice: Trying to get property of non-object in /home/usuarim/git/repositori1/cifocar/view/usuarios/modificacion.php on line 28\r\n', '2017-11-07 09:51:02'),
(22, 'comprador', '5ed02a1a2533758ab19b62dd4baaed69', 'comprador1', 1, 'comprador@gmail.com', 0, 'images/users/5a0188e9506f67oNBAXMwre7FXBDWSoVA.jpg', '2017-11-07 10:21:04');

-- --------------------------------------------------------

--
-- Table structure for table `vehiculos`
--

CREATE TABLE IF NOT EXISTS `vehiculos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `matricula` char(8) NOT NULL,
  `modelo` varchar(32) NOT NULL,
  `color` varchar(32) NOT NULL,
  `precio_venta` float NOT NULL,
  `precio_compra` float NOT NULL,
  `kms` int(11) NOT NULL,
  `caballos` int(11) NOT NULL,
  `fecha_venta` timestamp NULL DEFAULT NULL,
  `estado` int(11) NOT NULL,
  `any_matriculacion` int(4) NOT NULL,
  `detalles` text,
  `imagen` varchar(512) DEFAULT NULL,
  `marca` varchar(32) NOT NULL,
  `vendedor` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_vehiculos_marcas1_idx` (`marca`),
  KEY `fk_vehiculos_usuarios1_idx` (`vendedor`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `vehiculos`
--

INSERT INTO `vehiculos` (`id`, `matricula`, `modelo`, `color`, `precio_venta`, `precio_compra`, `kms`, `caballos`, `fecha_venta`, `estado`, `any_matriculacion`, `detalles`, `imagen`, `marca`, `vendedor`) VALUES
(3, 'gfgf1', 'gfgf1', 'gfg1', 1, 0, 3, 4, '0000-00-00 00:00:00', 0, 6, 'dfsfd', 'images/vehiculos/vehiculo.png', 'Peugeot1', 1),
(4, 'aaaaaa', 'aa', 'b', 1, 0, 2, 3, NULL, 4, 5, 'fdsfd', 'images/vehiculos/vehiculo.png', 'Toyota', 1),
(5, 'rer', 'rere', 'rer', 1, 0, 2, 3, NULL, 4, 5, 'fdfd', 'images/vehiculos/59f8480cb9447HMNfccnJba5nq0XT3fXD.jpg', 'Peugeot1', 1),
(6, 'rrrrrrrr', 'verd', 'fddf', 2, 0, 3, 4, '0000-00-00 00:00:00', 2, 67, 'ddgf', 'images/vehiculos/5a00455432c33n2vLcmp6O9EbuUSHkdEh.jpg', 'Peugeot1', 2),
(7, 'Toyota12', 'fdfd12', 'kjkgjh12', 112223, 0, 312, 4234, '0000-00-00 00:00:00', 2, 5234567, 'gfdhggf2', 'images/vehiculos/5a0044c13bea7GvEGgwO1AuKfQeEOeqBQ.jpg', 'Toyota', 2),
(8, 'fghgh', 'hghg', 'hghg', 1, 0, 2, 3, NULL, 0, 5, 'fdfgd', 'images/vehiculos/vehiculo.png', 'Peugeot1', 2),
(9, 'hgtjh', 'jhjh', 'jhjh', 1, 0, 3, 4, NULL, 1, 6, 'dfd', 'images/vehiculos/vehiculo.png', 'Peugeot1', 2),
(10, 'gfhghg', 'hghg', 'hghg', 1, 0, 3, 4, NULL, 0, 6, 'dffgdfd', 'images/vehiculos/vehiculo.png', 'Peugeot1', 2),
(11, 'kjkjkj', 'kjkj', 'kjkj', 1, 0, 2, 3, NULL, 2, 4, 'gfgtf', 'images/vehiculos/vehiculo.png', 'Peugeot1', 2);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `vehiculos`
--
ALTER TABLE `vehiculos`
  ADD CONSTRAINT `fk_vehiculos_marcas1` FOREIGN KEY (`marca`) REFERENCES `marcas` (`marca`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_vehiculos_usuarios1` FOREIGN KEY (`vendedor`) REFERENCES `usuarios` (`id`) ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
