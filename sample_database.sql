/*
SQLyog Ultimate v9.51 
MySQL - 5.6.24 : Database - tvz_skladiste
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`tvz_skladiste` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `tvz_skladiste`;

/*Table structure for table `categories` */

DROP TABLE IF EXISTS `categories`;

CREATE TABLE `categories` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `category_name` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

/*Data for the table `categories` */

insert  into `categories`(`id`,`category_name`,`created_at`,`updated_at`) values (1,'Grafičke kartice','2016-04-04 15:59:26','2016-04-04 16:37:53'),(3,'Memorija','2016-04-04 16:38:05','2016-04-04 16:38:05'),(4,'Diskovi','2016-04-04 16:38:14','2016-04-04 16:38:14'),(5,'Monitori','2016-04-04 16:38:20','2016-04-04 16:38:20'),(6,'Kuči&scaron;ta','2016-04-04 16:38:28','2016-04-04 16:38:28'),(7,'Mi&scaron;evi','2016-04-04 16:38:39','2016-04-04 16:38:39'),(8,'Tipkovnice','2016-04-04 16:38:48','2016-04-04 16:38:48'),(9,'Hladnjaci','2016-04-04 16:38:54','2016-04-04 16:38:54'),(10,'Procesori','2016-04-04 16:39:02','2016-04-04 16:39:02'),(11,'Ostalo','2016-04-04 16:39:28','2016-04-04 16:39:28'),(12,'Matične ploče','2016-04-07 16:19:38','2016-04-07 16:19:38');

/*Table structure for table `items` */

DROP TABLE IF EXISTS `items`;

