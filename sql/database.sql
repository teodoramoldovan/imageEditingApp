-- MySQL dump 10.13  Distrib 5.7.27, for Linux (x86_64)
--
-- Host: localhost    Database: share_my_art
-- ------------------------------------------------------
-- Server version	5.7.27-0ubuntu0.18.04.1

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
-- Table structure for table `order_item`
--

DROP TABLE IF EXISTS `order_item`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `order_item` (
  `user_id` int(11) NOT NULL,
  `tier_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`user_id`,`tier_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order_item`
--

LOCK TABLES `order_item` WRITE;
/*!40000 ALTER TABLE `order_item` DISABLE KEYS */;
INSERT INTO `order_item` VALUES (1,1,'2019-08-01 00:00:00'),(1,2,'2019-08-01 00:00:00'),(1,4,'2019-08-01 00:00:00'),(1,9,'2019-08-01 00:00:00'),(1,57,'2019-08-01 00:00:00'),(2,7,'2019-08-01 00:00:00');
/*!40000 ALTER TABLE `order_item` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product`
--

DROP TABLE IF EXISTS `product`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `camera_specifications` text NOT NULL,
  `capture_date` datetime NOT NULL,
  `thumbnail_path` varchar(255) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product`
--

LOCK TABLES `product` WRITE;
/*!40000 ALTER TABLE `product` DISABLE KEYS */;
INSERT INTO `product` VALUES (1,'Doggo','It\'s a nice doggo','Nikon D5000','2019-07-09 00:00:00','5d42797e96aaa_thumbnail.png',1),(2,'Couple','Could have been us but..','Canon 350D 50 mm','2019-07-10 00:00:00','5d427a5224527_thumbnail.png',1),(3,'Heart tree','Reallyy? That\'s a tree?','iphone 7','2019-07-09 00:00:00','5d427aef4cd47_thumbnail.png',1),(4,'Green alley','Too romantic for my taste','Aperture 3.5f Exposure time 1/100','2019-07-31 00:00:00','5d427b5e28c49_thumbnail.png',1),(5,'Tiny Shiny Thingy','It\'s sooo shiny','Don\'t know','2019-07-01 00:00:00','5d427bbd1bcf1_thumbnail.png',2),(6,'Basic','Watery flippy','Canon 350D','2019-06-05 00:00:00','5d427c471ed64_thumbnail.png',2),(7,'Moon','Is this real?','Out of this world','2019-05-09 00:00:00','5d427caad3d8a_thumbnail.png',2),(8,'Doggo at sunset','On the beach','Nikon D3100 Lens: 70-150mm','2019-07-17 00:00:00','5d427d02a93f6_thumbnail.png',2),(9,'Rose','Boooring','Canon 350D','2019-07-15 00:00:00','5d42eafd080b9_thumbnail.png',1),(10,'Road','Loooong','obiective de valoare','2019-04-09 00:00:00','5d42eb28e6cdb_thumbnail.png',1),(11,'Rocky','Just rocks','Canon 350D','2019-07-15 00:00:00','5d42eb6112255_thumbnail.png',1),(12,'Tiger','scaaaary','Iphone XS','2019-07-17 00:00:00','5d42f199e20ef_thumbnail.png',1),(15,'Beach','I want to be there','Nikon D3100 Lens: 70-150mm','2019-07-18 00:00:00','5d42f317b6eab_thumbnail.png',1),(21,'Monkey','Funny face','Unknown','2019-07-08 00:00:00','5d432300df729_thumbnail.png',1);
/*!40000 ALTER TABLE `product` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product_tag`
--

DROP TABLE IF EXISTS `product_tag`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `product_tag` (
  `product_id` int(11) NOT NULL,
  `tag_id` int(11) NOT NULL,
  PRIMARY KEY (`product_id`,`tag_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_tag`
--

LOCK TABLES `product_tag` WRITE;
/*!40000 ALTER TABLE `product_tag` DISABLE KEYS */;
INSERT INTO `product_tag` VALUES (1,6),(1,9),(2,1),(2,5),(2,9),(4,1),(4,6),(6,2),(7,4),(8,7),(10,6),(11,10),(13,4),(14,4),(17,6);
/*!40000 ALTER TABLE `product_tag` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tag`
--

DROP TABLE IF EXISTS `tag`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tag` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tag_name` varchar(70) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `tag_name` (`tag_name`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tag`
--

LOCK TABLES `tag` WRITE;
/*!40000 ALTER TABLE `tag` DISABLE KEYS */;
INSERT INTO `tag` VALUES (1,'Aperture'),(6,'DepthOfField'),(9,'Grayscale'),(5,'LightPhotography'),(2,'Long exposure'),(3,'Macro'),(10,'ManualFocus'),(8,'Monochrome'),(4,'Nature'),(7,'Panorama');
/*!40000 ALTER TABLE `tag` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tier`
--

DROP TABLE IF EXISTS `tier`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tier` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `price` decimal(10,2) NOT NULL,
  `path_with_watermark` varchar(255) NOT NULL,
  `path_without_watermark` varchar(255) DEFAULT NULL,
  `size` enum('small','medium','large') NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `tier_index` (`size`,`product_id`)
) ENGINE=InnoDB AUTO_INCREMENT=58 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tier`
--

LOCK TABLES `tier` WRITE;
/*!40000 ALTER TABLE `tier` DISABLE KEYS */;
INSERT INTO `tier` VALUES (1,11.50,'5d42797e96aaa_small_watermark.png','5d42797e96aaa_small.png','small',1),(2,16.10,'5d42797e96aaa_medium_watermark.png','5d42797e96aaa_medium.png','medium',1),(3,23.00,'5d42797e96aaa_watermark.png','5d42797e96aaa.png','large',1),(4,6.00,'5d427a5224527_small_watermark.png','5d427a5224527_small.png','small',2),(5,8.40,'5d427a5224527_medium_watermark.png','5d427a5224527_medium.png','medium',2),(6,12.00,'5d427a5224527_watermark.png','5d427a5224527.png','large',2),(7,5.00,'5d427aef4cd47_small_watermark.png','5d427aef4cd47_small.png','small',3),(8,7.00,'5d427aef4cd47_medium_watermark.png','5d427aef4cd47_medium.png','medium',3),(9,10.00,'5d427aef4cd47_watermark.png','5d427aef4cd47.png','large',3),(10,6.50,'5d427b5e28c49_small_watermark.png','5d427b5e28c49_small.png','small',4),(11,9.10,'5d427b5e28c49_medium_watermark.png','5d427b5e28c49_medium.png','medium',4),(12,13.00,'5d427b5e28c49_watermark.png','5d427b5e28c49.png','large',4),(13,4.50,'5d427bbd1bcf1_small_watermark.png','5d427bbd1bcf1_small.png','small',5),(14,6.30,'5d427bbd1bcf1_medium_watermark.png','5d427bbd1bcf1_medium.png','medium',5),(15,9.00,'5d427bbd1bcf1_watermark.png','5d427bbd1bcf1.png','large',5),(16,5.00,'5d427c471ed64_small_watermark.png','5d427c471ed64_small.png','small',6),(17,7.00,'5d427c471ed64_medium_watermark.png','5d427c471ed64_medium.png','medium',6),(18,10.00,'5d427c471ed64_watermark.png','5d427c471ed64.png','large',6),(19,25.00,'5d427caad3d8a_small_watermark.png','5d427caad3d8a_small.png','small',7),(20,35.00,'5d427caad3d8a_medium_watermark.png','5d427caad3d8a_medium.png','medium',7),(21,50.00,'5d427caad3d8a_watermark.png','5d427caad3d8a.png','large',7),(22,12.50,'5d427d02a93f6_small_watermark.png','5d427d02a93f6_small.png','small',8),(23,17.50,'5d427d02a93f6_medium_watermark.png','5d427d02a93f6_medium.png','medium',8),(24,25.00,'5d427d02a93f6_watermark.png','5d427d02a93f6.png','large',8),(25,49.00,'5d42eafd080b9_small_watermark.png','5d42eafd080b9_small.png','small',9),(26,68.60,'5d42eafd080b9_medium_watermark.png','5d42eafd080b9_medium.png','medium',9),(27,98.00,'5d42eafd080b9_watermark.png','5d42eafd080b9.png','large',9),(28,17.00,'5d42eb28e6cdb_small_watermark.png','5d42eb28e6cdb_small.png','small',10),(29,23.80,'5d42eb28e6cdb_medium_watermark.png','5d42eb28e6cdb_medium.png','medium',10),(30,34.00,'5d42eb28e6cdb_watermark.png','5d42eb28e6cdb.png','large',10),(31,6.00,'5d42eb6112255_small_watermark.png','5d42eb6112255_small.png','small',11),(32,8.40,'5d42eb6112255_medium_watermark.png','5d42eb6112255_medium.png','medium',11),(33,12.00,'5d42eb6112255_watermark.png','5d42eb6112255.png','large',11),(34,2.50,'5d42f199e20ef_small_watermark.png','5d42f199e20ef_small.png','small',12),(35,3.50,'5d42f199e20ef_medium_watermark.png','5d42f199e20ef_medium.png','medium',12),(36,5.00,'5d42f199e20ef_watermark.png','5d42f199e20ef.png','large',12),(37,8.50,'5d42f23ac2114_small_watermark.png','5d42f23ac2114_small.png','small',13),(38,11.90,'5d42f23ac2114_medium_watermark.png','5d42f23ac2114_medium.png','medium',13),(39,17.00,'5d42f23ac2114_watermark.png','5d42f23ac2114.png','large',13),(40,8.50,'5d42f284005cd_small_watermark.png','5d42f284005cd_small.png','small',14),(41,11.90,'5d42f284005cd_medium_watermark.png','5d42f284005cd_medium.png','medium',14),(42,17.00,'5d42f284005cd_watermark.png','5d42f284005cd.png','large',14),(43,6.50,'5d42f317b6eab_small_watermark.png','5d42f317b6eab_small.png','small',15),(44,9.10,'5d42f317b6eab_medium_watermark.png','5d42f317b6eab_medium.png','medium',15),(45,13.00,'5d42f317b6eab_watermark.png','5d42f317b6eab.png','large',15),(46,6.50,'5d42f32ed5f75_small_watermark.png','5d42f32ed5f75_small.png','small',16),(47,9.10,'5d42f32ed5f75_medium_watermark.png','5d42f32ed5f75_medium.png','medium',16),(48,13.00,'5d42f32ed5f75_watermark.png','5d42f32ed5f75.png','large',16),(49,1.00,'5d43205885d16_small_watermark.png','5d43205885d16_small.png','small',17),(50,1.40,'5d43205885d16_medium_watermark.png','5d43205885d16_medium.png','medium',17),(51,2.00,'5d43205885d16_watermark.png','5d43205885d16.png','large',17),(52,6.00,'5d4321e6250dc_small_watermark.png','5d4321e6250dc_small.png','small',20),(53,8.40,'5d4321e6250dc_medium_watermark.png','5d4321e6250dc_medium.png','medium',20),(54,12.00,'5d4321e6250dc_watermark.png','5d4321e6250dc.png','large',20),(55,1.50,'5d432300df729_small_watermark.png','5d432300df729_small.png','small',21),(56,2.10,'5d432300df729_medium_watermark.png','5d432300df729_medium.png','medium',21),(57,3.00,'5d432300df729_watermark.png','5d432300df729.png','large',21);
/*!40000 ALTER TABLE `tier` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'Ion Gheorghe','ion@gheorghe.com','$2y$10$DUUHboBzET/Nq8a/jv7ZxO4gkvZkzO4sILVNBIhEtOx4cMZWcE6XK'),(2,'Elena Ilie','elena@yahoo.com','$2y$10$KMzyrrKj9iU74VPJmqpJdORFCmZ63IDmDTUzEbyW0BtmkXbD73gsa'),(3,'Moloz','hola@gmail.com','$2y$10$GadDYZGBcGoSLyATzEb8o.aVdv16e6vE8HnvMn722mvou3dwkg8e2');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-08-01 20:45:38
