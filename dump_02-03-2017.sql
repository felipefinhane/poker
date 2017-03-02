/*
 Navicat Premium Backup

 Source Server         : Localhot
 Source Server Type    : MySQL
 Source Server Version : 50633
 Source Host           : localhost
 Source Database       : poker

 Target Server Type    : MySQL
 Target Server Version : 50633
 File Encoding         : utf-8

 Date: 03/02/2017 00:10:37 AM
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
--  Table structure for `campeonato`
-- ----------------------------
DROP TABLE IF EXISTS `campeonato`;
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

-- ----------------------------
--  Records of `campeonato`
-- ----------------------------
BEGIN;
INSERT INTO `campeonato` VALUES ('2', 'Poker dos amigos', 'Campeonato restrito para amigos', '2016-08-02 00:00:00', '2016-12-12 00:00:00', '10.00', '20.00'), ('3', 'Campeonato teste', 'Uma descrição de teste', '2016-10-01 00:00:00', '2016-12-15 00:00:00', '10.00', '20.00'), ('4', 'Poker dos Amigos 2017/1', 'Campeonato restrito a amigos', '2017-01-03 00:00:00', '2017-06-27 00:00:00', '10.00', '20.00');
COMMIT;

-- ----------------------------
--  Table structure for `campeonato_pontuacao`
-- ----------------------------
DROP TABLE IF EXISTS `campeonato_pontuacao`;
CREATE TABLE `campeonato_pontuacao` (
  `id_campeonato_pontuacao` int(11) NOT NULL AUTO_INCREMENT,
  `id_campeonato` int(11) NOT NULL,
  `posicao` int(3) NOT NULL DEFAULT '1',
  `valor_pontuacao` decimal(10,2) NOT NULL DEFAULT '1.00',
  PRIMARY KEY (`id_campeonato_pontuacao`,`posicao`),
  KEY `fk_campeonato_pontuacao_campeonato1_idx` (`id_campeonato`),
  CONSTRAINT `fk_campeonato_pontuacao_campeonato1` FOREIGN KEY (`id_campeonato`) REFERENCES `campeonato` (`id_campeonato`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `campeonato_pontuacao`
-- ----------------------------
BEGIN;
INSERT INTO `campeonato_pontuacao` VALUES ('1', '2', '1', '23.00'), ('2', '2', '3', '12.00'), ('3', '2', '4', '8.00'), ('4', '2', '2', '17.00'), ('5', '2', '5', '5.00'), ('6', '2', '6', '3.00'), ('7', '2', '7', '2.00'), ('10', '2', '10', '1.00'), ('11', '2', '8', '1.00'), ('12', '2', '8', '1.00'), ('18', '2', '11', '1.00'), ('20', '2', '12', '1.00');
COMMIT;

-- ----------------------------
--  Table structure for `campeonato_usuario`
-- ----------------------------
DROP TABLE IF EXISTS `campeonato_usuario`;
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

-- ----------------------------
--  Records of `campeonato_usuario`
-- ----------------------------
BEGIN;
INSERT INTO `campeonato_usuario` VALUES ('1', '1', '2', '1', '1'), ('2', '4', '2', '0', '1'), ('3', '5', '2', '0', '1'), ('4', '1', '4', '1', '1'), ('5', '4', '4', '1', '1'), ('6', '5', '4', '0', '1'), ('7', '6', '4', '0', '1'), ('8', '7', '4', '0', '1'), ('9', '8', '4', '0', '1'), ('10', '10', '4', '0', '0'), ('11', '11', '4', '0', '1'), ('12', '12', '4', '0', '1');
COMMIT;

-- ----------------------------
--  Table structure for `partida`
-- ----------------------------
DROP TABLE IF EXISTS `partida`;
CREATE TABLE `partida` (
  `id_partida` int(11) NOT NULL AUTO_INCREMENT,
  `id_campeonato` int(11) NOT NULL,
  `data` datetime DEFAULT NULL,
  PRIMARY KEY (`id_partida`),
  KEY `fk_partida_campeonato_idx` (`id_campeonato`),
  CONSTRAINT `fk_partida_campeonato` FOREIGN KEY (`id_campeonato`) REFERENCES `campeonato` (`id_campeonato`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `partida_usuario`
-- ----------------------------
DROP TABLE IF EXISTS `partida_usuario`;
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

-- ----------------------------
--  Table structure for `usuario`
-- ----------------------------
DROP TABLE IF EXISTS `usuario`;
CREATE TABLE `usuario` (
  `id_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(80) NOT NULL,
  `email` varchar(80) NOT NULL,
  `senha` varchar(60) NOT NULL,
  `telefone` varchar(45) DEFAULT NULL,
  `status` int(1) DEFAULT '1' COMMENT '0 - Inativo, 1 - Ativo, 3 - Removido',
  PRIMARY KEY (`id_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `usuario`
-- ----------------------------
BEGIN;
INSERT INTO `usuario` VALUES ('1', 'Felipe F. de Paula', 'felipe@finhane.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '19983396650', '1'), ('4', 'Emiliano Camargo', 'emiliano.camargo@gmail.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '19999999999', '1'), ('5', 'Renato Xavier', 'renato@opsweb.com.br', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '19999999998', '1'), ('6', 'Danilo ', 'danilo@ig.com.br', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '19999929292', '1'), ('7', 'Edinho', 'edinho@ig.com.br', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '192992392392', '1'), ('8', 'Nino', 'nino@ig.com.br', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '19992929292', '1'), ('9', 'Daniel Scherer', 'daniel.scherer@ig.com.br', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '19999992922', '1'), ('10', 'Turati', 'turati@ig.com.br', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '1999999999999', '1'), ('11', 'Carlao', 'carlos@ig.com.br', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '19999999231', '1'), ('12', 'Galego', 'galego@ig.com.br', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '19999999232', '1');
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;
