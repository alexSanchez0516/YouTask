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
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (15,'Alexander','$2y$10$v5hUm/UNHspIAa4z26gWDe72Qc152dMgbb/4zNGBzkehOAp1oDFXG','xxkaise@gmail.com',1,'61edd4e77f0a0',1,'','2022-01-22 21:14:48'),(16,'admin','1690001299Gr.','sdsd@gmail.com',1,'',0,'','2022-01-22 21:19:07'),(17,'admin','$2y$10$RUV4dB9y67DJ0BH3B0xw7OgzRwNdWOIG1oZSNnT2G6Q.FEQJjDILa','alexandervillegas0516@gmail.com',1,'',0,'','2022-01-23 18:22:39'),(19,'Administrador','$2y$10$oZmei/u7GtAXKA7q0zu1XumsckPP8qiEj7GWnGSgEsHGCMh4pkRhW','sdssdsd@gmail.com',0,'61eda3ed5e339',0,'','2022-01-23 18:52:31'),(22,'Administrador','$2y$10$PW9Rx9KFu4CfLlkRSHjkHeA5JjbYWRLW3TwWzhYvIc/XIu/0rIdlK','sdsssdsddsd@gmail.com',0,'61eda44038342',0,'','2022-01-23 18:53:54'),(24,'Administrador','$2y$10$pAPeL9QmyeCNX7jIvIVPgea6I5cVyhBD148pjkaIugpWBaVxWdbs2','alexandervillegads0516@gmail.com',1,'',0,'','2022-01-23 19:11:31'),(28,'Alexander','$2y$10$j94dMnXixxeq8LYgvDR.DuzFVRHgMZtyAsaoB6iTU25FuBlb3.8/y','xxkaisesse@gmail.com',1,'',0,'','2022-01-23 20:28:14');
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

-- Dump completed on 2022-01-24 12:02:22
