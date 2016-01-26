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

INSERT INTO `category` (`category_id`, `category_name`) VALUES
(1,	'Damkläder'),
(2,	'Herrkläder'),
(3,	'Barnkläder'),
(4,	'Leksaker'),
(5,	'Heminredning'),
(6,	'Verktyg'),
(7,	'Trädgård'),
(8,	'Böcker');

DROP TABLE IF EXISTS `membership`;
CREATE TABLE `membership` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `membership_name` varchar(50) COLLATE utf8_bin NOT NULL,
  `membership_limit` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

INSERT INTO `membership` (`id`, `membership_name`, `membership_limit`) VALUES
(1,	'Brons 99 kr/månad',	10),
(2,	'Silver 299 kr/månad',	50),
(3,	'Guld 499 kr/månad',	150);

DROP TABLE IF EXISTS `product`;
CREATE TABLE `product` (
  `product_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL,
  `text` text NOT NULL,
  `price` int(4) unsigned NOT NULL,
  `image_name` varchar(100) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `image_type` varchar(100) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `image_size` int(10) unsigned NOT NULL,
  `category` int(10) unsigned NOT NULL,
  `subcategory` int(10) unsigned NOT NULL,
  `date_added` datetime NOT NULL ON UPDATE CURRENT_TIMESTAMP,
  `user_id` int(10) unsigned NOT NULL,
  `state_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `product` (`product_id`, `title`, `text`, `price`, `image_name`, `image_type`, `image_size`, `category`, `subcategory`, `date_added`, `user_id`, `state_id`) VALUES
(48,	'Hörlurar',	'Säljer nya hörlurar! Bra kvalitet.',	250,	'annaco/horlurar.jpg',	'image/jpeg',	12684,	4,	6,	'2016-01-24 20:37:01',	16,	14),
(61,	'Bricka',	'Fin och praktiskt stor bricka till servering. 38 cm i diameter',	100,	'carin/Bricka_rund_bla_Pia B.jpg',	'image/jpeg',	102106,	5,	14,	'2016-01-24 20:50:53',	18,	11),
(62,	'Ask',	'Praktiskt ask med två fack, smidig att ha med.',	50,	'carin/pillerask_oppen.jpg',	'image/jpeg',	328938,	5,	14,	'2016-01-24 20:53:00',	18,	4),
(67,	'Kanin mjukis',	'Säljer min dotters gamla mjukiskanin som har varit mycket uppskattad genom åren, hoppas att någon annan kommer att tycka om den lika mycket som hon.',	100,	'Greger/catalogueImage.jpg',	'image/jpeg',	21184,	4,	7,	'2016-01-24 21:09:11',	28,	14),
(70,	'Hammare',	'Hammare med en smidd, böjd klo och 24 vridmoment med minimala stötar och vibrationer i armen vid användning. ',	150,	'Greger/Hammare.jpg',	'image/jpeg',	13491,	6,	16,	'2016-01-24 21:17:48',	28,	14),
(73,	'Grön kruka',	'Grön kruka, höjd 13 cm.',	50,	'mia/Kruka-Noa.jpg',	'image/jpeg',	109952,	5,	14,	'2016-01-24 21:34:49',	29,	19),
(74,	'Blå vas Kosta Boda',	'Vas ifrån Kosta Boda.',	200,	'mia/104448_1.jpg',	'image/jpeg',	68703,	5,	14,	'2016-01-24 21:36:27',	29,	19),
(76,	'Ängel slända ljusstake',	'Den söta och glada ljusstaken Dragonfly i svart kommer från Bengt & Lotta, och är formgiven av Lotta Glave.  ',	98,	'mia/01.jpg',	'image/jpeg',	14179,	5,	12,	'2016-01-25 12:04:44',	29,	19),
(77,	'Brädspel',	'Spelklassikern Den försvunna diamanten har roat och engagerat barn och vuxna i generationer. Äventyret inleds i Kairo och Tanger. Här får du och dina motspelare samma mystiska uppdrag: Att återfinna världens största diamant, den sägenomspunna Afrikas Stjärna. Men se upp! Längs vägen gömmer sig rövare som kan plundra dig på allt du äger!\r\n\r\n    Från 6 år\r\n    För 2-5 spelare\r\n    Tid 30-60 minuter\r\n    Regler på svenska\r\n',	100,	'mia/36336-den-foersvunna_diamanten_ml.jpg',	'image/jpeg',	114870,	4,	9,	'2016-01-25 09:52:39',	29,	19),
(78,	'Familjens ordjakt',	'A-Ö Familjens ordjakt Du ska på tid bli först med att täcka din bokstavsbricka (A-Ö) genom att säga ord med rätt begynnelsebokstav i den kategori som tärningen har valt. T.ex., kategorin fiskar: Du säger abborre, sik och gädda och kan då täcka över de tomma bokstäverna A,S och G på din bricka. Nästa gång så kanske det blir kategorin Sjöar och du säger då Vänern, Mälaren och Hjälmaren och kan då täcka över bokstäverna V, M och H\r\n\r\n    För 2-4 spelare\r\n    Från 7 år\r\n    Tid 30 minuter\r\n    Regler på svenska\r\n',	200,	'Greger/Fran_A_till_Oe_Familjens_Ordjakt_1_ml.jpg',	'image/jpeg',	58970,	4,	9,	'2016-01-24 21:49:32',	28,	14),
(79,	'Arbetsbyxor',	'Arbetsbyxor i slitstarkt material, sparsamt använda. storlek 38 dammodell.',	200,	'Greger/5167_boberg_dam-3.jpg',	'image/jpeg',	11416,	1,	1,	'2016-01-24 21:52:18',	28,	14),
(80,	'Sveriges Rikes Lag',	'Sveriges Rikes Lag gillad och antagen på Riksdagen år 1734, stadfäst av Konungen den 23 januari 1736. Med tillägg av författningar som publicerats i Svensk Författningssamling fram till början av januari 2014. ',	400,	'Greger/sveriges-rikes-lag-2015.jpg',	'image/jpeg',	38228,	8,	17,	'2016-01-24 21:55:40',	28,	14),
(82,	'Sid från Ice Age',	'Sid som mjukisdjur',	50,	'Greger/15998425-origpic-8ebbe9.jpg',	'image/jpeg',	21297,	4,	7,	'2016-01-24 21:55:05',	28,	14),
(83,	'Ljusstakar',	'Ljusstakar designade av Sigvard Bernadotte.\r\nStorlek: 20 cm, 24 cm och 28 cm.',	999,	'Greger/bernadotte-ljusstake-15_5cm_46-6302_1_1.jpg',	'image/jpeg',	88160,	5,	12,	'2016-01-24 21:57:40',	28,	14),
(84,	'Spetstång',	'Spetstång, 15 cm.',	50,	'Greger/20909473-origpic-901240.jpg',	'image/jpeg',	84755,	6,	16,	'2016-01-24 21:58:36',	28,	14),
(85,	'Mjuka byxor i velour',	'Storlek 68. ',	50,	'piafia/katvig-byxor-velvet-grass-aw12_grande.1433852199.jpg',	'image/jpeg',	221482,	3,	1,	'2016-01-24 22:01:12',	27,	12),
(86,	'Bamse',	'Bamse som mjukisdjur.',	99,	'piafia/129776732_1.jpg',	'image/jpeg',	9068,	4,	7,	'2016-01-24 22:00:51',	27,	13),
(87,	'Boken Gatukatten Bob',	'Boken om gatukatten Bob som blir omhändertagen av en gatumusiker i London. Sann historia.',	30,	'piafia/atn1024_gatukatten.jpg',	'image/jpeg',	77930,	8,	18,	'2016-01-24 22:02:27',	27,	12),
(88,	'Sjal',	'Svart sjal med kattmönster, 110 cm lång.',	50,	'piafia/kattsjal_svart2.jpg',	'image/jpeg',	3448615,	1,	6,	'2016-01-24 22:03:28',	27,	12);

DROP TABLE IF EXISTS `rate`;
CREATE TABLE `rate` (
  `rate_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `rate_name` varchar(100) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`rate_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

INSERT INTO `rate` (`rate_id`, `rate_name`) VALUES
(1,	'Dålig säljare'),
(2,	'Bra säljare'),
(3,	'Utmärk säljare');

DROP TABLE IF EXISTS `review`;
CREATE TABLE `review` (
  `review_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `buyer_id` int(10) unsigned NOT NULL,
  `buyer_name` varchar(100) COLLATE utf8_bin NOT NULL,
  `seller_id` int(10) unsigned NOT NULL,
  `rate_id` int(10) unsigned NOT NULL,
  `comment` text COLLATE utf8_bin NOT NULL,
  `date_comment` datetime NOT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`review_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

INSERT INTO `review` (`review_id`, `buyer_id`, `buyer_name`, `seller_id`, `rate_id`, `comment`, `date_comment`) VALUES
(90,	6,	'Anna',	15,	2,	'rekommenderar den här personen varmt!',	'2016-01-20 21:21:01'),
(91,	14,	'Helene',	27,	2,	'gujsöfgjlsj',	'2016-01-25 16:06:02'),
(92,	14,	'Helene',	29,	2,	'tsjdfsltjsdv',	'2016-01-25 16:08:09');

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
  `phone` int(10) unsigned zerofill NOT NULL,
  `date` datetime NOT NULL ON UPDATE CURRENT_TIMESTAMP,
  `type_membership` varchar(100) COLLATE utf8_bin NOT NULL,
  `membership_paid` enum('true','false') COLLATE utf8_bin NOT NULL DEFAULT 'false',
  `rate_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

INSERT INTO `user` (`user_id`, `name`, `username`, `password`, `adress`, `zip_code`, `city`, `state`, `email`, `phone`, `date`, `type_membership`, `membership_paid`, `rate_id`) VALUES
(14,	'Helene',	'helene',	'$2y$11$4rYRXRvwy1Ho6bN8b2xJr.AOjzZ1fcCdcsWx6GBsnsz3OOBSdqgNO',	'Kakvägen 1',	12345,	'Stockholm',	'3',	'helene.francke@medieinstitutet.se',	0001234567,	'2016-01-25 10:18:55',	'2',	'true',	0),
(15,	'Natalia',	'nat',	'$2y$11$jV2jJiJB.CpDF2zofX0rnuBuFLulexwa3sqpcjgJ/m4Lr6JoTPfcS',	'Vägen 10',	11123,	'Stockholm',	'11',	'natalianakagawa@gmail.com',	0000000000,	'2016-01-25 16:23:11',	'2',	'true',	0),
(16,	'Anna',	'annaco',	'$2y$11$dZWAFhS/M6GzNYA0q31FTufWw35UAdxm9qvJ8XtpAVLLQ3.yV/j3a',	'Vägen 9',	44456,	'Stockholm',	'7',	'anna@exempel.se',	4294967295,	'2016-01-25 16:25:44',	'3',	'true',	0),
(17,	'Tove',	'tove',	'$2y$11$DzduzWNWh6VdVU0X4PybkuKxjGxd8.Uv9pCSraGg1vFHI1jQwX2Bu',	'väg14',	78956,	'Stockholm',	'2',	'tove@exempel.se',	4294967295,	'2016-01-24 20:34:38',	'2',	'false',	0),
(18,	'Carin',	'carin',	'$2y$11$D19tWzcswoYqwg/b3Xe04uWpbDztXHUpO3vCt6.7TdD9K8ESO5jeW',	'Gatan 2',	12345,	'Malmö',	'11',	'carinnojd@hotmail.com',	0123456789,	'2016-01-24 19:57:22',	'3',	'true',	0),
(20,	'Dina',	'ponnyprisma',	'$2y$11$Gmoj2HUnhPkwqJbBDYXsQ.sTBY7BQDh6LhloNUfy9RauZv.JGh0Ni',	'Högalidsgatan 34 C',	11730,	'Stockholm',	'12',	'dinasandberg@gmail.com',	0704563265,	'2016-01-24 20:34:44',	'2',	'true',	0),
(27,	'Pia Lundström',	'piafia',	'$2y$11$dRLMk6Qu4b8U0lkYFIrUSeMvz9Cht5mPTSsnTOtx8LWo811TW2bem',	'Färnebogatan 64',	12342,	'Farsta',	'12',	'pia@mail.com',	4294967295,	'2016-01-24 20:54:47',	'1',	'true',	0),
(28,	'Greger',	'Greger',	'$2y$11$vc7Xqpwect2OkSurudkX.eUD/yeRAdmNd5hlnOIDnvHRVtN/YCobi',	'Kattvägen 4',	19500,	'Uppsala',	'14',	'gregan@mail.com',	0123776789,	'2016-01-24 21:07:11',	'3',	'true',	0),
(29,	'Mia',	'mia',	'$2y$11$94nMh3nbxjfhZr8S2bS7ceAVXlbyYpyS0L0.YhYzOwjaNT4gC2GCi',	'Nygårdsgatan 13',	46140,	'Trollhättan',	'19',	'amiaaaa@mail.com',	4294967295,	'2016-01-24 21:32:42',	'2',	'true',	0),
(30,	'olle',	'olle',	'$2y$11$vKK8eSZLDAX.MofZVKynn.wjrmaDL7r3XfFvAzxgUoANfErt9f1wS',	'hjdsfk',	7893,	'hjsadk',	'5',	'sjka@sjdk.se',	0000000678,	'2016-01-25 12:03:17',	'1',	'true',	0);

-- 2016-01-26 12:52:28
