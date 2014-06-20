/*
SQLyog Community v11.11 (64 bit)
MySQL - 5.5.29 : Database - aircentral
*********************************************************************
*/


/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`aircentral` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `aircentral`;

/*Table structure for table `account_type` */

DROP TABLE IF EXISTS `account_type`;

CREATE TABLE `account_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `account_type` */

insert  into `account_type`(`id`,`name`) values (1,'guest'),(3,'admin');

/*Table structure for table `event` */

DROP TABLE IF EXISTS `event`;

CREATE TABLE `event` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(500) NOT NULL,
  `description` text,
  `start` datetime NOT NULL,
  `end` datetime NOT NULL,
  `location_id` int(11) NOT NULL,
  `organisation_id` int(11) NOT NULL,
  `type_id` int(11) NOT NULL,
  `max_participants` int(11) DEFAULT NULL,
  `signup_url` varchar(256) DEFAULT NULL,
  `ruleset_id` int(11) NOT NULL,
  `fb_id` varchar(256) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `is_full` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `fk_event_organisation_idx` (`organisation_id`),
  KEY `fk_event_type1_idx` (`type_id`),
  KEY `location` (`location_id`),
  KEY `fk_event_ruleset` (`ruleset_id`),
  CONSTRAINT `fk_event_organisation` FOREIGN KEY (`organisation_id`) REFERENCES `organisation` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_event_ruleset` FOREIGN KEY (`ruleset_id`) REFERENCES `ruleset` (`id`),
  CONSTRAINT `fk_event_type1` FOREIGN KEY (`type_id`) REFERENCES `type` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `location` FOREIGN KEY (`location_id`) REFERENCES `location` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=latin1;

/*Data for the table `event` */

insert  into `event`(`id`,`name`,`description`,`start`,`end`,`location_id`,`organisation_id`,`type_id`,`max_participants`,`signup_url`,`ruleset_id`,`fb_id`,`updated_at`,`created_at`,`is_full`) values (5,'Monastery III','Monastery III is een feit! 28 Juni is iedereen weer welkom!\r\n\r\nDe Vrijdag avond mag men al komen, tijd 20:00, er zou een mini skirm zijn en een gezellig kampvuur.','2014-06-28 08:00:00','2014-06-29 12:00:00',4,9,3,40,NULL,1,'1437821019806834',NULL,NULL,0),(6,'Midzomernachskirm','Save the date! Een uniek evenement in NL: een grote midzomernachtskirm in Almere, inclusief BBQ! Deel, share, like, tag en invite je vrienden en we maken er een hele grote, gezellige, target-rich skirm avond van!','2014-06-14 18:30:00','2014-06-15 01:00:00',5,11,4,NULL,'http://www.airsoft-heaven.nl/index.php/events/apsd/midzom-14-jun-14.html',4,'1475341332694794',NULL,NULL,1),(39,'Test Event','Event test description','2014-06-14 18:30:00','2014-06-15 01:00:00',4,9,3,20,NULL,1,NULL,NULL,NULL,0),(40,'Open Skirm Assendelft  Inc Foto Shoot',NULL,'2014-06-22 08:30:00','2014-06-22 17:00:00',8,12,4,NULL,NULL,49,'1601002106791617','2014-06-20 13:04:49','2014-06-20 13:04:49',0),(41,'Open Skirm Assendelft  Noord Holland',NULL,'2014-06-29 08:30:00','2014-06-29 17:00:00',8,12,4,NULL,NULL,50,'239841809544612','2014-06-20 13:07:43','2014-06-20 13:07:43',1),(42,'Veluwe Airsoft',NULL,'2014-06-22 09:00:00','2014-06-22 17:00:00',9,13,4,NULL,NULL,52,'1430739803854233','2014-06-20 13:14:45','2014-06-20 13:14:45',0),(43,'Veluwe Airsoft',NULL,'2014-06-29 09:00:00','2014-06-29 17:00:00',9,13,4,NULL,NULL,53,'295010444001380','2014-06-20 13:14:52','2014-06-20 13:14:52',0),(44,'Veluwe Airsoft',NULL,'2014-07-13 09:00:00','2014-07-13 17:00:00',9,13,4,NULL,NULL,54,'249899628548594','2014-06-20 13:15:01','2014-06-20 13:15:01',0),(45,'Tactical Training Day level 2 - step 2',NULL,'2014-06-29 09:00:00','2014-06-29 17:00:00',5,11,4,NULL,NULL,55,'480682402036695','2014-06-20 13:19:58','2014-06-20 13:19:58',0),(46,'Placeholder: Openingsevenement Het Fort',NULL,'2014-07-04 18:00:00','2014-07-04 22:00:00',5,11,4,NULL,NULL,56,'288836147957274','2014-06-20 13:20:07','2014-06-20 13:20:07',0),(47,'Placeholder: Open Training Day',NULL,'2014-07-27 10:00:00','2014-07-27 17:00:00',5,11,4,NULL,NULL,57,'756328001053946','2014-06-20 13:20:12','2014-06-20 13:20:12',0),(48,'TacSim',NULL,'2014-09-28 09:00:00','2014-09-28 17:00:00',5,11,4,NULL,NULL,58,'1455024538069835','2014-06-20 13:20:19','2014-06-20 13:20:19',0);

