-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Darbinė stotis: 127.0.0.1
-- Atlikimo laikas: 2013 m. Grd 06 d. 22:01
-- Serverio versija: 5.5.32
-- PHP versija: 5.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Duomenų bazė: `gallery`
--
CREATE DATABASE IF NOT EXISTS `gallery` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `gallery`;

-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `albums`
--

CREATE TABLE IF NOT EXISTS `albums` (
  `album_id` int(11) NOT NULL AUTO_INCREMENT,
  `album_name` varchar(255) DEFAULT NULL,
  `album_short_description` varchar(255) DEFAULT NULL,
  `album_full_description` varchar(255) DEFAULT NULL,
  `album_place` varchar(255) DEFAULT NULL,
  `album_created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `album_title_photo_id` int(11) DEFAULT NULL,
  `album_title_photo_url` varchar(255) DEFAULT NULL,
  `album_title_photo_thumb_url` varchar(255) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `views` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`album_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=19 ;

--
-- Sukurta duomenų kopija lentelei `albums`
--

INSERT INTO `albums` (`album_id`, `album_name`, `album_short_description`, `album_full_description`, `album_place`, `album_created_at`, `album_title_photo_id`, `album_title_photo_url`, `album_title_photo_thumb_url`, `user_id`, `views`) VALUES
(1, 'Atostogos', 'teisiog', 'teisiog ir dar daugiau', 'sdsdsdsjj', '2013-10-25 19:29:58', 140, 'uploads/albums/1/title_1.jpg', 'uploads/albums/1/title_1_thumb.jpg', 104, 1337),
(3, 'albumo vardas 3', 'short', 'full', 'kazkur', '2013-11-15 15:19:17', 30, 'uploads/albums/3/title_3.png', 'uploads/albums/3/title_3_thumb.png', 104, 82),
(12, 'sdddf', 'fdfdf', 'fdfd', 'fdfdf', '2013-12-06 19:12:23', NULL, NULL, NULL, 104, 1),
(18, 'SDsdSDsd', '', '', '', '2013-12-06 20:52:43', NULL, NULL, NULL, 104, 0);

-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `category_description` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=22 ;

--
-- Sukurta duomenų kopija lentelei `categories`
--

INSERT INTO `categories` (`category_id`, `category_name`, `category_description`) VALUES
(5, 'cities', 'fgfgfgf'),
(14, 'Moto', 'moto'),
(15, 'animals', ''),
(16, 'BMW', 'bmw cars'),
(17, 'mercedess', 'mercedess cars'),
(20, 'dance', ''),
(21, 'BMQW>', '');

-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `comment_id` int(11) NOT NULL AUTO_INCREMENT,
  `comment` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `album_id` int(11) DEFAULT NULL,
  `photo_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `user_id` int(11) DEFAULT NULL,
  `commenter_ip` varchar(45) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`comment_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=46 ;

--
-- Sukurta duomenų kopija lentelei `comments`
--

INSERT INTO `comments` (`comment_id`, `comment`, `album_id`, `photo_id`, `created_at`, `user_id`, `commenter_ip`) VALUES
(1, 'asadsasdasdasd', 1, NULL, '2013-11-20 18:17:47', 104, NULL),
(2, 'sdfgsdgsdfsdf', 1, NULL, '2013-11-20 18:17:47', 105, NULL),
(3, 'write here', 3, NULL, '2013-11-20 21:04:24', 105, '::1'),
(4, 'asdasd', 3, NULL, '2013-11-20 21:43:14', 105, '::1'),
(5, 'write here', 3, NULL, '2013-11-20 21:48:10', NULL, '::1'),
(6, 'asddasd', 3, NULL, '2013-11-20 21:52:11', NULL, '::1'),
(7, 'k''''write here', 1, NULL, '2013-11-22 17:37:18', 105, '::1'),
(8, 'asfdsdgsdgffdbfdbfdbfdb', NULL, 1, '2013-11-23 16:11:24', 105, '::1'),
(9, 'jjjjj', 1, NULL, '2013-11-23 16:16:16', 105, '::1'),
(10, 'write here', 1, NULL, '2013-11-23 16:16:54', 105, '::1'),
(11, 'write here', NULL, 1, '2013-11-23 16:22:53', 105, '::1'),
(12, 'write hereasdas', NULL, 1, '2013-11-23 18:35:43', 105, '::1'),
(13, 'write herej', NULL, 1, '2013-11-24 12:38:21', 105, '::1'),
(15, NULL, 1, NULL, '2013-11-30 11:35:36', NULL, '::1'),
(16, NULL, 1, NULL, '2013-11-30 11:35:49', NULL, '::1'),
(17, NULL, 1, NULL, '2013-11-30 11:36:33', NULL, '::1'),
(18, NULL, 1, NULL, '2013-11-30 11:37:00', 104, '::1'),
(19, 'write herejjjjj', 1, NULL, '2013-11-30 11:37:37', 104, '::1'),
(21, 'write heresssssssdsdsds', 1, NULL, '2013-11-30 11:39:30', 104, '::1'),
(22, 'write herefghfghfghfghfghfgwrite herefghfghfghfghfghfgwrite herefghfghfghfghfghfgwrite herefghfghfghfghfghfgwrite herefghfghfghfghfghfgwrite herefghfghfghfghfghfgwrite herefghfghfghfghfghfgwrite herefghfghfghfghfghfgwrite herefghfghfghfghfghfgwrite herefg', 1, NULL, '2013-11-30 11:47:10', 104, '::1'),
(23, 'write here', NULL, 81, '2013-11-30 15:48:57', 104, '::1'),
(25, 'hjkjhkjhk', 1, NULL, '2013-11-30 17:08:49', 104, '::1'),
(34, 'write heregfhg', NULL, 96, '2013-12-02 23:17:57', 104, '::1'),
(39, 'fgfgf', NULL, 1, '2013-12-03 15:25:22', 104, '::1'),
(40, 'kklklklk', NULL, 1, '2013-12-03 16:59:37', 104, '::1');

-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `likes`
--

CREATE TABLE IF NOT EXISTS `likes` (
  `like_id` int(11) NOT NULL AUTO_INCREMENT,
  `album_id` int(11) DEFAULT NULL,
  `photo_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`like_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=87 ;

--
-- Sukurta duomenų kopija lentelei `likes`
--

INSERT INTO `likes` (`like_id`, `album_id`, `photo_id`, `user_id`) VALUES
(1, 1, NULL, 106),
(5, 2, NULL, 104),
(6, 3, NULL, 104),
(12, 3, NULL, 105),
(13, 2, NULL, 105),
(18, NULL, 1, 105),
(19, NULL, 2, 105),
(21, NULL, 3, 105),
(23, NULL, 81, 104),
(26, NULL, 131, 104),
(46, NULL, 59, 104),
(53, NULL, NULL, 104),
(54, NULL, NULL, 104),
(55, NULL, NULL, 104),
(56, NULL, NULL, 104),
(61, NULL, 104, 105),
(72, NULL, 40, 104),
(74, NULL, 59, 105),
(78, NULL, 1, 104),
(80, NULL, 79, 104),
(81, NULL, 94, 104),
(83, NULL, 205, 104),
(84, NULL, 221, 104),
(85, NULL, 222, 104),
(86, 1, NULL, 105);

-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `photos`
--

CREATE TABLE IF NOT EXISTS `photos` (
  `photo_id` int(11) NOT NULL AUTO_INCREMENT,
  `photo_name` varchar(255) DEFAULT NULL,
  `photo_short_description` varchar(255) DEFAULT NULL,
  `photo_taken_at` varchar(20) DEFAULT NULL,
  `photo_destination_url` varchar(255) DEFAULT NULL,
  `photo_thumbnail_destination_url` varchar(255) DEFAULT NULL,
  `photo_created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `photo_size` int(11) DEFAULT NULL,
  `album_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `views` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`photo_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=243 ;

--
-- Sukurta duomenų kopija lentelei `photos`
--

INSERT INTO `photos` (`photo_id`, `photo_name`, `photo_short_description`, `photo_taken_at`, `photo_destination_url`, `photo_thumbnail_destination_url`, `photo_created_at`, `photo_size`, `album_id`, `user_id`, `views`) VALUES
(1, 'photoa', 'shortt', 'norw', 'uploads/Big.jpg', 'uploads/albums/1/218_thumb.jpg', '2013-10-25 18:24:34', NULL, 1, 104, 421),
(4, 'sth', 'short', 'lithuania mountains', 'uploads/4.jpg', NULL, '2013-10-25 18:45:16', NULL, 3, 104, 13),
(5, 'ccc', 'short', 'italy', 'uploads/5.jpg', NULL, '2013-10-25 19:17:52', NULL, 3, NULL, 7),
(7, 'kazkas', NULL, NULL, 'uploads/3.jpg', 'uploads/3.jpg', '2013-11-16 23:37:36', NULL, 1, 104, 6),
(8, 'yo', NULL, NULL, 'uploads/4.jpg', NULL, '2013-11-16 23:37:36', NULL, 1, 104, 1),
(40, 'aaa', 'aaa', 'aaa', 'uploads/105/albums/1/3drunk_mice_2569.jpg', NULL, '2013-11-24 12:48:54', NULL, 1, 105, 9),
(54, 'qqqq', 'qqqqq', 'qqqqq', 'uploads/105/albums/1/182821_182195095242348_100440670084458_256913_1887161388_n.jpg', NULL, '2013-11-28 15:36:36', NULL, 1, 105, 10),
(56, 'aaaa', 'aaaa', 'aaaa', 'uploads/105/albums/1/3drunk_mice_2569.jpg', NULL, '2013-11-28 15:42:51', NULL, 1, 105, 33),
(59, '1', '2', '3', 'uploads/105/albums/1/samsung-galaxy-s3-wallpaper-plants.jpg', NULL, '2013-11-28 16:01:35', NULL, 1, 104, 34),
(60, 'aaaa', 'aaaa', 'aaaa', 'uploads/105/albums/1/samsung-galaxy-s3-wallpaper-water.jpg', NULL, '2013-11-28 16:01:35', NULL, 1, 105, 2),
(61, 'hhhh', 'hhhh', 'hhhh', 'uploads/105/albums/1/3drunk_mice_2569.jpg', NULL, '2013-11-28 16:04:06', NULL, 1, 105, 9),
(62, 'hhhh', 'hhhh', 'hhhh', 'uploads/105/albums/1/484898_299161873523685_2048456210_n.jpg', NULL, '2013-11-28 16:04:06', NULL, 1, 105, 2),
(79, 'aaa', '', '', 'uploads/104/albums/1/angel-of-war-wallpaper.jpg', NULL, '2013-11-29 22:19:21', NULL, 1, 104, 5),
(92, 'asdasd', 'adasd', 'asdasd', 'uploads/104/albums/1/92.jpg', NULL, '2013-12-01 05:21:50', NULL, 1, 104, 0),
(93, 'asdasd', 'adasd', 'asdasd', 'uploads/104/albums/1/93.jpg', NULL, '2013-12-01 05:21:50', NULL, 1, 104, 1),
(94, 'asdasd', 'adasd', 'asdasd', 'uploads/104/albums/1/94.jpg', NULL, '2013-12-01 05:21:50', NULL, 1, 104, 5),
(95, 'fghfgh', '', '', 'uploads/104/albums/1/95.jpg', NULL, '2013-12-01 20:45:10', NULL, 1, 104, 0),
(96, 'fghfgh', '', '', 'uploads/104/albums/1/96.jpg', NULL, '2013-12-01 20:45:10', NULL, 1, 104, 3),
(101, 'llll', '', '', 'uploads/104/albums/1/101.jpg', NULL, '2013-12-01 22:27:59', NULL, 1, 104, 1),
(102, ',.m,nmj', '', '', 'uploads/104/albums/1/102.jpg', NULL, '2013-12-01 22:40:57', NULL, 1, 104, 0),
(103, 'fff', '', '', 'uploads/104/albums/1/103.jpg', NULL, '2013-12-01 22:42:49', NULL, 1, 104, 1),
(104, ',,,hhh', '', '', 'uploads/104/albums/1/104.jpg', NULL, '2013-12-01 22:51:14', NULL, 1, 104, 5),
(105, 'gggg', '', '', 'uploads/104/albums/1/105.jpg', NULL, '2013-12-01 22:54:41', NULL, 1, 104, 1),
(106, 'kklhkljkljk', '', '', 'uploads/104/albums/1/106.jpg', NULL, '2013-12-01 23:03:45', NULL, 1, 104, 0),
(107, 'ujghkjhk', '', '', 'uploads/104/albums/1/107.png', NULL, '2013-12-01 23:05:21', NULL, 1, 104, 1),
(108, 'gch', 'cvhvgh', '', 'uploads/104/albums/1/108.jpg', NULL, '2013-12-01 23:06:03', NULL, 1, 104, 0),
(109, 'ccccccc', '', '', 'uploads/104/albums/1/109.jpg', NULL, '2013-12-01 23:07:45', NULL, 1, 104, 0),
(110, 'jkljklj', '', '', 'uploads/104/albums/1/110.jpg', NULL, '2013-12-01 23:08:54', NULL, 1, 104, 0),
(142, 'lll', '', '', 'uploads/104/albums/1/142.jpg', NULL, '2013-12-02 22:24:43', NULL, 1, 104, 0),
(144, 'jj', '', '', 'uploads/104/albums/1/144.jpg', NULL, '2013-12-02 22:33:40', NULL, 1, 104, 1),
(145, 'kjnjn', '', '', 'uploads/104/albums/1/145.jpg', NULL, '2013-12-02 22:35:42', NULL, 1, 104, 1),
(147, 'kkkk', '', '', 'uploads/104/albums/1/147.jpg', NULL, '2013-12-02 22:39:26', NULL, 1, 104, 0),
(151, 'aaaaa', '', '', 'uploads/104/albums/1/151.jpg', NULL, '2013-12-02 23:04:57', NULL, 1, 104, 1),
(152, 'aaaaa', '', '', 'uploads/104/albums/1/152.jpg', NULL, '2013-12-02 23:04:57', NULL, 1, 104, 1),
(154, 'aaaaa', '', '', 'uploads/104/albums/1/154.jpg', NULL, '2013-12-02 23:04:58', NULL, 1, 104, 0),
(155, 'kkkkk', '', '', 'uploads/104/albums/1/155.jpg', NULL, '2013-12-02 23:06:18', NULL, 1, 104, 2),
(157, 'ffffff', '', '', 'uploads/104/albums/1/157.jpg', NULL, '2013-12-02 23:10:37', NULL, 1, 104, 0),
(158, 'ffffff', '', '', 'uploads/104/albums/1/158.jpg', NULL, '2013-12-02 23:10:37', NULL, 1, 104, 0),
(159, 'ffffff', '', '', 'uploads/104/albums/1/159.jpg', NULL, '2013-12-02 23:10:37', NULL, 1, 104, 2),
(160, 'ffffff', '', '', 'uploads/104/albums/1/160.jpg', NULL, '2013-12-02 23:10:37', NULL, 1, 104, 1),
(161, 'ffffff', '', '', 'uploads/104/albums/1/161.jpg', NULL, '2013-12-02 23:10:37', NULL, 1, 104, 3),
(164, 'vvvvvv', '', '', 'uploads/104/albums/1/164.jpg', NULL, '2013-12-02 23:38:22', 223262, 1, 104, 1),
(175, 'ccccc', 'a', '', 'uploads/104/albums/3/175.jpg', NULL, '2013-12-04 07:30:02', 93425, 3, 104, 20),
(176, 'ddfdfd', '', '', 'uploads/104/albums/3/176.jpg', NULL, '2013-12-04 07:50:10', 69442, 3, 104, 3),
(181, 'kkkkk', '', '', 'uploads/104/albums/1/181.jpg', NULL, '2013-12-04 08:46:46', 238460, 1, 104, 0),
(182, ' nnnn', '', '', 'uploads/104/albums/1/182.jpg', NULL, '2013-12-04 12:18:07', 433798, 1, 104, 0),
(183, 'ggggg', 'gggg', 'gggg', 'uploads/104/albums/1/183.jpg', 'uploads/104/albums/1/183_thumb.jpg', '2013-12-04 12:34:13', 228669, 1, 104, 1),
(184, 'ggggg', 'gggg', 'gggg', 'uploads/104/albums/1/184.jpg', 'uploads/104/albums/1/184_thumb.jpg', '2013-12-04 12:34:14', 72627, 1, 104, 1),
(185, 'ggggg', 'gggg', 'gggg', 'uploads/104/albums/1/185.jpg', 'uploads/104/albums/1/185_thumb.jpg', '2013-12-04 12:34:14', 59621, 1, 104, 0),
(186, 'ggggg', 'gggg', 'gggg', 'uploads/104/albums/1/186.jpg', 'uploads/104/albums/1/186_thumb.jpg', '2013-12-04 12:34:14', 41651, 1, 104, 0),
(188, 'vvvvvv', '', '', 'uploads/104/albums/1/188.jpg', 'uploads/104/albums/1/188_thumb.jpg', '2013-12-04 19:33:54', 164581, 1, 104, 6),
(189, 'vvvvvv', '', '', 'uploads/104/albums/1/189.jpg', 'uploads/104/albums/1/189_thumb.jpg', '2013-12-04 19:33:54', 282106, 1, 104, 2),
(190, 'vvvvvv', '', '', 'uploads/104/albums/1/190.jpg', 'uploads/104/albums/1/190_thumb.jpg', '2013-12-04 19:33:54', 615952, 1, 104, 0),
(191, 'aaas', 'ssss', 'dddd', 'uploads/albums/1/191.jpg', 'uploads/albums/1/191_thumb.jpg', '2013-12-04 19:52:07', 907816, 1, 104, 0),
(192, 'aaas', 'ssss', 'dddd', 'uploads/albums/1/192.jpg', 'uploads/albums/1/192_thumb.jpg', '2013-12-04 19:52:08', 536614, 1, 104, 5),
(193, 'cccvvcb', '', '', 'uploads/albums/1/193.jpg', 'uploads/albums/1/193_thumb.jpg', '2013-12-04 19:53:34', 523332, 1, 104, 0),
(194, 'cccvvcb', '', '', 'uploads/albums/1/194.jpg', 'uploads/albums/1/194_thumb.jpg', '2013-12-04 19:53:34', 274520, 1, 104, 2),
(195, 'mmm', '', '', 'uploads/albums/1/195.jpg', 'uploads/albums/1/195_thumb.jpg', '2013-12-04 20:03:54', 584743, 1, 104, 2),
(196, 'mmm', '', '', 'uploads/albums/1/196.jpg', 'uploads/albums/1/196_thumb.jpg', '2013-12-04 20:03:54', 341438, 1, 104, 0),
(197, '     sxcxcxc', '', '', 'uploads/albums/1/197.jpg', 'uploads/albums/1/197_thumb.jpg', '2013-12-04 21:22:12', 228669, 1, 104, 1),
(198, '     sxcxcxc', '', '', 'uploads/albums/1/198.jpg', 'uploads/albums/1/198_thumb.jpg', '2013-12-04 21:22:12', 72627, 1, 104, 0),
(199, '     sxcxcxc', '', '', 'uploads/albums/1/199.jpg', 'uploads/albums/1/199_thumb.jpg', '2013-12-04 21:22:12', 59621, 1, 104, 0),
(200, '     sxcxcxc', '', '', 'uploads/albums/1/200.jpg', 'uploads/albums/1/200_thumb.jpg', '2013-12-04 21:22:13', 41651, 1, 104, 0),
(201, '     sxcxcxc', '', '', 'uploads/albums/1/201.jpg', 'uploads/albums/1/201_thumb.jpg', '2013-12-04 21:22:13', 77595, 1, 104, 0),
(202, '     sxcxcxc', '', '', 'uploads/albums/1/202.jpg', 'uploads/albums/1/202_thumb.jpg', '2013-12-04 21:22:13', 69442, 1, 104, 3),
(203, '     sxcxcxc', '', '', 'uploads/albums/1/203.jpg', 'uploads/albums/1/203_thumb.jpg', '2013-12-04 21:22:13', 582497, 1, 104, 2),
(204, 'j', '', '', 'uploads/albums/1/204.jpg', 'uploads/albums/1/204_thumb.jpg', '2013-12-04 21:36:59', 120035, 1, 104, 1),
(205, 'sss', 'ss', 'sss', 'uploads/albums/1/205.jpg', 'uploads/albums/1/205_thumb.jpg', '2013-12-05 23:33:35', 215217, 1, 104, 2),
(206, 'ddd', 'ddd', 'dd', 'uploads/albums/1/206.jpg', 'uploads/albums/1/206_thumb.jpg', '2013-12-05 23:42:25', 120749, 1, 104, 0),
(207, 'sffffff', 'sffff', 'sfff', 'uploads/albums/1/207.jpg', 'uploads/albums/1/207_thumb.jpg', '2013-12-06 00:07:35', 41651, 1, 104, 7),
(208, 'qqddeee', 'qqqqeee', 'qqqqeee', 'uploads/albums/1/208.jpg', 'uploads/albums/1/208_thumb.jpg', '2013-12-06 00:23:02', 69442, 1, 104, 8),
(209, 'ddfd', '', '', 'uploads/albums/1/209.jpg', 'uploads/albums/1/209_thumb.jpg', '2013-12-06 00:55:14', 707415, 1, 104, 2),
(210, 'sss', '', '', 'uploads/albums/1/210.jpg', 'uploads/albums/1/210_thumb.jpg', '2013-12-06 01:01:08', 77595, 1, 104, 0),
(211, 'hhhh', '', '', 'uploads/albums/1/211.jpg', 'uploads/albums/1/211_thumb.jpg', '2013-12-06 01:25:01', 81705, 1, 104, 0),
(212, 'gggg', '', '', 'uploads/albums/1/212.jpg', 'uploads/albums/1/212_thumb.jpg', '2013-12-06 01:28:13', 438291, 1, 104, 0),
(213, '77877', '', '', 'uploads/albums/1/213.jpg', 'uploads/albums/1/213_thumb.jpg', '2013-12-06 01:29:32', 75950, 1, 104, 0),
(214, 'jkj', '', '', 'uploads/albums/1/214.jpg', 'uploads/albums/1/214_thumb.jpg', '2013-12-06 01:32:11', 992232, 1, 104, 2),
(215, 'kkk', '', '', 'uploads/albums/1/215.jpg', 'uploads/albums/1/215_thumb.jpg', '2013-12-06 01:33:47', 89597, 1, 104, 0),
(216, 'gggg', '', '', 'uploads/albums/1/216.jpg', 'uploads/albums/1/216_thumb.jpg', '2013-12-06 01:48:29', 28261, 1, 104, 0),
(217, 'ojk', '', '', 'uploads/albums/1/217.jpg', 'uploads/albums/1/217_thumb.jpg', '2013-12-06 01:51:23', 707415, 1, 104, 0),
(218, 'gg', '', '', 'uploads/albums/1/218.jpg', 'uploads/albums/1/218_thumb.jpg', '2013-12-06 01:53:19', 41651, 1, 104, 0),
(219, 'ddd', '', '', 'uploads/albums/1/219.jpg', 'uploads/albums/1/219_thumb.jpg', '2013-12-06 01:54:14', 354831, 1, 104, 0),
(220, '''''''', '', '', 'uploads/albums/1/220.jpg', 'uploads/albums/1/220_thumb.jpg', '2013-12-06 01:55:16', 69442, 1, 104, 2),
(221, 'hhj', '', '', 'uploads/albums/1/221.jpg', 'uploads/albums/1/221_thumb.jpg', '2013-12-06 02:03:27', 658737, 1, 104, 9),
(222, 'aaaa', 'dgffffff', 'ddddd', 'uploads/albums/1/222.jpg', 'uploads/albums/1/222_thumb.jpg', '2013-12-06 09:55:01', 41651, 1, 104, 21),
(223, 'aaaaa', '', '', 'uploads/albums/1/223.jpg', 'uploads/albums/1/223_thumb.jpg', '2013-12-06 11:39:53', 644732, 1, 104, 11),
(224, 'ffffff', '', '', 'uploads/albums/1/224.jpg', 'uploads/albums/1/224_thumb.jpg', '2013-12-06 14:50:06', 77595, 1, 104, 0),
(225, 'ffffff', '', '', 'uploads/albums/1/225.jpg', 'uploads/albums/1/225_thumb.jpg', '2013-12-06 14:50:06', 69442, 1, 104, 0),
(226, 'ffffff', '', '', 'uploads/albums/1/226.jpg', 'uploads/albums/1/226_thumb.jpg', '2013-12-06 14:50:06', 582497, 1, 104, 1),
(227, 'zxczxczxc', 'jjjj', 'jjjjjj', 'uploads/albums/1/227.jpg', 'uploads/albums/1/227_thumb.jpg', '2013-12-06 14:51:34', 77595, 1, 104, 0),
(228, 'zxczxczxc', 'jjjj', 'jjjjjj', 'uploads/albums/1/228.jpg', 'uploads/albums/1/228_thumb.jpg', '2013-12-06 14:51:34', 925291, 1, 104, 1),
(230, 'sdsdsd', 'sssss', '', 'uploads/albums/1/230.jpg', 'uploads/albums/1/230_thumb.jpg', '2013-12-06 14:54:40', 615952, 1, 104, 2),
(231, 'fgfgfg', 'fgfg', 'fgfg', 'uploads/albums/1/231.jpg', 'uploads/albums/1/231_thumb.jpg', '2013-12-06 16:32:01', 77595, 1, 104, 0),
(232, 'hhhh', '', '', 'uploads/albums/1/232.jpg', 'uploads/albums/1/232_thumb.jpg', '2013-12-06 16:33:13', 582497, 1, 104, 0),
(233, 'dddddd', '', '', 'uploads/albums/1/233.jpg', 'uploads/albums/1/233_thumb.jpg', '2013-12-06 16:37:56', 228669, 1, 104, 0),
(234, 'dddddd', '', '', 'uploads/albums/1/234.jpg', 'uploads/albums/1/234_thumb.jpg', '2013-12-06 16:37:57', 72627, 1, 104, 0),
(235, 'dddddd', '', '', 'uploads/albums/1/235.jpg', 'uploads/albums/1/235_thumb.jpg', '2013-12-06 16:37:57', 59621, 1, 104, 0),
(236, 'dddddd', '', '', 'uploads/albums/1/236.jpg', 'uploads/albums/1/236_thumb.jpg', '2013-12-06 16:37:57', 69442, 1, 104, 0),
(237, 'f d fdfdfd fdfd', '', '', 'uploads/albums/1/237.jpg', 'uploads/albums/1/237_thumb.jpg', '2013-12-06 16:40:07', 228669, 1, 104, 0),
(238, 'f d fdfdfd fdfd', '', '', 'uploads/albums/1/238.jpg', 'uploads/albums/1/238_thumb.jpg', '2013-12-06 16:40:08', 72627, 1, 104, 0),
(239, 'f d fdfdfd fdfd', '', '', 'uploads/albums/1/239.jpg', 'uploads/albums/1/239_thumb.jpg', '2013-12-06 16:40:08', 59621, 1, 104, 0),
(240, 'f d fdfdfd fdfd', '', '', 'uploads/albums/1/240.jpg', 'uploads/albums/1/240_thumb.jpg', '2013-12-06 16:40:08', 41651, 1, 104, 0),
(241, 'sdfsdfsdf', 'sdfsd', '', 'uploads/albums/1/241.jpg', 'uploads/albums/1/241_thumb.jpg', '2013-12-06 16:40:43', 69442, 1, 104, 0),
(242, 'sdfsdfsdf', 'sdfsd', '', 'uploads/albums/1/242.jpg', 'uploads/albums/1/242_thumb.jpg', '2013-12-06 16:40:43', 582497, 1, 104, 0);

-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `photo_categories`
--

CREATE TABLE IF NOT EXISTS `photo_categories` (
  `photo_category_id` int(11) NOT NULL AUTO_INCREMENT,
  `photo_id` int(11) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`photo_category_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=28 ;

--
-- Sukurta duomenų kopija lentelei `photo_categories`
--

INSERT INTO `photo_categories` (`photo_category_id`, `photo_id`, `category_id`) VALUES
(6, 222, 4),
(7, 223, 5),
(8, 224, 5),
(9, 225, 5),
(10, 226, 5),
(11, 227, 8),
(12, 228, 8),
(13, 229, 8),
(14, 230, 8),
(15, 1, 5),
(16, 231, 5),
(17, 232, 14),
(18, 233, 13),
(19, 234, 13),
(20, 235, 13),
(21, 236, 13),
(22, 237, 5),
(23, 238, 5),
(24, 239, 5),
(25, 240, 5),
(26, 241, 5),
(27, 242, 5);

-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `photo_tags`
--

CREATE TABLE IF NOT EXISTS `photo_tags` (
  `photo_tag_id` int(11) NOT NULL AUTO_INCREMENT,
  `photo_id` int(11) DEFAULT NULL,
  `tags` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`photo_tag_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=419 ;

--
-- Sukurta duomenų kopija lentelei `photo_tags`
--

INSERT INTO `photo_tags` (`photo_tag_id`, `photo_id`, `tags`) VALUES
(383, 208, 'dddd ddd ff f gffff ssss awwww eeeee uuuuu'),
(384, 209, 'ssdsd, dfdf, fdfdf, fdfdfd, fdfdssdf'),
(385, 210, 'asdasdasdasd,saasdasdas,asdasdfdfd,gfgfgfh,ytytytyt'),
(386, 211, 'dfgdfgdfg,fd gfdgdf,gdf g,fdgdf gfd,gdf gdfgfdgdfgdf, dfgdfgdfg,df fdgdfgdfgdfg'),
(387, 212, 'fh5 4fgh4fgh 5fgh fgh54fghgfhh 4 gghghg5g ghghgh1'),
(388, 213, 'ggch4jghcj65 ghjgh45jghj45gh.gfhfghfg.hfgh*f-fhfhfghfh*hfhfhfhfg *gg4hl'),
(389, 214, 'dfg dfgdf .gdfg dfg |dfg , dfgdfg, /gfdgdfg ,gfdg5"gfdg'),
(390, 215, 'fg4hfg5h .fghfgh''fghh ,gh,fgh;fh ;fghfg45fghfg fghfghf hfg5'),
(391, 216, 'p[;l;l;l;lbgiluiggogo'),
(392, 217, 'kihgbikhol'),
(393, 218, 'gggggg'),
(394, 219, 'aaaa'),
(395, 220, 'cars, BMW'),
(396, 221, 'jgjdthghjg, fdgfdg, dfg45df4, gdf, dfg, dfgdg, dfs, dfgfdgdfgdfg1, dsad, asdasd, hhh, gh, gh, gh, h, h, h'),
(397, 222, 'asdasdasd, asdasdasd, asasdasdasd, as, cars, has, to, you, lll, kkk'),
(398, 223, 'bmw, trass, tratata, yyy'),
(399, 224, 'fffff'),
(400, 225, 'fffff'),
(401, 226, 'fffff'),
(402, 227, 'zxczxczxc, czx, czxczxc, zxczxczxczx'),
(403, 228, 'zxczxczxc, czx, czxczxc, zxczxczxczx'),
(405, 230, 'dfdfdfdfd, fdfdfdf, dfdf, dfd, fd, fd, df'),
(406, 1, 'sas, dsdsd, sdsdsds, dm, ty, y, yy, '),
(407, 231, 'ffg'),
(408, 232, ''),
(409, 233, 'dfsd, fsd, fsdf, sdf, sdf, sd'),
(410, 234, 'dfsd, fsd, fsdf, sdf, sdf, sd'),
(411, 235, 'dfsd, fsd, fsdf, sdf, sdf, sd'),
(412, 236, 'dfsd, fsd, fsdf, sdf, sdf, sd'),
(413, 237, 'dddfd, dfd'),
(414, 238, 'dddfd, dfd'),
(415, 239, 'dddfd, dfd'),
(416, 240, 'dddfd, dfd'),
(417, 241, 'fsdfsd, fds, fds, f'),
(418, 242, 'fsdfsd, fds, fds, f');

-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `roles`
--

CREATE TABLE IF NOT EXISTS `roles` (
  `role_id` int(11) NOT NULL AUTO_INCREMENT,
  `role_name` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`role_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Sukurta duomenų kopija lentelei `roles`
--

INSERT INTO `roles` (`role_id`, `role_name`) VALUES
(1, 'admin'),
(2, 'user'),
(3, 'moderator'),
(4, 'banned');

-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` char(60) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `role_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=111 ;

--
-- Sukurta duomenų kopija lentelei `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `name`, `last_name`, `updated_at`, `created_at`, `role_id`) VALUES
(104, 'admin', '$2y$08$kIxNWG.AwpC2tqkCuLKAM.dNSYOJcYTULXj6I7S8lr5C28BB9.z1K', 'admin@gmail.com', 'admin', 'admin', '2013-12-04 23:26:33', '2013-11-28 13:49:23', 1),
(105, 'hamsteris', '$2y$08$kIxNWG.AwpC2tqkCuLKAM.dNSYOJcYTULXj6I7S8lr5C28BB9.z1K', 'email@gmail.com', 'hamster', 'hamsteris', '2013-12-04 22:02:02', '2013-11-29 21:36:42', 2),
(106, 'test', '$2y$08$kIxNWG.AwpC2tqkCuLKAM.dNSYOJcYTULXj6I7S8lr5C28BB9.z1K', 'asas', 'asas', 'asas', '2013-12-04 23:26:44', '2013-11-29 21:37:20', 4),
(107, 'tomas', '$2y$08$COebJsktVfOvW/STv/koL.zD1ue8KIpDXcKIbiC./clfsaHNaZDzu', 'tomas@gaga.lt', 'Tomas', 'Tomas', '2013-12-04 22:10:49', '2013-12-04 20:47:56', 2),
(108, 'user', '$2y$08$kIxNWG.AwpC2tqkCuLKAM.dNSYOJcYTULXj6I7S8lr5C28BB9.z1K', 'rrrrr@gmail.vom', 'Rrrrrrrrr', 'Rrrrrrrr', '2013-12-04 23:25:55', '2013-12-04 20:57:40', 2),
(109, 'kauko', '$2y$08$wnPEmT5yEoV61FVINPeZKudmTm6fuJL.FT2/Xvdm8Kc9iR7qDTWIC', 'dddd@gmail.com', 'Dddddd', 'Ddddd', '2013-12-04 21:17:11', '2013-12-04 21:17:11', 2),
(110, 'usernamas', '$2y$08$D5iQB9sBKtUHJXqyf/oQM.5NWHIXyzrPXlQFdWF9SDeFEcnGAy7Ma', 'asasas@elpastas.lt', 'Labas', 'Tabas', '2013-12-06 18:24:15', '2013-12-06 18:24:15', 2);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
