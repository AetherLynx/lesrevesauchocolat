-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 20-05-2024 a las 01:51:40
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
CREATE DATABASE IF NOT EXISTS `lrac_bd` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `lrac_bd`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notifs`
--

CREATE TABLE `notifs` (
  `notif_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `notif_type` int(11) NOT NULL,
  `notif_link` varchar(256) NOT NULL,
  `notif_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  `order_product_options` varchar(9999) DEFAULT 'NULL',
  `order_product_amount` varchar(255) DEFAULT 'NULL',
  `order_total` int(11) NOT NULL,
  `final_state` int(11) NOT NULL DEFAULT 0,
  `order_dreason` varchar(255) NOT NULL,
  `order_preferences` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `orders`
--

INSERT INTO `orders` (`order_id`, `order_user`, `order_username`, `order_date`, `order_address`, `order_state`, `order_product_id`, `order_product_options`, `order_product_amount`, `order_total`, `final_state`, `order_dreason`, `order_preferences`) VALUES
(47, '1', 'Samuel', '2024-03-21', 'Cra 83F #53A-58', 'Confirmado como recibido', '12', 'Helado de vainilla', '1', 4500, 1, 'no me gusto su torta', ''),
(54, '1', 'Samuel', '2024-03-29', 'Cra 83F #53A-58', 'Confirmado como recibido', '6', '', '2', 10000, 1, 'no me gusto su torta', ''),
(76, '2', 'Paulina Figueroa', '2024-05-17', 'mi casa :3', 'Confirmado como recibido', '28, 46, 30, 7, 104', ', Chocolate, , Con relleno de crema, Tamaño Original', '1, 1, 1, 1, 1', 158000, 1, '', 'Excluír cafeína');

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
(1, 'sundae palo de ricooo (bajenle el precio)', 15, 13, '2024-03-26', 'viewproduct'),
(2, 'que torta tan peye', 33, 37, '2024-03-28', 'viewproduct'),
(2, 'q rico :)', 40, 44, '2024-04-01', 'viewproduct'),
(1, 'test', 42, 1, '2024-04-27', 'threadpost'),
(2, 'alo', 43, 1, '2024-04-27', 'threadpost'),
(10, 'Es verdad, el sabor del croissant es muy delicioso, definitivamente lo recomiendo', 48, 7, '2024-05-02', 'threadpost'),
(11, 'Y el envio tambien fue rapido :)', 50, 13, '2024-05-02', 'threadpost'),
(2, 'Tendremos en cuenta tu recomendacion para la futura elaboracion de productos! Muchas gracias', 52, 15, '2024-05-02', 'threadpost'),
(2, 'Nos alegra mucho oir eso :)', 53, 13, '2024-05-02', 'threadpost'),
(1, 'La malteda de chocolate es la mejor! La recomiendo bastante :)', 54, 79, '2024-05-05', 'viewproduct'),
(2, 'Sii!, tiene un sabor muy característico :)', 71, 7, '2024-05-06', 'threadpost'),
(1, 'sads', 80, 1, '2024-05-19', 'userprofile');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productdata`
--

CREATE TABLE `productdata` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(40) NOT NULL,
  `product_desc` varchar(999) NOT NULL,
  `product_uniprice` int(20) NOT NULL,
  `product_ingredients` varchar(999) NOT NULL,
  `product_category` varchar(50) NOT NULL,
  `product_image` varchar(999) NOT NULL,
  `product_options` varchar(999) DEFAULT NULL,
  `product_creator` varchar(20) NOT NULL,
  `cakecode` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `productdata`
--

