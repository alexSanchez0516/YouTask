-- MySQL dump 10.13  Distrib 8.0.25, for Linux (x86_64)
--
-- Host: localhost    Database: youtask
-- ------------------------------------------------------
-- Server version	8.0.23-3+b1

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
  `idGroups` int NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `description` longtext NOT NULL,
  `adminID` int NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_end` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`idGroups`),
  KEY `fkAdminGroups_idx` (`adminID`),
  CONSTRAINT `fkAdminGroups` FOREIGN KEY (`adminID`) REFERENCES `users` (`id`)
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
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `description` longtext,
  `adminID` int NOT NULL,
  `state` enum('REALIZADO','EN PROCESO','CANCELADO') NOT NULL,
  `priority` enum('ALTA','MEDIA','BAJA') NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_end` timestamp NULL DEFAULT NULL,
  `groupID` int DEFAULT NULL,
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
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `description` longtext NOT NULL,
  `adminID` int NOT NULL,
  `state` enum('REALIZADO','EN PROCESO','CANCELADO') NOT NULL,
  `priority` enum('ALTA','MEDIA','BAJA') NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_end` timestamp NULL DEFAULT NULL,
  `projectID` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fkAdminTask_idx` (`adminID`),
  KEY `fkprojectTask_idx` (`projectID`),
  CONSTRAINT `fkAdminTask` FOREIGN KEY (`adminID`) REFERENCES `users` (`id`),
  CONSTRAINT `fkprojectTask` FOREIGN KEY (`projectID`) REFERENCES `Projects` (`id`)
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
-- Table structure for table `activity`
--

DROP TABLE IF EXISTS `activity`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `activity` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `action` varchar(100) NOT NULL,
  `project_id` int DEFAULT NULL,
  `task_id` int DEFAULT NULL,
  `post_id` int DEFAULT NULL,
  `create_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `fk_user_idx` (`user_id`),
  KEY `fk_post_activity_idx` (`post_id`),
  KEY `fk_project_activity_idx` (`project_id`),
  KEY `fk_task_activity_idx` (`task_id`),
  CONSTRAINT `fk_post_activity` FOREIGN KEY (`post_id`) REFERENCES `post` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_project_activity` FOREIGN KEY (`project_id`) REFERENCES `Projects` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_task_activity` FOREIGN KEY (`task_id`) REFERENCES `Tasks` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_user_activity` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `activity`
--

