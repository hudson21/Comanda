-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 29-01-2018 a las 19:03:22
-- Versión del servidor: 10.1.30-MariaDB
-- Versión de PHP: 7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `comanda_electronica`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `barsol`
--

CREATE TABLE `barsol` (
  `no_mesero` int(11) NOT NULL,
  `no_palapa` int(11) NOT NULL,
  `no_habitacion` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id` int(11) NOT NULL,
  `categoria` text COLLATE utf8_spanish_ci NOT NULL,
  `ruta` text COLLATE utf8_spanish_ci NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id`, `categoria`, `ruta`, `fecha`) VALUES
(1, 'RON', 'ron', '2018-01-29 14:59:25'),
(2, 'VODKA', 'vodka', '2018-01-29 14:59:25'),
(3, 'TEQUILA', 'tequila', '2018-01-29 14:59:25'),
(4, 'GINEBRA', 'ginebra', '2018-01-29 14:59:25'),
(5, 'APERITIVOS Y DIGESTIVOS', 'aperitivos-digestivos', '2018-01-29 15:02:40'),
(6, 'CERVEZAS', 'cervezas', '2018-01-29 15:02:06'),
(7, 'VINOS', 'vinos', '2018-01-29 15:02:06'),
(8, 'WHISKIS', 'whiskis', '2018-01-29 15:02:06'),
(9, 'REFRESCOS, JUGOS Y OTROS', 'refrecos-jugos-y-otros', '2018-01-29 15:27:03');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `plantilla`
--

CREATE TABLE `plantilla` (
  `id` int(11) NOT NULL,
  `barraSuperior` text COLLATE utf8_spanish_ci NOT NULL,
  `textoSuperior` text COLLATE utf8_spanish_ci NOT NULL,
  `colorFondo` text COLLATE utf8_spanish_ci NOT NULL,
  `colorTexto` text COLLATE utf8_spanish_ci NOT NULL,
  `logo` text COLLATE utf8_spanish_ci NOT NULL,
  `icono` text COLLATE utf8_spanish_ci NOT NULL,
  `redesSociales` text COLLATE utf8_spanish_ci NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `plantilla`
--

INSERT INTO `plantilla` (`id`, `barraSuperior`, `textoSuperior`, `colorFondo`, `colorTexto`, `logo`, `icono`, `redesSociales`, `fecha`) VALUES
(1, '#000000', '#ffffff', '#C1CA2C', '#ffffff', 'vistas/img/plantilla/logo.jpg', 'vistas/img/plantilla/icono.png', '[\r\n\r\n	{\r\n		\"red\": \"fa-facebook\",\r\n		\"estilo\": \"facebookBlanco\",\r\n		\"url\": \"http://facebook.com/\"\r\n	},\r\n\r\n	{\r\n		\"red\": \"fa-youtube\",\r\n		\"estilo\": \"youtubeBlanco\",\r\n		\"url\": \"http://youtube.com\"\r\n	},\r\n\r\n	{\r\n		\"red\": \"fa-twitter\",\r\n		\"estilo\": \"twitterBlanco\",\r\n		\"url\": \"http://twitter.com/\"\r\n	},\r\n\r\n	{\r\n		\"red\": \"fa-google-plus\",\r\n		\"estilo\": \"googleBlanco\",\r\n		\"url\": \"http://google.com/\"\r\n	},\r\n\r\n	{\r\n		\"red\": \"fa-instagram\",\r\n		\"estilo\": \"instagramBlanco\",\r\n		\"url\": \"http://instagram.com/\"\r\n	}\r\n]', '2018-01-26 14:22:19');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(11) NOT NULL,
  `nombre_producto` text COLLATE utf8_spanish_ci NOT NULL,
  `id_subcategoria` int(11) NOT NULL,
  `ruta` text COLLATE utf8_spanish_ci NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `nombre_producto`, `id_subcategoria`, `ruta`, `fecha`) VALUES
(1, 'LIMÓN', 1, 'limon', '2018-01-29 17:40:40'),
(2, 'FRESA', 1, 'fresa', '2018-01-29 17:40:40'),
(3, 'MANGO', 1, 'mango', '2018-01-29 17:44:34');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `subcategorias`
--