/*Table structure for table `location` */

DROP TABLE IF EXISTS `location`;

CREATE TABLE `location` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `coordinates` varchar(45) NOT NULL,
  `address` varchar(256) NOT NULL,
  `organisation_id` int(11) NOT NULL,
  `banner` varchar(256) DEFAULT NULL,
  `ruleset_id` int(11) DEFAULT NULL,
  `url` varchar(45) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `organisation` (`organisation_id`),
  KEY `fk_location_ruleset1_idx` (`ruleset_id`),
  CONSTRAINT `fk_location_ruleset1` FOREIGN KEY (`ruleset_id`) REFERENCES `ruleset` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `organisation` FOREIGN KEY (`organisation_id`) REFERENCES `organisation` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

/*Data for the table `location` */

insert  into `location`(`id`,`name`,`coordinates`,`address`,`organisation_id`,`banner`,`ruleset_id`,`url`) values (4,'Monastery','52.236737,6.203645','Deventer',9,NULL,NULL,'monastery'),(5,'Gladiator Sports Park','52.410376,5.269299','hugo de vriesweg 23B, 1331AG Almere-Buiten, Flevoland, Netherlands',11,NULL,NULL,'gladiatorsports'),(6,'Bunker Hill','52,4185596,528330','Bruineveldweg 7b, 7688PJ Daarle, Overijssel, Netherlands',10,NULL,NULL,'bunkerhill'),(7,'Test Locatie','52,4185596,528330','Niet bestaand Adres',9,NULL,NULL,'testlocatie'),(8,'Rsl Assendelft','52.451612,4.695798','Kagerweg, 1566 NC Assendelft',12,NULL,48,'rslas_assendelft'),(9,'Veluwe Airsoft','52.356062,5.715322','Harderwijkerweg 497A, 8077 RJ Hulshorst, Gelderland, Netherlands',13,NULL,NULL,'veluweas');

/*Table structure for table `organisation` */

DROP TABLE IF EXISTS `organisation`;

