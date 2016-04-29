CREATE DATABASE  IF NOT EXISTS `chat_assignment` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `chat_assignment`;
-- MySQL dump 10.13  Distrib 5.6.22, for osx10.8 (x86_64)
--
-- Host: localhost    Database: chat_assignment
-- ------------------------------------------------------
-- Server version	5.6.22

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
-- Table structure for table `messages`
--

DROP TABLE IF EXISTS `messages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `messages` (
  `message_id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `to_name` varchar(20) DEFAULT NULL,
  `msg` varchar(255) NOT NULL,
  `posted` varchar(20) NOT NULL,
  `unread` binary(1) DEFAULT '0',
  PRIMARY KEY (`message_id`),
  KEY `name` (`name`),
  KEY `messages_fk_2` (`to_name`),
  CONSTRAINT `messages_fk_1` FOREIGN KEY (`name`) REFERENCES `chatters` (`name`) ON DELETE CASCADE,
  CONSTRAINT `messages_fk_2` FOREIGN KEY (`to_name`) REFERENCES `chatters` (`name`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=211 DEFAULT CHARSET=latin1;


--
-- Table structure for table `friends`
--

DROP TABLE IF EXISTS `friends`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `friends` (
  `name` varchar(20) NOT NULL,
  `friend` varchar(20) NOT NULL,
  UNIQUE KEY `unique_index` (`name`,`friend`),
  KEY `friend_fk_idx` (`friend`),
  CONSTRAINT `friend_fk` FOREIGN KEY (`friend`) REFERENCES `chatters` (`name`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `name_fk` FOREIGN KEY (`name`) REFERENCES `chatters` (`name`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;


--
-- Table structure for table `chatters`
--

DROP TABLE IF EXISTS `chatters`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `chatters` (
  `name` varchar(20) NOT NULL,
  `seen` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `onlinestatus` bit(1) DEFAULT b'0',
  PRIMARY KEY (`name`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;


/*!40101 SET character_set_client = @saved_cs_client */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2015-06-10 22:37:57
