-- MySQL dump 10.13  Distrib 8.0.25, for Linux (x86_64)
--
-- Host: localhost    Database: laboratorioRedes
-- ------------------------------------------------------
-- Server version	8.0.25-0ubuntu0.20.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `caracapoint`
--

DROP TABLE IF EXISTS `caracapoint`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `caracapoint` (
  `id_apoint` varchar(10) NOT NULL,
  `banda` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id_apoint`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `caracapoint`
--

LOCK TABLES `caracapoint` WRITE;
/*!40000 ALTER TABLE `caracapoint` DISABLE KEYS */;
INSERT INTO `caracapoint` VALUES ('1','2.4 GHz');
/*!40000 ALTER TABLE `caracapoint` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `caraccable`
--

DROP TABLE IF EXISTS `caraccable`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `caraccable` (
  `id_cable` varchar(10) NOT NULL,
  `logitud` varchar(20) DEFAULT NULL,
  `grosor` varchar(20) DEFAULT NULL,
  `adaptador_puerto_entrada` varchar(20) DEFAULT NULL,
  `adaptador_puerto_salida` varchar(20) DEFAULT NULL,
  `alim_electrica` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id_cable`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `caraccable`
--

LOCK TABLES `caraccable` WRITE;
/*!40000 ALTER TABLE `caraccable` DISABLE KEYS */;
INSERT INTO `caraccable` VALUES ('1','6 ft','2 mm','RJ45','DB9F','9.5 V');
/*!40000 ALTER TABLE `caraccable` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `caraccamara`
--

DROP TABLE IF EXISTS `caraccamara`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `caraccamara` (
  `id_camara` varchar(10) NOT NULL,
  `banda` varchar(20) DEFAULT NULL,
  `resolucion` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id_camara`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `caraccamara`
--

LOCK TABLES `caraccamara` WRITE;
/*!40000 ALTER TABLE `caraccamara` DISABLE KEYS */;
INSERT INTO `caraccamara` VALUES ('1','2.4 GHz','640x480');
/*!40000 ALTER TABLE `caraccamara` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `carackit`
--

DROP TABLE IF EXISTS `carackit`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `carackit` (
  `id_kit` varchar(10) NOT NULL,
  `numero_puertosPLE400_AV` int DEFAULT NULL,
  `numero_puertosPLS400_AV` int DEFAULT NULL,
  PRIMARY KEY (`id_kit`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `carackit`
--

LOCK TABLES `carackit` WRITE;
/*!40000 ALTER TABLE `carackit` DISABLE KEYS */;
INSERT INTO `carackit` VALUES ('1',1,4);
/*!40000 ALTER TABLE `carackit` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `caracmodem`
--

DROP TABLE IF EXISTS `caracmodem`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `caracmodem` (
  `id_modem` varchar(10) NOT NULL,
  `version` varchar(20) DEFAULT NULL,
  `subida_datos` varchar(20) DEFAULT NULL,
  `bajada_datos` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id_modem`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `caracmodem`
--

LOCK TABLES `caracmodem` WRITE;
/*!40000 ALTER TABLE `caracmodem` DISABLE KEYS */;
INSERT INTO `caracmodem` VALUES ('1','v.7.2.5.1','6.98 Mbps','887 Kbps');
/*!40000 ALTER TABLE `caracmodem` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `caracpinza`
--

DROP TABLE IF EXISTS `caracpinza`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `caracpinza` (
  `id_pinza` varchar(10) NOT NULL,
  `tipo_cable` varchar(15) DEFAULT NULL,
  `cable_categoria` int DEFAULT NULL,
  PRIMARY KEY (`id_pinza`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `caracpinza`
--

LOCK TABLES `caracpinza` WRITE;
/*!40000 ALTER TABLE `caracpinza` DISABLE KEYS */;
INSERT INTO `caracpinza` VALUES ('1','Coaxial',6);
/*!40000 ALTER TABLE `caracpinza` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `caracrouter`
--

DROP TABLE IF EXISTS `caracrouter`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `caracrouter` (
  `id_router` varchar(10) NOT NULL,
  `sistemaop_router` varchar(20) DEFAULT NULL,
  `numero_puertos_fe` int DEFAULT NULL,
  `numero_puertos_ge` int DEFAULT NULL,
  `numero_puertos_seriales` int DEFAULT NULL,
  `numero_modulosVPN` int DEFAULT NULL,
  `numero_puertos_usb` int DEFAULT NULL,
  PRIMARY KEY (`id_router`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `caracrouter`
--

LOCK TABLES `caracrouter` WRITE;
/*!40000 ALTER TABLE `caracrouter` DISABLE KEYS */;
INSERT INTO `caracrouter` VALUES ('1','12.4 v',2,0,2,1,2);
/*!40000 ALTER TABLE `caracrouter` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `caracservidor`
--

DROP TABLE IF EXISTS `caracservidor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `caracservidor` (
  `id_servidor` varchar(10) NOT NULL,
  `procesador` varchar(20) DEFAULT NULL,
  `ram` varchar(20) DEFAULT NULL,
  `disco_duro` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id_servidor`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `caracservidor`
--

LOCK TABLES `caracservidor` WRITE;
/*!40000 ALTER TABLE `caracservidor` DISABLE KEYS */;
INSERT INTO `caracservidor` VALUES ('1','Intel Xeon E3-1220','8GB DDR3','500GB');
/*!40000 ALTER TABLE `caracservidor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `caracswitch`
--

DROP TABLE IF EXISTS `caracswitch`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `caracswitch` (
  `id_switch` varchar(10) NOT NULL,
  `sistemaop_switch` varchar(20) DEFAULT NULL,
  `flash` varchar(20) DEFAULT NULL,
  `num_puertos_fe` int DEFAULT NULL,
  `num_puertos_ge` int DEFAULT NULL,
  `velocidad_min` varchar(20) DEFAULT NULL,
  `velocidad_max` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id_switch`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `caracswitch`
--

LOCK TABLES `caracswitch` WRITE;
/*!40000 ALTER TABLE `caracswitch` DISABLE KEYS */;
INSERT INTO `caracswitch` VALUES ('1','15.0 SE','20 Kb',24,2,'','');
/*!40000 ALTER TABLE `caracswitch` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `caractelefono`
--

DROP TABLE IF EXISTS `caractelefono`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `caractelefono` (
  `id_telefono` varchar(10) NOT NULL,
  `numero_telefono` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id_telefono`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `caractelefono`
--

LOCK TABLES `caractelefono` WRITE;
/*!40000 ALTER TABLE `caractelefono` DISABLE KEYS */;
INSERT INTO `caractelefono` VALUES ('1','2225261634');
/*!40000 ALTER TABLE `caractelefono` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `caracteristica`
--

DROP TABLE IF EXISTS `caracteristica`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `caracteristica` (
  `id_caracteristica` int NOT NULL AUTO_INCREMENT,
  `id_switch` varchar(10) DEFAULT NULL,
  `id_kit` varchar(10) DEFAULT NULL,
  `id_pinza` varchar(10) DEFAULT NULL,
  `id_router` varchar(10) DEFAULT NULL,
  `id_apoint` varchar(10) DEFAULT NULL,
  `id_telefono` varchar(10) DEFAULT NULL,
  `id_cable` varchar(10) DEFAULT NULL,
  `id_servidor` varchar(10) DEFAULT NULL,
  `id_modem` varchar(10) DEFAULT NULL,
  `id_camara` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id_caracteristica`),
  KEY `id_switch` (`id_switch`),
  KEY `id_kit` (`id_kit`),
  KEY `id_pinza` (`id_pinza`),
  KEY `id_router` (`id_router`),
  KEY `id_apoint` (`id_apoint`),
  KEY `id_telefono` (`id_telefono`),
  KEY `id_cable` (`id_cable`),
  KEY `id_servidor` (`id_servidor`),
  KEY `id_modem` (`id_modem`),
  KEY `id_camara` (`id_camara`),
  CONSTRAINT `caracteristica_ibfk_1` FOREIGN KEY (`id_switch`) REFERENCES `caracswitch` (`id_switch`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `caracteristica_ibfk_10` FOREIGN KEY (`id_camara`) REFERENCES `caraccamara` (`id_camara`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `caracteristica_ibfk_2` FOREIGN KEY (`id_kit`) REFERENCES `carackit` (`id_kit`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `caracteristica_ibfk_3` FOREIGN KEY (`id_pinza`) REFERENCES `caracpinza` (`id_pinza`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `caracteristica_ibfk_4` FOREIGN KEY (`id_router`) REFERENCES `caracrouter` (`id_router`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `caracteristica_ibfk_5` FOREIGN KEY (`id_apoint`) REFERENCES `caracapoint` (`id_apoint`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `caracteristica_ibfk_6` FOREIGN KEY (`id_telefono`) REFERENCES `caractelefono` (`id_telefono`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `caracteristica_ibfk_7` FOREIGN KEY (`id_cable`) REFERENCES `caraccable` (`id_cable`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `caracteristica_ibfk_8` FOREIGN KEY (`id_servidor`) REFERENCES `caracservidor` (`id_servidor`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `caracteristica_ibfk_9` FOREIGN KEY (`id_modem`) REFERENCES `caracmodem` (`id_modem`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `caracteristica`
--

LOCK TABLES `caracteristica` WRITE;
/*!40000 ALTER TABLE `caracteristica` DISABLE KEYS */;
INSERT INTO `caracteristica` VALUES (1,'1',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(2,NULL,'1',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(3,NULL,NULL,'1',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(4,NULL,NULL,NULL,'1',NULL,NULL,NULL,NULL,NULL,NULL),(5,NULL,NULL,NULL,NULL,'1',NULL,NULL,NULL,NULL,NULL),(6,NULL,NULL,NULL,NULL,NULL,'1',NULL,NULL,NULL,NULL),(7,NULL,NULL,NULL,NULL,NULL,NULL,'1',NULL,NULL,NULL),(8,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'1',NULL,NULL),(9,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'1',NULL),(10,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'1');
/*!40000 ALTER TABLE `caracteristica` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `estatus`
--

DROP TABLE IF EXISTS `estatus`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `estatus` (
  `id_estatus` int NOT NULL AUTO_INCREMENT,
  `nombre_estatus` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`id_estatus`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `estatus`
--

LOCK TABLES `estatus` WRITE;
/*!40000 ALTER TABLE `estatus` DISABLE KEYS */;
INSERT INTO `estatus` VALUES (1,'Disponible'),(2,'En reparación'),(3,'Retirado');
/*!40000 ALTER TABLE `estatus` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `herramienta`
--

DROP TABLE IF EXISTS `herramienta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `herramienta` (
  `id_herramienta` int NOT NULL AUTO_INCREMENT,
  `nombre_corto` varchar(35) DEFAULT NULL,
  `nombre_largo` varchar(50) DEFAULT NULL,
  `numero_serie` varchar(20) DEFAULT NULL,
  `modelo` varchar(20) DEFAULT NULL,
  `id_caracteristica` int DEFAULT NULL,
  `mac` varchar(20) DEFAULT NULL,
  `mac_opcional` varchar(20) DEFAULT NULL,
  `id_estatus` int DEFAULT NULL,
  `id_tipo` int DEFAULT NULL,
  `id_marca` int DEFAULT NULL,
  `cantidad` int DEFAULT NULL,
  PRIMARY KEY (`id_herramienta`),
  KEY `id_caracteristica` (`id_caracteristica`),
  KEY `id_estatus` (`id_estatus`),
  KEY `id_tipo` (`id_tipo`),
  KEY `id_marca` (`id_marca`),
  CONSTRAINT `herramienta_ibfk_1` FOREIGN KEY (`id_caracteristica`) REFERENCES `caracteristica` (`id_caracteristica`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `herramienta_ibfk_2` FOREIGN KEY (`id_estatus`) REFERENCES `estatus` (`id_estatus`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `herramienta_ibfk_3` FOREIGN KEY (`id_tipo`) REFERENCES `tipo` (`id_tipo`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `herramienta_ibfk_4` FOREIGN KEY (`id_marca`) REFERENCES `marca` (`id_marca`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `herramienta`
--

LOCK TABLES `herramienta` WRITE;
/*!40000 ALTER TABLE `herramienta` DISABLE KEYS */;
INSERT INTO `herramienta` VALUES (1,'Switch Catalyst 2960','Cisco WS-C2960-24TC-L','FOC1041X4X4','WS-C2960-24TC-L',1,'00:19:E7:0C:66:00','N/A',1,1,2,1),(3,'Pinzas Crimpeadoras','Pinazas Crimpeadoras','N/A','N/A',3,'N/A','N/A',1,2,6,1),(4,'Router 2900','Cisco 2900 Series','FTX1646AKKD','Cisco 2900 Series',4,'N/A','N/A',1,1,2,1),(5,'Access Point WAP4410N','Cisco Access Point WAP4410N','SER1732030O','Cisco WAP4410N',5,'4C:00:82:E0:47:40','N/A',1,1,2,1),(6,'Telefono IP','Telefono Cisco 6921','PUC17351445','CP-6921-C-K9',6,'50:17:FF:77:49:32','N/A',1,1,2,1),(7,'Cable de Consola','Cable de Consola','N/A','N/A',7,'N/A','N/A',1,2,2,1),(8,'Servidor DELL','Servidor DELL Power Edge T110 II','FP9FBZ1','POWER EDGE T110 II',8,'N/A','N/A',1,1,1,1),(10,'Camara IP','Cisco Camara Inalambrica IP WVC80N','AUY07M301297','Cisco WVC80N',10,'58:6D:8F:EA:2E:FE','N/A',1,1,2,1),(12,'update','Demo largo','nsprueba','nsprueba123',3,'N/A','N/A',3,2,2,2),(13,'wifi54','wifi54 pro','123456789','54',2,'23::23::23::23::23','N/A',1,2,3,2);
/*!40000 ALTER TABLE `herramienta` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `marca`
--

DROP TABLE IF EXISTS `marca`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `marca` (
  `id_marca` int NOT NULL AUTO_INCREMENT,
  `nombre_marca` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`id_marca`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `marca`
--

LOCK TABLES `marca` WRITE;
/*!40000 ALTER TABLE `marca` DISABLE KEYS */;
INSERT INTO `marca` VALUES (1,'DELL'),(2,'CISCO'),(3,'INFINITUM'),(5,'ALLIED TELESYN'),(6,'STEREN'),(7,'LINUX'),(11,'TEC');
/*!40000 ALTER TABLE `marca` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipo`
--

DROP TABLE IF EXISTS `tipo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tipo` (
  `id_tipo` int NOT NULL AUTO_INCREMENT,
  `nombre_tipo` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`id_tipo`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipo`
--

LOCK TABLES `tipo` WRITE;
/*!40000 ALTER TABLE `tipo` DISABLE KEYS */;
INSERT INTO `tipo` VALUES (1,'Equipo'),(2,'Material');
/*!40000 ALTER TABLE `tipo` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-05-21 18:45:37