CREATE TABLE `organisation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `facebook` varchar(45) DEFAULT NULL,
  `website` varchar(45) DEFAULT NULL,
  `banner` varchar(256) DEFAULT NULL,
  `url` varchar(45) NOT NULL,
  `ruleset_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uniqueurl` (`url`),
  KEY `fk_organisation_ruleset1_idx` (`ruleset_id`),
  CONSTRAINT `fk_organisation_ruleset1` FOREIGN KEY (`ruleset_id`) REFERENCES `ruleset` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

/*Data for the table `organisation` */

insert  into `organisation`(`id`,`name`,`facebook`,`website`,`banner`,`url`,`ruleset_id`) values (9,'Milsimsport','https://www.facebook.com/milsimsport','http://www.milsimsport.nl/','https://scontent-a-ams.xx.fbcdn.net/hphotos-ash3/t1.0-9/1185949_519920488078758_2136870735_n.jpg','milsimsport',1),(10,'3Division','https://www.facebook.com/3Division.eu','http://www.3division.eu/','https://scontent-a-ams.xx.fbcdn.net/hphotos-ash3/t1.0-9/1604540_680872695284553_1578820911_n.jpg','3division',5),(11,'Airsoft Heaven','https://www.facebook.com/airsofthemel',NULL,'https://fbcdn-sphotos-d-a.akamaihd.net/hphotos-ak-ash3/t1.0-9/1045179_469879366432566_876063470_n.png','asheaven',4),(12,'Rslairsoft','https://www.facebook.com/rslairsoft','http://www.rslairsoft.nl/',NULL,'rslairsoft',48),(13,'Veluwe Airsoft','https://www.facebook.com/veluweairsoften','http://www.veluweairsoft.nl/',NULL,'veluweas',NULL);

/*Table structure for table `organisation_user` */

DROP TABLE IF EXISTS `organisation_user`;

CREATE TABLE `organisation_user` (
  `organisation_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`organisation_id`),
  KEY `fk_users_has_organisation_organisation1_idx` (`organisation_id`),
  KEY `fk_user` (`user_id`),
  CONSTRAINT `fk_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  CONSTRAINT `fk_users_has_organisation_organisation1` FOREIGN KEY (`organisation_id`) REFERENCES `organisation` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `organisation_user` */

insert  into `organisation_user`(`organisation_id`,`user_id`) values (9,14),(11,14),(10,15);

/*Table structure for table `ruleset` */

DROP TABLE IF EXISTS `ruleset`;

CREATE TABLE `ruleset` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(500) NOT NULL,
  `organisation_id` int(11) NOT NULL,
  `rules` text,
  `updated_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_ruleset_organisation1_idx` (`organisation_id`),
  CONSTRAINT `fk_ruleset_organisation1` FOREIGN KEY (`organisation_id`) REFERENCES `organisation` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=59 DEFAULT CHARSET=latin1;

/*Data for the table `ruleset` */

insert  into `ruleset`(`id`,`name`,`organisation_id`,`rules`,`updated_at`,`created_at`) values (1,'Standaard',9,'Standaardreglement plaatshouder.',NULL,NULL),(4,'Standaard',11,'Standaardreglement plaatshouder.',NULL,NULL),(5,'Standaard',10,'FPS:\r\n\r\nHieronder staan de verschillende regels per categorie replica beschreven. Bij alle FPS testen moet de replica’s onder de 360 FPS schieten, zowel semi-, fullauto en burst. Dit geldt ook voor de replica’s die hier niet genoemd worden, maar wel op het evenement gebruikt worden.\r\n\r\nSidearm: Pistolen en revolvers maximaal 360FPS\r\nShotguns: maximaal 360FPS\r\nAssault Rifles en SMG’s: maximaal 360FPS\r\nSupport replica’s: maximaal 360FPS\r\nSniper: Bolt Action: maximaal 500 FPS\r\nSniper: Single shot elektrisch (zonder bolt action) 450 FPS + 2 seconden delay\r\nBB’s:\r\n\r\nDe BB’s die 3Division toelaat op het evenement zijn biodegradable BB\'s in de natuurlijk kiezel kleuren (wit, beige, grijs, bruin).\r\nOp verzoek en/of bij twijfel kunnen wij vragen om een Europees geldig certificaat. Op onze evenementen zijn alleen de biodegradable BB\'s toegestaan i.v.m de milieu eisen.\r\nHier zal regelmatig op worden gecontroleerd. In het geval wij u betrappen op het gebruik van plastic bb\'s en dit financiële gevolgen heeft voor onze organisatie zullen wij u hiervoor persoonlijk aansprakelijk stellen. Ons advies dan ook om bij twijfel altijd na te vragen of u uw bb\'s kunt gebruiken op onze terreinen.\r\nMocht u gesnapt worden met non biodegradable BB\'s wordt u van het evenement verwijderd zonder teruggave van het toegangsgeld.',NULL,NULL),(48,'Standaard',12,'\r\nInschrijving is alleen voor NABV leden, buitenlanders met een NABV ontheffing (hier aan te vragen) of introducés (aanmelden via MIJN.NABV.NL door bestaand NABV lid, meer informatie kan u hier vinden). Zet in deze gevallen “Buitenland” of “Introducé” neer in het veld waar het NABV nummer wordt gevraagd.\r\nEen skirm dag is van 8:00 tot 17:00. Vanaf 8:00 tot 9:30 is de aankomsttijd. Van 9:00 tot 9:45 airsoft apparaten en BB’s gecontroleerd. LET OP: wie niet voor kwart voor 10 aanwezig is op het terrein zal geen toegang meer kunnen krijgen tot het terrein. Tijden kunnen afwijken afhankelijk van het seizoen en locatie.\r\nDeelname kost 25,- contant te voldoen. Momenteel is pinnen niet mogelijk. Het is mogelijk voortijdig het bedrag over te maken onder vermelding van naam; datum en NABV nummer naar de volgende rekening: t.n.v Realistic Sport Leasure te Rijsenhoutrekeningnummer NL11 RABO 0393807150.\r\nEigen B.B’s meenemen is geen probleem, let wel op dat deze aan onze eisen voldoen.\r\nVol = Vol.\r\nEr is een bar aanwezig op de locatie.\r\nEigen consumpties zijn toegelaten.\r\nLees de regels vooraf door.\r\nDe FPS limieten zijn als volgt:\r\nAlle apparaten met full auto mogelijkheden: max 360 FPS\r\nAlle apparaten met enkel single shot mogelijkheden: max 450 FPS\r\nAlle apparaten met “Bolt-Action” mogelijkheden: max 500 FPS\r\nAlle airsoftapparaten welke niet vallen onder de bovengenoemde categorieën: max 360 FPS\r\nDe bovenstaande FPS-limieten gelden voor BB’s met een gewicht van 0,20 gram. Bij alle FPS-metingen dienen BB’s met een gewicht van 0,20 gram te worden gebruikt.\r\n\r\nNeem altijd je NABV pasje en legitimatiebewijs mee! Indien je deze niet mee hebt kan je niet spelen.\r\nNeem een geel/oranje veiligheidshesje mee voor als je af bent.',NULL,NULL),(49,'Open Skirm Assendelft  Inc Foto Shoot2014-06-22 08:30',12,NULL,'2014-06-20 13:04:49','2014-06-20 13:04:49'),(50,'Open Skirm Assendelft  Noord Holland2014-06-29 08:30',12,NULL,'2014-06-20 13:07:43','2014-06-20 13:07:43'),(51,'Standaard',13,'Standaardreglement plaatshouder.',NULL,NULL),(52,'Veluwe Airsoft2014-06-22 09:00',13,NULL,'2014-06-20 13:14:45','2014-06-20 13:14:45'),(53,'Veluwe Airsoft2014-06-29 09:00',13,NULL,'2014-06-20 13:14:52','2014-06-20 13:14:52'),(54,'Veluwe Airsoft2014-07-13 09:00',13,NULL,'2014-06-20 13:15:01','2014-06-20 13:15:01'),(55,'Tactical Training Day level 2 - step 22014-06-29 09:00',11,NULL,'2014-06-20 13:19:58','2014-06-20 13:19:58'),(56,'Placeholder: Openingsevenement Het Fort2014-07-04 18:00',11,NULL,'2014-06-20 13:20:07','2014-06-20 13:20:07'),(57,'Placeholder: Open Training Day2014-07-27 10:00',11,NULL,'2014-06-20 13:20:12','2014-06-20 13:20:12'),(58,'TacSim2014-09-28 09:00',11,NULL,'2014-06-20 13:20:19','2014-06-20 13:20:19');

/*Table structure for table `setting` */

DROP TABLE IF EXISTS `setting`;

CREATE TABLE `setting` (
  `id` varchar(50) NOT NULL,
  `value` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `setting` */

insert  into `setting`(`id`,`value`) values ('ytURL','https://www.youtube.com/watch?v=dWZcJHmoS_k');

/*Table structure for table `type` */

DROP TABLE IF EXISTS `type`;

CREATE TABLE `type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(45) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `type_UNIQUE` (`type`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `type` */

insert  into `type`(`id`,`type`) values (4,'open'),(3,'privé');

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(45) NOT NULL,
  `password` varchar(256) NOT NULL,
  `salt` varchar(256) DEFAULT NULL,
  `updated_at` datetime NOT NULL,
  `created_at` datetime NOT NULL,
  `account_type_id` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `fk_users_account_type` (`account_type_id`),
  CONSTRAINT `fk_users_account_type` FOREIGN KEY (`account_type_id`) REFERENCES `account_type` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

/*Data for the table `users` */

insert  into `users`(`id`,`username`,`password`,`salt`,`updated_at`,`created_at`,`account_type_id`) values (12,'admin','adcab350abdc62e12bfb0b52268c352e095e58c1','f3869ad66ca0f31d46a9cc44c704c8f6da0b88db','2014-05-25 14:18:52','2014-05-25 14:18:52',3),(14,'milsimtester','050ce89d3d9fc4a6448d2e1f929b7ea42b6891f1','5a1b976ec20516338cca0e393af8c84c61ff21b4','2014-05-25 15:27:37','2014-05-25 15:27:37',1),(15,'3dtester','efb6199562bf4a71feb7efad58144fc38004a4c2','dcbb3ddb68adb63aa7eaceb26b7fa797cbcca124','2014-05-28 17:39:00','2014-05-28 17:39:00',1),(16,'sverro2','6210f08642d4d01a1f6cc35a5e13ca0bef6adbd4','c4b89b09166f6c2506dd9668d9b85416d48c1a7f','2014-06-05 21:31:27','2014-06-05 21:31:27',1),(17,'admin2','$2y$10$SttsKl699jB0jGOhZ7TYOO6dI2tU0N7yLtot4s9eXIiT6guswNiQm',NULL,'2014-06-20 09:11:52','2014-06-20 09:11:52',1);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
