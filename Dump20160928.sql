-- MySQL dump 10.13  Distrib 5.7.12, for osx10.9 (x86_64)
--
-- Host: localhost    Database: poker
-- ------------------------------------------------------
-- Server version	5.6.31

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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `campeonato`
--

LOCK TABLES `campeonato` WRITE;
/*!40000 ALTER TABLE `campeonato` DISABLE KEYS */;
INSERT INTO `campeonato` VALUES (2,'Poker dos amigos','Campeonato restrito para amigos','2016-08-02 00:00:00','2016-12-12 00:00:00',10.00,20.00);
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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `campeonato_usuario`
--

LOCK TABLES `campeonato_usuario` WRITE;
/*!40000 ALTER TABLE `campeonato_usuario` DISABLE KEYS */;
INSERT INTO `campeonato_usuario` VALUES (1,1,2,1,1),(2,4,2,0,1),(3,5,2,0,1);
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `partida`
--

LOCK TABLES `partida` WRITE;
/*!40000 ALTER TABLE `partida` DISABLE KEYS */;
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
  `id_usuario` int(11) NOT NULL,
  `id_partida` int(11) NOT NULL,
  `pago` int(1) DEFAULT '0',
  `posicao` int(2) DEFAULT NULL,
  `id_usuario_carrasco` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_partida_usuario`),
  KEY `fk_usuario_has_partida_partida1_idx` (`id_partida`),
  KEY `fk_partida_usuarios_campeonato_usuarios1_idx` (`id_usuario`),
  KEY `fk_partida_usuarios_campeonato_usuarios2_idx` (`id_usuario_carrasco`),
  CONSTRAINT `fk_partida_usuarios_campeonato_usuarios1` FOREIGN KEY (`id_usuario`) REFERENCES `campeonato_usuario` (`id_campeonato_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_partida_usuarios_campeonato_usuarios2` FOREIGN KEY (`id_usuario_carrasco`) REFERENCES `campeonato_usuario` (`id_campeonato_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_usuario_has_partida_partida1` FOREIGN KEY (`id_partida`) REFERENCES `partida` (`id_partida`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `partida_usuario`
--

LOCK TABLES `partida_usuario` WRITE;
/*!40000 ALTER TABLE `partida_usuario` DISABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario`
--

LOCK TABLES `usuario` WRITE;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` VALUES (1,'Felipe F. de Paula','felipe@finhane.com','da39a3ee5e6b4b0d3255bfef95601890afd80709','19983396650',1),(4,'Emiliano Camargo','emiliano.camargo@gmail.com','7c4a8d09ca3762af61e59520943dc26494f8941b','19999999999',1),(5,'Renato Xavier','renato@opsweb.com.br','7c4a8d09ca3762af61e59520943dc26494f8941b','19999999998',1),(6,'Danilo ','danilo@ig.com.br','7c4a8d09ca3762af61e59520943dc26494f8941b','19999929292',1),(7,'Edinho','edinho@ig.com.br','7c4a8d09ca3762af61e59520943dc26494f8941b','192992392392',1),(8,'Nino','nino@ig.com.br','7c4a8d09ca3762af61e59520943dc26494f8941b','19992929292',1),(9,'Daniel Scherer','daniel.scherer@ig.com.br','7c4a8d09ca3762af61e59520943dc26494f8941b','19999992922',1),(10,'Turati','turati@ig.com.br','7c4a8d09ca3762af61e59520943dc26494f8941b','1999999999999',1);
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

-- Dump completed on 2016-09-28 23:42:54
