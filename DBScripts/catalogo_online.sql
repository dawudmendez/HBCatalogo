-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 06-10-2020 a las 22:44:41
-- Versión del servidor: 10.4.11-MariaDB
-- Versión de PHP: 7.2.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `catalogo_online`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `configuracion`
--

CREATE TABLE `configuracion` (
  `empresa` varchar(50) NOT NULL,
  `url` varchar(100) NOT NULL,
  `url_catalogo` varchar(100) NOT NULL,
  `mensaje` varchar(200) NOT NULL,
  `direccion` varchar(100) NOT NULL,
  `localidad` varchar(100) NOT NULL,
  `telefono` varchar(100) NOT NULL,
  `portada` varchar(100) NOT NULL,
  `logo` varchar(100) NOT NULL,
  `whatsapp` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `configuracion`
--

INSERT INTO `configuracion` (`empresa`, `url`, `url_catalogo`, `mensaje`, `direccion`, `localidad`, `telefono`, `portada`, `logo`, `whatsapp`) VALUES
('Home Basic', 'http://www.homebasic.com.ar', 'http://www.homebasic.com.ar/catalogo', 'Pronto tendrás acceso a nuestra tienda online.', 'Comodoro Py 3195', 'Gregorio de Laferrere', '(011) 4457-6407', 'uploads/images/portada.png', 'uploads/images/logo.png', '+5491126489063');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paginas`
--

CREATE TABLE `paginas` (
  `id` int(255) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `descripcion` varchar(150) NOT NULL,
  `imagen` varchar(200) DEFAULT NULL,
  `cant_prod` int(200) DEFAULT NULL,
  `orden` int(255) NOT NULL,
  `prod_1_cod` varchar(20) DEFAULT NULL,
  `prod_1_nom` varchar(20) DEFAULT NULL,
  `prod_1_des` varchar(20) DEFAULT NULL,
  `prod_1_pre` decimal(12,2) DEFAULT NULL,
  `prod_2_cod` varchar(20) DEFAULT NULL,
  `prod_2_nom` varchar(20) DEFAULT NULL,
  `prod_2_des` varchar(20) DEFAULT NULL,
  `prod_2_pre` decimal(12,2) DEFAULT NULL,
  `prod_3_cod` varchar(20) DEFAULT NULL,
  `prod_3_nom` varchar(20) DEFAULT NULL,
  `prod_3_des` varchar(20) DEFAULT NULL,
  `prod_3_pre` decimal(12,2) DEFAULT NULL,
  `prod_4_cod` varchar(20) DEFAULT NULL,
  `prod_4_nom` varchar(20) DEFAULT NULL,
  `prod_4_des` varchar(20) DEFAULT NULL,
  `prod_4_pre` decimal(12,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `paginas`
--

INSERT INTO `paginas` (`id`, `nombre`, `descripcion`, `imagen`, `cant_prod`, `orden`, `prod_1_cod`, `prod_1_nom`, `prod_1_des`, `prod_1_pre`, `prod_2_cod`, `prod_2_nom`, `prod_2_des`, `prod_2_pre`, `prod_3_cod`, `prod_3_nom`, `prod_3_des`, `prod_3_pre`, `prod_4_cod`, `prod_4_nom`, `prod_4_des`, `prod_4_pre`) VALUES
(25, 'Heladera Lavarropas', 'Pagina 1', 'uploads/images/1599422532_2-prod.jpeg', 2, 1, '123-45678', 'Heladera Multicolor', 'Heladera copadísima', '345.00', '321-45678', 'Lavarropas Negro', 'Lavarropas Malísimo', '765.00', '', '', '', '0.00', '', '', '', '0.00'),
(26, 'Varios electrodomésticos', 'Heladera, Lavarropas, Microondas, Horno Eléctrico', 'uploads/images/1599422665_4-prod.jpeg', 4, 7, '123-45678', 'Heladera Multicolor', 'Heladera copadísima', '345.00', '321-45678', 'Lavarropas Negro', 'Lavarropas Malísimo', '455.00', '12347', 'Horno Eléctrico', 'Horno copado', '345.00', '12348', 'Microondas', 'Micro bueno', '999.99'),
(28, 'Collage', 'Collage', 'uploads/images/1601151643_Collage.jpeg', 2, 2, '345', 'Dátiles', 'Preoducto 1', '34.00', '43', 'Alfombra', 'Preoducto 2', '43.00', '', '', '', '0.00', '', '', '', '0.00'),
(34, 'Pagina Electrodomésticos Validados', 'Esta es la portada loco', 'uploads/images/1601236266_hela.jpg', 2, 8, '1234', '1234 prod', 'Prod desc 1', '4000.00', '4321', '4321 prod', 'Prod desc 2', '4000.00', '', '', '', '0.00', '', '', '', '0.00'),
(35, 'dddd', 'ddddfdfdfdffdfdf', 'uploads/images/1601236601_cocina.jpg', 2, 9, 'd', 'df', 'dfdf', '0.00', 'mjjkjk', 'jkjkjk', 'jkjkkj', '0.00', '', '', '', '0.00', '', '', '', '0.00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `usuario` varchar(50) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellido` varchar(50) NOT NULL,
  `password` varchar(250) NOT NULL,
  `admin` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`usuario`, `nombre`, `apellido`, `password`, `admin`) VALUES
('home_admin', 'Home Basic', 'Admin', '$2y$10$zLTQublW.iqtYAW/R5LtS.CBrEhBtbovpM/ZkgvvEp1eHXIaTtqEK', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vendedores`
--

CREATE TABLE `vendedores` (
  `id` int(200) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `nombre` varchar(20) NOT NULL,
  `apellido` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `whatsapp` varchar(50) NOT NULL,
  `link` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `vendedores`
--

INSERT INTO `vendedores` (`id`, `usuario`, `nombre`, `apellido`, `email`, `whatsapp`, `link`) VALUES
(4, 'dawudmendez', 'Dawud', 'Mendez', 'dawud.mendez@outlook.com', '+5491161067766', 'http://www.homebasic.com.ar/catalogo?vend=dawudmendez'),
(6, 'sahl', 'Sahl', 'Molina', 'sahl.molina@gmail.com', '+5491161067766', 'http://www.homebasic.com.ar/catalogo?vend=sahl');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `paginas`
--
ALTER TABLE `paginas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`usuario`);

--
-- Indices de la tabla `vendedores`
--
ALTER TABLE `vendedores`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `paginas`
--
ALTER TABLE `paginas`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT de la tabla `vendedores`
--
ALTER TABLE `vendedores`
  MODIFY `id` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
