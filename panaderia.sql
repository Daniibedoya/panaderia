-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 27-05-2019 a las 00:01:06
-- Versión del servidor: 10.1.37-MariaDB
-- Versión de PHP: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `panaderia`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inventario`
--

CREATE TABLE `inventario` (
  `codigo_inventario` int(11) NOT NULL,
  `codigo_producto` char(11) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `cantidad_actual` int(11) DEFAULT NULL,
  `cantidad_minima` int(11) DEFAULT NULL,
  `costo` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `inventario`
--

INSERT INTO `inventario` (`codigo_inventario`, `codigo_producto`, `cantidad_actual`, `cantidad_minima`, `costo`) VALUES
(1, '3', 36, 30, 2500),
(2, '45', 36, 30, 25000);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permisos`
--

CREATE TABLE `permisos` (
  `codigo_permiso` int(11) NOT NULL,
  `permiso` int(11) DEFAULT NULL,
  `usuario` varchar(20) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `estado` varchar(20) COLLATE utf8_spanish2_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `permisos`
--

INSERT INTO `permisos` (`codigo_permiso`, `permiso`, `usuario`, `estado`) VALUES
(121, 1, 'danii@outlook.com', 's'),
(122, 2, 'danii@outlook.com', 's'),
(123, 3, 'danii@outlook.com', 's'),
(124, 4, 'danii@outlook.com', 's'),
(125, 5, 'danii@outlook.com', 's'),
(126, 6, 'danii@outlook.com', 's'),
(127, 7, 'danii@outlook.com', 's'),
(128, 8, 'danii@outlook.com', 's'),
(129, 1, 'sebas@gmail.com', 's'),
(130, 2, 'sebas@gmail.com', 'n'),
(131, 3, 'sebas@gmail.com', 'n'),
(132, 4, 'sebas@gmail.com', 'n'),
(133, 5, 'sebas@gmail.com', 'n'),
(134, 6, 'sebas@gmail.com', 'n'),
(135, 7, 'sebas@gmail.com', 's'),
(136, 8, 'sebas@gmail.com', 's');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permisos_tem`
--

CREATE TABLE `permisos_tem` (
  `codigo_permiso_tem` int(11) NOT NULL,
  `nombre_permiso` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `permisos_tem`
--

INSERT INTO `permisos_tem` (`codigo_permiso_tem`, `nombre_permiso`) VALUES
(1, 'registrar_usuarios'),
(2, 'registrar_productos'),
(3, 'registrar_inventario'),
(4, 'lista_usuarios'),
(5, 'lista_productos'),
(6, 'lista_inventario'),
(7, 'consultar_usuarios'),
(8, 'consultar_productos');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `codigo_producto` char(11) COLLATE utf8_spanish2_ci NOT NULL,
  `nombre_producto` varchar(30) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `descripcion` varchar(50) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `precio` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`codigo_producto`, `nombre_producto`, `descripcion`, `precio`) VALUES
('3', 'Pan', 'Fresco', 2500),
('45', 'Galletas', 'Crocantes', 2500),
('64', 'Palitos', 'Crocantes', 1500),
('9', 'Palitos', 'Palitos de arina', 1000);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id_usuario` char(11) COLLATE utf8_spanish2_ci NOT NULL,
  `nombres` varchar(30) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `apellidos` varchar(30) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `direccion` varchar(30) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `telefono` varchar(12) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `correo` varchar(30) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `contraseña` varchar(30) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `estado` varchar(20) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `tipo_usuario` varchar(20) COLLATE utf8_spanish2_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `nombres`, `apellidos`, `direccion`, `telefono`, `correo`, `contraseña`, `estado`, `tipo_usuario`) VALUES
('00010604494', 'Sebastian', 'Bedoya Agudelo', 'Dosquebradas', '3125075661', 'sebas@gmail.com', '789', 's', 'cajero'),
('1088039957', 'Kelly Daniela ', 'Bedoya Agudelo', 'Dosquebradas/Risaralda', '3114173804', 'danii@outlook.com', 'niña', 's', 'administrador');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `inventario`
--
ALTER TABLE `inventario`
  ADD PRIMARY KEY (`codigo_inventario`);

--
-- Indices de la tabla `permisos`
--
ALTER TABLE `permisos`
  ADD PRIMARY KEY (`codigo_permiso`);

--
-- Indices de la tabla `permisos_tem`
--
ALTER TABLE `permisos_tem`
  ADD PRIMARY KEY (`codigo_permiso_tem`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`codigo_producto`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `inventario`
--
ALTER TABLE `inventario`
  MODIFY `codigo_inventario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `permisos`
--
ALTER TABLE `permisos`
  MODIFY `codigo_permiso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=137;

--
-- AUTO_INCREMENT de la tabla `permisos_tem`
--
ALTER TABLE `permisos_tem`
  MODIFY `codigo_permiso_tem` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
