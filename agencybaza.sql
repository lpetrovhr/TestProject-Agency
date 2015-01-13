-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.6.16 - MySQL Community Server (GPL)
-- Server OS:                    Win32
-- HeidiSQL Version:             8.3.0.4694
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping database structure for apartmani
DROP DATABASE IF EXISTS `apartmani`;
CREATE DATABASE IF NOT EXISTS `apartmani` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci */;
USE `apartmani`;


-- Dumping structure for table apartmani.appobject
DROP TABLE IF EXISTS `apartman`;
CREATE TABLE IF NOT EXISTS `apartman` (
  `apartmanID` int(11) NOT NULL AUTO_INCREMENT,
  `apartmanName` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `apartmanAddress` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `apartmanLocation` int(11) NOT NULL,
  `nbrOfBeds` int(11) NOT NULL DEFAULT '0',
  `nbrOfAdditionalBeds` int(11) NOT NULL DEFAULT '0',
  `nbrOfBedRooms` int(11) NOT NULL DEFAULT '0',
  `haveLivingRoom` bit(1) NOT NULL,
  `haveTV` bit(1) NOT NULL,
  `haveTelephone` bit(1) NOT NULL,
  `haveWiFi` bit(1) NOT NULL,
  PRIMARY KEY (`apartmanID`),
  KEY `fk_apartmanLocation` (`apartmanLocation`),
  CONSTRAINT `fk_apartmanLocation` FOREIGN KEY (`apartmanLocation`) REFERENCES `location` (`idLocation`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table apartmani.appobject: ~7 rows (approximately)
DELETE FROM `appobject`;
/*!40000 ALTER TABLE `appobject` DISABLE KEYS */;
INSERT INTO `appobject` (`appObjectID`, `objectName`, `objectAddress`, `objectLocation`, `nbrOfBeds`, `nbrOfAdditionalBeds`, `nbrOfBedRooms`, `haveLivingRoom`, `haveTV`, `haveTelephone`, `haveWiFi`) VALUES
	(1, 'marasino', 'ulica trnopuja 11', 1, 10, 5, 3, b'0', b'0', b'1', b'0'),
	(2, 'marusovac', 'marusovac 3', 1, 12, 11, 5, b'1', b'1', b'1', b'1'),
	(3, 'marusovac', 'marusovac 3', 1, 12, 11, 5, b'1', b'1', b'1', b'1'),
	(4, 'marusovac', 'marusovac 3', 1, 12, 11, 5, b'1', b'1', b'1', b'1'),
	(5, 'marusovac', 'marusovac 3', 1, 12, 11, 5, b'1', b'1', b'1', b'1'),
	(6, 'marusovac', 'marusovac 3', 1, 12, 11, 5, b'1', b'1', b'1', b'1'),
	(7, 'seda', 'ssseda', 1, 12, 11, 5, b'1', b'1', b'1', b'1'),
	(8, 'seda aa', 'ssseda', 1, 12, 11, 5, b'1', b'1', b'1', b'1'),
	(9, 'seda23', 'ssseda', 1, 12, 5, 3, b'1', b'1', b'1', b'1'),
	(10, 'Marasovici', 'ssseda', 1, 12, 5, 3, b'1', b'1', b'1', b'1'),
	(13, 'Marasovici 28', 'ssseda', 2, 12, 5, 3, b'0', b'1', b'0', b'1');
/*!40000 ALTER TABLE `appobject` ENABLE KEYS */;


-- Dumping structure for table apartmani.location
DROP TABLE IF EXISTS `location`;
CREATE TABLE IF NOT EXISTS `location` (
  `idLocation` int(11) NOT NULL AUTO_INCREMENT,
  `city` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `state` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `postalNumer` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`idLocation`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table apartmani.location: ~0 rows (approximately)
DELETE FROM `location`;
/*!40000 ALTER TABLE `location` DISABLE KEYS */;
INSERT INTO `location` (`idLocation`, `city`, `state`, `postalNumer`) VALUES
	(1, 'Solin', 'Croatia', '21210'),
	(2, 'Split', 'Croatia', '21000');
/*!40000 ALTER TABLE `location` ENABLE KEYS */;


-- Dumping structure for table apartmani.ownerinfo
DROP TABLE IF EXISTS `ownerinfo`;
CREATE TABLE IF NOT EXISTS `ownerinfo` (
  `ownerID` int(11) NOT NULL AUTO_INCREMENT,
  `ownerFirstName` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `ownerLastName` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `ownerEmail` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ownerWeb` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ownerTelephone` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `ownerCellPhone` varchar(25) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ownershipID` int(11) NOT NULL,
  PRIMARY KEY (`ownerID`),
  KEY `fk_ownerObject` (`ownershipID`),
  CONSTRAINT `fk_ownerObject` FOREIGN KEY (`ownershipID`) REFERENCES `appobject` (`appObjectID`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table apartmani.ownerinfo: ~5 rows (approximately)
DELETE FROM `ownerinfo`;
/*!40000 ALTER TABLE `ownerinfo` DISABLE KEYS */;
INSERT INTO `ownerinfo` (`ownerID`, `ownerFirstName`, `ownerLastName`, `ownerEmail`, `ownerWeb`, `ownerTelephone`, `ownerCellPhone`, `ownershipID`) VALUES
	(3, 'PetarKas', 'Slavic', 'petarslavic@gmail.com', 'monsterapp.com', '021/277-121', '0915323623', 1),
	(4, 'test', 'zurkarules@gmail.com', 'zurkarules@gmail.com', 'testing.com', '021 244 709', '091 5323623', 4),
	(5, 'test', 'zurkarules@gmail.com', 'zurkarules@gmail.com', 'testing.com', '021 244 709', '091 5323623', 5),
	(6, 'test', 'zurkarules@gmail.com', 'zurkarules@gmail.com', 'testing.com', '021 244 709', '091 5323623', 6),
	(7, 'test', 'zurkarules@gmail.com', 'zurkarules@gmail.com', 'testing.com', '021 244 709', '091 5323623', 7),
	(8, 'test', 'zurkarules@gmail.com', 'zurkarules@gmail.com', 'testing.com', '021 244 709', '091 5323623', 8),
	(9, 'test', 'grepolis285@gmail.com', 'grepolis285@gmail.com', 'testing.com', '021 244 709', '091 5323623', 9),
	(10, 'test', 'grepolis285@gmail.com', 'grepolis285@gmail.com', 'testing.com', '021 244 709', '091 5323623', 10),
	(11, 'test', 'grepolis285@gmail.com', 'grepolis285@gmail.com', 'testing.com', '021 244 709', '091 5323623', 13);
/*!40000 ALTER TABLE `ownerinfo` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
