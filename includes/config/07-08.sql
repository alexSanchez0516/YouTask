-- MySQL dump 10.13  Distrib 8.0.29, for Linux (x86_64)
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
-- Table structure for table `Members_Projects`
--

DROP TABLE IF EXISTS `Members_Projects`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Members_Projects` (
  `id_project` int NOT NULL,
  `id_user` int NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  UNIQUE KEY `UC_Person` (`id_project`,`id_user`),
  UNIQUE KEY `uc_members` (`id_project`,`id_user`),
  KEY `fk_Members_Projects_1_idx` (`id_project`),
  KEY `fk_Members_user_idx` (`id_user`),
  CONSTRAINT `fk_Members_Projects_1` FOREIGN KEY (`id_project`) REFERENCES `Projects` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_Members_user` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Members_Projects`
--

LOCK TABLES `Members_Projects` WRITE;
/*!40000 ALTER TABLE `Members_Projects` DISABLE KEYS */;
INSERT INTO `Members_Projects` VALUES (85,15,'2022-06-08 19:39:54'),(85,46,'2022-06-08 22:01:59'),(85,100006,'2022-06-08 22:02:26'),(85,100007,'2022-06-08 22:08:08'),(85,100010,'2022-06-14 16:03:18');
/*!40000 ALTER TABLE `Members_Projects` ENABLE KEYS */;
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
  `folderURL` varchar(200) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fkAdmin_idx` (`adminID`),
  KEY `fkgroupProjects_idx` (`groupID`),
  CONSTRAINT `fkAdmin` FOREIGN KEY (`adminID`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fkGroupProject` FOREIGN KEY (`groupID`) REFERENCES `Groups` (`idGroups`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=152 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Projects`
--

LOCK TABLES `Projects` WRITE;
/*!40000 ALTER TABLE `Projects` DISABLE KEYS */;
INSERT INTO `Projects` VALUES (85,'YouTask-Gestor','Proyecto para la gestión de tareas y otros proyectos',15,'EN PROCESO','ALTA','2022-06-03 23:01:51','2022-06-15 23:00:51',NULL,'youtask');
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
  CONSTRAINT `fkprojectTask` FOREIGN KEY (`projectID`) REFERENCES `Projects` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=108 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Tasks`
--

LOCK TABLES `Tasks` WRITE;
/*!40000 ALTER TABLE `Tasks` DISABLE KEYS */;
INSERT INTO `Tasks` VALUES (76,'CAMBIAR $_SERVER[\'PATH_INFO\'] Paginator','Cambiar $_SERVER[\'PATH_INFO\'] por request uri\r\nen el momento de produccion',15,'EN PROCESO','ALTA','2022-06-13 20:11:33','2022-06-20 20:10:36',85),(77,'REVISAR API LISTPROJECT','Problema con el endpoint, id metido en codigo duro',15,'REALIZADO','MEDIA','2022-06-13 22:11:57','2022-06-13 22:10:44',85),(78,'Paginaciones','Paginación POST/SEGUIDORES/#ACTIVIDAD_PROJECT',15,'REALIZADO','MEDIA','2022-06-13 22:13:20','2022-06-13 22:10:44',85),(79,'LIMPIAR FORMULARIOS ','Limpiar formularios después de hacer el send',15,'REALIZADO','ALTA','2022-06-13 22:13:52','2022-06-13 22:10:44',85),(80,'ENVIAR MSG SEGUIDORES','MOSTRAR MODAL PARA ENVIAR MENSAJES DESDE EL PAGE SEGUIDORES',15,'REALIZADO','ALTA','2022-06-13 22:14:41','2022-06-13 22:10:44',85),(81,'PAGINA TAREA','Mostrar pagina de tareas:\r\n- miembros\r\n- historial\r\n- state\r\n- tiempo dedicacion',15,'REALIZADO','ALTA','2022-06-13 22:16:37','2022-06-13 22:10:44',85),(82,'reCAPTCHA','Añadir capcha en login y register https://code.tutsplus.com/es/tutorials/example-of-how-to-add-google-recaptcha-v3-to-a-php-form--cms-33752',15,'REALIZADO','ALTA','2022-06-13 22:17:16','2022-06-13 22:10:44',85),(83,'Pagina miembros proyecto','añadir pagina para miembros del proyecto',15,'REALIZADO','ALTA','2022-06-13 22:18:03','2022-06-13 22:10:44',85),(84,'EDITAR TAREA','Añadir página editar tarea, intentar reutilizar con editar proyecto',15,'REALIZADO','ALTA','2022-06-13 22:18:49','2022-06-13 22:10:44',85),(85,'Cookies','añadir cookies localstorage',15,'REALIZADO','ALTA','2022-06-13 22:19:08','2022-06-13 22:10:44',85),(86,'Añadir mas validaciones','Sanitizar y validar datos manera mas eficiente',15,'REALIZADO','ALTA','2022-06-13 22:19:34','2022-06-13 22:10:44',85),(87,'PAGINAS VISIBLES','Añadir páginas visibles --> contacto, políticas privacidad, términos legales, cookies',15,'REALIZADO','ALTA','2022-06-13 22:21:40','2022-06-13 22:10:44',85),(88,'PAYPAL DONACIONES','AÑADIR DONACIONES PAYPAL',15,'REALIZADO','ALTA','2022-06-13 22:22:00','2022-06-13 22:10:44',85),(101,'Busqueda de tareas','Realizar servicio que busque tareas de 1 mes/dia/semana/año',15,'REALIZADO','ALTA','2022-08-05 23:25:28','2022-08-06 11:24:21',85),(102,'Realiazar panel de ventos en las Task','Realizar panel de los eventos de una determinada tarea',15,'EN PROCESO','ALTA','2022-08-05 23:26:20','2022-08-05 23:25:47',85),(103,'Notificacion de miembro proyecto','Añadir en el modal de notificaciones la solicitud de miembro proyecto\r\n\r\n\r\n- aceptar/denegar',15,'EN PROCESO','ALTA','2022-08-06 17:06:20','2022-08-29 17:05:26',85),(104,'MOSTRAR TAREAS A LOS MEMBERS','Mostrar tareas a los miembros de los proyectos',15,'EN PROCESO','MEDIA','2022-08-06 17:06:54','2022-09-06 17:06:25',85),(105,'Fix check admin/creator','MODIFICAR ELEMENTOS DE CREACION , EDICION Y ELIMINADO PARA QUE SOLO SEAN VISISBLES O CLICKEABLES DICHOS USUARIOS ADMINISTRADORES O CREADOR.\r\n\r\n\r\nElementos:\r\n- comentarios, tareas, eventos',15,'EN PROCESO','ALTA','2022-08-06 17:08:57','2022-09-06 17:08:14',85),(106,'Crear modulo actividad reciente','Crear modulo actividad reciente del propio usuario y de los seguidores',15,'EN PROCESO','BAJA','2022-08-06 17:10:29','2022-10-06 17:10:00',85),(107,'Implementar servicio de emails','Implementar servicio de emails servidores ovh',15,'EN PROCESO','MEDIA','2022-08-06 17:11:11','2022-10-06 17:10:44',85);
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
/*!40000 ALTER TABLE `activity` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `administratorProject`
--

DROP TABLE IF EXISTS `administratorProject`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `administratorProject` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_user` int NOT NULL,
  `id_project` int NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UC_person_adn_project` (`id_user`,`id_project`),
  KEY `fk_administratorProject_1_idx` (`id_project`),
  KEY `fk_administratorProject_2_idx` (`id_user`),
  CONSTRAINT `fk_administratorProject_1` FOREIGN KEY (`id_project`) REFERENCES `Projects` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_administratorProject_2` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `administratorProject`
--

LOCK TABLES `administratorProject` WRITE;
/*!40000 ALTER TABLE `administratorProject` DISABLE KEYS */;
INSERT INTO `administratorProject` VALUES (20,45,85,'2022-06-14 13:22:58'),(21,46,85,'2022-06-14 13:47:28'),(22,100000,85,'2022-06-14 13:47:28'),(23,100006,85,'2022-06-14 13:47:52'),(24,100007,85,'2022-06-14 13:47:52');
/*!40000 ALTER TABLE `administratorProject` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=114 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `chat`
--

LOCK TABLES `chat` WRITE;
/*!40000 ALTER TABLE `chat` DISABLE KEYS */;
INSERT INTO `chat` VALUES (107,15,100006,'oye eres feo','2022-06-17 18:36:26',NULL),(108,15,46,'fdfdf','2022-06-17 18:36:47',NULL),(109,15,46,'kklkl','2022-06-17 18:37:08',NULL),(110,15,15,'enviando mensaje desde proyeccto','2022-06-17 18:50:40',NULL),(111,15,15,'sdsdsd','2022-06-17 18:51:46',NULL),(112,15,100000,'ghghgh','2022-08-01 21:11:02',NULL),(113,100011,15,'hola','2022-08-06 17:00:05',NULL);
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
) ENGINE=InnoDB AUTO_INCREMENT=106 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comments_post`
--

LOCK TABLES `comments_post` WRITE;
/*!40000 ALTER TABLE `comments_post` DISABLE KEYS */;
INSERT INTO `comments_post` VALUES (97,4,'2022-04-16 17:00:52','sdsdsd',45,NULL),(98,7,'2022-04-19 13:58:50','hola',15,NULL),(103,4,'2022-05-31 10:02:35','muy7 bueno',15,NULL),(104,4,'2022-06-09 14:59:19','kjjajaaa',15,103),(105,4,'2022-06-09 14:59:19','kjjajaaa',15,103);
/*!40000 ALTER TABLE `comments_post` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `events`
--

DROP TABLE IF EXISTS `events`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `events` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_task` int NOT NULL,
  `start` date NOT NULL,
  `end` date NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `fk_task` (`id_task`),
  CONSTRAINT `fk_task` FOREIGN KEY (`id_task`) REFERENCES `Tasks` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `events`