INSERT INTO `productdata` (`product_id`, `product_name`, `product_desc`, `product_uniprice`, `product_ingredients`, `product_category`, `product_image`, `product_options`, `product_creator`, `cakecode`) VALUES
(6, 'Panqueso Costeño', 'Un pan ampliamente relleno de queso, ideal para un buen desayuno o un cafe en la tarde!', 5000, 'Harina, huevo, queso doble crema, leche, agua, polvo para hornear, mantequilla.', 'Panaderia', 'pr6.jpg', '', '', '0'),
(7, 'Eclair', 'Eclair con cobertura de chocolate, relleno de crema, ideal para acompañar con café o una bebida de tu antojo :)', 5000, 'Agua, leche, azucar, harina de trigo, huevos, chocolate derretido, crema chantillí, extracto de vainilla.', 'Pasteleria', 'eclair.png', 'Con relleno de crema, Sin relleno de crema, Con crema + azucar reducida, Sin crema + azucar reducida', '', '0'),
(8, 'Alfajor', 'Un alfajor que se desintegra con cada mordida! Muy dulce y rico.', 1200, 'Harina de trigo, fécula de maíz, mantequilla, leche condensada, huevos, sabor a elección.', 'Pasteleria', 'pr8.jpg', 'Relleno de arequipe, Relleno de chocolate, Alfajor de Red Velvet, Alfajor de chocolate', '', '0'),
(9, 'Postre Posset', 'Un delicioso posset del sabor que elijas, 1 porción de apróx. 50g.', 2000, 'Crema, azucar, nata, ralladura de limon o de naranja, jugo de limon o de naranja, leche condensada y gelatina sin sabor.', 'Pasteleria', 'pr9.jpg', 'Posset de limón, Posset de naranja', '', '0'),
(10, 'Muffin de Chocolate', 'Un muffin esponjado hecho a base de chocolate y milo, bastante dulce.', 2000, 'Cocoa en Polvo, Harina, huevos, leche entera, Polvo para hornear, huevos y mantequilla.', 'Pasteleria', 'pr10.png', 'Muffin con Milo, Muffin solo con chocolate, Azúcar reducida', '', '0'),
(11, 'Cheesecake', 'Cheesecake con aderezo dulce de frutos rojos, contiene una rica y crocante base de galleta. (1 porci', 2400, 'Leche condensada, Queso Crema, Salsa de frutos rojos, galletas.', 'Pasteleria', 'cheesecake.png', 'Frutos Rojos, Maracuyá, Oreo, Mango', '', '0'),
(12, 'Brownie con Helado', 'Brownie esponjoso con una bola de helado adicionada!', 4500, 'Bola de helado, brownie de chocolate: Harina, chocolate en polvo, huevos, agua y leche.', 'Heladeria', 'pr12.jpg', 'Helado de chocolate, Helado de vainilla, Helado de arequipe, Helado de chicle, Helado de mandarina', '', '0'),
(13, 'Sundae', 'Un delicioso y cremoso Sundae, que puedes pedir con la salsa que gustes!', 2500, 'Leche, leche condensada, crema, salsa o syrup a elección.', 'Heladeria', 'pr13.jpg', 'Solo (sin crema), Chocolate, Fresa, Mora, Arequipe', '', '0'),
(21, 'Gelato', 'Un postre helado italiano antecesor al helado! Es bastante dulce, menos\r\ngrasoso y contiene mas leche', 4000, '3,35% de leche, azúcar, con el ingrediente saborizante que tu elijas :)', 'Heladeria', 'pr21.png', NULL, '', '0'),
(27, 'Beignet', 'Buñuelo de origen estadounidense frito en aceite caliente, espolvoreado con azucar glass y perfecto para ser acompañado con la bebida de tu seleccion', 2000, 'leche entera, harina de fuerza, levadura, azucar, bicabornato de sodio, azucar glass, sal. Freido en aceite para su coccion', 'Panaderia', 'pr27.jpg', NULL, '', '0'),
(28, 'Chifon de limon y arandanos', 'Pastel chifon de sabor limon, relleno con crema de limon, frosting de arandanos, y decorado con flores comestibles. (1unid equivale a un pastel completo)', 45000, 'Huevos, Azucar, leche entera, relladura de limon, jugo de limon, mantequilla sin sal, sal kosher, polvo para hornear, frosting de queso crema de arandanos (decoracion y relleno), crema de limon', 'Pasteleria', 'chiffon.jpg', NULL, '', '0'),
(29, 'Pastel de helado', 'Pastel de helado con base de galleta, helado de vainilla y rosa, crema batida, y cerezas y arandanos como decoracion', 6000, 'Base de galleta de chocolate molida, mantequilla sin sal, leche condensada, crema de leche, queso crema, crema batida, helado de fresa, helado de vainilla, regentina, frutas para decorar', 'Heladeria', 'pr29.jpg', NULL, '', '0'),
(30, 'Torta Guiness', 'Pastel de chocolate elaborado con cerveza guiness, alta intensidad de sabor y humedad', 35000, 'Cerveza begra guiness, cocoa en polvo sin azucar, azucar blanca, azucar morena, sal, mantequilla, buttermilk, levadura quimica, huevos, queso crema, azucar glass, crema batida', 'Pasteleria', 'guiness.jpg', '', '', '0'),
(42, 'Pastel de crepes', 'Pastel hecho con capas individuales de crepes separadas por un relleno de crema chantilly entre cada una de ellas', 13000, 'Huevos, harina, azucar, sal, leche, escencia de vainilla, crema de chantilly', 'Pasteleria', 'pastel de crepes.png', 'Chocolate, Vainilla', '', '0'),
(43, 'Napolitanas', 'Pequeños pedazos de masa de hojaldre rellenos con una deliciosa ganache de chocolate', 5500, 'Harina, agua, mantequilla, sal, azucar', 'Panaderia', 'pr43.jpg', 'Chocolate', '', '0'),
(44, 'Crookie', 'Crookie, una novedosa combinacion entre galletas de chispas de chocolate y croissant', 6500, 'Azucar blanca, Azucar morena, Sal, Mantequilla, Huevos, Chispas de choccholate', 'Panaderia', 'pr44.jpg', '', '', '0'),
(46, 'Macaron', 'Macarones franceses de varios sabores, perfecto para acompañar con una bebida', 6000, 'Harina de almendras, leche, huevos, saborizante, esencias', 'Pasteleria', 'pr46.jpg', 'Chocolate, Vainilla, Fresa', '', '0'),
(48, 'Mochi de helado', 'Mochi relleno con el sabor de helado seleccionado, perfecto para los dias de frio', 2400, 'Harina de arroz glutinoso, agua, azucar, fecula de maiz, helado segun la seleccion', 'Heladeria', 'pr48.jpg', 'Fresa, Vainilla, Limon, Chocolate', '', '0'),
(49, 'Empanadas Argentinas Dulces', 'Empanadas horneadas rellenas por un delicioso relleno de guayaba y queso', 4500, 'Aceite de Oliva, Margarina, Harina, Maiz, Azucar, Pimienta negra, Agua, Queso Mozarella, Salsa de dulce de guayaba', 'Panaderia', 'pr49.jpg', '', '', '0'),
(50, 'Croissant', 'Delicioso Croissant frances perfecto para acompañar tu café del desayuno.', 5000, 'Harina de trigo, mantequilla, agua, azúcar, harina de trigo, levadura, huevo, sal, ', 'Panaderia', 'pr50.jpg', '', '', '0'),
(51, 'New York Roll', 'Tambien conocido como croissant circular, el famoso newyork roll junta la masa clasica del croissant tradicional con un delicioso relleno de ganache chocolate.', 5500, 'Harina de trigo, mantequilla, agua, azúcar, gluten de trigo, levadura, huevo, sal, chocolate semiamargo 60%, aceite de coco', 'Panaderia', 'pr51.jpg', '', '', '0'),
(52, 'Rolls de Canela', 'Deliciosos rolls de masa suave y  esponjosas rellenos de azucar morena y cubiertos con un dulce y sabroso glaseado.', 5500, 'Leche, Levadura, Harina, Mantequilla, Azucar blanca, Sal, Azucar moreno, Canela', 'Pasteleria', 'pr52.jpg', '', '', '0'),
(53, 'Kouign Amann', 'Proviniente de Francia, el Kouign Amann es una tarta de mantequilla que combina perfectamente el sabor salado de la mantequilla y lo contrasta con notas dulces de azucar.', 5000, 'harina de trigo, huevo, mantequilla y azúcar.', 'Panaderia', 'pr53.jpg', '', '', '0'),
(54, 'Chouquettes', 'Pequeñas bombas de pasta Choux rellena con crema y decoradas con perlas de azucar en la parte exterior, forma parte de uno de los desayunos mas comunes y emblematicos en todo Francia', 2000, 'Leche, Mantequilla sin sal, Harina, Huevos, Escencia de Vainilla, Azucar blanca, Sal marina, Perlas de azucar', 'Panaderia', 'pr54.jpg', '', '', '0'),
(61, 'Parfait', 'Postre de origen frances cuyo nombre de traduce a literalmente perfecto, excelente para comer solo o acompañado por cualquier bebida de preferencia', 7500, 'Yogurt griego, Fresas frescas, Chispas de chocolate, Cocoa, Harina, huevos, mantequilla, leche, edulcorante (Azucar)', 'Pasteleria', 'pr61.jpg', '', '', '0'),
(62, 'Sandwich de helado', 'Un sandwich de helado un poco diferente a lo convencional, lleva galletas con chispas de chocolate en vez de galleta de vainilla, y en el centro posee un delicioso relleno de helado de vainilla', 5000, 'Chispas de chocolate semiamargo, harina, huevos, leche, azucar, escencia de vainilla, crema de leche, leche condensada', 'Heladeria', 'pr62.jpg', '', '', '0'),
(63, 'Tiramisu', 'Agua, Espresso, Azucar, Huevos, Azucar, Queso crema, escencia de vainilla, Crema para batir, Leche, Cocoa', 8000, 'Leche, relleno de queso crema, escencia de vainilla, cafe, cocoa, crema de leche', 'Pasteleria', 'pr63.jpg', '', '', '0'),
(77, 'Cupcakes x6', '6 unidades de cupcakes del mismo sabor, decorados con frosting de vainilla', 24000, 'Huevos, Leche, Harina, Polvo para hornear, Azucar, Escencia de vainilla, Aceite, saborizantes naturales (Naranja o Fresa), Cocoa (En caso de ser de chocolate)', 'Pasteleria', 'pr77.jpg', 'Chocolate, Vainilla, Naranja, Fresa', '', '0'),
(78, 'Cupcake ', 'Un cupcake individual del sabor de tu preferencia decorado con betún de vainilla', 4000, 'Huevos, Leche, Harina, Polvo para hornear, Azúcar, Esencia de vainilla, Aceite, saborizantes naturales (Naranja o Fresa), Cocoa (En caso de ser de chocolate)', 'Pasteleria', 'pr78.jpg', 'Chocolate, Vainilla, Fresa, Naranja', '', '0'),
(79, 'Malteada', 'Deliciosa malteada de helado con galletas de eleccion (Waffer o Oreo), salsa de chocolate y crema batida', 12000, 'Leche, Sabor del helado de la eleccion, Crema batida, salsa de chocolate, Wafer o galletas de decoracion', 'Heladeria', 'pr79.jpg', 'Chocolate, Fresa, Caramelo, Vainilla, Mandarina', '', '0'),
(80, 'Pan de masa madre ', 'Un delicioso pan de masa madre, muy crujiente, perfecto para acompañar con queso o un delicioso chocolate caliente', 10000, 'Levadura, Harina, Agua, Mantequilla, Sal de mar', 'Panaderia', 'pr80.jpg', '', '', '0'),
(81, 'Cafe Helado', 'Un delicioso Cafe helado cargado, con espuma de cafe arriba (12 onz)', 12000, 'Cafe expreso, agua, hielo, azucar (o edulcorante), Canela', 'Heladeria', 'pr81.jpg', '', '', '0'),
(82, 'Macciato de caramelo frio', 'Macciato de caramelo frio de 12 onzas', 9000, 'Leche evaporada, Esencia de vainilla, Salsa de Caramelo, Edulcorante, Espresso', 'Heladeria', 'pr82.png', '', '', '0'),
(83, 'Iced americano', 'Café americano cargado con hielos, perfecto para tomar en conjunto con cualquier producto de nuestra panaderia de tu eleccion', 3000, 'Cafe arabica molido, agua, hielo, endulzante ', 'Heladeria', 'pr83.jpg', '', '', '0'),
(84, 'Iced latte', 'Delicioso cafe latte espumoso con hielos, perfecto para aquellos amantes del cafe con leche  que desean refrescarse en días de calor', 5000, 'Leche o substituo vegano, café, hielo, endulzante de eleccion', 'Heladeria', 'pr84.png', '', '', '0'),
(85, 'Granizado de cafe', 'Café Granizado', 5500, 'Crema batida, salsa chocolate de eleccion, leche (o subtituo de leche), Café', 'Heladeria', 'pr85.png', '', '', '0'),
(86, 'Pan de leche Japones', 'El pan de leche japones o Shokupan japones posee una textura suave y esponjosa, perfecto para comer solo o acompañado de nuestros bebidas.', 5000, 'Leche, Harina de fuerza, Mantequilla/Margarina, Huevos, Azucar, Sal, Huevos', 'Panaderia', 'pr86.jpg', '', '', '0'),
(87, 'Focaccia', 'Deliciosa Focaccia con vegetales y aceite de oliva', 14000, 'Harina de fuerza, mantequilla, agua, sal marina, azucar, levadura, cebolla, tomate cherry, albahaca', 'Panaderia', 'pr87.jpeg', '', '', '0'),
(88, 'Donas', 'Esponjosas y suaves donas, perfectas para tu desayuno o para acompañar tu café de la tarde.', 2500, 'Azucar, Harina de trigo, Sal, Levadura seca, Vainilla, Huevos, escencia de vainilla', 'Pasteleria', 'pr88.png', '', '', '0'),
(89, 'Tartaleta', 'Deliciosas tartaletas rellenas de crema pastelera, decoradas con frutas cortadas por encima.', 2500, 'Agua, Harina, Margarina, Azucar, Sal, Huevos, escencia de vainilla, Maicena, Leche, limon, kiwi, mango y fresa', 'Pasteleria', 'pr89.jpg', 'Limon, Vainilla', '', '0'),
(102, 'Torta barata', 'Pastel de 1/4 de libra, Bizcocho con sabor a Zanahoria, Sin relleno, Sin cobertura, Sin bordeado.', 22000, '<b>Tamaño: </b>Molde de pastel de 1/4 de libra.<br><b>Sabor del bizcocho: </b>Zanahorias ralladas, Harina de trigo, Azúcar, Mantequilla, Huevos, Levadura en polvo, Canela en polvo.<br><b>Relleno: </b>Sin relleno.<br><b>Cobertura: </b>Sin cobertura.<br><b>Bordeado: </b>Sin bordeado.', 'Creacion', 'customcake_id102.png', 'Tamaño Original, Tamaño S (1/4 de libra), Tamaño M (1/2 de libra), Tamaño L (1 libra)', '1', '0101000000'),
(103, 'pastel de fresa', 'Pastel de 1/4 de libra, Bizcocho con sabor a Fresa, Fresas con crema, Cubierto de Chocolate Blanco, Bordeado de Fresas.', 39000, '<b>Tamaño: </b>Molde de pastel de 1/4 de libra.<br><b>Sabor del bizcocho: </b>Harina de trigo, azúcar, mantequilla, huevos, levadura en polvo, fresas trituradas, colorante rosado.<br><b>Relleno: </b>Fresas, crema de leche, leche condensada, azucar.<br><b>Cobertura: </b>Chocolate blanco, mantequilla, crema de leche.<br><b>Bordeado: </b>Fresas frescas.', 'Creacion', 'customcake_id103.png', 'Tamaño Original, Tamaño S (1/4 de libra), Tamaño M (1/2 de libra), Tamaño L (1 libra)', '1', '0107130306'),
(104, 'Arandanos', 'Pastel de 1/2 de libra, Bizcocho con sabor a Mora, Con relleno dulce de Crema de arándanos, Bordeado de media cubierta, Bordeado de Frutos del bosque y Chocolate.', 59000, '<b>Tamaño: </b>Molde de pastel de 1/2 de libra.<br><b>Sabor del bizcocho: </b>Harina de trigo, azúcar, mantequilla, huevos, levadura en polvo, moras trituradas..<br><b>Relleno: </b>Arándanos, crema de leche, azúcar.<br><b>Cobertura: </b>Leche, crema de leche, esencia de vainilla.<br><b>Bordeado: </b>Mora, fresa, chocolate negro.', 'Creacion', 'customcake_id104.png', 'Tamaño Original, Tamaño S (1/4 de libra), Tamaño M (1/2 de libra), Tamaño L (1 libra)', '1', '0208050608'),
(105, 'Triple chocolate', 'Pastel de 1/2 de libra, Bizcocho con sabor a Chocolate, Con relleno dulce de Ganache de chocolate, Cubierto de Chocolate Negro, Bordeado de Pepitas de Chocolate.', 49000, '<b>Tamaño: </b>Molde de pastel de 1/2 de libra.<br><b>Sabor del bizcocho: </b>Harina de trigo, Azucar, Cacao en polvo, Mantequilla, Huevos, levadura en polvo, esencia de vainilla.<br><b>Relleno: </b>Chocolate negro, leche condensada, crema de leche, azúcar.<br><b>Cobertura: </b>Chocolate negro, mantequilla, crema de leche.<br><b>Bordeado: </b>Pepitas de chocolate.', 'Creacion', 'customcake_id105.png', 'Tamaño Original, Tamaño S (1/4 de libra), Tamaño M (1/2 de libra), Tamaño L (1 libra)', '1', '0202060204'),
(106, 'Pastel de vainilla', 'Pastel de 1/2 de libra, Bizcocho con sabor a Vainilla, Con relleno dulce de Crema chantilly, Bordeado de media cubierta, Sin bordeado.', 47000, '<b>Tamaño: </b>Molde de pastel de 1/2 de libra.<br><b>Sabor del bizcocho: </b>Harina de trigo, azucar, mantequilla, huevos, levadura en polvo, esencia de vainilla.<br><b>Relleno: </b>Crema de leche, azúcar glass, esencia de vainilla.<br><b>Cobertura: </b>Leche, crema de leche, esencia de vainilla.<br><b>Bordeado: </b>Sin bordeado.', 'Creacion', 'customcake_id106.png', 'Tamaño Original, Tamaño S (1/4 de libra), Tamaño M (1/2 de libra), Tamaño L (1 libra)', '2', '0204040600'),
(107, 'Frutos rojos y fresa', 'Pastel de 1/2 de libra, Bizcocho con sabor a Fresa, Con relleno de Mermelada de Frutos rojos, Bordeado de media cubierta, Sin bordeado.', 46000, '<b>Tamaño: </b>Molde de pastel de 1/2 de libra.<br><b>Sabor del bizcocho: </b>Harina de trigo, azúcar, mantequilla, huevos, levadura en polvo, fresas trituradas, colorante rosado.<br><b>Relleno: </b>Mermelada de frutos rojos.<br><b>Cobertura: </b>Leche, crema de leche, esencia de vainilla.<br><b>Bordeado: </b>Sin bordeado.', 'Creacion', 'customcake_id107.png', 'Tamaño Original, Tamaño S (1/4 de libra), Tamaño M (1/2 de libra), Tamaño L (1 libra)', '2', '0207010006'),
(113, 'asdasdsa', 'Pastel de 1 libra, Bizcocho con sabor a Mora, Fresas con crema, Cubierto de Crema Chantilly, Bordeado de Frutos del bosque y Chocolate.', 76000, '<b>Tamaño: </b>Molde de pastel de 1 libra.<br><b>Sabor del bizcocho: </b>Harina de trigo, azúcar, mantequilla, huevos, levadura en polvo, moras trituradas..<br><b>Relleno: </b>Fresas, crema de leche, leche condensada, azucar.<br><b>Cobertura: </b>Crema de leche, azúcar glass, esencia de vainilla.<br><b>Bordeado: </b>Mora, fresa, chocolate negro.', 'Creacion', 'customcake_id113.png', 'Tamaño Original, Tamaño S (1/4 de libra), Tamaño M (1/2 de libra), Tamaño L (1 libra)', '1', '0308130408'),
(115, 'testingRadnom2', 'Pastel de 1/2 de libra, Bizcocho con sabor a Chocolate, Con relleno dulce de Ganache de chocolate, Cubierto de Chocolate Blanco, Bordeado de Pepitas de Chocolate.', 49000, '<b>Tamaño: </b>Molde de pastel de 1/2 de libra.<br><b>Sabor del bizcocho: </b>Harina de trigo, Azucar, Cacao en polvo, Mantequilla, Huevos, levadura en polvo, esencia de vainilla.<br><b>Relleno: </b>Chocolate negro, leche condensada, crema de leche, azúcar.<br><b>Cobertura: </b>Chocolate blanco, mantequilla, crema de leche.<br><b>Bordeado: </b>Pepitas de chocolate.', 'Creacion', 'customcake_id115.png', 'Tamaño Original, Tamaño S (1/4 de libra), Tamaño M (1/2 de libra), Tamaño L (1 libra)', '11', '0202060304'),
(116, 'testingRandom3', 'Pastel de 1/2 de libra, Bizcocho con sabor a Fresa, Con relleno de Mermelada de Naranja, Cubierto de Fondant Blanco, Bordeado de Oreos.', 47000, '<b>Tamaño: </b>Molde de pastel de 1/2 de libra.<br><b>Sabor del bizcocho: </b>Harina de trigo, azúcar, mantequilla, huevos, levadura en polvo, fresas trituradas, colorante rosado.<br><b>Relleno: </b>Mermelada de naranja.<br><b>Cobertura: </b>Fondant blanco (azúcar glass y agua).<br><b>Bordeado: </b>Oreos normales.', 'Creacion', 'customcake_id116.png', 'Tamaño Original, Tamaño S (1/4 de libra), Tamaño M (1/2 de libra), Tamaño L (1 libra)', '11', '0207120502'),
(117, 'asdsadad', 'Pastel de 1/2 de libra, Bizcocho con sabor a Fresa, Con relleno de Mermelada de Naranja, Cubierto de Fondant Blanco, Bordeado de M&Ms.', 48000, '<b>Tamaño: </b>Molde de pastel de 1/2 de libra.<br><b>Sabor del bizcocho: </b>Harina de trigo, azúcar, mantequilla, huevos, levadura en polvo, fresas trituradas, colorante rosado.<br><b>Relleno: </b>Mermelada de naranja.<br><b>Cobertura: </b>Fondant blanco (azúcar glass y agua).<br><b>Bordeado: </b>M&Ms de chocolate.', 'Creacion', 'customcake_id117.png', NULL, '11', '0207120503');

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

