# ************************************************************
# Sequel Pro SQL dump
# Version 4096
#
# http://www.sequelpro.com/
# http://code.google.com/p/sequel-pro/
#
# Host: 127.0.0.1 (MySQL 5.6.21)
# Database: cmtiads
# Generation Time: 2015-04-16 00:49:22 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table md_campaigns
# ------------------------------------------------------------

DROP TABLE IF EXISTS `md_campaigns`;

CREATE TABLE `md_campaigns` (
  `campaign_id` int(11) NOT NULL AUTO_INCREMENT,
  `campaign_owner` varchar(100) NOT NULL,
  `campaign_status` varchar(100) NOT NULL,
  `campaign_type` varchar(100) NOT NULL,
  `campaign_name` varchar(100) NOT NULL,
  `campaign_desc` text NOT NULL,
  `campaign_start` date NOT NULL,
  `campaign_end` date NOT NULL,
  `campaign_creationdate` varchar(100) NOT NULL,
  `campaign_networkid` varchar(100) NOT NULL,
  `campaign_priority` varchar(100) NOT NULL,
  `campaign_rate_type` varchar(100) NOT NULL,
  `campaign_rate` varchar(100) NOT NULL,
  `target_iphone` varchar(1) NOT NULL,
  `target_ipod` varchar(1) NOT NULL,
  `target_ipad` varchar(1) NOT NULL,
  `target_android` varchar(1) NOT NULL,
  `target_other` varchar(1) NOT NULL,
  `ios_version_min` varchar(100) NOT NULL,
  `ios_version_max` varchar(100) NOT NULL,
  `android_version_min` varchar(100) NOT NULL,
  `android_version_max` varchar(100) NOT NULL,
  `country_target` varchar(1) NOT NULL,
  `publication_target` varchar(1) NOT NULL,
  `channel_target` varchar(1) NOT NULL,
  `device_target` varchar(1) NOT NULL,
  `gender_target` varchar(1) NOT NULL,
  `income_targer` varchar(1) NOT NULL DEFAULT '',
  `chroniccondition_target` varchar(1) NOT NULL,
  PRIMARY KEY (`campaign_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

LOCK TABLES `md_campaigns` WRITE;
/*!40000 ALTER TABLE `md_campaigns` DISABLE KEYS */;

INSERT INTO `md_campaigns` (`campaign_id`, `campaign_owner`, `campaign_status`, `campaign_type`, `campaign_name`, `campaign_desc`, `campaign_start`, `campaign_end`, `campaign_creationdate`, `campaign_networkid`, `campaign_priority`, `campaign_rate_type`, `campaign_rate`, `target_iphone`, `target_ipod`, `target_ipad`, `target_android`, `target_other`, `ios_version_min`, `ios_version_max`, `android_version_min`, `android_version_max`, `country_target`, `publication_target`, `channel_target`, `device_target`, `gender_target`, `income_targer`, `chroniccondition_target`)
VALUES
	(12,'2','1','1','all_banner','','2015-03-26','2090-12-12','1425666750','','5','','','','','','','','','','','','1','1','1','1','1','','1'),
	(13,'2','1','1','male_banner','','2015-03-07','2090-12-12','1425683714','','5','','','','','','','','','','','','1','1','1','1','2','','1'),
	(11,'2','1','1','female_fullpage','','2015-02-10','2090-12-12','1423529532','','5','','','','','','','','','','','','1','1','1','1','2','','1'),
	(10,'2','1','1','male_fullpage','','2015-03-26','2090-12-12','1423529377','','5','','','','','','','','','','','','1','1','1','1','2','','1'),
	(14,'2','1','1','female_banner','','2015-03-07','2090-12-12','1425684466','','5','','','','','','','','','','','','1','1','1','1','2','','1'),
	(19,'1','1','1','Diabetes Ads','','2015-04-09','2090-12-12','1428535626','','5','','','','','','','','','','','','1','1','1','1','1','','2');

/*!40000 ALTER TABLE `md_campaigns` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