CREATE TABLE `items` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `item_name` varchar(255) NOT NULL,
  `item_price` double unsigned NOT NULL,
  `item_availability` int(10) unsigned NOT NULL DEFAULT '1',
  `item_quantity` int(10) NOT NULL DEFAULT '1',
  `category_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `FK_category_id_idx` (`category_id`),
  CONSTRAINT `FK_category_id` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=78 DEFAULT CHARSET=utf8;

/*Data for the table `items` */

insert  into `items`(`id`,`item_name`,`item_price`,`item_availability`,`item_quantity`,`category_id`,`created_at`,`updated_at`) values (1,'PCI-E SAPPHIRE AMD RADEON R7',1266,0,0,1,'0000-00-00 00:00:00','2016-04-10 12:56:34'),(2,'Kingston DDR3 4GB',250,1,100,3,'2016-04-05 18:14:03','2016-04-05 18:38:35'),(4,'Matična ploča ASROCK 970 EXTREME3 R2.0, AMD 970/SB950, DDR3, zvuk, SATA, G-LAN, RAID',664,1,15,12,'2016-04-07 16:20:08','2016-04-07 16:20:08'),(5,'Matična ploča ASROCK 970 PRO3, AMD 970/SB950, DDR3, zvuk, SATA, G-LAN, RAID, PCI-E, CrossFireX',521,1,124,12,'2016-04-07 16:20:24','2016-04-07 16:20:24'),(6,'Matična ploča ASROCK 990FX EXTREME3, AMD 990FX/SB950, DDR3, zvuk, S-ATA, RAID, G-LAN',873,1,12,12,'2016-04-07 16:20:34','2016-04-07 16:20:34'),(7,'Matična ploča ASROCK AM1B-ITX, AMD AM1, DDR3, zvuk, VGA, SATA, G-LAN, PCI-E, USB 3.0, D-SUB, DVI',265,1,56,12,'2016-04-07 16:20:51','2016-04-07 16:20:51'),(8,'Matična ploča ASROCK B150M-ITX, Intel B150, DDR4, zvuk, S-ATA, G-LAN, PCI-E 3.0, DVI, HDMI, USB',730,1,60,12,'2016-04-07 16:21:03','2016-04-07 16:21:03'),(9,'Matična ploča ASROCK B85M-DGS, Intel B85, DDR3, G-LAN, PCI-E 3.0, USB 3.0, D-SUB, DVI, mATX, s. 1150',474,1,32,12,'2016-04-07 16:21:15','2016-04-11 17:54:03'),(10,'Procesor AMD A10 X4 7800 BOX, s. FM2+, 3.9GHz, 4MB cache, GPU R7, Quad Core',1110,1,15,10,'2016-04-07 16:21:40','2016-04-07 16:21:40'),(11,'Procesor AMD A10 X4 7850K BOX, Black Edition, s. FM2+, 4.0GHz, 4MB cache, GPU R7, Quad Core',939,1,2,10,'2016-04-07 16:21:57','2016-04-07 16:21:57'),(12,'Procesor AMD A10 X4 7870K BOX, s. FM2+, 3.9GHz, 4MB cache, GPU R7, Quad Core',1139,1,50,10,'2016-04-07 16:22:08','2016-04-10 12:56:38'),(13,'Procesor INTEL Celeron G1840 BOX, s. 1150, 2.8GHz, 2MB cache, DualCore, GPU',341,0,0,10,'2016-04-07 16:22:49','2016-04-07 16:34:42'),(14,'Procesor INTEL Core i3 4170 BOX, s. 1150, 3.7GHz, 3MB cache, GPU, Dual Core',1006,1,26,10,'2016-04-07 16:23:02','2016-04-07 16:23:02'),(15,'Procesor INTEL Core i3 4330 BOX, s. 1150, 3.5GHz, 4MB cache, GPU, Dual Core',1215,1,64,10,'2016-04-07 16:23:12','2016-04-09 15:33:37'),(16,'Procesor INTEL Core i7 5960X Extreme Edition, s. 2011-3, 3.0GHz, 20MB cache, Eight Core',9499,1,10,10,'2016-04-07 16:23:32','2016-04-11 16:49:13'),(17,'Cooler ARCTIC COOLING Freezer 13 CO, s. 775/1155/1150/1156/754/939/AM2/AM3/FM2/FM1',236,1,11,9,'2016-04-07 16:24:03','2016-04-10 12:56:21'),(18,'Cooler ARCTIC COOLING Freezer 13 Limited Edition, s 775/1366/1156/1155/AM3/AM2/939/940/754',259,1,123,9,'2016-04-07 16:24:14','2016-04-11 16:49:38'),(19,'Cooler COOLERMASTER GEMIN II M4, 1155/1156/1150/1366/AM3+/AM3/AM2+/AM2',263,0,0,9,'2016-04-07 16:24:27','2016-04-09 14:33:27'),(20,'Cooler COOLERMASTER Hyper 412S, 775/1155/1156/1366/AM3/AM2+/AM2',265,1,22,9,'2016-04-07 16:24:39','2016-04-10 12:56:19'),(21,'Cooler LC POWER LC-CC-120-X3 Airazor, socket 775/1150/1155/1156/1366/2011/AM2/AM2+/AM3/AM3+',596,1,5,9,'2016-04-07 16:24:52','2016-04-09 14:33:49'),(22,'Cooler NOCTUA NH-L9i, socket 1150/1155/1156',331,1,52,9,'2016-04-07 16:25:05','2016-04-07 16:25:05'),(23,'Memorija PC-10600, 16 GB, G.SKILL DDR3 series, F3-10600CL9D-16GBNT, DDR3 ',672,1,80,3,'2016-04-07 16:25:39','2016-04-07 16:25:39'),(24,'Memorija PC-10600, 2 GB, G.SKILL NS series, F3-10600CL9S-2GBNS, DDR3 1333MHz',103,1,8,3,'2016-04-07 16:25:50','2016-04-07 16:25:50'),(25,'Memorija PC-10666, 16 GB, G.SKILL Ripjaws series, F3-10666CL9D-16GBXL, DDR3 1333',645,1,8,3,'2016-04-07 16:26:02','2016-04-09 15:33:57'),(26,'Memorija PC-10666, 4 GB G.SKILL Ripjaws series, F3-10666CL7D-4GBRH, DDR3 1333MHz, kit 2x2GB ',265,1,53,3,'2016-04-07 16:26:22','2016-04-11 16:55:12'),(27,'Memorija PC-10666, 4 GB, G.SKILL DDR3 Series, F3-10666CL9D-4GBNQ, DDR3 1333 MHz, KIT 2x2 ',236,1,65,3,'2016-04-07 16:26:32','2016-04-07 16:26:32'),(28,'Memorija PC-12800, 16 GB (2x8GB), G.SKILL Ripjaws X series, F3-12800CL10D-16GBXL, DDR3 ',645,1,78,3,'2016-04-07 16:26:43','2016-04-07 16:26:43'),(29,'Memorija PC-12800, 16 GB, MUSHKIN RadioActive FrostByte, 997069Y, DDR3 1600MHz, kit 2x8GB',664,0,0,3,'2016-04-07 16:27:02','2016-04-07 16:34:37'),(30,'SSD 1000 GB SAMSUNG 850 Pro Series Basic, MZ-7KE1T0BW 550/520 MB/s',3149,1,64,4,'2016-04-07 16:27:27','2016-04-09 15:33:49'),(31,'SSD 1000.0 GB SAMSUNG 850 EVO Basic, MZ-75E1T0B, SATA 3, 2.5&quot;, 540/520 MB/s',2754,1,11,4,'2016-04-07 16:27:37','2016-04-11 16:49:44'),(32,'SSD 120.0 GB CORSAIR Force LS series CSSD-F120GBLSB, SATA3, 2.5&quot;, maks. do 540/450 MB/s',464,1,235,4,'2016-04-07 16:27:49','2016-04-07 16:27:49'),(33,'SSD 240.0 GB INTEL Series 535, SSDSC2BW240H601, SATA3, 2.5&quot;, MLC-Chip, maks. do 540/490 MB/s',759,0,0,4,'2016-04-07 16:28:03','2016-04-07 16:34:28'),(34,'SSD 240.0 GB INTEL Series 730, SSDSC2BP240G4R5, SATA3, 2.5&quot;, MLC-Chip, maks do 550/470 MB/s',1424,1,2,4,'2016-04-07 16:28:38','2016-04-09 15:33:54'),(35,'SSD 240.0 GB MUSHKIN Chronos G2, MKNSSDCR240GB-G2, SATA3, 2.5&quot;, MLC Chip, maks do 555/535 ',658,1,4,4,'2016-04-07 16:31:08','2016-04-07 16:31:08'),(36,'Tvrdi disk 1000.0 GB WESTERN DIGITAL Blue, WD10EZRZ, SATA3, 64MB cache, 5400okr./min, 3.5',445,1,65,4,'2016-04-07 16:31:27','2016-04-07 16:31:27'),(37,'Tvrdi disk 1000.0 GB SEAGATE ST1000VX000 Surveillanace (SV 35 Series), SATA3, 64MB cache, 7200',493,1,323,4,'2016-04-07 16:31:37','2016-04-07 16:31:37'),(38,'Tvrdi disk 1000.0 GB WESTERN DIGITAL Red, WD10EFRX, SATA3, 64MB cache, IntelliPower, 3.5',588,1,13,4,'2016-04-07 16:31:46','2016-04-11 16:54:57'),(39,'Tvrdi disk 2000.0 GB SEAGATE ST2000DM001, SATA, 64MB cache, 7200 okr/min, 3.5&quot;, za desktop',645,1,74,4,'2016-04-07 16:32:00','2016-04-11 16:55:00'),(40,'Tvrdi disk 2000.0 GB SEAGATE ST2000VM003 Pipeline, SATA3, 64MB cache, 5900 okr./min, 3.5',711,1,32,4,'2016-04-07 16:32:13','2016-04-11 17:49:27'),(41,'Tvrdi disk 2000.0 GB WESTERN DIGITAL Green, WD20EZRX, SATA3, 64MB cache, IntelliSeek, 3.5',702,0,0,4,'2016-04-07 16:32:23','2016-04-07 16:34:21'),(42,'Grafička kartica GAINWARD GeForce GTX 980 Ti Phoenix GS, 6GB DDR5, DVI, HDMI',6174,1,122,1,'2016-04-07 16:32:51','2016-04-07 16:32:51'),(43,'Grafička kartica PCI-E ASUS AMD RADEON R5 230 Silent, 2GB DDR3, D-SUB, DVI, HDMI',455,1,334,1,'2016-04-07 16:33:00','2016-04-07 16:33:00'),(44,'Grafička kartica PCI-E ASUS GeForce GTX 750 Ti, GTX750TI-OC-2GD5, 2GB DDR5, D-SUB, DVI',1234,1,77,1,'2016-04-07 16:33:10','2016-04-07 16:33:10'),(45,'Grafička kartica PCI-E ASUS GeForce GTX 960 Strix DC2 4GD5, 4GB DDR5, DVI, HDMI, DP',2172,0,0,1,'2016-04-07 16:33:19','2016-04-07 16:34:32'),(46,'Grafička kartica PCI-E ASUS GeForce GTX 960 Turbo OC 2GD5, 2GB DDR5, DVI, HDMI, DP',1899,1,333,1,'2016-04-07 16:33:30','2016-04-07 16:33:30'),(47,'Kući&scaron;te LC POWER 977B Big Block, mATX, crno, bez napajanja',599,1,98,6,'2016-04-07 16:35:17','2016-04-07 16:35:17'),(48,'Kući&scaron;te ANTEC GX300, MIDI, crno, bez napajanja',312,1,56,6,'2016-04-07 16:35:26','2016-04-07 16:35:26'),(49,'Kući&scaron;te ANTEC P380, Full Tower, bez napajanja',1519,1,45,6,'2016-04-07 16:35:37','2016-04-07 16:35:37'),(50,'Kući&scaron;te BITFENIX Colossus M, mITX, USB 3.0, crno-crveno, bez PS',550,0,0,6,'2016-04-07 16:35:49','2016-04-07 16:35:49'),(51,'Kući&scaron;te BITFENIX Aegis Core, mATX, USB 3.0, crno, bez PS',721,1,33,6,'2016-04-07 16:36:04','2016-04-07 16:36:04'),(52,'Kući&scaron;te BITFENIX Phenom, mITX, USB 3.0, crno, bez PS',626,1,65,6,'2016-04-07 16:36:13','2016-04-07 16:36:13'),(53,'Kući&scaron;te CHIEFTEC Libra Series LF-02B-OP, MIDI, crno, bez napajanja',417,1,68,6,'2016-04-07 16:36:23','2016-04-07 16:36:23'),(54,'Kući&scaron;te COOLERMASTER 690 III, CMS-693-KKN1, MIDI, crno, bez napajanja',664,1,33,6,'2016-04-07 16:36:33','2016-04-07 16:36:33'),(55,'Kući&scaron;te CHIEFTEC Libra Series LG-01B-OP, MIDI, crno, bez napajanja',284,1,63,6,'2016-04-07 16:36:43','2016-04-07 16:36:43'),(56,'Mi&scaron; GAMDIAS Ourea Optical, 2500dpi, crni, USB',149,1,988,7,'2016-04-07 16:37:25','2016-04-07 16:37:25'),(57,'Mi&scaron; LOGITECH G302 Daedalus Prime, Gaming, optički, 4000dpi, crni, USB',299,1,8057,7,'2016-04-07 16:37:35','2016-04-10 12:56:24'),(58,'Mi&scaron; STEELSERIES Rival 300, optički, 6500cpi, crni, USB',449,1,33,7,'2016-04-07 16:37:45','2016-04-07 16:37:45'),(59,'Slu&scaron;alice STEELSERIES 3H v2, crne',199,1,12,11,'2016-04-07 16:37:55','2016-04-11 17:54:47'),(60,'Tipkovnica RAZER DeathStalker Essential 2014, gaming keyboard, crna, USB',449,1,333,8,'2016-04-07 16:38:05','2016-04-07 16:38:05'),(61,'3D Printer xyzPrinting Da Vinci 1.0s AiO, 3D printer, skener, ABS/PLA, USB',6174,1,60,11,'2016-04-07 16:38:17','2016-04-10 11:42:01'),(62,'3D Printer xyzPrinting Da Vinci 1.0a, ABS/PLA, USB',4599,1,2,11,'2016-04-07 16:38:26','2016-04-10 11:44:01'),(63,'Bar code čitač ZEBEX Z-3100U-K, 1D, LED, USB, bijeli',407,1,333,11,'2016-04-07 16:38:35','2016-04-10 11:46:43'),(64,'Dispenzer Scotch C38, crni',14,1,190,11,'2016-04-07 16:38:48','2016-04-07 16:38:48'),(65,'Tipkovnica APPLE žična, HR znakovi, mb110cr/b',474,1,334,8,'2016-04-07 16:39:25','2016-04-07 16:39:25'),(66,'Tipkovnica COOLERMASTER STORM QuickFire XTi Brown, mehanička, USB',949,1,32,8,'2016-04-07 16:39:34','2016-04-07 16:39:34'),(67,'Tipkovnica Das Keyboard 4 Professional, MX brown, DE + HR layout, USB',1424,1,876,8,'2016-04-07 16:39:44','2016-04-07 16:39:44'),(68,'Tipkovnica Das Keyboard 4 Professional, MX blue, UK + HR layout, USB',1424,0,0,8,'2016-04-07 16:39:55','2016-04-07 16:39:55'),(69,'Tipkovnica Das Keyboard 4 Ultimate, MX blue, USB',1395,1,987,8,'2016-04-07 16:40:05','2016-04-07 16:40:05'),(70,'Tipkovnica G.SKILL Ripjaws KM780 RGB, mehanička, crna, USB',1424,1,65,8,'2016-04-07 16:40:26','2016-04-07 16:40:26'),(71,'Mi&scaron; G.SKILL RIPJAWS MX780 RGB, 8200dpi, USB, crni',474,1,676,7,'2016-04-07 16:40:48','2016-04-07 16:40:48'),(72,'Mi&scaron; GENIUS DeathTaker, Gaming, laserski, macro, 5700dpi, USB',284,1,21,7,'2016-04-07 16:40:57','2016-04-10 12:56:27'),(73,'Mi&scaron; GENIUS NX-7000, BlueEye, USB, bežični, bijeli',65,1,25,7,'2016-04-07 16:41:08','2016-04-11 18:30:06'),(74,'Mi&scaron; GENIUS NX-7000, BlueEye, USB, bežični, crveni',65,1,61,7,'2016-04-07 16:41:18','2016-04-10 12:56:26'),(75,'Mi&scaron; GENIUS X-G300, Gaming, optički, 2000dpi, crni, USB',132,1,78,7,'2016-04-07 16:41:28','2016-04-07 16:41:28');

/*Table structure for table `items_cart` */

DROP TABLE IF EXISTS `items_cart`;

CREATE TABLE `items_cart` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `item_id` int(10) unsigned NOT NULL,
  `quantity` int(10) NOT NULL DEFAULT '1',
  `order_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `FK_item_id_cart_idx` (`item_id`),
  KEY `FK_order_id_cart_idx` (`order_id`),
  CONSTRAINT `FK_item_id_cart` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_order_id_cart` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8;

/*Data for the table `items_cart` */

insert  into `items_cart`(`id`,`item_id`,`quantity`,`order_id`,`created_at`,`updated_at`) values (1,62,3,1,'2016-04-09 14:28:35','2016-04-09 14:28:35'),(2,61,1,1,'2016-04-09 14:32:27','2016-04-09 14:32:27'),(4,17,1,1,'2016-04-09 14:32:34','2016-04-09 14:32:34'),(7,15,2,1,'2016-04-09 14:50:15','2016-04-09 14:50:15'),(8,15,3,2,'2016-04-09 15:33:37','2016-04-09 15:33:37'),(9,30,1,2,'2016-04-09 15:33:49','2016-04-09 15:33:49'),(11,31,1,2,'2016-04-09 15:33:51','2016-04-09 15:33:51'),(12,34,1,2,'2016-04-09 15:33:54','2016-04-09 15:33:54'),(13,25,1,2,'2016-04-09 15:33:57','2016-04-09 15:33:57'),(18,61,1,4,'2016-04-10 11:42:01','2016-04-10 11:42:01'),(20,20,14,5,'2016-04-10 12:56:19','2016-04-10 12:56:19'),(21,17,3,5,'2016-04-10 12:56:21','2016-04-10 12:56:21'),(22,57,1,5,'2016-04-10 12:56:24','2016-04-10 12:56:24'),(23,74,1,5,'2016-04-10 12:56:26','2016-04-10 12:56:26'),(24,72,1,5,'2016-04-10 12:56:27','2016-04-10 12:56:27'),(25,1,2,5,'2016-04-10 12:56:34','2016-04-10 12:56:34'),(26,12,14,5,'2016-04-10 12:56:38','2016-04-10 12:56:38'),(29,16,3,6,'2016-04-11 16:49:13','2016-04-11 16:49:13'),(30,40,12,6,'2016-04-11 16:49:20','2016-04-11 16:49:20'),(31,38,20,7,'2016-04-11 16:54:57','2016-04-11 16:54:57'),(32,39,15,7,'2016-04-11 16:55:00','2016-04-11 16:55:00'),(35,26,16,7,'2016-04-11 16:55:12','2016-04-11 16:55:12');

/*Table structure for table `orders` */

DROP TABLE IF EXISTS `orders`;

CREATE TABLE `orders` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `order_date` datetime NOT NULL,
  `order_status` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `order_price` int(10) unsigned NOT NULL DEFAULT '0',
  `user_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `FK_user_id_idx` (`user_id`),
  CONSTRAINT `FK_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

/*Data for the table `orders` */

insert  into `orders`(`id`,`order_date`,`order_status`,`order_price`,`user_id`,`created_at`,`updated_at`) values (1,'2016-04-09 14:20:03',1,5242,5,'2016-04-09 14:20:03','2016-04-09 15:33:30'),(2,'2016-04-09 15:33:37',1,5994,5,'2016-04-09 15:33:37','2016-04-11 17:54:47'),(4,'2016-04-10 11:41:47',1,259,5,'2016-04-10 11:41:47','2016-04-10 12:46:34'),(5,'2016-04-10 12:56:19',1,11604,6,'2016-04-10 12:56:19','2016-04-10 12:56:46'),(6,'2016-04-11 16:48:54',1,39780,5,'2016-04-11 16:48:54','2016-04-11 16:49:47'),(7,'2016-04-11 16:54:57',1,74516,6,'2016-04-11 16:54:57','2016-04-11 17:54:03');

/*Table structure for table `user_groups` */

DROP TABLE IF EXISTS `user_groups`;

CREATE TABLE `user_groups` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `group_name` varchar(60) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

/*Data for the table `user_groups` */

insert  into `user_groups`(`id`,`group_name`) values (1,'User'),(2,'Seller'),(3,'Manager'),(4,'Administrator');

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(60) NOT NULL,
  `password` varchar(60) NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `group_id` int(10) unsigned NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username_UNIQUE` (`username`),
  UNIQUE KEY `email_UNIQUE` (`email`),
  KEY `FK_group_id_idx` (`group_id`),
  CONSTRAINT `FK_group_id` FOREIGN KEY (`group_id`) REFERENCES `user_groups` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

