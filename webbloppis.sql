-- Adminer 4.2.2 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `category`;
CREATE TABLE `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(30) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
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
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `state` varchar(100) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;


DROP TABLE IF EXISTS `subcategory`;
CREATE TABLE `subcategory` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `subcategory_name` varchar(30) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;


DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8_bin NOT NULL,
  `username` varchar(100) COLLATE utf8_bin NOT NULL,
  `password` varchar(100) COLLATE utf8_bin NOT NULL,
  `adress` varchar(100) COLLATE utf8_bin NOT NULL,
  `zip_code` int(10) unsigned NOT NULL,
  `city` varchar(100) COLLATE utf8_bin NOT NULL,
  `state` enum('Blekinge län','Dalarnas län','Gotlands län','Gävleborgs län','Hallands län','Jämtlands län','Jönköpings län','Kalmar län','Kronobergs län','Norrbottens län','Skåne lä','Stockholms lä','Södermanlands län','Uppsala län','Värmlands län','Västerbottens län','Västernorrlands lä','Västmanlands län','Västra Götalands län','Örebro län','Östergötlands län') COLLATE utf8_bin NOT NULL,
  `email` varchar(100) COLLATE utf8_bin NOT NULL,
  `phone` int(10) unsigned NOT NULL,
  `date` datetime NOT NULL ON UPDATE CURRENT_TIMESTAMP,
  `type_membership_id` enum('Brons','Silver','Guld') COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;


-- 2015-12-30 09:18:49
