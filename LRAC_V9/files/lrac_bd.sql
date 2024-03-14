-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 14-03-2024 a las 04:34:58
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
-- Estructura de tabla para la tabla `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `order_user` varchar(100) NOT NULL,
  `order_username` varchar(255) NOT NULL,
  `order_date` date NOT NULL,
  `order_address` varchar(200) NOT NULL,
  `order_state` varchar(255) NOT NULL,
  `order_product_id` varchar(255) DEFAULT 'NULL',
  `order_product_options` varchar(255) DEFAULT 'NULL',
  `order_product_amount` varchar(255) DEFAULT 'NULL',
  `order_total` int(11) NOT NULL,
  `final_state` int(11) NOT NULL DEFAULT 0,
  `order_dreason` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productdata`
--

CREATE TABLE `productdata` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(50) NOT NULL,
  `product_desc` varchar(200) NOT NULL,
  `product_uniprice` int(20) NOT NULL,
  `product_ingredients` varchar(200) NOT NULL,
  `product_category` varchar(50) NOT NULL,
  `product_image` varchar(50) NOT NULL,
  `product_options` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `productdata`
--

INSERT INTO `productdata` (`product_id`, `product_name`, `product_desc`, `product_uniprice`, `product_ingredients`, `product_category`, `product_image`, `product_options`) VALUES
(6, 'Panqueso Costeño', 'Un pan ampliamente relleno de queso, ideal para un buen desayuno o un cafe en la tarde!', 5000, 'Harina, huevo, queso doble crema, leche, agua, polvo para hornear, mantequilla.', 'Panaderia', '1.jpg', NULL),
(7, 'Eclair', 'Eclair con cobertura de chocolate, relleno de crema, ideal para acompañar con café o una bebida de tu antojo :)', 5000, 'Agua, leche, azucar, harina de trigo, huevos, chocolate derretido, crema chantillí, extracto de vainilla.', 'Panaderia', '3.jpg', 'Con relleno de crema, Sin relleno de crema'),
(8, 'Alfajor', 'Un alfajor que se desintegra con cada mordida! Muy dulce y rico.', 1200, 'Harina de trigo, fécula de maíz, mantequilla, leche condensada, huevos, sabor a elección.', 'Pasteleria', '4.jpg', 'Relleno de arequipe, Relleno de chocolate, Alfajor de Red Velvet, Alfajor de chocolate'),
(9, 'Postre Posset', 'Un delicioso posset del sabor que elijas, 1 porción de apróx. 50g.', 2000, 'Crema, azucar, nata, ralladura de limon o de naranja, jugo de limon o de naranja, leche condensada y gelatina sin sabor.', 'Pasteleria', 'posset.jpg', 'Posset de limón, Posset de naranja'),
(10, 'Muffin de Chocolate', 'Un muffin esponjado hecho a base de chocolate y milo, bastante dulce.', 2000, 'Cocoa en Polvo, Harina, huevos, leche entera, Polvo para hornear, huevos y mantequilla.', 'Pasteleria', 'muffin.png', 'Con milo, Sin milo. Solo chocolate'),
(11, 'Cheesecake', 'Cheesecake con aderezo dulce de frutos rojos, contiene una rica y crocante base de galleta. (1 porci', 2400, 'Leche condensada, Queso Crema, Salsa de frutos rojos, galletas.', 'Pasteleria', 'cheesecake.jpg', 'Frutos Rojos, Maracuyá, Oreo, Mango'),
(12, 'Brownie con Helado', 'Brownie esponjoso con una bola de helado adicionada!', 4500, 'Bola de helado, brownie de chocolate: Harina, chocolate en polvo, huevos, agua y leche.', 'Heladeria', 'brownieconhelado.jpg', 'Helado de chocolate, Helado de vainilla, Helado de arequipe'),
(13, 'Sundae', 'Un delicioso y cremoso Sundae, que puedes pedir con la salsa que gustes!', 2500, 'Leche, leche condensada, crema, salsa o syrup a elección.', 'Heladeria', 'sundae.jpg', 'Solo (sin crema), Chocolate, Fresa, Mora, Arequipe'),
(21, 'Gelato', 'Un postre helado italiano antecesor al helado! Es bastante dulce, menos\r\ngrasoso y contiene mas leche', 4000, '3,35% de leche, azúcar, con el ingrediente saborizante que tu elijas :)', 'Heladeria', 'gelatto.png', NULL),
(27, 'Beignet', 'Buñuelo de origen estadounidense frito en aceite caliente, espolvoreado con azucar glass y perfecto para ser acompañado con la bebida de tu seleccion', 2000, 'leche entera, harina de fuerza, levadura, azucar, bicabornato de sodio, azucar glass, sal. Freido en aceite para su coccion', 'Panaderia', 'beignet.jpg', NULL),
(28, 'Chifon de limon y arandanos', 'Pastel chifon de sabor limon, relleno con crema de limon, frosting de arandanos, y decorado con flores comestibles. (1unid equivale a un pastel completo)', 45000, 'Huevos, Azucar, leche entera, relladura de limon, jugo de limon, mantequilla sin sal, sal kosher, polvo para hornear, frosting de queso crema de arandanos (decoracion y relleno), crema de limon', 'Pasteleria', 'falopa.jpg', NULL),
(29, 'Pastel de helado', 'Pastel de helado con base de galleta, helado de vainilla y rosa, crema batida, y cerezas y arandanos como decoracion', 6000, 'Base de galleta de chocolate molida, mantequilla sin sal, leche condensada, crema de leche, queso crema, crema batida, helado de fresa, helado de vainilla, regentina, frutas para decorar', 'Heladeria', 'aaa.jpg', NULL),
(30, 'Torta Guiness', 'Pastel de chocolate elaborado con cerveza guiness, alta intensidad de sabor y humedad', 35000, 'Cerveza begra guiness, cocoa en polvo sin azucar, azucar blanca, azucar morena, sal, mantequilla, buttermilk, levadura quimica, huevos, queso crema, azucar glass, crema batida', 'Pasteleria', 'guiness.jpg', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `scdata`
--

CREATE TABLE `scdata` (
  `user_mail` varchar(50) NOT NULL,
  `user_product` int(11) NOT NULL,
  `sc_prodAmount` int(11) NOT NULL,
  `sc_prodOption` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `scdata`
--

INSERT INTO `scdata` (`user_mail`, `user_product`, `sc_prodAmount`, `sc_prodOption`) VALUES
('raviollinolli@gmail.com', 13, 2, 'Fresa'),
('raviollinolli@gmail.com', 8, 1, 'Alfajor de Red Velvet'),
('samimesa2000@gmail.com', 13, 1, 'Mora'),
('samimesa2000@gmail.com', 12, 1, 'Helado de vainilla');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `userdata`
--

CREATE TABLE `userdata` (
  `userid` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `pass` varchar(20) NOT NULL,
  `mail` varchar(50) NOT NULL,
  `question` varchar(50) NOT NULL,
  `qanswer` varchar(50) NOT NULL,
  `numtel` varchar(50) NOT NULL,
  `userRole` varchar(10) NOT NULL,
  `adminCode` int(11) NOT NULL,
  `pfp` varchar(300) NOT NULL DEFAULT 'default.png',
  `address` varchar(255) NOT NULL,
  `prefColor` varchar(255) NOT NULL DEFAULT 'default',
  `bio` varchar(255) DEFAULT NULL,
  `ordersCant` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `userdata`
--

INSERT INTO `userdata` (`userid`, `name`, `pass`, `mail`, `question`, `qanswer`, `numtel`, `userRole`, `adminCode`, `pfp`, `address`, `prefColor`, `bio`, `ordersCant`) VALUES
(1, 'Sara Martinez', 'admin', 'samimesa2000@gmail.com', '2 + 2 = 4?', 'si', '314 6928859', 'admin', 0, 'sharkie.png', 'Cra 83F #53A-58', 'dark', 'me gustan las de 6°', 0),
(2, 'Vicky', 'admin', 'raviollinolli@gmail.com', 'te gustan los tiburones?', 'mucho', '310490235', 'user', 0, 'tiburon.jpg', 'mi casa :3', 'cyan', 'me gustan las empanadas', 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indices de la tabla `productdata`
--
ALTER TABLE `productdata`
  ADD PRIMARY KEY (`product_id`);

--
-- Indices de la tabla `userdata`
--
ALTER TABLE `userdata`
  ADD PRIMARY KEY (`userid`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT de la tabla `productdata`
--
ALTER TABLE `productdata`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT de la tabla `userdata`
--
ALTER TABLE `userdata`
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
