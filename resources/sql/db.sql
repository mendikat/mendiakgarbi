--
--  Mendiak Garbi
--
--  (c) 2018 Javi Urrutia
--

--
-- Create Database
--

-- CREATE DATABASE mendiakgarbi;
-- USE mendiakgarbi;

--
-- Table structure for table `mg_access`
--

DROP TABLE IF EXISTS `mg_access`;
CREATE TABLE `mg_access` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Table structure for table `mg_events`
--

DROP TABLE IF EXISTS `mg_events`;
CREATE TABLE `mg_events` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `date_c` datetime DEFAULT NULL,
  `date_m` datetime DEFAULT NULL,
  `user` int(11) DEFAULT NULL,
  `type` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `lat` double DEFAULT NULL,
  `lng` double DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Table structure for table `mg_images`
--

DROP TABLE IF EXISTS `mg_images`;
CREATE TABLE `mg_images` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `event` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Table structure for table `mg_status`
--

DROP TABLE IF EXISTS `mg_status`;
CREATE TABLE `mg_status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nameES` varchar(50) NOT NULL,
  `nameEU` varchar(50) NOT NULL,
  `progress` int(3) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Table structure for table `mg_types`
--

DROP TABLE IF EXISTS `mg_types`;
CREATE TABLE `mg_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nameES` varchar(50) DEFAULT NULL,
  `nameEU` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Table structure for table `mg_users`
--

DROP TABLE IF EXISTS `mg_users`;
CREATE TABLE `mg_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `email` varchar(70) NOT NULL,
  `hash` varchar(32) NOT NULL,
  `access` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;