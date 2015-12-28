-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Värd: 127.0.0.1
-- Tid vid skapande: 28 dec 2015 kl 12:12
-- Serverversion: 10.1.8-MariaDB
-- PHP-version: 5.6.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Databas: `webbloppis`
--

-- --------------------------------------------------------

--
-- Tabellstruktur `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `category_name` varchar(30) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumpning av Data i tabell `category`
--

INSERT INTO `category` (`id`, `category_name`) VALUES
(1, 'Damkläder'),
(2, 'Herrkläder'),
(3, 'Barnkläder'),
(4, 'Leksaker'),
(5, 'Heminredning'),
(6, 'Verktyg'),
(7, 'Trädgård');

-- --------------------------------------------------------

--
-- Tabellstruktur `product`
--

CREATE TABLE `product` (
  `product_id` int(10) UNSIGNED NOT NULL,
  `title` varchar(50) COLLATE utf8_bin NOT NULL,
  `text` text COLLATE utf8_bin NOT NULL,
  `price` int(4) UNSIGNED NOT NULL,
  `image_name` varchar(100) COLLATE utf8_bin NOT NULL,
  `image_type` varchar(100) COLLATE utf8_bin NOT NULL,
  `image_size` int(10) UNSIGNED NOT NULL,
  `category` text COLLATE utf8_bin NOT NULL,
  `subcategory` text COLLATE utf8_bin NOT NULL,
  `date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `user_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumpning av Data i tabell `product`
--

INSERT INTO `product` (`product_id`, `title`, `text`, `price`, `image_name`, `image_type`, `image_size`, `category`, `subcategory`, `date`, `user_id`) VALUES
(2, '', 'Ljusstake som även är ett vinställ', 15, 'img/$product_id/ljusstake', '', 0, 'heminredning', 'ljusstake', '0000-00-00 00:00:00', 1),
(3, '', 'Vit nalle', 12, 'img/$product_id/nalle', '', 0, 'leksaker', 'mjukdjur', '0000-00-00 00:00:00', 1);

-- --------------------------------------------------------

--
-- Tabellstruktur `select_category`
--

CREATE TABLE `select_category` (
  `category_id` int(4) NOT NULL,
  `subcategory_id` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumpning av Data i tabell `select_category`
--

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

-- --------------------------------------------------------

--
-- Tabellstruktur `subcategory`
--

CREATE TABLE `subcategory` (
  `id` int(11) NOT NULL,
  `subcategory_name` varchar(30) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumpning av Data i tabell `subcategory`
--

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

-- --------------------------------------------------------

--
-- Tabellstruktur `type_membership`
--

CREATE TABLE `type_membership` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8_bin NOT NULL,
  `permission` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumpning av Data i tabell `type_membership`
--

INSERT INTO `type_membership` (`id`, `name`, `permission`) VALUES
(1, 'Bronze', ''),
(2, 'Silver', ''),
(3, 'Gold', '');

-- --------------------------------------------------------

--
-- Tabellstruktur `user`
--

CREATE TABLE `user` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8_bin NOT NULL,
  `username` varchar(100) COLLATE utf8_bin NOT NULL,
  `password` varchar(100) COLLATE utf8_bin NOT NULL,
  `date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `type_membership_id` int(10) UNSIGNED NOT NULL,
  `adress` varchar(100) COLLATE utf8_bin NOT NULL,
  `county` varchar(30) COLLATE utf8_bin NOT NULL,
  `email` varchar(30) COLLATE utf8_bin NOT NULL,
  `telephone` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumpning av Data i tabell `user`
--

INSERT INTO `user` (`id`, `name`, `username`, `password`, `date`, `type_membership_id`, `adress`, `county`, `email`, `telephone`) VALUES
(2, 'Natalia', 'nat', '1234', '2015-12-27 00:00:00', 1, 'Storgatan 34', 'Stockholm', 'nat@hotmail.com', 85637228);

--
-- Index för dumpade tabeller
--

--
-- Index för tabell `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Index för tabell `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`);

--
-- Index för tabell `subcategory`
--
ALTER TABLE `subcategory`
  ADD PRIMARY KEY (`id`);

--
-- Index för tabell `type_membership`
--
ALTER TABLE `type_membership`
  ADD PRIMARY KEY (`id`);

--
-- Index för tabell `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT för dumpade tabeller
--

--
-- AUTO_INCREMENT för tabell `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT för tabell `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT för tabell `subcategory`
--
ALTER TABLE `subcategory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT för tabell `type_membership`
--
ALTER TABLE `type_membership`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT för tabell `user`
--
ALTER TABLE `user`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
