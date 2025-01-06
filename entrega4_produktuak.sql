-- MySQL dump 10.13  Distrib 8.0.38, for Win64 (x86_64)
--
-- Host: localhost    Database: entrega4
-- ------------------------------------------------------
-- Server version	8.0.39

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `produktuak`
--

DROP TABLE IF EXISTS `produktuak`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `produktuak` (
  `id` int NOT NULL AUTO_INCREMENT,
  `izena` varchar(45) NOT NULL,
  `mota` varchar(45) NOT NULL,
  `prezioa` double NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `produktuak`
--

LOCK TABLES `produktuak` WRITE;
/*!40000 ALTER TABLE `produktuak` DISABLE KEYS */;
INSERT INTO `produktuak` VALUES (1,'Sagarrak','Fruta',1.2),(2,'Laranjak','Fruta',1.5),(3,'Mandoiak','Fruta',2.3),(4,'Platanoak','Fruta',1.8),(5,'Tomateak','Barazki',2.5),(6,'Lekak','Barazki',3.2),(7,'Kalabazak','Barazki',1.75),(8,'Tipulak','Barazki',0.9),(9,'Patatak','Barazki',1.4),(10,'Haragia','Proteina',8.5),(11,'Oilaskoa','Proteina',6.75),(12,'Arraina','Proteina',9.3),(13,'Atuna','Proteina',7.25),(14,'Esnekiak','Lacteo',4.5),(15,'Gazta','Lacteo',5.8),(16,'Yogurrak','Lacteo',3.2),(17,'Arrautzak','Lacteo',2.8),(18,'Olioa','Gantza',6.4),(19,'Gurina','Gantza',4.3),(20,'Txokolatea','Azukrea',2.5),(21,'Gailetak','Azukrea',3),(22,'Pastelak','Azukrea',4.5),(23,'Coca-cola','Edaria',1.8),(24,'Ura','Edaria',0.8),(25,'Zukua','Edaria',1.5),(26,'Ogia','Karbohidrato',1.2),(27,'Pasta','Karbohidrato',1.9),(28,'Arroza','Karbohidrato',1.6),(29,'Patata frijituak','Aperitibo',2.2),(30,'Kakahueteak','Aperitibo',3);
/*!40000 ALTER TABLE `produktuak` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-12-30 12:42:54