--

LOCK TABLES `events` WRITE;
/*!40000 ALTER TABLE `events` DISABLE KEYS */;
INSERT INTO `events` VALUES (23,77,'2022-08-15','2022-08-20','2022-08-05 22:31:44'),(24,82,'2022-08-22','2022-08-24','2022-08-05 22:36:48'),(25,76,'2022-08-16','2022-08-16','2022-08-05 22:44:27'),(26,86,'2022-08-25','2022-08-29','2022-08-05 22:48:22'),(27,78,'2022-08-08','2022-08-12','2022-08-05 22:55:41');
/*!40000 ALTER TABLE `events` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `msgProjects`
--

DROP TABLE IF EXISTS `msgProjects`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `msgProjects` (
  `id` int NOT NULL AUTO_INCREMENT,
  `msg` text NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_id` int NOT NULL,
  `project_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fkProject_idx` (`project_id`),
  KEY `fk_user_project_idx` (`user_id`),
  CONSTRAINT `fk_user_project` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fkProject` FOREIGN KEY (`project_id`) REFERENCES `Projects` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `msgProjects`
--

LOCK TABLES `msgProjects` WRITE;
/*!40000 ALTER TABLE `msgProjects` DISABLE KEYS */;
INSERT INTO `msgProjects` VALUES (4,'que paso aquiscrollbar-width: none;scrollbar-width: none;scrollbar-width: none;scrollbar-width: none;scrollbar-width: none;scrollbar-width: none;','2022-06-09 18:12:26',15,85),(5,'que paso aquiscrollbar-width: none;scrollbar-width: none;scrollbar-width: none;scrollbar-width: none;scrollbar-width: none;scrollbar-width: none;','2022-06-09 18:12:27',15,85),(16,'HOLAAA','2022-08-06 17:09:28',100011,85);
/*!40000 ALTER TABLE `msgProjects` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `msgTask`
--

DROP TABLE IF EXISTS `msgTask`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `msgTask` (
  `id` int NOT NULL AUTO_INCREMENT,
  `msg` text NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_user` int NOT NULL,
  `id_task` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk__user__tasks_idx` (`id_user`),
  KEY `fk__user__task_idx` (`id_task`),
  CONSTRAINT `fk__user__task` FOREIGN KEY (`id_task`) REFERENCES `Tasks` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk__user__tasks` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `msgTask`
--

LOCK TABLES `msgTask` WRITE;
/*!40000 ALTER TABLE `msgTask` DISABLE KEYS */;
INSERT INTO `msgTask` VALUES (1,'dfmldjkfnjdnbfjkdbfnjkdbfjkbslkjnbfdkljsnfjklndjklfndjknf jkldf','2022-06-22 00:19:18',15,81),(2,'orem Ipsum es simplemente el texto de relleno de las imprentas y archivos de texto. Lorem Ipsum ha sido el texto de relleno estándar de las industrias desde el año 1500, cuando un impresor (N. del T. persona que se dedica a la imprenta) desconocido usó una galería de textos y los mezcló de tal manera que logró hacer un libro de textos especimen. No sólo sobrevivió 500 años, sino que tambien ingresó como texto de relleno en documentos electrónicos, quedando esencialmente igual al original. Fue popularizado en los 60s con la creación de las hojas \"Letraset\", las cuales contenian pasajes de Lorem Ipsum, y más recientemente con software de autoedición, como por ejemplo Aldus PageMaker, el cual incluye versiones de Lorem Ipsum.','2022-06-22 00:36:07',15,81),(3,'que fue','2022-06-22 00:42:44',15,81),(4,'dimelo','2022-06-22 00:43:06',15,81),(5,'hola','2022-06-22 13:22:03',15,86),(7,'dime qie','2022-06-22 15:39:23',15,85),(8,'que pasa aqui','2022-07-08 20:45:51',15,87),(10,'fgfg','2022-08-06 17:11:59',100011,76);
/*!40000 ALTER TABLE `msgTask` ENABLE KEYS */;
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
INSERT INTO `post` VALUES (4,'Python y su historia','Python está destinado a ser un lenguaje de fácil lectura. Su formato es visualmente ordenado y, a menudo, usa palabras clave en inglés donde otros idiomas usan puntuación. A diferencia de muchos otros lenguajes, no utiliza corchetes para delimitar bloques y se permiten puntos y coma después de las declaraciones, pero rara vez, si es que alguna vez, se utilizan. Tiene menos excepciones sintácticas y casos especiales que C o Pascal.\r\n\r\nDiseñado para ser leído con facilidad, una de sus características es el uso de palabras donde otros lenguajes utilizarían símbolos. Por ejemplo, los operadores lógicos !, || y && en Python se escriben not, or y and, respectivamente. Curiosamente el lenguaje Pascal es junto con COBOL uno de los lenguajes con muy clara sintaxis y ambos son de la década del 70. La idea del código claro y legible no es algo nuevo.\r\n\r\nEl contenido de los bloques de código (bucles, funciones, clases, etc.) es delimitado mediante espacios o tabuladores, conocidos como indentación, antes de cada línea de órdenes pertenecientes al bloque.27​ Python se diferencia así de otros lenguajes de programación que mantienen como costumbre declarar los bloques mediante un conjunto de caracteres, normalmente entre llaves {}.28​29​ Se pueden utilizar tanto espacios como tabuladores para sangrar el código, pero se recomienda no mezclarlos.30​\r\nFunción factorial en C (sangría opcional) 	Función factorial en Python (sangría obligatoria)\r\n\r\nint factorial(int x)\r\n{\r\n    if (x < 0 || x % 1 != 0) {\r\n        printf(\"x debe ser un numero entero mayor o igual a 0\");\r\n        return -1; //Error\r\n    }\r\n    if (x == 0) {\r\n        return 1;\r\n    }\r\n    return x * factorial(x - 1);\r\n}\r\n\r\n	\r\n\r\ndef factorial(x):\r\n    assert x >= 0 and x % 1 == 0, \"x debe ser un entero mayor o igual a 0.\"\r\n    if x == 0:\r\n        return 1\r\n    else:\r\n        return x * factorial(x - 1)\r\n\r\nDebido al significado sintáctico de la sangría, cada instrucción debe estar contenida en una sola línea. No obstante, si por legibilidad se quiere dividir la instrucción en varias líneas, añadiendo una barra invertida \\ al final de una línea, se indica que la instrucción continúa en la siguiente.\r\n\r\nEstas instrucciones son equivalentes:\r\n\r\n  lista=[\'valor 1\',\'valor 2\',\'valor 3\']\r\n  cadena=\'Esto es una cadena bastante larga\'\r\n\r\n	\r\n\r\n  lista=[\'valor 1\',\'valor 2\' \\\r\n        ,\'valor 3\']\r\n  cadena=\'Esto es una cadena \' \\\r\n         \'bastante larga\'\r\n                    ','2022-04-15 22:29:18',15),(7,'creado por mayra','contenido de este poisssdsdsd','2022-04-19 13:55:39',45);
/*!40000 ALTER TABLE `post` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `requestMemberProject`
--

DROP TABLE IF EXISTS `requestMemberProject`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `requestMemberProject` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_user` int NOT NULL,
  `id_project` int NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `state` tinyint NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `uc_members` (`id_user`,`id_project`),
  KEY `fk_user__1_idx` (`id_user`),
  KEY `fk_project_request_1_idx` (`id_project`),
  CONSTRAINT `fk_project_request_1` FOREIGN KEY (`id_project`) REFERENCES `Projects` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_user__1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `requestMemberProject`
--

LOCK TABLES `requestMemberProject` WRITE;
/*!40000 ALTER TABLE `requestMemberProject` DISABLE KEYS */;
INSERT INTO `requestMemberProject` VALUES (2,15,85,'2022-06-13 07:19:50',0),(3,100010,85,'2022-06-13 07:30:32',0),(7,100003,85,'2022-06-13 11:27:57',0),(9,100005,85,'2022-06-14 15:28:32',0),(11,100009,85,'2022-06-14 15:28:41',0),(15,100011,85,'2022-08-06 17:02:57',1);
/*!40000 ALTER TABLE `requestMemberProject` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=85 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `requests_friends`
--

LOCK TABLES `requests_friends` WRITE;
/*!40000 ALTER TABLE `requests_friends` DISABLE KEYS */;
INSERT INTO `requests_friends` VALUES (28,46,15,'2022-04-17 02:07:20',1),(79,15,100001,'2022-04-20 16:50:03',1),(81,15,45,'2022-04-22 15:46:15',0),(82,100000,15,'2022-04-22 15:46:17',1),(83,100009,15,'2022-06-13 07:45:46',0),(84,15,100011,'2022-08-06 17:01:37',1);
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
) ENGINE=InnoDB AUTO_INCREMENT=67 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `skill_users`
--

