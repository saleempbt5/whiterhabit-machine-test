# ************************************************************
# Sequel Pro SQL dump
# Version 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 127.0.0.1 (MySQL 5.7.27)
# Database: whiterabbit_test
# Generation Time: 2021-09-05 10:24:55 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table file_permissions
# ------------------------------------------------------------

DROP TABLE IF EXISTS `file_permissions`;

CREATE TABLE `file_permissions` (
  `permissionid` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `fileid` int(11) DEFAULT NULL,
  `userid` int(11) DEFAULT NULL,
  `createdat` datetime DEFAULT NULL,
  `updatedat` datetime DEFAULT NULL,
  PRIMARY KEY (`permissionid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table wh_files
# ------------------------------------------------------------

DROP TABLE IF EXISTS `wh_files`;

CREATE TABLE `wh_files` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `filename` varchar(100) DEFAULT NULL,
  `fileurl` varchar(200) DEFAULT NULL,
  `createdat` datetime DEFAULT NULL,
  `updatedat` datetime DEFAULT NULL,
  `createdby` int(11) DEFAULT NULL,
  `status` int(1) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table wh_menu_master
# ------------------------------------------------------------

DROP TABLE IF EXISTS `wh_menu_master`;

CREATE TABLE `wh_menu_master` (
  `id` int(50) NOT NULL AUTO_INCREMENT,
  `menuname` varchar(500) NOT NULL,
  `link` varchar(500) NOT NULL,
  `parent` int(10) NOT NULL,
  `wieght` int(2) NOT NULL,
  `iconclass` varchar(50) NOT NULL,
  `createdtime` datetime NOT NULL,
  `createdby` varchar(20) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1 : active, 2:deleted, 3: disabled',
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table wh_role_master
# ------------------------------------------------------------

DROP TABLE IF EXISTS `wh_role_master`;

CREATE TABLE `wh_role_master` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table wh_role_permissions
# ------------------------------------------------------------

DROP TABLE IF EXISTS `wh_role_permissions`;

CREATE TABLE `wh_role_permissions` (
  `id` bigint(100) NOT NULL AUTO_INCREMENT,
  `roleid` varchar(30) NOT NULL,
  `menuid` int(4) NOT NULL,
  `permission` varchar(500) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `menuid` (`menuid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table wh_user_actionlog
# ------------------------------------------------------------

DROP TABLE IF EXISTS `wh_user_actionlog`;

CREATE TABLE `wh_user_actionlog` (
  `logid` int(20) NOT NULL AUTO_INCREMENT,
  `userid` int(20) NOT NULL,
  `sourceobj` varchar(25) CHARACTER SET utf8 DEFAULT NULL,
  `sourceobjid` int(20) DEFAULT NULL,
  `action_taken` varchar(500) CHARACTER SET utf8 NOT NULL,
  `actiontime` datetime NOT NULL,
  PRIMARY KEY (`logid`),
  KEY `userid` (`userid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table wh_users
# ------------------------------------------------------------

DROP TABLE IF EXISTS `wh_users`;

CREATE TABLE `wh_users` (
  `id` int(30) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `email` varchar(200) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `address` varchar(500) NOT NULL,
  `phoneno` varchar(20) NOT NULL,
  `roleid` int(3) NOT NULL,
  `createdat` datetime NOT NULL,
  `status` int(1) NOT NULL,
  `deletedat` datetime DEFAULT NULL,
  `craetedby` int(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;




/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
