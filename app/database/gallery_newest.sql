-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 18, 2014 at 05:11 PM
-- Server version: 5.5.32
-- PHP Version: 5.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `gallery`
--
CREATE DATABASE IF NOT EXISTS `gallery` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `gallery`;

-- --------------------------------------------------------


--
-- Table structure for table `logins`
--

CREATE TABLE IF NOT EXISTS `logins` (
  `login_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `success` int(11) NOT NULL,
  `ip` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`login_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

--
-- Table structure for table `searches`
--

CREATE TABLE IF NOT EXISTS `searches` (
  `search_id` int(11) NOT NULL AUTO_INCREMENT,
  `search` varchar(255) DEFAULT '',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`search_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

--
-- Table structure for table `user_actions`
--

CREATE TABLE IF NOT EXISTS `user_actions` (
  `user_action_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `action` varchar(255) DEFAULT '',
  `ip` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`user_action_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

--
-- Table structure for table `subscribes`
--

CREATE TABLE IF NOT EXISTS `subscribes` (
  `subscribe_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `subscribed_user_id` int(11) NOT NULL,
  PRIMARY KEY (`subscribe_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

--
-- Table structure for table `albums`
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=24 ;

--
-- Dumping data for table `albums`
--

INSERT INTO `albums` (`album_id`, `album_name`, `album_short_description`, `album_full_description`, `album_place`, `album_created_at`, `album_title_photo_id`, `album_title_photo_url`, `album_title_photo_thumb_url`, `user_id`, `views`) VALUES
(19, 'aaa', 'yhrfhfgh', 'fhfgh', 'fhfg', '2013-12-06 21:36:26', NULL, 'uploads/albums/19/title_19.jpg', 'uploads/albums/19/title_19_thumb.jpg', 104, 51),
(22, 'dfgdfg', 'dfgdfg', 'full descriptionas', 'kazkur', '2013-12-09 23:06:33', NULL, 'uploads/albums/22/title_22.jpg', 'uploads/albums/22/title_22_thumb.jpg', 104, 42),
(23, 'kuriu', 'kuriu', 'kuriu', 'kuriu', '2014-05-18 14:58:43', NULL, NULL, NULL, 104, 2);

-- --------------------------------------------------------

--
-- Table structure for table `album_categories`
--

CREATE TABLE IF NOT EXISTS `album_categories` (
  `album_category_id` int(11) NOT NULL AUTO_INCREMENT,
  `album_id` int(11) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`album_category_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `album_categories`
--

INSERT INTO `album_categories` (`album_category_id`, `album_id`, `category_id`) VALUES
(1, 22, 16),
(2, 19, 17),
(3, 23, 16);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `category_description` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `category_name`, `category_description`) VALUES
(1, 'Uncategorized', 'fgfgfgf'),
(14, 'Moto', 'moto'),
(15, 'animals', ''),
(16, 'BMW', 'bmw cars'),
(17, 'mercedess', 'mercedess cars');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=33 ;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`comment_id`, `comment`, `album_id`, `photo_id`, `created_at`, `user_id`, `commenter_ip`) VALUES
(23, 'write here', NULL, 81, '2013-11-30 15:48:57', 104, '::1'),
(24, 'dfsdf', NULL, 243, '2013-12-09 23:00:20', 104, '::1'),
(26, 'sddf', NULL, 258, '2013-12-09 23:09:15', 104, '::1'),
(27, 'fghfg', NULL, 257, '2013-12-09 23:17:18', 104, '::1'),
(28, 'admiinas\n', 22, NULL, '2013-12-09 23:48:19', 104, '::1'),
(30, 'tomce', 22, NULL, '2013-12-09 23:49:11', 107, '::1'),
(32, 'nu dasas', 22, NULL, '2013-12-10 00:01:09', 104, '::1');

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE IF NOT EXISTS `likes` (
  `like_id` int(11) NOT NULL AUTO_INCREMENT,
  `album_id` int(11) DEFAULT NULL,
  `photo_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`like_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=64 ;

--
-- Dumping data for table `likes`
--

INSERT INTO `likes` (`like_id`, `album_id`, `photo_id`, `user_id`) VALUES
(5, 2, NULL, 104),
(13, 2, NULL, 105),
(19, NULL, 2, 105),
(21, NULL, 3, 105),
(23, NULL, 81, 104),
(26, NULL, 131, 104),
(53, NULL, NULL, 104),
(54, NULL, NULL, 104),
(55, NULL, NULL, 104),
(56, NULL, NULL, 104),
(57, NULL, 243, 104),
(59, 22, NULL, 104),
(61, NULL, 257, 104),
(63, NULL, 243, 105);

-- --------------------------------------------------------

--
-- Table structure for table `photos`
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=259 ;

--
-- Dumping data for table `photos`
--

INSERT INTO `photos` (`photo_id`, `photo_name`, `photo_short_description`, `photo_taken_at`, `photo_destination_url`, `photo_thumbnail_destination_url`, `photo_created_at`, `photo_size`, `album_id`, `user_id`, `views`) VALUES
(243, 'asdas', '', '', 'uploads/albums/19/243.jpg', 'uploads/albums/19/243_thumb.jpg', '2013-12-06 21:49:42', 93425, 19, 104, 63),
(250, 'ssfdfdfd', '', '', 'uploads/albums/22/250.jpg', 'uploads/albums/22/250_thumb.jpg', '2013-12-09 23:06:57', 41651, 22, 104, 5),
(251, 'ssfdfdfd', '', '', 'uploads/albums/22/251.jpg', 'uploads/albums/22/251_thumb.jpg', '2013-12-09 23:06:57', 77595, 22, 104, 2),
(252, 'ssfdfdfd', '', '', 'uploads/albums/22/252.jpg', 'uploads/albums/22/252_thumb.jpg', '2013-12-09 23:06:57', 69442, 22, 104, 2),
(253, 'ssfdfdfd', '', '', 'uploads/albums/22/253.jpg', 'uploads/albums/22/253_thumb.jpg', '2013-12-09 23:06:57', 582497, 22, 104, 5),
(254, '', '', '', 'uploads/albums/22/254.jpg', 'uploads/albums/22/254_thumb.jpg', '2013-12-09 23:07:12', 120749, 22, 104, 7),
(255, '', '', '', 'uploads/albums/22/255.jpg', 'uploads/albums/22/255_thumb.jpg', '2013-12-09 23:07:12', 81705, 22, 104, 0),
(256, '', 'ddddd', '', 'uploads/albums/22/256.jpg', 'uploads/albums/22/256_thumb.jpg', '2013-12-09 23:07:38', 69442, 22, 104, 1),
(257, 'fffff', '', '', 'uploads/albums/22/257.jpg', 'uploads/albums/22/257_thumb.jpg', '2013-12-09 23:08:05', 109493, 22, 104, 13),
(258, 'fffff', 'dfdd', 'ddfdfg', 'uploads/albums/22/258.jpg', 'uploads/albums/22/258_thumb.jpg', '2013-12-09 23:08:05', 621422, 22, 104, 16);

-- --------------------------------------------------------

--
-- Table structure for table `photo_categories`
--

CREATE TABLE IF NOT EXISTS `photo_categories` (
  `photo_category_id` int(11) NOT NULL AUTO_INCREMENT,
  `photo_id` int(11) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`photo_category_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=47 ;

--
-- Dumping data for table `photo_categories`
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
(27, 242, 5),
(28, 243, 15),
(29, 244, 5),
(30, 245, 5),
(31, 246, 5),
(32, 247, 5),
(33, 248, 5),
(34, 249, 14),
(35, 250, 14),
(36, 251, 14),
(37, 252, 14),
(38, 253, 14),
(39, 254, 5),
(40, 255, 5),
(41, 256, 5),
(42, 257, 5),
(43, 258, 5),
(44, 259, 14),
(45, 260, 14),
(46, 261, 1);

-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `photo_people`
--

CREATE TABLE IF NOT EXISTS `photo_people` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `photo_id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Table structure for table `photo_tags`
--

CREATE TABLE IF NOT EXISTS `photo_tags` (
  `photo_tag_id` int(11) NOT NULL AUTO_INCREMENT,
  `photo_id` int(11) DEFAULT NULL,
  `tags` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`photo_tag_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=438 ;

--
-- Dumping data for table `photo_tags`
--

INSERT INTO `photo_tags` (`photo_tag_id`, `photo_id`, `tags`) VALUES
(419, 243, ''),
(424, 248, 'asd'),
(426, 250, 'sdf, dsfsdfsd, fsd, fsd, f'),
(427, 251, 'sdf, dsfsdfsd, fsd, fsd, f'),
(428, 252, 'sdf, dsfsdfsd, fsd, fsd, f'),
(429, 253, 'sdf, dsfsdfsd, fsd, fsd, f'),
(430, 254, ''),
(431, 255, ''),
(432, 256, ''),
(433, 257, 'cvbvd, gdf, gdf, gdf, gdf, g'),
(434, 258, 'dfg, df, gf, dfg, fgdf, gdf, gdf, gf, f, dfg, dfgdf, '),
(435, 259, ''),
(436, 260, ''),
(437, 261, 'asd, dsds');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE IF NOT EXISTS `roles` (
  `role_id` int(11) NOT NULL AUTO_INCREMENT,
  `role_name` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`role_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`role_id`, `role_name`) VALUES
(1, 'admin'),
(2, 'user'),
(3, 'moderator'),
(4, 'banned');

-- --------------------------------------------------------

--
-- Table structure for table `users`
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
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `name`, `last_name`, `updated_at`, `created_at`, `role_id`) VALUES
(104, 'admin', '$2y$08$kIxNWG.AwpC2tqkCuLKAM.dNSYOJcYTULXj6I7S8lr5C28BB9.z1K', 'admin@gmail.com', 'admin', 'admin', '2013-12-04 23:26:33', '2013-11-28 13:49:23', 1),
(105, 'hamsteris', '$2y$08$kIxNWG.AwpC2tqkCuLKAM.dNSYOJcYTULXj6I7S8lr5C28BB9.z1K', 'email@gmail.com', 'hamster', 'hamsteris', '2013-12-04 22:02:02', '2013-11-29 21:36:42', 2),
(106, 'test', '$2y$08$kIxNWG.AwpC2tqkCuLKAM.dNSYOJcYTULXj6I7S8lr5C28BB9.z1K', 'asas', 'asas', 'asas', '2013-12-04 23:26:44', '2013-11-29 21:37:20', 4),
(107, 'tomas', '$2y$08$kIxNWG.AwpC2tqkCuLKAM.dNSYOJcYTULXj6I7S8lr5C28BB9.z1K', 'tomas@gaga.lt', 'Tomas', 'Tomas', '2013-12-09 22:00:31', '2013-12-04 20:47:56', 2),
(108, 'user', '$2y$08$kIxNWG.AwpC2tqkCuLKAM.dNSYOJcYTULXj6I7S8lr5C28BB9.z1K', 'rrrrr@gmail.vom', 'Rrrrrrrrr', 'Rrrrrrrr', '2013-12-04 23:25:55', '2013-12-04 20:57:40', 2),
(109, 'kauko', '$2y$08$wnPEmT5yEoV61FVINPeZKudmTm6fuJL.FT2/Xvdm8Kc9iR7qDTWIC', 'dddd@gmail.com', 'Dddddd', 'Ddddd', '2013-12-04 21:17:11', '2013-12-04 21:17:11', 2),
(110, 'usernamas', '$2y$08$D5iQB9sBKtUHJXqyf/oQM.5NWHIXyzrPXlQFdWF9SDeFEcnGAy7Ma', 'asasas@elpastas.lt', 'Labas', 'Tabas', '2013-12-06 18:24:15', '2013-12-06 18:24:15', 2);

--
-- Sukurta duomenų struktūra lentelei `user_settings`
--

CREATE TABLE IF NOT EXISTS `user_settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `key` varchar(255) NOT NULL,
  `value` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `album_moderators`
--

CREATE TABLE IF NOT EXISTS `album_moderators` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `album_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