LOCK TABLES `skill_users` WRITE;
/*!40000 ALTER TABLE `skill_users` DISABLE KEYS */;
INSERT INTO `skill_users` VALUES (60,15,5),(61,15,1),(62,15,3),(63,15,15),(64,15,2),(65,15,11),(66,15,12);
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
  `avatar` varchar(200) NOT NULL DEFAULT 'male.png',
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
) ENGINE=InnoDB AUTO_INCREMENT=100012 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (15,'Gustavo Alexander','$2y$10$n8FXTsPy0O3g/MPD1ktOaOuC4ksryG9uK205LwktGQ42uhBk0T.BC','xxkaise@gmail.com',1,'6273b8b85eb77',1,'5755bbf5da69ec0257bda0a635b669a1.png','2022-01-22 21:14:48','Developer  FullStack Junior Java','Programador','Sánchez Villegas',1,'','https://github.com/alexSanchez0516/','https://www.linkedin.com/in/alexander-sanchez-423260184/',NULL),(45,'Mayra','132323','sd',1,NULL,NULL,'male.png','2022-02-13 01:43:15',NULL,NULL,'',NULL,NULL,NULL,NULL,NULL),(46,'mayLuandro','1212121212121','skdjlsjdlsd',1,NULL,NULL,'male.png','2022-04-16 23:51:20','jugar lol, minecraft metin','gamer','sanchez',NULL,NULL,NULL,NULL,NULL),(100000,'maymendes','232323','23232323',1,NULL,NULL,'male.png','2022-04-17 00:03:35','hacer deporte, jugar habbo y no hacer nada mas','franco de csgo','rivero gomez',NULL,NULL,NULL,NULL,NULL),(100001,'metin2','sdsdsdsdsd','sdsdsdsd',1,NULL,NULL,'male.png','2022-04-19 21:29:47','jugar metin2 todo el dia','gamer fulltime','gonzalez',NULL,NULL,NULL,NULL,NULL),(100002,'gus1540','$2y$10$JUX4RwPt.3FxPH48Yt5aBOxmPVMPSMAZtddo6LL5AWDDO3sy21t/a','metin3@gmail.com',1,'',0,'male.png','2022-04-22 16:26:43','','','sanchez',0,'','','',NULL),(100003,'juan andres','$2y$10$anBpoz75/4FhWW4W8rNiKeYfM4sMC1xNoZe9zT/Z5NJkt/Za7mn8O','metin4@gmail.com',1,'',0,'male.png','2022-04-22 17:16:20','','','sanchez villegas',0,'','','',1),(100004,'Alexander','$2y$10$XoEsUMPGZ6jVBIqITkoM0.ZFNpPGNdRna8PmhNNK.wxOaVR9w3Ul.','metin10@gmail.com',1,'',0,'male.png','2022-04-22 17:17:23','','','sanchez',0,'','','',1),(100005,'alba Jimena','$2y$10$82y4R273XRDT4ros1aGRwuMXHb3auVPokr/YLrJ8DhTLUoL0MAhGS','alba@gmail.com',1,'',0,'male.png','2022-04-22 17:20:10','','','sanchez villegas',0,'','','',1),(100006,'admin','$2y$10$DI2Au43TAvwMviOOXKDLNuwKhcAPVLFmTpfRuFYTQkN9mep4Xv1eK','metin0@gmail.com',1,'',0,'male.png','2022-04-22 17:21:36','','','sanchez',0,'','','',0),(100007,'xcxcxcxcxc','$2y$10$jQ2Un80iYp1uXiYqokuZaOA1GQh3L8mT/ddKxiEAw7jQv.A0oR7ny','xcxcxc@gmail.com',0,'6273b7e5d508a',0,'male.png','2022-05-05 11:41:25','dfd','','xcxcxcxcxcx',0,'','','',0),(100009,'juan andres','$2y$10$jQ2Un80iYp1uXiYqokuZaOA1GQh3L8mT/ddKxiEAw7jQv.A0oR7ns','xcddxcxc@gmail.com',1,'6273b7e5d508a',NULL,'user-solid.svg','2022-06-12 18:20:39','dfdfdfdf','Programador','ddddd',1,NULL,NULL,NULL,NULL),(100010,'suarez ¡neymar','$2y$10$jQ2Un80iYp1uXiYqokuZaOA1GQd3L8mT/ddKxiEAw7jQv.A0oR7ns','xcddffxcxc@gmail.com',1,NULL,NULL,'male.png','2022-06-12 19:15:20','sssss',NULL,'sdsdsdsdsd',1,NULL,NULL,NULL,NULL),(100011,'alexito','$2y$10$UaoAkbVqOh3xN.lbcClcPuuLNOuM0l55M/RhGMc35rrjPPlIeX4Hi','alexander.sanchez@quiter.com',1,'',0,'male.png','2022-08-06 16:57:45','','','sanchez',0,'','','',1);
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

-- Dump completed on 2022-08-06 19:25:10