LOCK TABLES `activity` WRITE;
/*!40000 ALTER TABLE `activity` DISABLE KEYS */;
INSERT INTO `activity` VALUES (1,15,'se ha unido al proyecto',5,NULL,NULL,'2022-04-15 18:19:01');
/*!40000 ALTER TABLE `activity` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `chat`
--

DROP TABLE IF EXISTS `chat`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `chat` (
  `id` int NOT NULL AUTO_INCREMENT,
  `sender` int NOT NULL,
  `receiver` int DEFAULT NULL,
  `msg` text NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `group_chat` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_sender_idx` (`sender`),
  KEY `fk_receiver_chat_idx` (`receiver`),
  KEY `fk_group_chat_idx` (`group_chat`),
  CONSTRAINT `fk_group_chat` FOREIGN KEY (`group_chat`) REFERENCES `Groups` (`idGroups`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_receiver_chat` FOREIGN KEY (`receiver`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_sender` FOREIGN KEY (`sender`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `chat`
--

LOCK TABLES `chat` WRITE;
/*!40000 ALTER TABLE `chat` DISABLE KEYS */;
INSERT INTO `chat` VALUES (1,15,100000,'ajsjansjasjabsjabsjbasjbajsjas','2022-04-22 22:10:31',NULL),(2,100000,15,'respondiendo dicho mensaje','2022-04-22 22:11:00',NULL),(3,46,15,'nuevio m enaksnkansksndksd','2022-05-01 22:29:51',NULL);
/*!40000 ALTER TABLE `chat` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `comments_post`
--

DROP TABLE IF EXISTS `comments_post`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `comments_post` (
  `id` int NOT NULL AUTO_INCREMENT,
  `post_id` int NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `content` text NOT NULL,
  `user_id` int NOT NULL,
  `comment_response` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_comments_post_1_idx` (`post_id`),
  KEY `fk_user_comments_idx` (`user_id`),
  KEY `comment_response_idx` (`comment_response`),
  CONSTRAINT `comment_response` FOREIGN KEY (`comment_response`) REFERENCES `comments_post` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_comments_post_1` FOREIGN KEY (`post_id`) REFERENCES `post` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_user_comments` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=103 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comments_post`
--

LOCK TABLES `comments_post` WRITE;
/*!40000 ALTER TABLE `comments_post` DISABLE KEYS */;
INSERT INTO `comments_post` VALUES (97,4,'2022-04-16 17:00:52','sdsdsd',45,NULL),(98,7,'2022-04-19 13:58:50','hola',15,NULL);
/*!40000 ALTER TABLE `comments_post` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `post`
--

DROP TABLE IF EXISTS `post`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `post` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `content` text NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_user` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_USER_idx` (`id_user`),
  CONSTRAINT `FK_USER` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `post`
--

LOCK TABLES `post` WRITE;
/*!40000 ALTER TABLE `post` DISABLE KEYS */;
INSERT INTO `post` VALUES (4,'sdsdsdsdsdsd','dfdfddddf','2022-04-15 22:29:18',15),(5,'dfdfdf','                    dfdfdf','2022-04-17 05:20:47',15),(6,'metin2323232323','dfdfdff                    ','2022-04-17 05:20:51',15),(7,'creado por mayra','contenido de este poisssdsdsd','2022-04-19 13:55:39',45);
/*!40000 ALTER TABLE `post` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `requests_friends`
--

DROP TABLE IF EXISTS `requests_friends`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `requests_friends` (
  `id` int NOT NULL AUTO_INCREMENT,
  `transmitter` int NOT NULL,
  `receiver` int NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `isAccept` tinyint DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `receiver` (`receiver`,`transmitter`),
  KEY `fk_receiver_idx` (`receiver`),
  KEY `fk_transmitter_idx` (`transmitter`),
  CONSTRAINT `fk_receiver` FOREIGN KEY (`receiver`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_transmitter` FOREIGN KEY (`transmitter`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=83 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `requests_friends`
--

LOCK TABLES `requests_friends` WRITE;
/*!40000 ALTER TABLE `requests_friends` DISABLE KEYS */;
INSERT INTO `requests_friends` VALUES (28,46,15,'2022-04-17 02:07:20',1),(79,15,100001,'2022-04-20 16:50:03',1),(81,15,45,'2022-04-22 15:46:15',0),(82,100000,15,'2022-04-22 15:46:17',1);
/*!40000 ALTER TABLE `requests_friends` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `skill_users`
--

DROP TABLE IF EXISTS `skill_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `skill_users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_user` int NOT NULL,
  `id_skill` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_skill_users_1_idx` (`id_user`),
  KEY `fk_skill_skills_idx` (`id_skill`),
  CONSTRAINT `fk_skill_skills` FOREIGN KEY (`id_skill`) REFERENCES `skills` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_skill_users_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=60 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `skill_users`
--

LOCK TABLES `skill_users` WRITE;
/*!40000 ALTER TABLE `skill_users` DISABLE KEYS */;
INSERT INTO `skill_users` VALUES (53,15,5),(54,15,1),(55,15,3),(56,15,11),(57,15,12),(58,15,2),(59,15,15);
/*!40000 ALTER TABLE `skill_users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `skills`
--

DROP TABLE IF EXISTS `skills`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `skills` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name_UNIQUE` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `skills`
--

LOCK TABLES `skills` WRITE;
/*!40000 ALTER TABLE `skills` DISABLE KEYS */;
INSERT INTO `skills` VALUES (5,'Django'),(1,'java'),(3,'Laravel'),(15,'MySql'),(2,'PHP'),(11,'Python'),(14,'Redis'),(13,'Slim'),(12,'Spring');
/*!40000 ALTER TABLE `skills` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `password` varchar(200) NOT NULL,
  `email` varchar(60) NOT NULL,
  `validate` tinyint(1) DEFAULT NULL,
  `token` varchar(100) DEFAULT NULL,
  `admin` tinyint(1) DEFAULT NULL,
  `avatar` varchar(200) DEFAULT 'user-solid.svg',
  `dateC` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `description` mediumtext,
  `rol` varchar(45) DEFAULT NULL,
  `apellidos` varchar(70) NOT NULL,
  `isSocials` tinyint(1) DEFAULT '1',
  `instagram` varchar(200) DEFAULT NULL,
  `github` varchar(200) DEFAULT NULL,
  `linkedin` varchar(200) DEFAULT NULL,
  `gen` tinyint DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=100007 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (15,'Gustavo Alexander','$2y$10$n8FXTsPy0O3g/MPD1ktOaOuC4ksryG9uK205LwktGQ42uhBk0T.BC','xxkaise@gmail.com',1,'6260624e414e2',1,'5755bbf5da69ec0257bda0a635b669a1.png','2022-01-22 21:14:48','Developer  FullStack Junior Java','Programador','Sánchez Villegas',0,'','https://github.com/alexSanchez0516/','https://www.linkedin.com/in/alexander-sanchez-423260184/',NULL),(45,'Mayra','132323','sd',1,NULL,NULL,'male.png','2022-02-13 01:43:15',NULL,NULL,'',NULL,NULL,NULL,NULL,NULL),(46,'mayLuandro','1212121212121','skdjlsjdlsd',1,NULL,NULL,'male.png','2022-04-16 23:51:20','jugar lol, minecraft metin','gamer','sanchez',NULL,NULL,NULL,NULL,NULL),(100000,'maymendes','232323','23232323',1,NULL,NULL,'male.png','2022-04-17 00:03:35','hacer deporte, jugar habbo y no hacer nada mas','franco de csgo','rivero gomez',NULL,NULL,NULL,NULL,NULL),(100001,'metin2','sdsdsdsdsd','sdsdsdsd',1,NULL,NULL,'male.png','2022-04-19 21:29:47','jugar metin2 todo el dia','gamer fulltime','gonzalez',NULL,NULL,NULL,NULL,NULL),(100002,'gus1540','$2y$10$JUX4RwPt.3FxPH48Yt5aBOxmPVMPSMAZtddo6LL5AWDDO3sy21t/a','metin3@gmail.com',1,'',0,'male.png','2022-04-22 16:26:43','','','sanchez',0,'','','',NULL),(100003,'juan andres','$2y$10$anBpoz75/4FhWW4W8rNiKeYfM4sMC1xNoZe9zT/Z5NJkt/Za7mn8O','metin4@gmail.com',1,'',0,'male.png','2022-04-22 17:16:20','','','sanchez villegas',0,'','','',1),(100004,'Alexander','$2y$10$XoEsUMPGZ6jVBIqITkoM0.ZFNpPGNdRna8PmhNNK.wxOaVR9w3Ul.','metin10@gmail.com',1,'',0,'male.png','2022-04-22 17:17:23','','','sanchez',0,'','','',1),(100005,'alba Jimena','$2y$10$82y4R273XRDT4ros1aGRwuMXHb3auVPokr/YLrJ8DhTLUoL0MAhGS','alba@gmail.com',1,'',0,'male.png','2022-04-22 17:20:10','','','sanchez villegas',0,'','','',1),(100006,'admin','$2y$10$DI2Au43TAvwMviOOXKDLNuwKhcAPVLFmTpfRuFYTQkN9mep4Xv1eK','metin0@gmail.com',1,'',0,'male.png','2022-04-22 17:21:36','','','sanchez',0,'','','',0);
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

-- Dump completed on 2022-05-05 13:26:16
