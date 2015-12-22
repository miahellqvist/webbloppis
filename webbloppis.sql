-- Adminer 4.2.2 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP DATABASE IF EXISTS `webbloppis`;
CREATE DATABASE `webbloppis` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_bin */;
USE `webbloppis`;

DROP TABLE IF EXISTS `type_membership`;
CREATE TABLE `type_membership` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8_bin NOT NULL,
  `permission` text COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

INSERT INTO `type_membership` (`id`, `name`, `permission`) VALUES
(1,	'Bronze',	''),
(2,	'Silver',	''),
(3,	'Gold',	'');

DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8_bin NOT NULL,
  `username` varchar(100) COLLATE utf8_bin NOT NULL,
  `password` varchar(64) COLLATE utf8_bin NOT NULL,
  `salt` varchar(32) COLLATE utf8_bin NOT NULL,
  `date` datetime NOT NULL ON UPDATE CURRENT_TIMESTAMP,
  `type_membership_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

INSERT INTO `user` (`id`, `name`, `username`, `password`, `salt`, `date`, `type_membership_id`) VALUES
(1,	'Natalia',	'nat',	'1234',	'',	'0000-00-00 00:00:00',	0);

-- 2015-12-22 15:53:27