CREATE TABLE `subcategorias` (
  `id` int(11) NOT NULL,
  `subcategoria` text COLLATE utf8_spanish_ci NOT NULL,
  `id_categoria` int(11) NOT NULL,
  `ruta` text COLLATE utf8_spanish_ci NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `subcategorias`
--

INSERT INTO `subcategorias` (`id`, `subcategoria`, `id_categoria`, `ruta`, `fecha`) VALUES
(1, 'DAIQUIRÍS', 1, 'daiquiris', '2018-01-29 15:07:15'),
(2, 'MOJITOS', 1, 'mojitos', '2018-01-29 15:09:41'),
(3, 'MARCA', 1, 'marca', '2018-01-29 15:09:41'),
(4, 'CÓCTEL', 2, 'coctel', '2018-01-29 15:11:13'),
(5, 'FROZZEN', 2, 'frozzen', '2018-01-29 15:11:13'),
(6, 'MARCA', 2, 'marca', '2018-01-29 15:11:13'),
(7, 'CÓCTEL', 3, 'coctel', '2018-01-29 15:13:41'),
(8, 'MARGARITAS', 3, 'margaritas', '2018-01-29 15:13:41'),
(9, 'MARCA', 3, 'marca', '2018-01-29 15:13:41'),
(10, 'CÓCTEL', 4, 'coctel', '2018-01-29 15:14:58'),
(11, 'MARCA', 4, 'marca', '2018-01-29 15:14:58'),
(12, 'APERITIVOS', 5, 'aperitivos', '2018-01-29 15:18:50'),
(13, 'DIGESTIVOS', 5, 'digestivos', '2018-01-29 15:18:50'),
(14, 'CÓCTEL', 6, 'coctel', '2018-01-29 15:20:28'),
(15, 'XX LAGER', 6, 'xx-lager', '2018-01-29 15:20:28'),
(16, 'XX AMBAR', 6, 'xx-ambar', '2018-01-29 15:20:28'),
(17, 'SOL CERO', 6, 'sol-cero', '2018-01-29 15:20:28'),
(18, 'TINTOS', 7, 'tintos', '2018-01-29 15:23:30'),
(19, 'BLANCOS', 7, 'blancos', '2018-01-29 15:23:05'),
(20, 'ESPUMOSO', 7, 'espumoso', '2018-01-29 15:23:05'),
(21, 'ROSADO', 7, 'rosado', '2018-01-29 15:24:16'),
(22, 'CÓCTEL', 7, 'coctel', '2018-01-29 15:24:16'),
(23, 'CÓCTEL', 8, 'coctel', '2018-01-29 15:25:24'),
(24, 'MARCA', 8, 'marca', '2018-01-29 15:25:24'),
(25, 'REFRESCOS', 9, 'refrescos', '2018-01-29 15:28:35'),
(26, 'JUGOS', 9, 'jugos', '2018-01-29 15:28:35'),
(27, 'OTROS', 9, 'otros', '2018-01-29 15:31:08');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `barsol`
--
ALTER TABLE `barsol`
  ADD PRIMARY KEY (`no_mesero`);

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `plantilla`
--
ALTER TABLE `plantilla`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_subcategoria` (`id_subcategoria`);

--
-- Indices de la tabla `subcategorias`
--
ALTER TABLE `subcategorias`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD UNIQUE KEY `id_categorias` (`id`),
  ADD KEY `id_categoria` (`id_categoria`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `barsol`
--
ALTER TABLE `barsol`
  MODIFY `no_mesero` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `plantilla`
--
ALTER TABLE `plantilla`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `subcategorias`
--
ALTER TABLE `subcategorias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `productos_ibfk_1` FOREIGN KEY (`id_subcategoria`) REFERENCES `subcategorias` (`id`);

--
-- Filtros para la tabla `subcategorias`
--
ALTER TABLE `subcategorias`
  ADD CONSTRAINT `subcategorias_ibfk_1` FOREIGN KEY (`id_categoria`) REFERENCES `categorias` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
