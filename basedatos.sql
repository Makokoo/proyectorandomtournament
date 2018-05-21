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


-- Volcando estructura de base de datos para random_tournament
DROP DATABASE IF EXISTS `random_tournament`;
CREATE DATABASE IF NOT EXISTS `random_tournament` /*!40100 DEFAULT CHARACTER SET latin1 COLLATE latin1_spanish_ci */;
USE `random_tournament`;

-- Volcando estructura para tabla random_tournament.juegos
CREATE TABLE IF NOT EXISTS `juegos` (
  `id_juego` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) COLLATE latin1_spanish_ci NOT NULL,
  PRIMARY KEY (`id_juego`),
  UNIQUE KEY `nombre` (`nombre`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- Volcando datos para la tabla random_tournament.juegos: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `juegos` DISABLE KEYS */;
INSERT INTO `juegos` (`id_juego`, `nombre`) VALUES
	(1, 'Dragon Ball FighterZ');
/*!40000 ALTER TABLE `juegos` ENABLE KEYS */;

-- Volcando estructura para tabla random_tournament.partidas
CREATE TABLE IF NOT EXISTS `partidas` (
  `id_partida` int(11) NOT NULL AUTO_INCREMENT,
  `id_torneo` int(11) NOT NULL DEFAULT '0',
  `local` int(11) NOT NULL DEFAULT '0',
  `visitante` int(11) NOT NULL DEFAULT '0',
  `estado` varchar(50) COLLATE latin1_spanish_ci NOT NULL DEFAULT 'espera',
  `resultado` varchar(50) COLLATE latin1_spanish_ci NOT NULL DEFAULT 'espera',
  `ronda` int(11) NOT NULL,
  PRIMARY KEY (`id_partida`),
  KEY `FK_partidas_torneos` (`id_torneo`),
  KEY `FK_partidas_usuarios` (`local`),
  KEY `FK_partidas_usuarios_2` (`visitante`),
  CONSTRAINT `FK_partidas_torneos` FOREIGN KEY (`id_torneo`) REFERENCES `torneos` (`id_torneo`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_partidas_usuarios` FOREIGN KEY (`local`) REFERENCES `usuarios` (`id_usuario`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `FK_partidas_usuarios_2` FOREIGN KEY (`visitante`) REFERENCES `usuarios` (`id_usuario`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- Volcando datos para la tabla random_tournament.partidas: ~7 rows (aproximadamente)
/*!40000 ALTER TABLE `partidas` DISABLE KEYS */;
INSERT INTO `partidas` (`id_partida`, `id_torneo`, `local`, `visitante`, `estado`, `resultado`, `ronda`) VALUES
	(1, 1, 1, 2, 'espera', '1', 1),
	(2, 1, 3, 4, 'espera', '1', 1),
	(6, 1, 5, 6, 'espera', '2', 1),
	(7, 1, 7, 8, 'espera', '1', 1),
	(8, 1, 1, 3, 'espera', '2', 2),
	(9, 1, 6, 7, 'espera', '1', 2),
	(10, 1, 3, 6, 'espera', '1', 3);
/*!40000 ALTER TABLE `partidas` ENABLE KEYS */;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- Volcando datos para la tabla random_tournament.personajes: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `personajes` DISABLE KEYS */;
/*!40000 ALTER TABLE `personajes` ENABLE KEYS */;

-- Volcando estructura para tabla random_tournament.torneos
CREATE TABLE IF NOT EXISTS `torneos` (
  `id_torneo` int(11) NOT NULL AUTO_INCREMENT,
  `id_juego` int(11) NOT NULL DEFAULT '0',
  `estado` varchar(50) COLLATE latin1_spanish_ci NOT NULL DEFAULT 'abierto',
  `max_participantes` int(11) NOT NULL,
  `total_participantes` int(11) NOT NULL,
  `fec_inicio` date DEFAULT NULL,
  `fec_final` date NOT NULL,
  `ganador` int(11) DEFAULT NULL,
  `nombre_torneo` varchar(50) COLLATE latin1_spanish_ci DEFAULT NULL,
  `participantes` varchar(50) COLLATE latin1_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`id_torneo`),
  KEY `FK_torneos_juegos` (`id_juego`),
  KEY `FK_torneos_usuarios` (`ganador`),
  CONSTRAINT `FK_torneos_juegos` FOREIGN KEY (`id_juego`) REFERENCES `juegos` (`id_juego`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `FK_torneos_usuarios` FOREIGN KEY (`ganador`) REFERENCES `usuarios` (`id_usuario`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- Volcando datos para la tabla random_tournament.torneos: ~3 rows (aproximadamente)
/*!40000 ALTER TABLE `torneos` DISABLE KEYS */;
INSERT INTO `torneos` (`id_torneo`, `id_juego`, `estado`, `max_participantes`, `total_participantes`, `fec_inicio`, `fec_final`, `ganador`, `nombre_torneo`, `participantes`) VALUES
	(1, 1, 'abierto', 8, 8, '2018-04-20', '0000-00-00', 3, 'prueba', '1,2,3,4,5,6,7,8'),
	(2, 1, 'abierto', 16, 0, NULL, '0000-00-00', 1, 'test', '1,2'),
	(4, 1, 'finalizado', 16, 16, '2018-04-29', '2018-04-29', 1, 'finalizado', '1,2,3,4,5,6,7,8'),
	(6, 1, 'abierto', 8, 0, NULL, '0000-00-00', NULL, 'apuntarse', '1,2,3,4,5,6,7,8');
/*!40000 ALTER TABLE `torneos` ENABLE KEYS */;

-- Volcando estructura para tabla random_tournament.usuarios
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) COLLATE latin1_spanish_ci NOT NULL,
  `mail` varchar(50) COLLATE latin1_spanish_ci NOT NULL,
  `password` varchar(50) COLLATE latin1_spanish_ci NOT NULL,
  `permiso` varchar(50) COLLATE latin1_spanish_ci NOT NULL DEFAULT '0',
  `puntuacion` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_usuario`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `mail` (`mail`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- Volcando datos para la tabla random_tournament.usuarios: ~7 rows (aproximadamente)
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` (`id_usuario`, `username`, `mail`, `password`, `permiso`, `puntuacion`) VALUES
	(1, 'admin', 'admin@admin.es', 'admin', '2', 9),
	(2, 'moly', 'molylvp@gmail.com', 'moly', '0', 3),
	(3, 'usuario3', 'usuario3@usuario.es', 'usuario3', '0', 0),
	(4, 'usuario4', 'usuario4@usuario.es', 'usuario4', '0', 0),
	(5, 'usuario5', 'usuario5@usuario.es', 'usuario5', '0', 0),
	(6, 'usuario6', 'usuario6@usuario.es', 'usuario6', '0', 0),
	(7, 'usuario7', 'usuario7@usuario.es', 'usuario7', '0', 0),
	(8, 'usuario8', 'usuario8@usuario.es', 'usuario8', '0', 0);
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
