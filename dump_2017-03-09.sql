-- MySQL dump 10.13  Distrib 5.7.12, for osx10.9 (x86_64)
--
-- Host: localhost    Database: poker
-- ------------------------------------------------------
-- Server version	5.6.33

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `campeonato`
--

DROP TABLE IF EXISTS `campeonato`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `campeonato` (
  `id_campeonato` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(45) NOT NULL,
  `descricao` longtext,
  `data_inicio` datetime DEFAULT NULL,
  `data_fim` datetime DEFAULT NULL,
  `valor_partida` decimal(10,2) NOT NULL DEFAULT '0.00',
  `porcentagem_campeonato` decimal(10,2) NOT NULL DEFAULT '0.00',
  PRIMARY KEY (`id_campeonato`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `campeonato`
--

LOCK TABLES `campeonato` WRITE;
/*!40000 ALTER TABLE `campeonato` DISABLE KEYS */;
INSERT INTO `campeonato` VALUES (2,'Poker dos amigos','Campeonato restrito para amigos','2016-08-02 00:00:00','2016-12-12 00:00:00',10.00,20.00),(3,'Campeonato teste','Uma descrição de teste','2016-10-01 00:00:00','2016-12-15 00:00:00',10.00,20.00),(4,'Poker dos Amigos 2017/1','Campeonato restrito a amigos','2017-01-03 00:00:00','2017-06-27 00:00:00',10.00,20.00);
/*!40000 ALTER TABLE `campeonato` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `campeonato_pontuacao`
--

DROP TABLE IF EXISTS `campeonato_pontuacao`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `campeonato_pontuacao` (
  `id_campeonato_pontuacao` int(11) NOT NULL AUTO_INCREMENT,
  `id_campeonato` int(11) NOT NULL,
  `posicao` int(3) NOT NULL DEFAULT '1',
  `valor_pontuacao` decimal(10,2) NOT NULL DEFAULT '1.00',
  PRIMARY KEY (`id_campeonato_pontuacao`,`posicao`),
  KEY `fk_campeonato_pontuacao_campeonato1_idx` (`id_campeonato`),
  CONSTRAINT `fk_campeonato_pontuacao_campeonato1` FOREIGN KEY (`id_campeonato`) REFERENCES `campeonato` (`id_campeonato`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `campeonato_pontuacao`
--

LOCK TABLES `campeonato_pontuacao` WRITE;
/*!40000 ALTER TABLE `campeonato_pontuacao` DISABLE KEYS */;
INSERT INTO `campeonato_pontuacao` VALUES (1,2,1,23.00),(2,2,3,12.00),(3,2,4,8.00),(4,2,2,17.00),(5,2,5,5.00),(6,2,6,3.00),(7,2,7,2.00),(10,2,10,1.00),(11,2,8,1.00),(12,2,8,1.00),(18,2,11,1.00),(20,2,12,1.00);
/*!40000 ALTER TABLE `campeonato_pontuacao` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `campeonato_usuario`
--

DROP TABLE IF EXISTS `campeonato_usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `campeonato_usuario` (
  `id_campeonato_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` int(11) NOT NULL,
  `id_campeonato` int(11) NOT NULL,
  `administrador` int(1) DEFAULT '0' COMMENT '0 - Participante\n1 - Administrador',
  `status` int(1) NOT NULL DEFAULT '1' COMMENT '0 - Inativo\n1 - Ativo',
  PRIMARY KEY (`id_campeonato_usuario`),
  KEY `fk_usuario_has_campeonato_campeonato1_idx` (`id_campeonato`),
  KEY `fk_usuario_has_campeonato_usuario1_idx` (`id_usuario`),
  CONSTRAINT `fk_usuario_has_campeonato_campeonato1` FOREIGN KEY (`id_campeonato`) REFERENCES `campeonato` (`id_campeonato`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_usuario_has_campeonato_usuario1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `campeonato_usuario`
--

LOCK TABLES `campeonato_usuario` WRITE;
/*!40000 ALTER TABLE `campeonato_usuario` DISABLE KEYS */;
INSERT INTO `campeonato_usuario` VALUES (1,1,2,1,1),(2,4,2,0,1),(3,5,2,0,1),(4,1,4,1,1),(5,4,4,1,1),(6,5,4,0,1),(7,6,4,0,1),(8,7,4,0,1),(9,8,4,0,1),(10,10,4,0,0),(11,11,4,0,1),(12,12,4,0,1);
/*!40000 ALTER TABLE `campeonato_usuario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `partida`
--

DROP TABLE IF EXISTS `partida`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `partida` (
  `id_partida` int(11) NOT NULL AUTO_INCREMENT,
  `id_campeonato` int(11) NOT NULL,
  `data` datetime DEFAULT NULL,
  PRIMARY KEY (`id_partida`),
  KEY `fk_partida_campeonato_idx` (`id_campeonato`),
  CONSTRAINT `fk_partida_campeonato` FOREIGN KEY (`id_campeonato`) REFERENCES `campeonato` (`id_campeonato`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `partida`
--

LOCK TABLES `partida` WRITE;
/*!40000 ALTER TABLE `partida` DISABLE KEYS */;
INSERT INTO `partida` VALUES (1,4,'2017-01-10 00:00:00'),(2,4,'2017-01-17 00:00:00'),(3,4,'2017-01-24 00:00:00'),(4,4,'2017-01-30 00:00:00'),(5,4,'2017-02-07 00:00:00'),(6,4,'2017-02-14 00:00:00'),(7,4,'2017-02-21 00:00:00'),(8,4,'2017-03-07 00:00:00');
/*!40000 ALTER TABLE `partida` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `partida_usuario`
--

DROP TABLE IF EXISTS `partida_usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `partida_usuario` (
  `id_partida_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `id_campeonato_usuario` int(11) NOT NULL,
  `id_partida` int(11) NOT NULL,
  `pago` int(1) DEFAULT '0',
  `posicao` int(2) DEFAULT NULL,
  `id_campeonato_usuario_carrasco` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_partida_usuario`),
  KEY `fk_usuario_has_partida_partida1_idx` (`id_partida`),
  KEY `fk_partida_usuarios_campeonato_usuarios1_idx` (`id_campeonato_usuario`),
  KEY `fk_partida_usuarios_campeonato_usuarios2_idx` (`id_campeonato_usuario_carrasco`),
  CONSTRAINT `fk_partida_usuarios_campeonato_usuarios1` FOREIGN KEY (`id_campeonato_usuario`) REFERENCES `campeonato_usuario` (`id_campeonato_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_partida_usuarios_campeonato_usuarios2` FOREIGN KEY (`id_campeonato_usuario_carrasco`) REFERENCES `campeonato_usuario` (`id_campeonato_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_usuario_has_partida_partida1` FOREIGN KEY (`id_partida`) REFERENCES `partida` (`id_partida`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=115 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `partida_usuario`
--

LOCK TABLES `partida_usuario` WRITE;
/*!40000 ALTER TABLE `partida_usuario` DISABLE KEYS */;
INSERT INTO `partida_usuario` VALUES (1,4,1,0,7,NULL),(2,5,1,0,4,NULL),(3,7,1,0,2,NULL),(4,8,1,0,3,NULL),(5,9,1,0,6,NULL),(6,11,1,0,5,NULL),(7,12,1,0,1,NULL),(8,4,2,0,4,NULL),(9,5,2,0,2,NULL),(10,6,2,0,5,NULL),(11,7,2,0,7,NULL),(12,8,2,0,9,NULL),(13,9,2,0,3,NULL),(14,10,2,0,1,NULL),(15,11,2,0,6,NULL),(16,12,2,0,8,NULL),(23,4,3,0,7,NULL),(24,5,3,0,3,NULL),(25,7,3,0,5,NULL),(26,8,3,0,4,NULL),(27,9,3,0,1,NULL),(28,10,3,0,6,NULL),(29,11,3,0,8,NULL),(30,12,3,0,2,NULL),(38,4,4,0,3,NULL),(39,5,4,0,4,NULL),(40,6,4,0,9,NULL),(41,7,4,0,6,NULL),(42,8,4,0,2,NULL),(43,9,4,0,1,NULL),(44,11,4,0,8,NULL),(45,12,4,0,5,NULL),(53,4,5,0,8,NULL),(54,5,5,0,7,NULL),(55,6,5,0,6,NULL),(56,7,5,0,1,NULL),(57,8,5,0,5,NULL),(58,9,5,0,3,NULL),(59,11,5,0,2,NULL),(60,12,5,0,4,NULL),(68,4,6,0,2,NULL),(69,5,6,0,8,NULL),(70,6,6,0,1,NULL),(71,7,6,0,3,NULL),(72,8,6,0,7,NULL),(73,9,6,0,5,NULL),(74,11,6,0,4,NULL),(75,12,6,0,6,NULL),(83,4,7,0,7,NULL),(84,5,7,0,4,NULL),(86,7,7,0,2,NULL),(87,8,7,0,3,NULL),(88,9,7,0,6,NULL),(89,11,7,0,1,NULL),(90,12,7,0,5,NULL),(98,4,8,0,3,5),(99,5,8,0,2,NULL),(100,6,8,0,5,5),(101,7,8,0,1,NULL),(102,8,8,0,6,4),(103,9,8,0,4,4),(104,11,8,0,8,7),(105,12,8,0,7,5),(114,10,4,0,7,NULL);
/*!40000 ALTER TABLE `partida_usuario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuario`
--

DROP TABLE IF EXISTS `usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuario` (
  `id_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(80) NOT NULL,
  `email` varchar(80) NOT NULL,
  `senha` varchar(60) NOT NULL,
  `telefone` varchar(45) DEFAULT NULL,
  `status` int(1) DEFAULT '1' COMMENT '0 - Inativo, 1 - Ativo, 3 - Removido',
  PRIMARY KEY (`id_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario`
--

LOCK TABLES `usuario` WRITE;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` VALUES (1,'Felipe F. de Paula','felipe@finhane.com','40bd001563085fc35165329ea1ff5c5ecbdbbeef','19983396650',1),(4,'Emiliano Camargo','emiliano.camargo@gmail.com','40bd001563085fc35165329ea1ff5c5ecbdbbeef','19999999999',1),(5,'Renato Xavier','renato@opsweb.com.br','40bd001563085fc35165329ea1ff5c5ecbdbbeef','19999999998',1),(6,'Danilo ','danilo@ig.com.br','40bd001563085fc35165329ea1ff5c5ecbdbbeef','19999929292',1),(7,'Edinho','edinho@ig.com.br','40bd001563085fc35165329ea1ff5c5ecbdbbeef','192992392392',1),(8,'Nino','nino@ig.com.br','40bd001563085fc35165329ea1ff5c5ecbdbbeef','19992929292',1),(9,'Daniel Scherer','daniel.scherer@ig.com.br','40bd001563085fc35165329ea1ff5c5ecbdbbeef','19999992922',1),(10,'Turati','turati@ig.com.br','40bd001563085fc35165329ea1ff5c5ecbdbbeef','1999999999999',1),(11,'Carlao','carlos@ig.com.br','40bd001563085fc35165329ea1ff5c5ecbdbbeef','19999999231',1),(12,'Galego','galego@ig.com.br','40bd001563085fc35165329ea1ff5c5ecbdbbeef','19999999232',1);
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-03-08 23:52:17
