-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 12-02-2024 a las 00:48:07
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
(5, 'Buñuelo', 'Buñuelo crocante y fresco, hecho con un queso de buena calidad!', 1000, 'Queso costeño, Harina, Almidón de yuca, Leche, Azucar, Huevos, Polvo para Hornear y Sal, freído en aceite.', 'Panaderia', '2.jpg'),
(6, 'Pan Queso Costeño', 'Un pan ampliamente relleno de queso, ideal para un desayuno cargado.', 3000, 'Harina, huevo, queso doble crema, leche, agua, polvo para hornear, mantequilla.', 'Panaderia', '1.jpg'),
(7, 'Eclair', 'Eclair con chocolate, relleno de crema, bastante dulce.', 10000, 'Agua, leche, azucar, harina de trigo, huevos, chocolate derretido, crema chantillí, extracto de vainilla', 'Panaderia', '3.jpg'),
(8, 'Alfajor', 'Un alfajor que se desintegra con cada mordida! Muy dulce y rico.', 1200, 'harina, maizena, arequipe, leche', 'Pasteleria', '4.jpg'),
(9, 'Posset de Limón', 'Un delicioso posset de limón, 1 porción de apróx. 50g.', 1500, 'Crema, azucar, nata, limón, leche condensada y gelatina sin sabor.', 'Pasteleria', 'posset.jpg'),
(10, 'Muffin de Chocolate Milo', 'Un muffin esponjado hecho a base de chocolate y Milo, bastante dulce.', 2000, 'Milo, Chocolate, Harina, Polvo para hornear, huevos, leche entera y agua.', 'Pasteleria', 'muffin.png'),
(11, 'Cheesecake Frutos Rojos', 'Cheesecake con aderezo dulce de frutos rojos, contiene una rica y crocante base de galleta. (1 porci', 1500, 'Leche condensada, Queso Crema, Caramelo de frutos rojos, galletas.', 'Pasteleria', 'cheesecake.jpg'),
(12, 'Brownie con Helado', 'Brownie esponjoso con una bola de helado adicionada!', 4500, 'Bola de helado, brownie de chocolate: Harina, chocolate en polvo, huevos, agua y leche.', 'Heladeria', 'brownieconhelado.jpg'),
(13, 'Sundae de Chocolate', 'Sundae con crema de chocolate.', 2500, 'Leche, leche condensada, crema, syrup de chocolate.', 'Heladeria', 'sundae.jpg'),
(14, 'Malteada de Helado', 'Malteada espesa del helado de sabor que desees! 12 onzas.', 5000, '2 bolas de Helado de elección, 350ml de Leche entera.', 'Heladeria', 'malteada.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `scdata`
--

CREATE TABLE `scdata` (
  `user_mail` varchar(50) NOT NULL,
  `user_product` int(11) NOT NULL,
  `sc_prodAmount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `scdata`
--

INSERT INTO `scdata` (`user_mail`, `user_product`, `sc_prodAmount`) VALUES
('correo1', 14, 0),
('correo1', 12, 0);

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
('1', '12', 'correo1', '2 + 4 = 4?', 'si', '', ''),
('asdasd', 'asdasdas', 'asdasdsad@a', 'asdasd', 'asdasdas', '', '');

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
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
