-- Adminer 4.2.2 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP DATABASE IF EXISTS `webbloppis`;
CREATE DATABASE `webbloppis` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_bin */;
USE `webbloppis`;

DROP TABLE IF EXISTS `category`;
CREATE TABLE `category` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(30) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;


DROP TABLE IF EXISTS `product`;
CREATE TABLE `product` (
  `product_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(50) COLLATE utf8_bin NOT NULL,
  `text` text COLLATE utf8_bin NOT NULL,
  `price` int(4) unsigned NOT NULL,
  `image_name` varchar(100) COLLATE utf8_bin NOT NULL,
  `image_type` varchar(100) COLLATE utf8_bin NOT NULL,
  `image_size` int(10) unsigned NOT NULL,
  `category` text COLLATE utf8_bin NOT NULL,
  `subcategory` text COLLATE utf8_bin NOT NULL,
  `date` datetime NOT NULL ON UPDATE CURRENT_TIMESTAMP,
  `user_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;


DROP TABLE IF EXISTS `select_category`;
CREATE TABLE `select_category` (
  `category_id` int(4) NOT NULL,
  `subcategory_id` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;


DROP TABLE IF EXISTS `state`;
CREATE TABLE `state` (
  `state_id` int(11) NOT NULL AUTO_INCREMENT,
  `state_name` varchar(100) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`state_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;


DROP TABLE IF EXISTS `subcategory`;
CREATE TABLE `subcategory` (
  `subcategory_id` int(11) NOT NULL AUTO_INCREMENT,
  `subcategory_name` varchar(30) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`subcategory_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;


DROP TABLE IF EXISTS `type_membership`;
CREATE TABLE `type_membership` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8_bin NOT NULL,
  `permission` text COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;


DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `user_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8_bin NOT NULL,
  `username` varchar(100) COLLATE utf8_bin NOT NULL,
  `password` varchar(100) COLLATE utf8_bin NOT NULL,
  `adress` varchar(100) COLLATE utf8_bin NOT NULL,
  `zip_code` int(10) unsigned NOT NULL,
  `city` varchar(100) COLLATE utf8_bin NOT NULL,
  `state` varchar(100) COLLATE utf8_bin NOT NULL,
  `email` varchar(100) COLLATE utf8_bin NOT NULL,
  `phone` int(10) unsigned NOT NULL,
  `date` datetime NOT NULL ON UPDATE CURRENT_TIMESTAMP,
  `type_membership_id` enum('Brons','Silver','Guld') COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

INSERT INTO `user` (`user_id`, `name`, `username`, `password`, `adress`, `zip_code`, `city`, `state`, `email`, `phone`, `date`, `type_membership_id`) VALUES
(5,	'Natalia',	'nat',	'$2y$11$e.KXqNPo.cyOajF6KF/i/.IaGnmktdoWcj1lT/ZBPv60fxGxErUzu',	'SveavÃ¤gen 41',	77788,	'Stockholm',	'12',	'natalianakagawa@gmail.com',	0,	'2016-01-04 17:04:00',	'Brons'),
(6,	'Anna',	'annaco',	'$2y$11$m04JBtZetrgFrb6hlp6oLOxyFaxUsTV1YD0GHxIVCh6VE5.uRLJqe',	'VÃ¤gen 10',	222,	'Stockholm',	'12',	'anna@exempel.se',	0,	'2016-01-04 01:45:43',	'Brons'),
(7,	'Maria',	'mia',	'$2y$11$D/paABdgp7PotP3Jcmrdaes7.fhjU71iC9Omijk.vybZ6kL142vr2',	'VÃ¤gen 9',	11144,	'Stockholm',	'3',	'mia@exempel.se',	0,	'2016-01-05 05:28:59',	'Silver'),
(8,	'Helene',	'helene',	'$2y$11$ImHHBdQpBCLYOoq5E404G.0upF4hlhN0RfMq5L880JhBZu4zvJfc2',	'KakvÃ¤gen 1',	112,	'Stockholm',	'12',	'helene.francke@gmail.com',	0,	'2016-01-11 02:51:47',	'Brons');

-- 2016-01-12 10:07:43
