-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 29-03-2024 a las 01:37:20
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

--
-- Volcado de datos para la tabla `orders`
--

INSERT INTO `orders` (`order_id`, `order_user`, `order_username`, `order_date`, `order_address`, `order_state`, `order_product_id`, `order_product_options`, `order_product_amount`, `order_total`, `final_state`, `order_dreason`) VALUES
(47, '1', 'Samuel', '2024-03-21', 'Cra 83F #53A-58', 'Confirmado como recibido', '12', 'Helado de vainilla', '1', 4500, 1, ''),
(49, '2', 'Vicky', '2024-03-21', 'mi casa :3', 'Pedido enviado', '13, 8', 'Fresa, Alfajor de Red Velvet', '2, 1', 6200, 0, ''),
(52, '1', 'Samuel', '2024-03-27', 'Cra 83F #53A-58', 'Pedido enviado', '9, 9', 'Posset de limón, Posset de naranja, Solo (sin crema)', '1, 1, 1', 4000, 0, '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `posts`
--

CREATE TABLE `posts` (
  `userid` int(11) NOT NULL,
  `content` varchar(999) NOT NULL,
  `postid` int(11) NOT NULL,
  `postwhere` int(11) NOT NULL,
  `postdate` date NOT NULL,
  `postcategory` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `posts`
--

INSERT INTO `posts` (`userid`, `content`, `postid`, `postwhere`, `postdate`, `postcategory`) VALUES
(1, 'palo de caro', 11, 7, '2024-03-26', 'viewproduct'),
(1, 'que recocha', 12, 4, '2024-03-26', 'userprofile'),
(1, 'mano soy ese', 13, 1, '2024-03-26', 'userprofile'),
(1, 'sundae palo de ricooo (bajenle el precio)', 15, 13, '2024-03-26', 'viewproduct'),
(1, 'torta tan mela mano', 32, 38, '2024-03-28', 'viewproduct');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productdata`
--

CREATE TABLE `productdata` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(50) NOT NULL,
  `product_desc` varchar(999) NOT NULL,
  `product_uniprice` int(20) NOT NULL,
  `product_ingredients` varchar(999) NOT NULL,
  `product_category` varchar(50) NOT NULL,
  `product_image` varchar(999) NOT NULL,
  `product_options` varchar(999) DEFAULT NULL,
  `product_creator` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `productdata`
--

INSERT INTO `productdata` (`product_id`, `product_name`, `product_desc`, `product_uniprice`, `product_ingredients`, `product_category`, `product_image`, `product_options`, `product_creator`) VALUES
(6, 'Panqueso Costeño', 'Un pan ampliamente relleno de queso, ideal para un buen desayuno o un cafe en la tarde!', 5000, 'Harina, huevo, queso doble crema, leche, agua, polvo para hornear, mantequilla.', 'Panaderia', '1.jpg', NULL, ''),
(7, 'Eclair', 'Eclair con cobertura de chocolate, relleno de crema, ideal para acompañar con café o una bebida de tu antojo :)', 5000, 'Agua, leche, azucar, harina de trigo, huevos, chocolate derretido, crema chantillí, extracto de vainilla.', 'Panaderia', '3.jpg', 'Con relleno de crema, Sin relleno de crema', ''),
(8, 'Alfajor', 'Un alfajor que se desintegra con cada mordida! Muy dulce y rico.', 1200, 'Harina de trigo, fécula de maíz, mantequilla, leche condensada, huevos, sabor a elección.', 'Pasteleria', '4.jpg', 'Relleno de arequipe, Relleno de chocolate, Alfajor de Red Velvet, Alfajor de chocolate', ''),
(9, 'Postre Posset', 'Un delicioso posset del sabor que elijas, 1 porción de apróx. 50g.', 2000, 'Crema, azucar, nata, ralladura de limon o de naranja, jugo de limon o de naranja, leche condensada y gelatina sin sabor.', 'Pasteleria', 'posset.jpg', 'Posset de limón, Posset de naranja', ''),
(10, 'Muffin de Chocolate', 'Un muffin esponjado hecho a base de chocolate y milo, bastante dulce.', 2000, 'Cocoa en Polvo, Harina, huevos, leche entera, Polvo para hornear, huevos y mantequilla.', 'Pasteleria', 'muffin.png', 'Con milo, Sin milo. Solo chocolate', ''),
(11, 'Cheesecake', 'Cheesecake con aderezo dulce de frutos rojos, contiene una rica y crocante base de galleta. (1 porci', 2400, 'Leche condensada, Queso Crema, Salsa de frutos rojos, galletas.', 'Pasteleria', 'cheesecake.jpg', 'Frutos Rojos, Maracuyá, Oreo, Mango', ''),
(12, 'Brownie con Helado', 'Brownie esponjoso con una bola de helado adicionada!', 4500, 'Bola de helado, brownie de chocolate: Harina, chocolate en polvo, huevos, agua y leche.', 'Heladeria', 'brownieconhelado.jpg', 'Helado de chocolate, Helado de vainilla, Helado de arequipe', ''),
(13, 'Sundae', 'Un delicioso y cremoso Sundae, que puedes pedir con la salsa que gustes!', 2500, 'Leche, leche condensada, crema, salsa o syrup a elección.', 'Heladeria', 'sundae.jpg', 'Solo (sin crema), Chocolate, Fresa, Mora, Arequipe', ''),
(21, 'Gelato', 'Un postre helado italiano antecesor al helado! Es bastante dulce, menos\r\ngrasoso y contiene mas leche', 4000, '3,35% de leche, azúcar, con el ingrediente saborizante que tu elijas :)', 'Heladeria', 'gelatto.png', NULL, ''),
(27, 'Beignet', 'Buñuelo de origen estadounidense frito en aceite caliente, espolvoreado con azucar glass y perfecto para ser acompañado con la bebida de tu seleccion', 2000, 'leche entera, harina de fuerza, levadura, azucar, bicabornato de sodio, azucar glass, sal. Freido en aceite para su coccion', 'Panaderia', 'beignet.jpg', NULL, ''),
(28, 'Chifon de limon y arandanos', 'Pastel chifon de sabor limon, relleno con crema de limon, frosting de arandanos, y decorado con flores comestibles. (1unid equivale a un pastel completo)', 45000, 'Huevos, Azucar, leche entera, relladura de limon, jugo de limon, mantequilla sin sal, sal kosher, polvo para hornear, frosting de queso crema de arandanos (decoracion y relleno), crema de limon', 'Pasteleria', 'falopa.jpg', NULL, ''),
(29, 'Pastel de helado', 'Pastel de helado con base de galleta, helado de vainilla y rosa, crema batida, y cerezas y arandanos como decoracion', 6000, 'Base de galleta de chocolate molida, mantequilla sin sal, leche condensada, crema de leche, queso crema, crema batida, helado de fresa, helado de vainilla, regentina, frutas para decorar', 'Heladeria', 'aaa.jpg', NULL, ''),
(30, 'Torta Guiness', 'Pastel de chocolate elaborado con cerveza guiness, alta intensidad de sabor y humedad', 35000, 'Cerveza begra guiness, cocoa en polvo sin azucar, azucar blanca, azucar morena, sal, mantequilla, buttermilk, levadura quimica, huevos, queso crema, azucar glass, crema batida', 'Pasteleria', 'guiness.jpg', NULL, ''),
(37, 'Naranja dulzón', 'Pastel de 1 libra, Bizcocho con sabor a Naranja con semillas de amapola, Con relleno dulce de Crema de chocolate, Sin cobertura, Bordeado de Crema Chantilly.', 60000, '<b>Tamaño: </b>Molde de pastel de 1/4 de libra.<br><b>Sabor del bizcocho: </b>Harina de trigo, azúcar, zumo de naranja, mantequilla, huevos, levadura en polvo, semillas de amapola, ralladura de naranja.<br><b>Relleno: </b>chocolate negro, leche, azúcar.<br><b>Cobertura: </b>Ninguna.<br><b>Bordeado: </b>Crema chantilly.', 'Creacion', 'customcake_id37.png', NULL, '1'),
(38, 'torta melosaaaa', 'Pastel de 1/4 de libra, Bizcocho con sabor a Chocolate, Con relleno de Mermelada de Fresa, Cubierto de Chocolate Blanco, Bordeado de Oreos.', 32000, '<b>Tamaño: </b>Molde de pastel de 1/4 de libra.<br><b>Sabor del bizcocho: </b>Harina de trigo, Azucar, Cacao en polvo, Mantequilla, Huevos, levadura en polvo, esencia de vainilla.<br><b>Relleno: </b>mermelada de fresa.<br><b>Cobertura: </b>chocolate blanco, mantequilla, crema de leche.<br><b>Bordeado: </b>Oreos normales.', 'Creacion', 'customcake_id38.png', NULL, '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `scdata`
--

CREATE TABLE `scdata` (
  `user_id` int(11) NOT NULL,
  `user_product` int(11) NOT NULL,
  `sc_prodAmount` int(11) NOT NULL,
  `sc_prodOption` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(1, 'Samuel', 'admin', 'samimesa2000@gmail.com', '2 + 2 = 4?', 'si', '314 6928859', 'admin', 0, 'user1.gif', 'Cra 83F #53A-58', 'lily', 'jaja biografia vamoss', 9),
(2, 'Vicky', 'admin', 'raviollinolli@gmail.com', 'te gustan los tiburones?', 'mucho', '310490235', 'admin', 0, 'user2.jpg', 'mi casa :3', 'cyan', 'tengo un gato llamado poto :)', 0),
(3, 'El teorias', '_1432352_Jd', 'jonathancortestm143@gmail.com', 'Item favorito del isaac', 'C Section', '3177045333', 'user', 0, 'user3.PNG', 'Calle 72', 'cyan', 'Muerte a las traumaditas', 0),
(4, 'que recocha', 'salchipapa', 'querecocha@gmail.com', 'que recocha?', 'que recocha', '3154790827', 'user', 0, 'user4.jpg', 'que recocha ', 'lime', 'juan cucknizo', 0),
(5, 'juanito123', 'salchipapa', 'juanito123@gmail.com', 'quien es carlos?', 'el del sena', '273307042', 'user', 0, 'default.png', 'comfandi', 'dark', 'me gusta la salchipapa', 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indices de la tabla `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`postid`);

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
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT de la tabla `posts`
--
ALTER TABLE `posts`
  MODIFY `postid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT de la tabla `productdata`
--
ALTER TABLE `productdata`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT de la tabla `userdata`
--
ALTER TABLE `userdata`
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
