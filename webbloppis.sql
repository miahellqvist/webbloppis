-- Adminer 4.2.2 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `category`;
CREATE TABLE `category` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(30) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

INSERT INTO `category` (`category_id`, `category_name`) VALUES
(1,	'Damkläder'),
(2,	'Herrkläder'),
(3,	'Barnkläder'),
(4,	'Leksaker'),
(5,	'Heminredning'),
(6,	'Verktyg'),
(7,	'Trädgård'),
(8,	'Böcker');

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

INSERT INTO `product` (`product_id`, `title`, `text`, `price`, `image_name`, `image_type`, `image_size`, `category`, `subcategory`, `date`, `user_id`) VALUES
(5,	'BÃ¶cker i bokhylla',	'SÃ¤ljer alla mina bÃ¶cker och tillhÃ¶rande bokhylla.',	1000,	'colinthompson.jpg',	'image/jpeg',	329238,	'8',	'17',	'2016-01-05 16:21:43',	5),
(6,	'Kattunge',	'SÃ¶t kattunge sÃ¤ljes till kÃ¤rleksfullt hem.',	500,	'Foto 2012-08-19 16 52 48.jpg',	'image/jpeg',	1705844,	'4',	'7',	'2016-01-05 16:21:47',	5),
(7,	'Tre glada pingviner',	'SÃ¤ljer mina tre pratglada och matglada pingviner. \r\n\r\nDe Ã¤ter 30 sillar om dagen/pingvin.',	7500,	'Penguins.jpg',	'image/jpeg',	777835,	'4',	'8',	'2016-01-05 16:21:52',	6),
(17,	't-shirt',	'snygg t-shirt',	50,	'nat/tshirt.jpg',	'image/jpeg',	631951,	'5',	'3',	'2016-01-05 15:33:17',	5),
(18,	'TrÃ¶t hund',	'jÃ¤ttecharmig och gullig hund',	1000,	'annaco/hund.jpg',	'image/jpeg',	113844,	'4',	'7',	'2016-01-05 15:40:01',	6),
(22,	'Monopply spel',	'fun!',	100,	'mia/monopoly.jpg',	'image/jpeg',	119249,	'4',	'11',	'2016-01-05 17:34:32',	7);

DROP TABLE IF EXISTS `select_category`;
CREATE TABLE `select_category` (
  `category_id` int(4) NOT NULL,
  `subcategory_id` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

INSERT INTO `select_category` (`category_id`, `subcategory_id`) VALUES
(1,	1),
(1,	2),
(1,	3),
(1,	4),
(2,	1),
(2,	2),
(2,	3),
(2,	4),
(3,	1),
(3,	2),
(3,	3),
(3,	4),
(4,	7),
(4,	8),
(4,	9),
(4,	10),
(4,	11),
(1,	11),
(2,	11),
(3,	11),
(5,	12),
(5,	13),
(5,	14),
(5,	11),
(7,	15),
(7,	16),
(7,	11),
(8,	17),
(8,	18);

DROP TABLE IF EXISTS `state`;
CREATE TABLE `state` (
  `state_id` int(11) NOT NULL AUTO_INCREMENT,
  `state_name` varchar(100) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`state_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

INSERT INTO `state` (`state_id`, `state_name`) VALUES
(1,	'Blekinge län'),
(2,	'Dalarnas län'),
(3,	'Gotlands län'),
(4,	'Gävleborgs län'),
(5,	'Hallands län'),
(6,	'Jämtlands län'),
(7,	'Jönköpings län'),
(8,	'Kalmar län'),
(9,	'Kronobergs län'),
(10,	'Norrbottens län'),
(11,	'Skåne län'),
(12,	'Stockholms län'),
(13,	'Södermanlands län'),
(14,	'Uppsala län'),
(15,	'Värmlands län'),
(16,	'Västerbottens län'),
(17,	'Västernorrlands län'),
(18,	'Västmanlands län'),
(19,	'Västra Götalands län'),
(20,	'Örebro län'),
(21,	'Östergötlands län');

DROP TABLE IF EXISTS `subcategory`;
CREATE TABLE `subcategory` (
  `subcategory_id` int(11) NOT NULL AUTO_INCREMENT,
  `subcategory_name` varchar(30) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`subcategory_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

INSERT INTO `subcategory` (`subcategory_id`, `subcategory_name`) VALUES
(1,	'Byxor'),
(2,	'Tröjor'),
(3,	'Skor'),
(4,	'Ytterkläder'),
(5,	'Redskap'),
(6,	'Övrigt'),
(7,	'Mjukisdjur'),
(8,	'Uteleksaker'),
(9,	'Spel'),
(10,	'Dockor'),
(11,	'Övrigt'),
(12,	'Ljusstakar'),
(13,	'Textil'),
(14,	'Husgeråd'),
(15,	'Frön'),
(16,	'Redskap'),
(17,	'Inbundna böcker'),
(18,	'Pocket');

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
(7,	'Maria',	'mia',	'$2y$11$D/paABdgp7PotP3Jcmrdaes7.fhjU71iC9Omijk.vybZ6kL142vr2',	'VÃ¤gen 9',	11144,	'Stockholm',	'3',	'mia@exempel.se',	0,	'2016-01-05 05:28:59',	'Silver');

-- 2016-01-05 17:35:09
