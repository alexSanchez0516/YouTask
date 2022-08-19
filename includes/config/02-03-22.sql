-- MySQL dump 10.13  Distrib 8.0.26, for macos11 (x86_64)
--
-- Host: 127.0.0.1    Database: youtask
-- ------------------------------------------------------
-- Server version	5.7.36

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
-- Table structure for table `Groups`
--

DROP TABLE IF EXISTS `Groups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Groups` (
  `idGroups` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `description` longtext NOT NULL,
  `adminID` int(11) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_end` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`idGroups`),
  KEY `fkAdminGroups_idx` (`adminID`),
  CONSTRAINT `fkAdminGroups` FOREIGN KEY (`adminID`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Groups`
--

LOCK TABLES `Groups` WRITE;
/*!40000 ALTER TABLE `Groups` DISABLE KEYS */;
/*!40000 ALTER TABLE `Groups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Projects`
--

DROP TABLE IF EXISTS `Projects`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Projects` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `description` longtext,
  `adminID` int(11) NOT NULL,
  `state` enum('REALIZADO','EN PROCESO','CANCELADO') NOT NULL,
  `priority` enum('ALTA','MEDIA','BAJA') NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_end` timestamp NULL DEFAULT NULL,
  `groupID` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fkAdmin_idx` (`adminID`),
  KEY `fkgroupProjects_idx` (`groupID`),
  CONSTRAINT `fkAdmin` FOREIGN KEY (`adminID`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fkGroupProject` FOREIGN KEY (`groupID`) REFERENCES `Groups` (`idGroups`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Projects`
--

LOCK TABLES `Projects` WRITE;
/*!40000 ALTER TABLE `Projects` DISABLE KEYS */;
INSERT INTO `Projects` VALUES (5,'JAJAJAJJAJA','JAJAJJAJAJA',15,'REALIZADO','ALTA','2022-02-03 22:23:42','2022-02-03 21:22:01',0),(6,'otro masotro mas','otro masotro mas',15,'EN PROCESO','BAJA','2022-02-03 22:28:59','2022-02-03 21:28:51',0),(7,'habbo.es','habbo.eshabbo.eshabbo.eshabbo.es',15,'EN PROCESO','ALTA','2022-02-04 00:42:16','2022-02-03 23:42:01',0),(8,'mas pruebas metin3.essese','mas pruebas metin3.essesemas pruebas metin3.essesemas pruebas metin3.essese',15,'EN PROCESO','BAJA','2022-02-05 11:19:58','2022-02-05 10:19:49',0),(9,'otro mas par aver','otro mas par averotro mas par averotro mas par aver',15,'EN PROCESO','BAJA','2022-02-06 17:58:44','2022-02-06 16:58:31',0),(10,'otro mas par aver','otro mas par averotro mas par averotro mas par aver',15,'EN PROCESO','BAJA','2022-02-06 17:59:10','2022-02-06 16:58:31',0),(11,'selectedselectedselected','selectedselectedselectedselectedselectedselectedselectedselectedselected',15,'EN PROCESO','BAJA','2022-02-06 18:07:15','2022-02-06 17:06:25',0),(12,'mas pruebas metin3.essese','mas pruebas metin3.essesemas pruebas metin3.essese',15,'EN PROCESO','BAJA','2022-02-06 18:09:00','2022-02-06 17:08:48',0),(13,'Hybnakk','pruebas',15,'REALIZADO','ALTA','2022-02-13 03:38:36',NULL,0),(14,'Hybnakk','pruebas',15,'REALIZADO','ALTA','2022-02-13 03:39:43',NULL,0),(15,'alex','alex',15,'REALIZADO','ALTA','2022-02-13 03:42:43',NULL,0),(16,'Hybnakk','pruebas',15,'REALIZADO','ALTA','2022-02-13 03:43:29',NULL,0),(17,'Hybnakk','pruebas',15,'REALIZADO','ALTA','2022-02-13 04:00:42',NULL,0),(18,'Hybnakk','pruebas',15,'REALIZADO','ALTA','2022-02-13 04:01:20',NULL,0),(19,'Hybnakk','pruebas',15,'REALIZADO','ALTA','2022-02-13 04:02:13',NULL,0),(20,'Hybnakk','pruebas',15,'REALIZADO','ALTA','2022-02-13 04:02:53',NULL,0),(21,'Hybnakk','pruebas',15,'REALIZADO','ALTA','2022-02-13 05:20:26',NULL,0),(22,'Hybnakk','pruebas',15,'REALIZADO','ALTA','2022-02-13 05:20:39',NULL,0),(23,'Hybnakk','pruebas',15,'REALIZADO','ALTA','2022-02-13 05:20:52',NULL,0),(24,'Hybnakk','pruebas',15,'REALIZADO','ALTA','2022-02-13 05:26:55',NULL,0),(25,'Hybnakk','pruebas',15,'REALIZADO','ALTA','2022-02-13 05:33:35',NULL,0),(27,'JDBC','pruebas',15,'REALIZADO','ALTA','2022-02-13 05:51:31',NULL,0),(32,'JDBC','pruebas',15,'REALIZADO','ALTA','2022-02-13 05:53:11',NULL,0),(34,'JDBC','pruebas',15,'REALIZADO','ALTA','2022-02-13 05:54:28',NULL,0),(35,'PRUEBAS23-02','PRUEBAS23-02PRUEBAS23-02PRUEBAS23-02',15,'EN PROCESO','BAJA','2022-02-23 20:04:00','2022-02-25 19:03:13',0);
/*!40000 ALTER TABLE `Projects` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Tasks`
--

DROP TABLE IF EXISTS `Tasks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Tasks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `description` longtext NOT NULL,
  `adminID` int(11) NOT NULL,
  `state` enum('REALIZADO','EN PROCESO','CANCELADO') NOT NULL,
  `priority` enum('ALTA','MEDIA','BAJA') NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_end` timestamp NULL DEFAULT NULL,
  `projectID` int(9) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fkAdminTask_idx` (`adminID`),
  KEY `fkprojectTask_idx` (`projectID`),
  CONSTRAINT `fkAdminTask` FOREIGN KEY (`adminID`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fkprojectTask` FOREIGN KEY (`projectID`) REFERENCES `Projects` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Tasks`
--

LOCK TABLES `Tasks` WRITE;
/*!40000 ALTER TABLE `Tasks` DISABLE KEYS */;
INSERT INTO `Tasks` VALUES (1,'alxanderalxander','alxanderalxanderalxanderalxanderalxanderalxander',15,'EN PROCESO','BAJA','2022-02-20 02:07:53','2022-02-20 01:05:48',15),(2,'alxanderalxander','alxanderalxanderalxanderalxanderalxanderalxander',15,'EN PROCESO','BAJA','2022-02-20 02:09:14','2022-02-20 01:05:48',15),(3,'alxanderalxander','alxanderalxanderalxanderalxanderalxanderalxander',15,'EN PROCESO','BAJA','2022-02-20 02:09:36','2022-02-20 01:05:48',15),(4,'alxanderalxander','alxanderalxanderalxanderalxanderalxanderalxander',15,'EN PROCESO','BAJA','2022-02-20 02:09:43','2022-02-20 01:05:48',15),(5,'tareas23-2-22','tareas23-2-22tareas23-2-22tareas23-2-22',15,'EN PROCESO','ALTA','2022-02-23 20:05:10','2022-02-25 19:04:47',15);
/*!40000 ALTER TABLE `Tasks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `password` varchar(100) NOT NULL,
  `email` varchar(60) NOT NULL,
  `validate` tinyint(1) DEFAULT NULL,
  `token` varchar(100) DEFAULT NULL,
  `admin` tinyint(1) DEFAULT NULL,
  `avatar` varchar(200) DEFAULT NULL,
  `dateC` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `description` mediumtext,
  `rol` varchar(45) DEFAULT NULL,
  `apellidos` varchar(70) NOT NULL,
  `isSocials` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (15,'Gustavin','$2y$10$n8FXTsPy0O3g/MPD1ktOaOuC4ksryG9uK205LwktGQ42uhBk0T.BC','xxkaise@gmail.com',1,'61fc724c11360',1,'34825c9162d4465ee6375032a0483005.png','2022-01-22 21:14:48','programador backend en php',NULL,'',NULL),(32,'xxkaise@gmail.com','$2y$10$vEXvn9K6o.SVdUUdYrrmZe0NLr04XMvSTWC9RBEesqibkBSR3phmy','12121@gmail.com',0,'61f47ef03b2ec',0,'','2022-01-28 23:40:32','',NULL,'',NULL),(33,'metin222','$2y$10$w5/KwdBmqD2kB5hegrjrxeijIVzUhkd2KW2h6p33F65FVUrzRi/Wq','sddfdlfdl@gmail.com',0,'61fc5b3c685e9',0,'','2022-02-03 22:46:20','',NULL,'',NULL),(37,'admin','$2y$10$gHadPEH.3xNTmDSc61UuQOsZaLOiOlcCP3nqT6DLWdriz84/7ZDT6','alex1818@gmail.com',1,'',0,'','2022-02-04 00:40:00','',NULL,'',NULL),(38,'Mayra','132323','pruebasMaven',NULL,NULL,NULL,NULL,'2022-02-13 01:22:55',NULL,NULL,'',NULL),(40,'Mayra','132323','pruebasEmailNoRepetir',NULL,NULL,NULL,NULL,'2022-02-13 01:26:31',NULL,NULL,'',NULL),(43,'Mayra','132323','pruebasEmailNoRepetirx1',NULL,NULL,NULL,NULL,'2022-02-13 01:28:13',NULL,NULL,'',NULL),(45,'Mayra','132323','sd',NULL,NULL,NULL,NULL,'2022-02-13 01:43:15',NULL,NULL,'',NULL);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-03-02 23:51:38