/*Data for the table `users` */

insert  into `users`(`id`,`username`,`password`,`remember_token`,`full_name`,`email`,`group_id`,`created_at`,`updated_at`) values (3,'dfodor','$2y$10$3GanB61hOQeHq5D..dlEue.fa85vF5qJXdnY.2JnT3jAkLJaoS8fu','2cFh3A3XobDcyAylwawL1pS5TSkNWI83zyRslF0OY2lp1F980wQ7De6uOLfn','Denis Fodor','dfodor@tvz.hr',3,'2016-03-28 15:44:55','2016-04-02 14:43:54'),(4,'prodavac','$2y$10$k9CShiUI.drGYUBZ6DSIiO10FxUESieEFuFqYHlJigkCcbXxvC0oS','yqQYt1mxuIQH0CR7czwxyk5ztC7QnmQBJFFfbJIGM2brQnKMw9kPH78RhzzW','Pero Perić','pero@tvz.hr',2,'2016-03-28 15:49:23','2016-04-03 11:16:21'),(5,'admin','$2y$10$2KxHXB5QbDAMRnG.ZfeBaeATzkvu2Qpov3kXOVmqpADDCkmf/MjGa','8yuv4nlHTORe1G8G63h35HCeF0E16ljQWjsnFuXWuWK6COuxiEy2Q6dvsLxl','Admin Admin','admin@tvz.hr',4,'2016-03-28 15:50:00','2016-04-11 16:54:12'),(6,'korisnik','$2y$10$tN46VnuC0F/aeRVB.BS55.zgFJI3g5KGDl63DkcnwyAl7vZ2HiIXS','TdOY1njVhoKgy3h8i66eyMlOYDFv6hyx2g2GkeWQq65SVM0hzROtlDVJmnMw','Test Testić','test1@gmail.com',1,'2016-04-02 16:36:01','2016-04-11 16:55:54'),(7,'mburisa','$2y$10$aoL.M5eP5BJh7vzcxErWc.QM2pMAAE65BrLgRdMAaosouWaqTneIm','','Matija Buri&scaron;a','mburisa@tvz.hr',3,'2016-04-04 14:21:19','2016-04-04 15:07:07');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
