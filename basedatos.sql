-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         10.1.31-MariaDB - mariadb.org binary distribution
-- SO del servidor:              Win32
-- HeidiSQL Versión:             9.5.0.5278
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Volcando estructura de base de datos para random_tournament
DROP DATABASE IF EXISTS `random_tournament`;
CREATE DATABASE IF NOT EXISTS `random_tournament` /*!40100 DEFAULT CHARACTER SET latin1 COLLATE latin1_spanish_ci */;
USE `random_tournament`;

-- Volcando estructura para tabla random_tournament.articulos
CREATE TABLE IF NOT EXISTS `articulos` (
  `cod_articulo` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_articulo` varchar(50) COLLATE latin1_spanish_ci DEFAULT NULL,
  `descripcion_articulo` varchar(200) COLLATE latin1_spanish_ci DEFAULT NULL,
  `imagen` varchar(200) COLLATE latin1_spanish_ci DEFAULT NULL,
  `precio` double DEFAULT NULL,
  `categoria` varchar(50) COLLATE latin1_spanish_ci DEFAULT NULL,
  `estado` varchar(50) COLLATE latin1_spanish_ci DEFAULT 'alta',
  `stock` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`cod_articulo`),
  KEY `FK_articulos_categorias` (`categoria`),
  CONSTRAINT `FK_articulos_categorias` FOREIGN KEY (`categoria`) REFERENCES `categorias` (`categoria`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- Volcando datos para la tabla random_tournament.articulos: ~19 rows (aproximadamente)
DELETE FROM `articulos`;
/*!40000 ALTER TABLE `articulos` DISABLE KEYS */;
INSERT INTO `articulos` (`cod_articulo`, `nombre_articulo`, `descripcion_articulo`, `imagen`, `precio`, `categoria`, `estado`, `stock`) VALUES
	(1, 'Razer BlackWidow', 'Teclado Mecanico', 'http://benchmarkreviews.com/wp-content/uploads/2015/10/Razer-BlackWidow-Ultimate-2016-Mechanical-Keyboard-Unveiled.png', 120, 'teclados', 'alta', 0),
	(2, 'Ozone Strike Pro', 'Teclado Mecanico Ozone', 'https://www.vsgamers.es/thumbnails/images/products/859/feature/122/es-teclados-gaming-gaming-mecanico-ozone-strike-pro-cherry-mx-red.jpg', 99.99, 'teclados', 'alta', 0),
	(3, 'Logitech Pro Gaming', 'Teclado Mecanico con Cherry Red', 'https://www.logitechg.com/assets/64244/13/g810-orion-spectrum-rgb-mechanical-keyboard.png', 60, 'teclados', 'alta', 0),
	(4, 'Logitech G35', 'Raton Logitech G35 para jugones', 'https://www.logitechg.com/assets/53016/logitech-gaming-mice-g300s.png', 50, 'ratones', 'alta', 0),
	(5, 'Krom Kahn', 'Raton Gaming 5000DPI', 'https://www.cyberpuerta.mx/img/product/XL/CP-LOGITECH-910-005100-3.jpg', 20, 'ratones', 'alta', 0),
	(6, 'WD Blue 1TB', 'Disco Duro Interno 1TB 5400rpm', 'https://image.darty.com/console_jeux/composant/disque_dur_interne/western_digital_mainstream_3_5_1to_sata_7200tr_m_s1309181390406A_210019112.jpg', 53.25, 'hdd', 'alta', 0),
	(7, 'SSD Samsung 120GB', 'Disco Duro Solido 120GB', 'https://lifeinformatica.com/wp-content/uploads/Life/SAMSUNG-MZ-75E250B_EU/imgs/MZ-75E250B_EU-01_300x300.jpg', 69.99, 'hdd', 'alta', 0),
	(8, 'SSD Samsung 250GB', 'Disco Duro Solido 250GB', 'https://lifeinformatica.com/wp-content/uploads/Life/SAMSUNG-MZ-75E250B_EU/imgs/MZ-75E250B_EU-01_300x300.jpg', 89.99, 'hdd', 'alta', 0),
	(9, 'SSD Samsung 2TB', 'Disco Duro Solido 2TB', 'https://lifeinformatica.com/wp-content/uploads/Life/SAMSUNG-MZ-75E250B_EU/imgs/MZ-75E250B_EU-01_300x300.jpg', 250, 'hdd', 'alta', 0),
	(10, 'MG MK4B', 'Teclado mecanico economico', 'https://images-na.ssl-images-amazon.com/images/I/71gEJwMFX7L._SX450_.jpg', 49.99, 'teclados', 'alta', 0),
	(11, 'Krom Key', 'Raton con teclas programables', 'https://images-na.ssl-images-amazon.com/images/I/61tW5ISSpFL._SX450_.jpg', 19.99, 'ratones', 'alta', 0),
	(12, 'Razer Abyssus', 'Raton Gaming de Razer', 'https://images-na.ssl-images-amazon.com/images/I/51iby-ZD0UL._SX450_.jpg', 49.99, 'ratones', 'alta', 0),
	(13, 'Raton Monstruoso', 'Raton Transformer', 'https://images-na.ssl-images-amazon.com/images/I/71frpl1EBnL._SX450_.jpg', 30.5, 'teclados', 'alta', 0),
	(14, 'prueba', 'prueba', 'http://www.imagen.com.mx/assets/img/imagen_share.png', 120, 'teclados', 'baja', 0),
	(15, 'i7-2600', 'Proc i7', 'https://www.mantis.es/skin/frontend/mantis/default/images/catalog/product/placeholder/cpu/Intel-Core-i7-Right-Side.png', 50, 'procesadores', 'alta', 0),
	(16, 'i5-4690', 'Procesador i5', 'https://dstatic.computeruniverse.net/images/500/90613456A9DB2E1816F2443487A40BF6.jpg', 40, 'procesadores', 'alta', 0),
	(17, 'R5 1600X', 'Ryzen 5 1600X', 'https://asset.msi.com/event/2017/promod/images/prize/2nd-AMD-Ryzen5-1600X-Processors.jpg', 250, 'procesadores', 'alta', 0),
	(18, 'R7 1800', 'Ryzen 7 1800', 'https://tekno.makobar.com/wp-content/uploads/sites/3/2018/02/11157-ryzen-7-pib-left-facing-1260x709.png', 325, 'procesadores', 'alta', 0),
	(19, 'M21 Samsung', 'monitor 21"', 'https://www.cyberpuerta.mx/img/product/XL/CP-SAMSUNG-LS19F355HNLXZX-5.jpg', 100, 'monitores', 'alta', 0);
/*!40000 ALTER TABLE `articulos` ENABLE KEYS */;

-- Volcando estructura para tabla random_tournament.categorias
CREATE TABLE IF NOT EXISTS `categorias` (
  `id_categoria` int(11) NOT NULL AUTO_INCREMENT,
  `categoria` varchar(50) COLLATE latin1_spanish_ci NOT NULL,
  PRIMARY KEY (`id_categoria`),
  UNIQUE KEY `categoria` (`categoria`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- Volcando datos para la tabla random_tournament.categorias: ~5 rows (aproximadamente)
DELETE FROM `categorias`;
/*!40000 ALTER TABLE `categorias` DISABLE KEYS */;
INSERT INTO `categorias` (`id_categoria`, `categoria`) VALUES
	(3, 'hdd'),
	(5, 'monitores'),
	(4, 'procesadores'),
	(2, 'ratones'),
	(1, 'teclados');
/*!40000 ALTER TABLE `categorias` ENABLE KEYS */;

-- Volcando estructura para tabla random_tournament.categoria_foro
CREATE TABLE IF NOT EXISTS `categoria_foro` (
  `id_categoria` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_categoria` varchar(50) COLLATE latin1_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`id_categoria`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- Volcando datos para la tabla random_tournament.categoria_foro: ~2 rows (aproximadamente)
DELETE FROM `categoria_foro`;
/*!40000 ALTER TABLE `categoria_foro` DISABLE KEYS */;
INSERT INTO `categoria_foro` (`id_categoria`, `nombre_categoria`) VALUES
	(1, 'general'),
	(2, 'torneos');
/*!40000 ALTER TABLE `categoria_foro` ENABLE KEYS */;

-- Volcando estructura para tabla random_tournament.contacto
CREATE TABLE IF NOT EXISTS `contacto` (
  `id_mensaje` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_usuario` varchar(50) COLLATE latin1_spanish_ci NOT NULL DEFAULT '0',
  `mensaje` text COLLATE latin1_spanish_ci NOT NULL,
  `asunto` varchar(250) COLLATE latin1_spanish_ci NOT NULL,
  `mail` varchar(250) COLLATE latin1_spanish_ci NOT NULL,
  PRIMARY KEY (`id_mensaje`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- Volcando datos para la tabla random_tournament.contacto: ~3 rows (aproximadamente)
DELETE FROM `contacto`;
/*!40000 ALTER TABLE `contacto` DISABLE KEYS */;
INSERT INTO `contacto` (`id_mensaje`, `nombre_usuario`, `mensaje`, `asunto`, `mail`) VALUES
	(1, 'Sergio', 'Hola, escribo para comentarles que tienen una tienda estupenda.', 'Impresionante', ''),
	(2, 'prueba', '', 'Probandoooo', 'prueba@prueba.com'),
	(3, 'test', 'dasdasdad', 'testtts', 'test@test.es');
/*!40000 ALTER TABLE `contacto` ENABLE KEYS */;

-- Volcando estructura para tabla random_tournament.hilo
CREATE TABLE IF NOT EXISTS `hilo` (
  `id_hilo` int(11) NOT NULL AUTO_INCREMENT,
  `id_categoria` int(11) DEFAULT NULL,
  `autor` int(11) DEFAULT NULL,
  `titulo` varchar(50) COLLATE latin1_spanish_ci DEFAULT NULL,
  `mensaje` varchar(250) COLLATE latin1_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`id_hilo`),
  KEY `FK_hilo_categoria_foro` (`id_categoria`),
  KEY `FK_hilo_usuarios` (`autor`),
  CONSTRAINT `FK_hilo_categoria_foro` FOREIGN KEY (`id_categoria`) REFERENCES `categoria_foro` (`id_categoria`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `FK_hilo_usuarios` FOREIGN KEY (`autor`) REFERENCES `usuarios` (`id_usuario`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- Volcando datos para la tabla random_tournament.hilo: ~4 rows (aproximadamente)
DELETE FROM `hilo`;
/*!40000 ALTER TABLE `hilo` DISABLE KEYS */;
INSERT INTO `hilo` (`id_hilo`, `id_categoria`, `autor`, `titulo`, `mensaje`) VALUES
	(1, 1, 1, 'Hola!', '								Comenzamos el dia 12\r\n								'),
	(2, 2, 1, 'Torneo de bienvenida', 'El torneo de bienvenida ha abierto sus inscripciones. Apuntate!'),
	(6, 1, 2, 'Busco rival', 'Hola, se busca rival para derbi decente 								'),
	(14, 1, 1, 'test', 'test');
/*!40000 ALTER TABLE `hilo` ENABLE KEYS */;

-- Volcando estructura para tabla random_tournament.juegos
CREATE TABLE IF NOT EXISTS `juegos` (
  `id_juego` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) COLLATE latin1_spanish_ci NOT NULL,
  PRIMARY KEY (`id_juego`),
  UNIQUE KEY `nombre` (`nombre`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- Volcando datos para la tabla random_tournament.juegos: ~1 rows (aproximadamente)
DELETE FROM `juegos`;
/*!40000 ALTER TABLE `juegos` DISABLE KEYS */;
INSERT INTO `juegos` (`id_juego`, `nombre`) VALUES
	(1, 'Dragon Ball FighterZ');
/*!40000 ALTER TABLE `juegos` ENABLE KEYS */;

-- Volcando estructura para tabla random_tournament.lineas_pedidos
CREATE TABLE IF NOT EXISTS `lineas_pedidos` (
  `num_linea_pedido` int(11) NOT NULL,
  `cod_pedido` int(11) NOT NULL,
  `cod_articulo` int(11) DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `estado` varchar(50) COLLATE latin1_spanish_ci NOT NULL DEFAULT 'pedido',
  PRIMARY KEY (`num_linea_pedido`,`cod_pedido`),
  KEY `cod_pedido` (`cod_pedido`),
  KEY `cod_articulo` (`cod_articulo`),
  CONSTRAINT `cod_articulo` FOREIGN KEY (`cod_articulo`) REFERENCES `articulos` (`cod_articulo`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `cod_pedido` FOREIGN KEY (`cod_pedido`) REFERENCES `pedidos` (`cod_pedido`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- Volcando datos para la tabla random_tournament.lineas_pedidos: ~10 rows (aproximadamente)
DELETE FROM `lineas_pedidos`;
/*!40000 ALTER TABLE `lineas_pedidos` DISABLE KEYS */;
INSERT INTO `lineas_pedidos` (`num_linea_pedido`, `cod_pedido`, `cod_articulo`, `cantidad`, `estado`) VALUES
	(1, 1, 2, 1, 'pedido'),
	(1, 2, 3, 5, 'pedido'),
	(1, 4, 3, 1, 'pedido'),
	(1, 5, 5, 2, 'pedido'),
	(1, 6, 17, 2, 'pedido'),
	(1, 7, 18, 3, 'pedido'),
	(1, 8, 13, 5, 'pedido'),
	(2, 2, 4, 2, 'pedido'),
	(2, 6, 16, 4, 'pedido'),
	(2, 7, 4, 2, 'pedido');
/*!40000 ALTER TABLE `lineas_pedidos` ENABLE KEYS */;

-- Volcando estructura para tabla random_tournament.mensajes
CREATE TABLE IF NOT EXISTS `mensajes` (
  `id_mensaje` int(11) NOT NULL AUTO_INCREMENT,
  `id_hilo` int(11) DEFAULT NULL,
  `autor` int(11) DEFAULT NULL,
  `mensaje` text COLLATE latin1_spanish_ci,
  PRIMARY KEY (`id_mensaje`),
  KEY `FK_mensajes_hilo` (`id_hilo`),
  KEY `FK_mensajes_usuarios` (`autor`),
  CONSTRAINT `FK_mensajes_hilo` FOREIGN KEY (`id_hilo`) REFERENCES `hilo` (`id_hilo`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_mensajes_usuarios` FOREIGN KEY (`autor`) REFERENCES `usuarios` (`id_usuario`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- Volcando datos para la tabla random_tournament.mensajes: ~4 rows (aproximadamente)
DELETE FROM `mensajes`;
/*!40000 ALTER TABLE `mensajes` DISABLE KEYS */;
INSERT INTO `mensajes` (`id_mensaje`, `id_hilo`, `autor`, `mensaje`) VALUES
	(3, 6, 1, 'IMPRESIONANTE'),
	(4, 6, 9, 'ESETIOAHI'),
	(6, 1, 6, 'Hola, soy nuevo por aquÃ­, alguien me puede ayudar?'),
	(16, 1, 26, 'aaaaaaaaaaaaaasdsa dasdasdas');
/*!40000 ALTER TABLE `mensajes` ENABLE KEYS */;

-- Volcando estructura para tabla random_tournament.participantes
CREATE TABLE IF NOT EXISTS `participantes` (
  `id_usuario` int(11) DEFAULT NULL,
  `id_torneo` int(11) DEFAULT NULL,
  KEY `FK_participantes_usuarios` (`id_usuario`),
  KEY `FK_participantes_torneos` (`id_torneo`),
  CONSTRAINT `FK_participantes_torneos` FOREIGN KEY (`id_torneo`) REFERENCES `torneos` (`id_torneo`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_participantes_usuarios` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- Volcando datos para la tabla random_tournament.participantes: ~24 rows (aproximadamente)
DELETE FROM `participantes`;
/*!40000 ALTER TABLE `participantes` DISABLE KEYS */;
INSERT INTO `participantes` (`id_usuario`, `id_torneo`) VALUES
	(2, 6),
	(1, 6),
	(3, 6),
	(4, 6),
	(5, 6),
	(6, 6),
	(7, 6),
	(8, 6),
	(1, 1),
	(2, 1),
	(3, 1),
	(4, 1),
	(5, 1),
	(6, 1),
	(7, 1),
	(8, 1),
	(1, 7),
	(2, 7),
	(26, 7),
	(23, 7),
	(22, 7),
	(10, 7),
	(5, 7),
	(25, 7);
/*!40000 ALTER TABLE `participantes` ENABLE KEYS */;

-- Volcando estructura para tabla random_tournament.partidas
CREATE TABLE IF NOT EXISTS `partidas` (
  `id_partida` int(11) NOT NULL AUTO_INCREMENT,
  `id_torneo` int(11) NOT NULL DEFAULT '0',
  `local` int(11) NOT NULL DEFAULT '0',
  `visitante` int(11) NOT NULL DEFAULT '0',
  `estado` varchar(50) COLLATE latin1_spanish_ci NOT NULL DEFAULT 'espera',
  `resultado` varchar(50) COLLATE latin1_spanish_ci NOT NULL DEFAULT 'espera',
  `ronda` int(11) NOT NULL,
  `p_local` int(11) DEFAULT NULL,
  `p_visitante` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_partida`),
  KEY `FK_partidas_torneos` (`id_torneo`),
  KEY `FK_partidas_usuarios` (`local`),
  KEY `FK_partidas_usuarios_2` (`visitante`),
  KEY `FK_partidas_personajes` (`p_local`),
  KEY `FK_partidas_personajes_2` (`p_visitante`),
  CONSTRAINT `FK_partidas_personajes` FOREIGN KEY (`p_local`) REFERENCES `personajes` (`id_personaje`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `FK_partidas_personajes_2` FOREIGN KEY (`p_visitante`) REFERENCES `personajes` (`id_personaje`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `FK_partidas_torneos` FOREIGN KEY (`id_torneo`) REFERENCES `torneos` (`id_torneo`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_partidas_usuarios` FOREIGN KEY (`local`) REFERENCES `usuarios` (`id_usuario`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `FK_partidas_usuarios_2` FOREIGN KEY (`visitante`) REFERENCES `usuarios` (`id_usuario`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=112 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- Volcando datos para la tabla random_tournament.partidas: ~12 rows (aproximadamente)
DELETE FROM `partidas`;
/*!40000 ALTER TABLE `partidas` DISABLE KEYS */;
INSERT INTO `partidas` (`id_partida`, `id_torneo`, `local`, `visitante`, `estado`, `resultado`, `ronda`, `p_local`, `p_visitante`) VALUES
	(92, 1, 7, 3, 'espera', 'espera', 1, 2, 2),
	(93, 1, 2, 5, 'espera', 'espera', 1, 2, 2),
	(94, 1, 1, 6, 'espera', 'espera', 1, 1, 1),
	(95, 1, 8, 4, 'espera', 'espera', 1, 1, 1),
	(104, 7, 26, 2, 'espera', '1', 1, 1, 2),
	(105, 7, 10, 1, 'espera', '2', 1, 2, 1),
	(106, 7, 22, 23, 'espera', '1', 1, 1, 2),
	(107, 7, 5, 25, 'espera', '2', 1, 2, 1),
	(108, 6, 4, 5, 'espera', 'espera', 1, 2, 1),
	(109, 6, 6, 2, 'espera', 'espera', 1, 1, 1),
	(110, 6, 1, 7, 'espera', 'espera', 1, 1, 1),
	(111, 6, 8, 3, 'espera', 'espera', 1, 1, 1);
/*!40000 ALTER TABLE `partidas` ENABLE KEYS */;

-- Volcando estructura para tabla random_tournament.pedidos
CREATE TABLE IF NOT EXISTS `pedidos` (
  `cod_pedido` int(11) NOT NULL AUTO_INCREMENT,
  `cod_cliente` int(11) NOT NULL,
  `fecha` date DEFAULT NULL,
  `estado` varchar(50) COLLATE latin1_spanish_ci NOT NULL DEFAULT 'procesando',
  PRIMARY KEY (`cod_pedido`),
  KEY `cod_cliente` (`cod_cliente`),
  CONSTRAINT `cod_cliente` FOREIGN KEY (`cod_cliente`) REFERENCES `usuarios` (`id_usuario`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- Volcando datos para la tabla random_tournament.pedidos: ~7 rows (aproximadamente)
DELETE FROM `pedidos`;
/*!40000 ALTER TABLE `pedidos` DISABLE KEYS */;
INSERT INTO `pedidos` (`cod_pedido`, `cod_cliente`, `fecha`, `estado`) VALUES
	(1, 1, '2018-01-25', 'procesado'),
	(2, 1, '2018-01-25', 'procesado'),
	(4, 1, '2018-02-22', 'procesado'),
	(5, 2, '2018-02-22', 'procesado'),
	(6, 2, '2018-02-22', 'procesado'),
	(7, 1, '2018-02-22', 'procesado'),
	(8, 6, '2018-02-25', 'procesado');
/*!40000 ALTER TABLE `pedidos` ENABLE KEYS */;

-- Volcando estructura para tabla random_tournament.personajes
CREATE TABLE IF NOT EXISTS `personajes` (
  `id_personaje` int(11) NOT NULL AUTO_INCREMENT,
  `id_juego` int(11) NOT NULL DEFAULT '0',
  `nombre` varchar(50) COLLATE latin1_spanish_ci NOT NULL,
  `descripcion` text COLLATE latin1_spanish_ci NOT NULL,
  `imagen` text COLLATE latin1_spanish_ci NOT NULL,
  PRIMARY KEY (`id_personaje`),
  KEY `FK_personajes_juegos` (`id_juego`),
  CONSTRAINT `FK_personajes_juegos` FOREIGN KEY (`id_juego`) REFERENCES `juegos` (`id_juego`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- Volcando datos para la tabla random_tournament.personajes: ~2 rows (aproximadamente)
DELETE FROM `personajes`;
/*!40000 ALTER TABLE `personajes` DISABLE KEYS */;
INSERT INTO `personajes` (`id_personaje`, `id_juego`, `nombre`, `descripcion`, `imagen`) VALUES
	(1, 1, 'Goku', '', ''),
	(2, 1, 'Vegetta', '', '');
/*!40000 ALTER TABLE `personajes` ENABLE KEYS */;

-- Volcando estructura para tabla random_tournament.proveedores
CREATE TABLE IF NOT EXISTS `proveedores` (
  `cod_proveedor` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_proveedor` varchar(50) COLLATE latin1_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`cod_proveedor`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- Volcando datos para la tabla random_tournament.proveedores: ~0 rows (aproximadamente)
DELETE FROM `proveedores`;
/*!40000 ALTER TABLE `proveedores` DISABLE KEYS */;
/*!40000 ALTER TABLE `proveedores` ENABLE KEYS */;

-- Volcando estructura para tabla random_tournament.torneos
CREATE TABLE IF NOT EXISTS `torneos` (
  `id_torneo` int(11) NOT NULL AUTO_INCREMENT,
  `id_juego` int(11) NOT NULL DEFAULT '0',
  `estado` varchar(50) COLLATE latin1_spanish_ci NOT NULL DEFAULT 'abierto',
  `max_participantes` int(11) NOT NULL,
  `fec_inicio` date DEFAULT NULL,
  `fec_final` date NOT NULL,
  `ganador` int(11) DEFAULT NULL,
  `nombre_torneo` varchar(50) COLLATE latin1_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`id_torneo`),
  KEY `FK_torneos_juegos` (`id_juego`),
  KEY `FK_torneos_usuarios` (`ganador`),
  CONSTRAINT `FK_torneos_juegos` FOREIGN KEY (`id_juego`) REFERENCES `juegos` (`id_juego`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `FK_torneos_usuarios` FOREIGN KEY (`ganador`) REFERENCES `usuarios` (`id_usuario`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- Volcando datos para la tabla random_tournament.torneos: ~3 rows (aproximadamente)
DELETE FROM `torneos`;
/*!40000 ALTER TABLE `torneos` DISABLE KEYS */;
INSERT INTO `torneos` (`id_torneo`, `id_juego`, `estado`, `max_participantes`, `fec_inicio`, `fec_final`, `ganador`, `nombre_torneo`) VALUES
	(1, 1, 'iniciado', 8, '2018-04-20', '0000-00-00', NULL, 'prueba'),
	(6, 1, 'iniciado', 8, NULL, '0000-00-00', NULL, 'apuntarse'),
	(7, 1, 'iniciado', 8, '2018-06-12', '0000-00-00', NULL, 'Torneo de Inauguracion');
/*!40000 ALTER TABLE `torneos` ENABLE KEYS */;

-- Volcando estructura para tabla random_tournament.usuarios
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) COLLATE latin1_spanish_ci NOT NULL,
  `mail` varchar(50) COLLATE latin1_spanish_ci NOT NULL,
  `password` varchar(50) COLLATE latin1_spanish_ci NOT NULL,
  `permiso` varchar(50) COLLATE latin1_spanish_ci NOT NULL DEFAULT '0',
  `puntuacion` int(11) NOT NULL DEFAULT '0',
  `avatar` varchar(50) COLLATE latin1_spanish_ci NOT NULL DEFAULT '0',
  `estado` varchar(50) COLLATE latin1_spanish_ci DEFAULT 'alta',
  PRIMARY KEY (`id_usuario`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `mail` (`mail`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- Volcando datos para la tabla random_tournament.usuarios: ~15 rows (aproximadamente)
DELETE FROM `usuarios`;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` (`id_usuario`, `username`, `mail`, `password`, `permiso`, `puntuacion`, `avatar`, `estado`) VALUES
	(1, 'admin', 'admin@admin.es', '21232f297a57a5a743894a0e4a801fc3', '2', 9, '1', 'alta'),
	(2, 'ylom', 'molylvp@gmail.com', 'fb00059f0695a4360e7614590dc09570', '1', 3, '0', 'alta'),
	(3, 'usuario3', 'usuario3@usuario.es', '5a54c609c08a0ab3f7f8eef1365bfda6', '0', 0, '0', 'alta'),
	(4, 'usuario4', 'usuario4@usuario.es', '0ddd0fbf933b170eb6d90987a67d0a5d', '0', 0, '0', 'alta'),
	(5, 'usuario5', 'usuario5@usuario.es', '0b65933df3421cf1bdf4ff082ffc8901', '0', 0, '0', 'alta'),
	(6, 'usuario6', 'usuario6@usuario.es', '101617c6d22ee89e6326d01a7d7c38da', '0', 0, '0', 'alta'),
	(7, 'usuario7', 'usuario7@usuario.es', '6151cd58191039c28cdf392bea7e26b2', '0', 0, '0', 'alta'),
	(8, 'usuario8', 'usuario8@usuario.es', 'e1ac088e844a98ea0fd604ebb336ca86', '0', 0, '0', 'alta'),
	(9, 'ppolp', 'ppolp@ppolp.com', 'a7d269bdf864979ea03793a2bc303c23', '0', 0, '0', 'alta'),
	(10, 'Artherius', 'alvarogonzalezmira@gmail.com', 'd69e6d6798baff9b1789d24602338082', '0', 0, '0', 'alta'),
	(21, 'test', 'test@test.es', '098f6bcd4621d373cade4e832627b4f6', '0', 0, '0', 'alta'),
	(22, 'sergio', 'sergio@sergio.es', '3bffa4ebdf4874e506c2b12405796aa5', '0', 0, '0', 'alta'),
	(23, 'amador', 'amador@amador.es', '299ad925b432e99fbc250cf7fde69c51', '0', 0, '0', 'alta'),
	(25, 'probando', 'probando@probando.es', 'd852f92d887c3788efb8c08c38788969', '0', 0, '0', 'alta'),
	(26, 'javiasesino90', 'javiasesino90@hotmail.es', '202cb962ac59075b964b07152d234b70', '0', 0, '0', 'alta');
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
