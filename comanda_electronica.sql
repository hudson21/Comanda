-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 26-01-2018 a las 21:04:04
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
(1, 'VINOS', 'vinos', '2018-01-26 15:07:03'),
(2, 'PLATILLOS', 'platillos', '2018-01-26 15:07:03'),
(3, 'POSTRES', 'postres', '2018-01-26 15:07:03'),
(4, 'ACCESORIOS', 'accesorios', '2018-01-26 15:07:03'),
(5, 'ROPA', 'ropa', '2018-01-26 15:07:03');

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
(1, 'Vinos de Cosecha 1883', 1, 'vinos-de-cosecha-1883', '2018-01-26 15:30:29'),
(2, 'Vinos de Cosecha 1700', 1, 'vinos-de-cosecha-1700', '2018-01-26 15:30:29'),
(3, 'Platillos de Carnes', 2, 'platillos-de-carnes', '2018-01-26 15:32:21'),
(4, 'Platillos de Pescado', 2, 'platillos-de-pescado', '2018-01-26 15:32:21'),
(5, 'Postres de la Mañana', 3, 'postres-de-la-mañana', '2018-01-26 15:33:38'),
(6, 'Postres de la Noche', 3, 'postres-de-la-noche', '2018-01-26 15:33:38'),
(7, 'Accesorios de Relojes', 4, 'accesorios-de-relojes', '2018-01-26 15:34:22'),
(8, 'Accesorios de zapatos', 4, 'accesorios-de-zapatos', '2018-01-26 15:34:22'),
(9, 'Ropa de Verano', 5, 'ropa-de-verano', '2018-01-26 15:35:08'),
(10, 'Ropa de Invierno', 5, 'ropa-de-invierno', '2018-01-26 15:35:08'),
(11, 'Vinos de Cosecha 1600', 1, 'vinos-de-cosecha-1600', '2018-01-26 15:41:38'),
(12, 'Vinos de Cosecha 1500', 1, 'vinos-de-cosecha-1500', '2018-01-26 15:41:50'),
(13, 'Carnes de Estilo Holanda', 2, 'carnes-de-estilo-holanda', '2018-01-26 15:42:43'),
(14, 'Carnes de Estilo Mexico', 2, 'carnes-de-estilo-mexico', '2018-01-26 15:42:43'),
(15, 'Platillos al Estilo Europeo', 2, 'platillos-al-estilo-europeo', '2018-01-26 15:45:00'),
(16, 'Platillos al Estilo Asiático', 2, 'platillos-al-estilo-asiatico', '2018-01-26 15:45:00'),
(17, 'Postres del Mediodía', 3, 'postres-de-mediodia', '2018-01-26 17:12:54');

--
-- Índices para tablas volcadas
--

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
-- Indices de la tabla `subcategorias`
--
ALTER TABLE `subcategorias`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `plantilla`
--
ALTER TABLE `plantilla`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `subcategorias`
--
ALTER TABLE `subcategorias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
