-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 04-02-2024 a las 21:10:40
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `lrac_bd`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productdata`
--

CREATE TABLE `productdata` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(50) NOT NULL,
  `product_desc` varchar(100) NOT NULL,
  `product_uniprice` int(20) NOT NULL,
  `product_ingredients` varchar(200) NOT NULL,
  `product_category` varchar(50) NOT NULL,
  `product_image` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `productdata`
--

INSERT INTO `productdata` (`product_id`, `product_name`, `product_desc`, `product_uniprice`, `product_ingredients`, `product_category`, `product_image`) VALUES
(5, 'Buñuelo', 'Un buñuelo bien pero bien crocante', 1000, 'harina huevo y no se buñuelo?', 'Panaderia', '2.jpg'),
(6, 'Pan Queso Costeño', 'un pan queso bien sabroso', 3000, 'pan y queso jskdsk', 'Heladeria', '1.jpg'),
(7, 'Eclair', 'un eclair bien chocolatoso', 10000, 'no se nunca he comido uno', 'Panaderia', '3.jpg'),
(8, 'Alfajor', 'un alfajor bien caro jaja', 1200, 'alfajor comprado de diletto', 'Pasteleria', '4.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `userdata`
--

CREATE TABLE `userdata` (
  `name` varchar(20) NOT NULL,
  `pass` varchar(20) NOT NULL,
  `mail` varchar(50) NOT NULL,
  `question` varchar(50) NOT NULL,
  `qanswer` varchar(50) NOT NULL,
  `numtel` varchar(50) NOT NULL,
  `tempcode` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `userdata`
--

INSERT INTO `userdata` (`name`, `pass`, `mail`, `question`, `qanswer`, `numtel`, `tempcode`) VALUES
('1', '12', 'correo1', '2 + 4 = 4?', 'si', '', '');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `productdata`
--
ALTER TABLE `productdata`
  ADD PRIMARY KEY (`product_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `productdata`
--
ALTER TABLE `productdata`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