--
-- Volcado de datos para la tabla `scdata`
--

INSERT INTO `scdata` (`user_id`, `user_product`, `sc_prodAmount`, `sc_prodOption`) VALUES
(2, 28, 1, ''),
(2, 46, 1, 'Chocolate'),
(2, 30, 1, ''),
(2, 7, 1, 'Con relleno de crema'),
(9, 47, 1, ''),
(1, 13, 1, 'Chocolate'),
(1, 62, 4, ''),
(13, 11, 10, 'Frutos Rojos'),
(1, 82, 2, ''),
(1, 79, 1, 'Fresa'),
(1, 8, 1, 'Relleno de chocolate'),
(1, 8, 1, 'Relleno de arequipe'),
(2, 104, 1, 'Tamaño Original'),
(11, 117, 10, '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `threads`
--

CREATE TABLE `threads` (
  `thread_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `thread_header` varchar(50) NOT NULL,
  `thread_content` varchar(256) NOT NULL,
  `thread_link` varchar(256) NOT NULL,
  `thread_link_type` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `threads`
--

INSERT INTO `threads` (`thread_id`, `user_id`, `thread_header`, `thread_content`, `thread_link`, `thread_link_type`) VALUES
(7, 1, 'me gusta el croissant', 'me gusta el croissant porque sabe bien bueno', '50', 0),
(9, 2, 'deberian meter mas productos de heladeria', 'el catalogo de la heladeria esta bien peyeee es el que tiene menos productos, metanle mas :(', '', 69),
(12, 11, 'Crookies', 'Me alegra que tengan productos innovadores como el Crookie, que vi que se volvio muy viral en instagram, y me alegra mucho que lo tengan aqui. El domicilio, precio y sabor son un 10/10', '44', 0),
(13, 11, 'Deliciosos pasteles', 'Pedi el Chiffon de limon y arandanos para el aniversario de relacion mio y de mi pareja, a los dos nos encanto :D', '28', 0),
(15, 13, 'Deberian añadir mas sabores de cheesecake', 'Seria bueno tener mas sabores de cheesecake, como cheesecake de mora', '11', 0);

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
  `address` varchar(100) NOT NULL,
  `prefColor` varchar(255) NOT NULL DEFAULT 'default',
  `bio` varchar(150) DEFAULT NULL,
  `ordersCant` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `userdata`
--

INSERT INTO `userdata` (`userid`, `name`, `pass`, `mail`, `question`, `qanswer`, `numtel`, `userRole`, `adminCode`, `pfp`, `address`, `prefColor`, `bio`, `ordersCant`) VALUES
(1, 'Samuel Martinez', 'admin', 'samimesa2000@gmail.com', '2 + 2 = 4?', 'si', '3146928859', 'admin', 0, 'user1.gif', 'Cra 83F #53A-58', 'chocodark', 'el programador de les reves au chocolat :3', 22),
(2, 'Paulina Figueroa', 'admin', 'raviollinolli@gmail.com', 'te gustan los tiburones?', 'mucho', '310490235', 'admin', 0, 'user2.png', 'mi casa :3', 'cyan', 'el diseñador y asistente de les reves au chocolat :3', 6),
(3, 'Jonathan Cortés', '_1432352_Jd', 'jonathancortestm143@gmail.com', 'Item favorito del isaac', 'C Section', '3177045333', 'user', 0, 'user3.PNG', 'Calle 72', 'cyan', 'programador de cataLOG :)', 2),
(9, 'Andres Camacho', '123', 'andrescamachito@gmail.com', 'le gusta enseñar informatica?', 'si', '23762836284', 'user', 0, 'user9.png', 'Cra. 50 #10 12', 'cyan', 'El profesor andres camacho del sena', 1),
(10, 'Wendy', '1', 'wendyjahavasquez@gmail.com', 'zilla es negra?', 'mas o menos', '3188568767', 'user', 0, 'user10.png', 'Cra 1H #59 198', 'dark', NULL, 0),
(11, 'Victor Figueroa', 'admin', 'inkchetaw@gmail.com', 'te gusta el chocolate?', 'si', '31093812', 'user', 0, 'user11.png', 'Cra. 54 #1 A60', 'orange', 'Mi nombre es Victor, y me gusta mucho el pan (y los gatos)', 0),
(13, 'parra073', '1', 'gamesps4yt@gmail.com', 'eres papi?', 'si', '3205341265', 'user', 0, 'default.png', 'cra1a11', 'default', NULL, 0),
(14, 'xaimerball', '1', 'xaimerball@xaimerball.com', 'usted vende libros', 'si', '602715896', 'user', 0, 'user14.png', 'Ciudad jardin - Las vegas de Comfandi', 'red', 'La mejor opcion en cuanto a bibliotecas virtuales', 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `notifs`
--
ALTER TABLE `notifs`
  ADD PRIMARY KEY (`notif_id`);

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
-- Indices de la tabla `threads`
--
ALTER TABLE `threads`
  ADD PRIMARY KEY (`thread_id`);

--
-- Indices de la tabla `userdata`
--
ALTER TABLE `userdata`
  ADD PRIMARY KEY (`userid`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `notifs`
--
ALTER TABLE `notifs`
  MODIFY `notif_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT de la tabla `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT de la tabla `posts`
--
ALTER TABLE `posts`
  MODIFY `postid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT de la tabla `productdata`
--
ALTER TABLE `productdata`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=118;

--
-- AUTO_INCREMENT de la tabla `threads`
--
ALTER TABLE `threads`
  MODIFY `thread_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de la tabla `userdata`
--
ALTER TABLE `userdata`
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
