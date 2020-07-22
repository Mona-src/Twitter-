-- phpMyAdmin SQL Dump
-- version 5.0.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Feb 14, 2020 at 11:02 AM
-- Server version: 5.7.29-0ubuntu0.18.04.1
-- PHP Version: 7.2.24-0ubuntu0.18.04.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `common-database`
--
CREATE DATABASE IF NOT EXISTS `common-database` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `common-database`;

-- --------------------------------------------------------

--
-- Table structure for table `fav`
--

CREATE TABLE `fav` (
  `id_user` int(11) NOT NULL,
  `id_tweet` int(11) NOT NULL,
  `date_fav` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `follow`
--

CREATE TABLE `follow` (
  `id_follower` int(11) NOT NULL,
  `id_following` int(11) NOT NULL,
  `date_follow` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `follow`
--

INSERT INTO `follow` (`id_follower`, `id_following`, `date_follow`) VALUES
(19, 20, '2020-02-10 10:18:01'),
(17, 19, '2020-02-10 10:18:24'),
(17, 20, '2020-02-10 10:18:33'),
(17, 21, '2020-02-10 10:19:25'),
(19, 17, '2020-02-10 10:19:49');

-- --------------------------------------------------------

--
-- Table structure for table `hashtags`
--

CREATE TABLE `hashtags` (
  `id_hashtag` int(11) NOT NULL,
  `nom` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `counter` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `id_tweet` int(11) NOT NULL,
  `img_url` varchar(1000) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE `members` (
  `id` int(11) NOT NULL,
  `mail` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `fullname` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `passw` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `date_inscription` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_naissance` date DEFAULT NULL,
  `etat_compte` enum('0','1','2','3') COLLATE utf8_unicode_ci NOT NULL,
  `avatar` varchar(1000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `banner` varchar(1000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `pays` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ville` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `biography` varchar(160) COLLATE utf8_unicode_ci DEFAULT NULL,
  `genre` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tel` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `site_web` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `light_mode` enum('on','off') COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`id`, `mail`, `fullname`, `username`, `passw`, `date_inscription`, `date_naissance`, `etat_compte`, `avatar`, `banner`, `pays`, `ville`, `biography`, `genre`, `tel`, `site_web`, `light_mode`) VALUES
(16, 'alex@gmail.com', 'Alexandre', 'alexou', '14510e2962a814c4d0d38a11e1a4825d697af415', '2020-02-09 14:04:18', '1998-11-12', '1', '', '', 'France', 'Lyon', '', 'Masculin', '0625533452', '', 'on'),
(17, 'alex2@gmail.com', 'Ouloux', 'tactac', '14510e2962a814c4d0d38a11e1a4825d697af415', '2020-02-09 14:25:53', '1998-11-12', '1', '', '', 'France', 'Lyon', '', 'Masculin', '0986343524', '', 'on'),
(19, 'alexxc@gmail.com', 'alexe', 'testt', '14510e2962a814c4d0d38a11e1a4825d697af415', '2020-02-10 10:13:37', '1998-11-12', '1', '', '', 'France', '', '', 'Masculin', '', '', 'on'),
(20, 'alexxxxxx@gmail.com', 'alexxxx', 'alexxxxxxx', '14510e2962a814c4d0d38a11e1a4825d697af415', '2020-02-10 10:17:18', '1998-11-12', '1', '', '', 'France', '', '', 'Masculin', '', '', 'on'),
(21, 'alexxxo@gmail.com', 'alexouu', 'alexoou', '14510e2962a814c4d0d38a11e1a4825d697af415', '2020-02-10 10:18:59', '1998-11-12', '1', '', '', 'France', '', '', 'Masculin', '', '', 'on'),
(25, 'alex5@gmail.com', 'alexo', 'aleu', 'tezteztez', '2020-02-14 10:51:43', '2020-02-14', '0', '', '', 'france', 'lyon', '', 'homme', '625533452', '', 'on');

-- --------------------------------------------------------

--
-- Table structure for table `notifs`
--

CREATE TABLE `notifs` (
  `id_user_to` int(11) NOT NULL,
  `id_user_from` int(11) NOT NULL,
  `type_notif` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `date_reception` datetime NOT NULL,
  `is_read` enum('0','1') COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `private_message`
--

CREATE TABLE `private_message` (
  `id_user_to` int(11) NOT NULL,
  `id_user_from` int(11) NOT NULL,
  `message` varchar(2000) COLLATE utf8_unicode_ci NOT NULL,
  `date_envoie` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `private_message`
--

INSERT INTO `private_message` (`id_user_to`, `id_user_from`, `message`, `date_envoie`) VALUES
(21, 17, 'salu', '2020-02-13 11:21:45'),
(17, 21, 'salu oé', '2020-02-13 11:22:01'),
(17, 21, 'bi1?', '2020-02-13 11:22:28'),
(21, 17, 'bi1 et toa', '2020-02-13 11:22:38'),
(17, 21, 'bi1', '2020-02-13 11:22:53');

-- --------------------------------------------------------

--
-- Table structure for table `rt`
--

CREATE TABLE `rt` (
  `id_user` int(11) NOT NULL,
  `id_tweet` int(11) NOT NULL,
  `date_fav` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tweets`
--

CREATE TABLE `tweets` (
  `id_tweet` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `message` varchar(140) COLLATE utf8_unicode_ci NOT NULL,
  `date_sent` datetime NOT NULL,
  `fav_counter` int(11) NOT NULL,
  `rt_counter` int(11) NOT NULL,
  `comm_counter` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tweets`
--

INSERT INTO `tweets` (`id_tweet`, `id_user`, `message`, `date_sent`, `fav_counter`, `rt_counter`, `comm_counter`) VALUES
(6, 17, 'premier twite aussi #tropbientwitter #blabla', '2020-02-09 14:26:01', 0, 0, 0),
(7, 19, 'bla bla bla', '2020-02-05 14:23:01', 0, 0, 0),
(8, 20, 'blablablaaaa', '2020-02-09 14:23:01', 0, 0, 0),
(9, 19, 'blablablaaaa blabla', '2020-01-09 14:23:01', 0, 0, 0),
(10, 21, 'blablablaaaa bla @alexxxxxxx', '2020-11-09 14:23:01', 0, 0, 0),
(11, 20, 'blabla', '2020-03-09 14:26:01', 0, 0, 0),
(12, 20, 'blablabla   fatazt #blabla', '2020-04-09 14:23:01', 0, 0, 0),
(13, 19, 'bla bla bla bla bla', '2020-05-05 14:23:01', 0, 0, 0),
(14, 20, 'blabla', '2020-06-09 14:26:01', 0, 0, 0),
(15, 19, 'ma vie est intéressante', '2020-07-05 14:23:01', 0, 0, 0),
(16, 20, 'blabla #blabla @alexou', '2020-09-09 14:26:01', 0, 0, 0),
(17, 19, 'ma vie est intéressante', '2020-08-05 14:23:01', 0, 0, 0),
(18, 20, 'blabla', '2020-10-09 14:26:01', 0, 0, 0),
(19, 21, 'blablablaaaa bla #blabla', '2020-12-09 14:23:01', 0, 0, 0),
(20, 19, 'premier twite ossi #tropbientwitter #blabla', '2020-02-09 14:26:01', 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tweet_comms`
--

CREATE TABLE `tweet_comms` (
  `id_tweet` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_tweet_parent` int(11) NOT NULL,
  `message` varchar(140) COLLATE utf8_unicode_ci NOT NULL,
  `date_envoie` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `fav`
--
ALTER TABLE `fav`
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_tweet` (`id_tweet`);

--
-- Indexes for table `follow`
--
ALTER TABLE `follow`
  ADD KEY `id_follower` (`id_follower`),
  ADD KEY `id_following` (`id_following`);

--
-- Indexes for table `hashtags`
--
ALTER TABLE `hashtags`
  ADD PRIMARY KEY (`id_hashtag`),
  ADD UNIQUE KEY `id_hashtag` (`id_hashtag`),
  ADD UNIQUE KEY `nom` (`nom`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD KEY `id_tweet` (`id_tweet`);

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD UNIQUE KEY `mail` (`mail`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `mail_2` (`mail`),
  ADD UNIQUE KEY `username_2` (`username`);

--
-- Indexes for table `notifs`
--
ALTER TABLE `notifs`
  ADD KEY `id_user_to` (`id_user_to`),
  ADD KEY `id_user_from` (`id_user_from`);

--
-- Indexes for table `private_message`
--
ALTER TABLE `private_message`
  ADD KEY `id_user_to` (`id_user_to`),
  ADD KEY `id_user_from` (`id_user_from`);

--
-- Indexes for table `rt`
--
ALTER TABLE `rt`
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_tweet` (`id_tweet`);

--
-- Indexes for table `tweets`
--
ALTER TABLE `tweets`
  ADD PRIMARY KEY (`id_tweet`),
  ADD UNIQUE KEY `id_tweet` (`id_tweet`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `tweet_comms`
--
ALTER TABLE `tweet_comms`
  ADD PRIMARY KEY (`id_tweet`),
  ADD UNIQUE KEY `id_tweet` (`id_tweet`),
  ADD KEY `id_user` (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `hashtags`
--
ALTER TABLE `hashtags`
  MODIFY `id_hashtag` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `tweets`
--
ALTER TABLE `tweets`
  MODIFY `id_tweet` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `tweet_comms`
--
ALTER TABLE `tweet_comms`
  MODIFY `id_tweet` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `fav`
--
ALTER TABLE `fav`
  ADD CONSTRAINT `fav_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `members` (`id`),
  ADD CONSTRAINT `fav_ibfk_2` FOREIGN KEY (`id_tweet`) REFERENCES `tweets` (`id_tweet`);

--
-- Constraints for table `follow`
--
ALTER TABLE `follow`
  ADD CONSTRAINT `follow_ibfk_1` FOREIGN KEY (`id_follower`) REFERENCES `members` (`id`),
  ADD CONSTRAINT `follow_ibfk_2` FOREIGN KEY (`id_following`) REFERENCES `members` (`id`);

--
-- Constraints for table `images`
--
ALTER TABLE `images`
  ADD CONSTRAINT `images_ibfk_1` FOREIGN KEY (`id_tweet`) REFERENCES `tweets` (`id_tweet`);

--
-- Constraints for table `notifs`
--
ALTER TABLE `notifs`
  ADD CONSTRAINT `notifs_ibfk_1` FOREIGN KEY (`id_user_to`) REFERENCES `members` (`id`),
  ADD CONSTRAINT `notifs_ibfk_2` FOREIGN KEY (`id_user_from`) REFERENCES `members` (`id`);

--
-- Constraints for table `private_message`
--
ALTER TABLE `private_message`
  ADD CONSTRAINT `private_message_ibfk_1` FOREIGN KEY (`id_user_to`) REFERENCES `members` (`id`),
  ADD CONSTRAINT `private_message_ibfk_2` FOREIGN KEY (`id_user_from`) REFERENCES `members` (`id`);

--
-- Constraints for table `rt`
--
ALTER TABLE `rt`
  ADD CONSTRAINT `rt_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `members` (`id`),
  ADD CONSTRAINT `rt_ibfk_2` FOREIGN KEY (`id_tweet`) REFERENCES `tweets` (`id_tweet`);

--
-- Constraints for table `tweets`
--
ALTER TABLE `tweets`
  ADD CONSTRAINT `tweets_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `members` (`id`);

--
-- Constraints for table `tweet_comms`
--
ALTER TABLE `tweet_comms`
  ADD CONSTRAINT `tweet_comms_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `members` (`id`),
  ADD CONSTRAINT `tweet_comms_ibfk_2` FOREIGN KEY (`id_tweet`) REFERENCES `tweets` (`id_tweet`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

