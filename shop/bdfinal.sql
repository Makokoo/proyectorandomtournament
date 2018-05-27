-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         10.1.29-MariaDB - mariadb.org binary distribution
-- SO del servidor:              Win32
-- HeidiSQL Versión:             9.5.0.5196
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Volcando estructura para tabla proyectotienda.articulos
DROP TABLE IF EXISTS `articulos`;
CREATE TABLE IF NOT EXISTS `articulos` (
  `cod_articulo` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_articulo` varchar(50) COLLATE latin1_spanish_ci DEFAULT NULL,
  `descripcion_articulo` varchar(200) COLLATE latin1_spanish_ci DEFAULT NULL,
  `imagen` varchar(200) COLLATE latin1_spanish_ci DEFAULT NULL,
  `precio` double DEFAULT NULL,
  `categoria` varchar(50) COLLATE latin1_spanish_ci,
  `estado` varchar(50) COLLATE latin1_spanish_ci DEFAULT 'alta',
  PRIMARY KEY (`cod_articulo`),
  KEY `FK_articulos_categorias` (`categoria`),
  CONSTRAINT `FK_articulos_categorias` FOREIGN KEY (`categoria`) REFERENCES `categorias` (`categoria`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- Volcando datos para la tabla proyectotienda.articulos: ~18 rows (aproximadamente)
/*!40000 ALTER TABLE `articulos` DISABLE KEYS */;
REPLACE INTO `articulos` (`cod_articulo`, `nombre_articulo`, `descripcion_articulo`, `imagen`, `precio`, `categoria`, `estado`) VALUES
	(1, 'Razer BlackWidow', 'Teclado Mecanico', 'http://benchmarkreviews.com/wp-content/uploads/2015/10/Razer-BlackWidow-Ultimate-2016-Mechanical-Keyboard-Unveiled.png', 120, 'teclados', 'alta'),
	(2, 'Ozone Strike Pro', 'Teclado Mecanico Ozone', 'https://www.vsgamers.es/thumbnails/images/products/859/feature/122/es-teclados-gaming-gaming-mecanico-ozone-strike-pro-cherry-mx-red.jpg', 99.99, 'teclados', 'alta'),
	(3, 'Logitech Pro Gaming', 'Teclado Mecanico con Cherry Red', 'https://www.logitechg.com/assets/64244/13/g810-orion-spectrum-rgb-mechanical-keyboard.png', 60, 'teclados', 'alta'),
	(4, 'Logitech G35', 'Raton Logitech G35 para jugones', 'https://www.logitechg.com/assets/53016/logitech-gaming-mice-g300s.png', 50, 'ratones', 'alta'),
	(5, 'Krom Kahn', 'Raton Gaming 5000DPI', 'https://www.cyberpuerta.mx/img/product/XL/CP-LOGITECH-910-005100-3.jpg', 20, 'ratones', 'alta'),
	(6, 'WD Blue 1TB', 'Disco Duro Interno 1TB 5400rpm', 'https://image.darty.com/console_jeux/composant/disque_dur_interne/western_digital_mainstream_3_5_1to_sata_7200tr_m_s1309181390406A_210019112.jpg', 53.25, 'hdd', 'alta'),
	(7, 'SSD Samsung 120GB', 'Disco Duro Solido 120GB', 'https://lifeinformatica.com/wp-content/uploads/Life/SAMSUNG-MZ-75E250B_EU/imgs/MZ-75E250B_EU-01_300x300.jpg', 69.99, 'hdd', 'alta'),
	(8, 'SSD Samsung 250GB', 'Disco Duro Solido 250GB', 'https://lifeinformatica.com/wp-content/uploads/Life/SAMSUNG-MZ-75E250B_EU/imgs/MZ-75E250B_EU-01_300x300.jpg', 89.99, 'hdd', 'alta'),
	(9, 'SSD Samsung 2TB', 'Disco Duro Solido 2TB', 'https://lifeinformatica.com/wp-content/uploads/Life/SAMSUNG-MZ-75E250B_EU/imgs/MZ-75E250B_EU-01_300x300.jpg', 250, 'hdd', 'alta'),
	(10, 'MG MK4B', 'Teclado mecanico economico', 'https://images-na.ssl-images-amazon.com/images/I/71gEJwMFX7L._SX450_.jpg', 49.99, 'teclados', 'alta'),
	(11, 'Krom Key', 'Raton con teclas programables', 'https://images-na.ssl-images-amazon.com/images/I/61tW5ISSpFL._SX450_.jpg', 19.99, 'ratones', 'alta'),
	(12, 'Razer Abyssus', 'Raton Gaming de Razer', 'https://images-na.ssl-images-amazon.com/images/I/51iby-ZD0UL._SX450_.jpg', 49.99, 'ratones', 'alta'),
	(13, 'Raton Monstruoso', 'Raton Transformer', 'https://images-na.ssl-images-amazon.com/images/I/71frpl1EBnL._SX450_.jpg', 30.5, 'teclados', 'alta'),
	(14, 'prueba', 'prueba', 'http://www.imagen.com.mx/assets/img/imagen_share.png', 120, 'teclados', 'baja'),
	(15, 'i7-2600', 'Proc i7', 'https://www.mantis.es/skin/frontend/mantis/default/images/catalog/product/placeholder/cpu/Intel-Core-i7-Right-Side.png', 50, 'procesadores', 'alta'),
	(16, 'i5-4690', 'Procesador i5', 'https://dstatic.computeruniverse.net/images/500/90613456A9DB2E1816F2443487A40BF6.jpg', 40, 'procesadores', 'alta'),
	(17, 'R5 1600X', 'Ryzen 5 1600X', 'https://asset.msi.com/event/2017/promod/images/prize/2nd-AMD-Ryzen5-1600X-Processors.jpg', 250, 'procesadores', 'alta'),
	(18, 'R7 1800', 'Ryzen 7 1800', 'https://tekno.makobar.com/wp-content/uploads/sites/3/2018/02/11157-ryzen-7-pib-left-facing-1260x709.png', 325, 'procesadores', 'alta'),
	(19, 'M21 Samsung', 'monitor 21"', 'https://www.cyberpuerta.mx/img/product/XL/CP-SAMSUNG-LS19F355HNLXZX-5.jpg', 100, 'monitores', 'alta');
/*!40000 ALTER TABLE `articulos` ENABLE KEYS */;

-- Volcando estructura para tabla proyectotienda.categorias
DROP TABLE IF EXISTS `categorias`;
CREATE TABLE IF NOT EXISTS `categorias` (
  `id_categoria` int(11) NOT NULL AUTO_INCREMENT,
  `categoria` varchar(50) COLLATE latin1_spanish_ci NOT NULL,
  PRIMARY KEY (`id_categoria`),
  UNIQUE KEY `categoria` (`categoria`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- Volcando datos para la tabla proyectotienda.categorias: ~6 rows (aproximadamente)
/*!40000 ALTER TABLE `categorias` DISABLE KEYS */;
REPLACE INTO `categorias` (`id_categoria`, `categoria`) VALUES
	(3, 'hdd'),
	(5, 'monitores'),
	(4, 'procesadores'),
	(2, 'ratones'),
	(1, 'teclados');
/*!40000 ALTER TABLE `categorias` ENABLE KEYS */;

-- Volcando estructura para tabla proyectotienda.clientes
DROP TABLE IF EXISTS `clientes`;
CREATE TABLE IF NOT EXISTS `clientes` (
  `cod_cliente` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(50) COLLATE latin1_spanish_ci DEFAULT NULL,
  `nick` varchar(50) COLLATE latin1_spanish_ci NOT NULL,
  `pass` varchar(50) COLLATE latin1_spanish_ci NOT NULL,
  `estado` varchar(50) COLLATE latin1_spanish_ci DEFAULT 'alta',
  `permiso` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`cod_cliente`),
  UNIQUE KEY `nick` (`nick`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- Volcando datos para la tabla proyectotienda.clientes: ~7 rows (aproximadamente)
/*!40000 ALTER TABLE `clientes` DISABLE KEYS */;
REPLACE INTO `clientes` (`cod_cliente`, `Nombre`, `nick`, `pass`, `estado`, `permiso`) VALUES
	(1, 'Sergio', 'moly', 'moly', 'alta', 3),
	(2, 'paco', 'paco', 'paco', 'alta', 0),
	(3, 'pepe', 'pepe', 'pepe', 'alta', 1),
	(4, 'test', 'test', 'test', 'alta', 0),
	(5, 'check', 'check', 'check', 'alta', 0),
	(6, 'nuevo', 'nuevo', 'nuevo', 'alta', 0),
	(7, 'g', 'g', 'g', 'baja', 0);
/*!40000 ALTER TABLE `clientes` ENABLE KEYS */;

-- Volcando estructura para tabla proyectotienda.contacto
DROP TABLE IF EXISTS `contacto`;
CREATE TABLE IF NOT EXISTS `contacto` (
  `id_mensaje` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_usuario` varchar(50) COLLATE latin1_spanish_ci NOT NULL DEFAULT '0',
  `mensaje` text COLLATE latin1_spanish_ci NOT NULL,
  PRIMARY KEY (`id_mensaje`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- Volcando datos para la tabla proyectotienda.contacto: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `contacto` DISABLE KEYS */;
REPLACE INTO `contacto` (`id_mensaje`, `nombre_usuario`, `mensaje`) VALUES
	(1, 'Sergio', 'Hola, escribo para comentarles que tienen una tienda estupenda.');
/*!40000 ALTER TABLE `contacto` ENABLE KEYS */;

-- Volcando estructura para tabla proyectotienda.pedidos
DROP TABLE IF EXISTS `pedidos`;
CREATE TABLE IF NOT EXISTS `pedidos` (
  `cod_pedido` int(11) NOT NULL AUTO_INCREMENT,
  `cod_cliente` int(11) NOT NULL,
  `fecha` date DEFAULT NULL,
  `estado` varchar(50) COLLATE latin1_spanish_ci NOT NULL DEFAULT 'procesando',
  PRIMARY KEY (`cod_pedido`),
  KEY `cod_cliente` (`cod_cliente`),
  CONSTRAINT `cod_cliente` FOREIGN KEY (`cod_cliente`) REFERENCES `clientes` (`cod_cliente`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- Volcando estructura para tabla proyectotienda.lineas_pedidos
DROP TABLE IF EXISTS `lineas_pedidos`;
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

-- Volcando datos para la tabla proyectotienda.lineas_pedidos: ~12 rows (aproximadamente)
/*!40000 ALTER TABLE `lineas_pedidos` DISABLE KEYS */;
REPLACE INTO `lineas_pedidos` (`num_linea_pedido`, `cod_pedido`, `cod_articulo`, `cantidad`, `estado`) VALUES
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



-- Volcando datos para la tabla proyectotienda.pedidos: ~9 rows (aproximadamente)
/*!40000 ALTER TABLE `pedidos` DISABLE KEYS */;
REPLACE INTO `pedidos` (`cod_pedido`, `cod_cliente`, `fecha`, `estado`) VALUES
	(1, 1, '2018-01-25', 'procesado'),
	(2, 1, '2018-01-25', 'procesado'),
	(4, 1, '2018-02-22', 'procesado'),
	(5, 2, '2018-02-22', 'procesado'),
	(6, 2, '2018-02-22', 'procesado'),
	(7, 1, '2018-02-22', 'procesado'),
	(8, 6, '2018-02-25', 'procesado');
/*!40000 ALTER TABLE `pedidos` ENABLE KEYS */;

-- Volcando estructura para tabla proyectotienda.proveedores
DROP TABLE IF EXISTS `proveedores`;
CREATE TABLE IF NOT EXISTS `proveedores` (
  `cod_proveedor` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_proveedor` varchar(50) COLLATE latin1_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`cod_proveedor`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- Volcando datos para la tabla proyectotienda.proveedores: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `proveedores` DISABLE KEYS */;
/*!40000 ALTER TABLE `proveedores` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
