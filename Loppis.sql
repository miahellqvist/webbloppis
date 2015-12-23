SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

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
  `password` varchar(100) COLLATE utf8_bin NOT NULL,
  `date` datetime NOT NULL ON UPDATE CURRENT_TIMESTAMP,
  `type_membership_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

INSERT INTO `user` (`id`, `name`, `username`, `password`, `date`, `type_membership_id`) VALUES
(1,	'Natalia',	'nat',	'1234',	'0000-00-00 00:00:00',	0);

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `category_name` varchar(30) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;


INSERT INTO `category` (`id`, `category_name`) VALUES
(1, 'Damkläder'),
(2, 'Herrkläder'),
(3, 'Barnkläder'),
(4, 'Leksaker'),
(5, 'Heminredning'),
(6, 'Verktyg'),
(7, 'Trädgård');


CREATE TABLE `product` (
  `product_id` int(10) UNSIGNED NOT NULL,
  `text` text COLLATE utf8_bin NOT NULL,
  `price` int(4) NOT NULL,
  `image` text COLLATE utf8_bin NOT NULL,
  `category` text COLLATE utf8_bin NOT NULL,
  `subcategory` text COLLATE utf8_bin NOT NULL,
  `user_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

INSERT INTO `product` (`product_id`, `text`, `price`, `image`, `category`, `subcategory`, `user_id`) VALUES
(2, 'Ljusstake som även är ett vinställ', 15, 'img/$product_id/ljusstake', 'heminredning', 'ljusstake', 1),
(3, 'Vit nalle', 12, 'img/$product_id/nalle', 'leksaker', 'mjukdjur', 1);


CREATE TABLE `select_category` (
  `category_id` int(4) NOT NULL,
  `subcategory_id` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

INSERT INTO `select_category` (`category_id`, `subcategory_id`) VALUES
(1, 1),
(1, 2),
(1, 3),
(1, 4),
(2, 1),
(2, 2),
(2, 3),
(2, 4),
(3, 1),
(3, 2),
(3, 3),
(3, 4),
(4, 7),
(4, 8),
(4, 9),
(4, 10),
(4, 11),
(1, 11),
(2, 11),
(3, 11),
(5, 12),
(5, 13),
(5, 14),
(5, 11),
(7, 15),
(7, 16),
(7, 11);

CREATE TABLE `subcategory` (
  `id` int(11) NOT NULL,
  `subcategory_name` varchar(30) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

INSERT INTO `subcategory` (`id`, `subcategory_name`) VALUES
(1, 'Byxor'),
(2, 'Tröjor'),
(3, 'Skor'),
(4, 'Ytterkläder'),
(5, 'Redskap'),
(6, 'Övrigt'),
(7, 'Mjukisdjur'),
(8, 'Uteleksaker'),
(9, 'Spel'),
(10, 'Dockor'),
(11, 'Övrigt'),
(12, 'Ljusstakar'),
(13, 'Textil'),
(14, 'Husgeråd'),
(15, 'Frön'),
(16, 'Redskap');


ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`);

ALTER TABLE `subcategory`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

ALTER TABLE `product`
  MODIFY `product_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

ALTER TABLE `subcategory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;


