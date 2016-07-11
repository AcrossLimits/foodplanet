-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: Jul 11, 2016 at 04:38 PM
-- Server version: 5.5.40
-- PHP Version: 5.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `fnd`
--

-- --------------------------------------------------------

--
-- Table structure for table `tblAnswer`
--

CREATE TABLE IF NOT EXISTS `tblAnswer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `text` varchar(24) NOT NULL,
  `imgURL` varchar(256) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=105 ;

--
-- Dumping data for table `tblAnswer`
--

INSERT INTO `tblAnswer` (`id`, `text`, `imgURL`) VALUES
(1, 'Bulgaria', 'bulgaria.png'),
(2, 'Croatia', 'croatia.png'),
(3, 'Czech Republic', 'czechrepublic.png'),
(4, 'Denmark', 'denmark.png'),
(5, 'Netherlands', 'netherlands.png'),
(6, 'United Kingdom', 'unitedkingdom.png'),
(7, 'Estonia', 'estonia.png'),
(8, 'Finland', 'finland.png'),
(9, 'France', 'france.png'),
(10, 'Germany', 'germany.png'),
(11, 'Greece', 'greece.png'),
(12, 'Hungary', 'hungary.png'),
(13, 'Ireland', 'ireland.png'),
(14, 'Italy', 'italy.png'),
(15, 'Latvia', 'latvia.png'),
(16, 'Lithuania', 'lithuania.png'),
(17, 'Malta', 'malta.png'),
(18, 'Poland', 'poland.png'),
(19, 'Portugal', 'portugal.png'),
(20, 'Romania', 'romania.png'),
(21, 'Slovakia', 'slovakia.png'),
(22, 'Slovenia', 'slovenia.png'),
(23, 'Spain', 'spain.png'),
(24, 'Sweden', 'sweden.png'),
(25, 'Algeria', 'algeria.png'),
(26, 'Angola', 'angola.png'),
(27, 'Cameroon', 'cameroon.png'),
(28, 'Cyprus', 'cyprus.png'),
(29, 'Ethiopia', 'ethiopia.png'),
(30, 'Ivory Coast', 'ivorycoast.png'),
(31, 'Morocco', 'morocco.png'),
(32, 'Namibia', 'namibia.png'),
(33, 'Nigeria', 'nigeria.png'),
(34, 'Tanzania', 'tanzania.png'),
(35, 'Ukraine', 'ukraine.png'),
(36, 'Azerbaijan', 'azerbaijan.png'),
(37, 'Egypt', 'egypt.png'),
(38, 'Serbia', 'serbia.png'),
(39, 'Turkey', 'turkey.png'),
(40, 'Austria', 'austria.png'),
(41, 'Belgium', 'belgium.png'),
(42, 'Myanmar', 'myanmar.png'),
(43, 'Malaysia', 'malaysia.png'),
(44, 'Peru', 'peru.png'),
(45, 'USA', 'usa.png'),
(46, 'China', 'china.png'),
(47, 'Russia', 'russia.png'),
(48, 'Mexico', 'mexico.png'),
(49, 'Venezuela', 'venezuela.png'),
(50, 'Vietnam', 'vietnam.png'),
(51, 'Zimbabwe', 'zimbabwe.png'),
(52, 'Luxembourg', 'luxembourg.png'),
(53, 'Kenya', 'kenya.png'),
(54, 'Kazakhstan', 'kazakhstan.png'),
(55, 'Jordan', 'jordan.png'),
(56, 'Jamaica', 'jamaica.png'),
(57, 'Japan', 'japan.png'),
(58, 'Israel', 'israel.png'),
(59, 'Iraq', 'iraq.png'),
(60, 'Iran', 'iran.png'),
(61, 'India', 'india.png'),
(62, 'Iceland', 'iceland.png'),
(63, 'Hong Kong', 'hong-kong.png'),
(64, 'Haiti', 'haiti.png'),
(65, 'Greenland', 'greenland.png'),
(66, 'Ghana', 'ghana.png'),
(67, 'Eritrea', 'eritrea.png'),
(68, 'Equador', 'equador.png'),
(69, 'Cuba', 'cuba.png'),
(70, 'Costa Rica', 'costa-rica.png'),
(71, 'Colombia', 'colombia.png'),
(72, 'Chile', 'chile.png'),
(73, 'Canada', 'canada.png'),
(74, 'Brazil', 'brazil.png'),
(75, 'Bolivia', 'bolivia.png'),
(76, 'Belarus', 'belarus.png'),
(77, 'Australia', 'australia.png'),
(78, 'Armenia', 'armenia.png'),
(79, 'Argentina', 'argentina.png'),
(80, 'Andorra', 'andorra.png'),
(81, 'Albania', 'albania.png'),
(82, 'Afghanistan', 'afghanistan.png'),
(83, 'Thailand', 'thailand.png'),
(84, 'Libya', 'libya.png'),
(85, 'Mali', 'mali.png'),
(86, 'Lebanon', 'lebanon.png'),
(87, 'South Africa', 'south-africa.png'),
(88, 'Philippines', 'philippines.png'),
(89, 'Indonesia', 'indonesia.png'),
(90, 'Macedonia', 'macedonia.png'),
(91, 'Georgia', 'georgia.png'),
(92, 'Chad', 'chad.png'),
(93, 'Cambodia', 'cambodia.png'),
(94, 'Burundi', 'burundi.png'),
(95, 'Brunei', 'brunei.png'),
(96, 'Bhutan', 'bhutan.png'),
(97, 'Botswana', 'botswana.png'),
(98, 'Benin', 'benin.png'),
(99, 'Belize', 'belize.png'),
(100, 'Barbados', 'barbados.png'),
(101, 'Bahrain', 'bahrain.png'),
(102, 'Bahamas', 'bahamas.png'),
(103, 'Switzerland', 'switzerland.png'),
(104, 'Papua New Guinea', 'papuanewguinea.png');

-- --------------------------------------------------------

--
-- Table structure for table `tblBadge`
--

CREATE TABLE IF NOT EXISTS `tblBadge` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `imgURL` varchar(120) NOT NULL DEFAULT '0.png',
  `name` varchar(64) NOT NULL,
  `description` varchar(256) NOT NULL,
  `value` int(11) NOT NULL DEFAULT '10000',
  `categoryID` int(11) NOT NULL,
  `bgColor` varchar(6) NOT NULL DEFAULT '000000',
  `borderColor` varchar(6) NOT NULL DEFAULT '000000',
  `special` int(11) NOT NULL DEFAULT '0',
  `tag_descriptionTranslation` varchar(64) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=34 ;

--
-- Dumping data for table `tblBadge`
--

INSERT INTO `tblBadge` (`id`, `imgURL`, `name`, `description`, `value`, `categoryID`, `bgColor`, `borderColor`, `special`, `tag_descriptionTranslation`) VALUES
(1, '01.png', 'European', 'Unlock each European Geographical badge', 50000, 1, '003298', '00062f', 1, '_unlock_euro_geographical'),
(2, '02.png', 'World Leader', 'Unlock each Geographical badge', 50000, 1, '02aeec', '086589', 1, '_unlock_geographical'),
(3, '03.png', 'Scandinavia', 'Play against 5 people from Scandinavia', 10000, 1, 'fff101', '966704', 0, '_unlock_scandinavia'),
(4, '04.png', 'Western Europe', 'Play against 5 players from Western Europe', 10000, 1, '00aeef', '005b82', 0, '_unlock_western'),
(5, '05.png', 'Central Europe', 'Play against 5 players from Central Europe', 10000, 1, '8dd7f7', '4291b5', 0, '_unlock_central'),
(6, '06.png', 'Eastern Europe', 'Play against 5 players from Eastern Europe', 10000, 1, 'ee1f25', '920910', 0, '_unlock_eastern'),
(7, '07.png', 'The Balkans', 'Play against 5 players from the Balkans', 10000, 1, '00927f', '03574c', 0, '_unlock_balkans'),
(8, '08.png', 'Mediterranean', 'Play against 5 players from the Mediterranean', 10000, 1, '0094d8', '005d83', 0, '_unlock_mediterranean'),
(9, '09.png', 'Asia', 'Play against 5 players from Asia', 10000, 1, 'ee1d23', '900002', 0, '_unlock_asia'),
(10, '10.png', 'Africa', 'Play against 5 players from Africa', 10000, 1, 'a25641', '752c10', 0, '_unlock_africa'),
(11, '11.png', 'North / Central America', 'Play against 5 players from North / Central America', 10000, 1, 'f01c23', '6e2a0a', 0, '_unlock_north_america'),
(12, '12.png', 'Latin America', 'Play against 5 players from Latin America', 10000, 1, '756fb3', '2b218a', 0, '_unlock_latin_america'),
(13, '13.png', 'The Middle East', 'Play against 5 players from the Middle East', 10000, 1, 'd6cb6e', '9d8e05', 0, '_unlock_middle_east'),
(14, '14.png', 'Oceania', 'Play against 5 players from Oceania', 10000, 1, '00927f', '02554a', 0, '_unlock_oceania'),
(15, '15.png', 'Master Chef', 'Upload 25 meals', 10000, 2, 'f58220', 'bb6113', 1, '_unlock_25upload'),
(16, '16.png', 'Kitchen Assistant', 'Upload 1 meal', 10000, 2, 'ed028c', '9f0660', 0, '_unlock_1upload'),
(17, '17.png', 'Fry Cook', 'Upload 2 meals', 20000, 2, 'a6ce39', '799a1f', 0, '_unlock_2upload'),
(18, '18.png', 'Grill Cook', 'Upload 5 meals', 40000, 2, 'ee1d23', '8e0004', 0, '_unlock_5upload'),
(19, '19.png', 'Executive Chef', 'Upload 10 meals', 40000, 2, '00927f', '025549', 0, '_unlock_10upload'),
(20, '20.png', 'Master', 'Win 50 Challenges', 25000, 3, '0095d9', '00446d', 1, '_unlock_50Challenges'),
(21, '21.png', 'Rookie', 'Win 1 Challenge', 5000, 3, 'f8abad', 'b83476', 0, '_unlock_1Challenge'),
(22, '22.png', 'Amateur', 'Win 5 Challenges', 10000, 3, 'feca0a', '725f07', 0, '_unlock_5Challenges'),
(23, '23.png', 'Semi Pro', 'Win 10 Challenges', 15000, 3, '90dafa', '0d5a7b', 0, '_unlock_10Challenges'),
(24, '24.png', 'Pro', 'Win 25 Challenges', 20000, 3, 'a8a9ad', '595658', 0, '_unlock_25Challenges'),
(25, '25.png', '5-in-a-row', 'Win 5 challenges in a row', 5000, 3, 'feca0a', '9b6900', 0, '_unlock_5inarow'),
(26, '26.png', '10-in-a-row', 'Win 10 challenges in a row', 10000, 3, 'f58220', '6a2f00', 0, '_unlock_10inarow'),
(27, '27.png', '25-in-a-row', 'Win 25 challenges in a row', 25000, 3, 'd01823', '241e1f', 0, '_unlock_25inarow'),
(28, '28.png', '5 Questions', 'Answer 5 questions correctly in a row', 5000, 3, '8dd7f7', '328cb5', 0, '_unlock_5qinarow'),
(29, '29.png', '10 Questions', 'Answer 10 questions correctly in a row', 10000, 3, '4595b9', '016185', 0, '_unlock_10qinarow'),
(30, '30.png', '25 Questions', 'Answer 25 questions correctly in a row', 25000, 3, '026186', '2e2b2c', 0, '_unlock_25qinarow'),
(31, '31.png', '1 Share', 'Share 1 meal', 1000, 3, 'c0d74f', '84a033', 0, '_unlock_1share'),
(32, '32.png', '5 Shares', 'Share 5 meals', 5000, 3, 'a6ce39', '556b0d', 0, '_unlock_5shares'),
(33, '33.png', '10 Shares', 'Share 10 meals', 10000, 3, '667e21', '1f1a1f', 0, '_unlock_10shares');

-- --------------------------------------------------------

--
-- Table structure for table `tblBadgeCategory`
--

CREATE TABLE IF NOT EXISTS `tblBadgeCategory` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `tblBadgeCategory`
--

INSERT INTO `tblBadgeCategory` (`id`, `name`) VALUES
(1, 'Geographical'),
(2, 'Upload'),
(3, 'Challenge');

-- --------------------------------------------------------

--
-- Table structure for table `tblChallenge`
--

CREATE TABLE IF NOT EXISTS `tblChallenge` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` datetime NOT NULL,
  `player1ID` varchar(28) NOT NULL DEFAULT 'na',
  `player2ID` varchar(28) NOT NULL DEFAULT 'na',
  `challengestatusID` int(11) NOT NULL DEFAULT '1',
  `acceptedDate` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Table structure for table `tblChallengeQuestion`
--

CREATE TABLE IF NOT EXISTS `tblChallengeQuestion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `challengeID` int(11) NOT NULL,
  `questionID` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;


--
-- Table structure for table `tblChallengeQuestionScore`
--

CREATE TABLE IF NOT EXISTS `tblChallengeQuestionScore` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `challengeID` int(11) NOT NULL,
  `playerID` varchar(20) NOT NULL,
  `questionID` int(11) NOT NULL,
  `score` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Table structure for table `tblChallengeScore`
--

CREATE TABLE IF NOT EXISTS `tblChallengeScore` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `challengeID` int(11) NOT NULL,
  `playerID` varchar(20) NOT NULL,
  `score` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Table structure for table `tblChallengeStatus`
--

CREATE TABLE IF NOT EXISTS `tblChallengeStatus` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(8) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `tblChallengeStatus`
--

INSERT INTO `tblChallengeStatus` (`id`, `name`) VALUES
(1, 'active'),
(2, 'closed'),
(3, 'timedout'),
(4, 'occupied'),
(5, 'creating');

-- --------------------------------------------------------

--
-- Table structure for table `tblChallengeWins`
--

CREATE TABLE IF NOT EXISTS `tblChallengeWins` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `challengeID` int(11) NOT NULL,
  `winnerID` varchar(28) NOT NULL,
  `dateWon` datetime NOT NULL,
  `seen` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;


--
-- Table structure for table `tblCountry`
--

CREATE TABLE IF NOT EXISTS `tblCountry` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=192 ;

--
-- Dumping data for table `tblCountry`
--

INSERT INTO `tblCountry` (`id`, `name`) VALUES
(1, 'Afghanistan'),
(2, 'Albania'),
(3, 'Algeria'),
(4, 'Andorra'),
(5, 'Angola'),
(6, 'Anguilla'),
(8, 'Argentina'),
(9, 'Armenia'),
(10, 'Australia'),
(11, 'Austria'),
(12, 'Azerbaijan'),
(13, 'Bahamas'),
(14, 'Bahrain'),
(15, 'Barbados'),
(16, 'Belarus'),
(17, 'Belgium'),
(18, 'Belize'),
(19, 'Benin'),
(20, 'Bermuda'),
(21, 'Bhutan'),
(22, 'Bolivia'),
(23, 'Bosnia and Herzegovina'),
(24, 'Botswana'),
(25, 'Brazil'),
(26, 'Brunei'),
(27, 'Bulgaria'),
(28, 'Burundi'),
(29, 'Cambodia'),
(30, 'Cameroon'),
(31, 'Canada'),
(32, 'Central African Republic'),
(33, 'Chad'),
(34, 'Chile'),
(35, 'China'),
(36, 'Colombia'),
(37, 'Comoros'),
(38, 'Congo'),
(39, 'Costa Rica'),
(40, 'Ivory Coast'),
(41, 'Croatia'),
(42, 'Cuba'),
(43, 'Cyprus'),
(44, 'Czech Republic'),
(45, 'Denmark'),
(46, 'Ecuador'),
(47, 'Egypt'),
(48, 'El Salvador'),
(49, 'Eritrea'),
(50, 'Estonia'),
(51, 'Ethiopia'),
(52, 'Fiji'),
(53, 'Finland'),
(54, 'France'),
(55, 'French Polynesia'),
(56, 'Gabon'),
(57, 'Gambia'),
(58, 'Georgia'),
(59, 'Germany'),
(60, 'Ghana'),
(61, 'Gibraltar'),
(62, 'Greece'),
(63, 'Greenland'),
(64, 'Grenada'),
(65, 'Guadeloupe'),
(66, 'Guam'),
(67, 'Guatemala'),
(69, 'Guinea'),
(70, 'Haiti'),
(71, 'Honduras'),
(72, 'Hong Kong'),
(73, 'Hungary'),
(74, 'Iceland'),
(75, 'India'),
(76, 'Indonesia'),
(77, 'Iran'),
(78, 'Iraq'),
(79, 'Ireland'),
(80, 'Israel'),
(81, 'Italy'),
(82, 'Jamaica'),
(83, 'Japan'),
(84, 'Jordan'),
(85, 'Kazakhstan'),
(86, 'Kenya'),
(87, 'Kiribati'),
(88, 'Kuwait'),
(89, 'Kyrgyzstan'),
(90, 'Latvia'),
(91, 'Lebanon'),
(92, 'Lesotho'),
(93, 'Liberia'),
(94, 'Libya'),
(95, 'Liechtenstein'),
(96, 'Lithuania'),
(97, 'Luxembourg'),
(98, 'Macau'),
(99, 'Macedonia'),
(100, 'Malawi'),
(101, 'Malaysia'),
(102, 'Maldives'),
(103, 'Mali'),
(104, 'Malta'),
(105, 'Marshall Islands'),
(106, 'Martinique'),
(107, 'Mauritania'),
(108, 'Mauritius'),
(109, 'Mayotte'),
(110, 'Mexico'),
(111, 'Moldova'),
(112, 'Monaco'),
(113, 'Mongolia'),
(114, 'Montenegro'),
(115, 'Montserrat'),
(116, 'Morocco'),
(117, 'Mozambique'),
(118, 'Myanmar'),
(119, 'Namibia'),
(120, 'Nepal'),
(121, 'New Zealand'),
(122, 'Nicaragua'),
(123, 'Nigeria'),
(124, 'North Korea'),
(125, 'Norway'),
(126, 'Oman'),
(127, 'Pakistan'),
(128, 'Palestine'),
(129, 'Panama'),
(130, 'Papua New Guinea'),
(131, 'Paraguay'),
(132, 'Peru'),
(133, 'Philippines'),
(134, 'Poland'),
(135, 'Portugal'),
(136, 'Puerto Rico'),
(137, 'Qatar'),
(138, 'Romania'),
(139, 'Russia'),
(140, 'Rwanda'),
(141, 'Samoa'),
(142, 'San Marino'),
(143, 'Saudi Arabia'),
(144, 'Senegal'),
(145, 'Serbia'),
(146, 'Seychelles'),
(147, 'Sierra Leone'),
(148, 'Singapore'),
(149, 'Slovakia'),
(150, 'Slovenia'),
(151, 'Solomon Islands'),
(152, 'Somalia'),
(153, 'South Africa'),
(154, 'South Korea'),
(156, 'Spain'),
(157, 'Sri Lanka'),
(158, 'Sudan'),
(159, 'Suriname'),
(160, 'Swaziland'),
(161, 'Sweden'),
(162, 'Switzerland'),
(163, 'Syria'),
(164, 'Taiwan'),
(165, 'Tajikistan'),
(166, 'Tanzania'),
(167, 'Thailand'),
(168, 'Netherlands'),
(169, 'Togo'),
(170, 'Tokelau'),
(171, 'Tonga'),
(172, 'Trinidad and Tobago'),
(173, 'Tunisia'),
(174, 'Turkey'),
(175, 'Turkmenistan'),
(176, 'Tuvalu'),
(177, 'Uganda'),
(178, 'Ukraine'),
(179, 'United Arab Emirates'),
(180, 'United Kingdom'),
(181, 'United States'),
(182, 'Uruguay'),
(183, 'Uzbekistan'),
(184, 'Vanuatu'),
(185, 'Vatican'),
(186, 'Venezuela'),
(187, 'Vietnam'),
(188, 'Yemen'),
(189, 'Zambia'),
(190, 'Zimbabwe'),
(191, 'DR Congo');

-- --------------------------------------------------------

--
-- Table structure for table `tblCountryRegion`
--

CREATE TABLE IF NOT EXISTS `tblCountryRegion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `countryID` int(11) NOT NULL,
  `regionID` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=246 ;

--
-- Dumping data for table `tblCountryRegion`
--

INSERT INTO `tblCountryRegion` (`id`, `countryID`, `regionID`) VALUES
(1, 1, 7),
(2, 2, 4),
(3, 2, 5),
(4, 3, 6),
(5, 3, 8),
(6, 4, 2),
(7, 5, 8),
(8, 6, 9),
(9, 8, 10),
(10, 9, 7),
(11, 10, 12),
(12, 11, 2),
(13, 11, 3),
(14, 12, 4),
(15, 13, 9),
(16, 14, 7),
(17, 14, 11),
(18, 15, 9),
(19, 16, 4),
(20, 17, 2),
(21, 18, 9),
(22, 19, 8),
(23, 20, 9),
(24, 21, 7),
(25, 22, 10),
(26, 23, 4),
(27, 23, 5),
(28, 24, 8),
(29, 25, 10),
(30, 26, 7),
(31, 27, 4),
(32, 27, 5),
(33, 28, 8),
(34, 29, 7),
(35, 30, 8),
(36, 31, 9),
(37, 32, 8),
(38, 33, 8),
(39, 34, 10),
(40, 35, 7),
(41, 36, 10),
(42, 37, 8),
(43, 38, 8),
(44, 39, 9),
(45, 39, 10),
(46, 40, 8),
(47, 41, 3),
(48, 41, 4),
(49, 42, 9),
(50, 42, 10),
(51, 43, 6),
(52, 43, 11),
(53, 44, 3),
(54, 44, 4),
(55, 45, 1),
(56, 46, 10),
(57, 47, 6),
(58, 47, 8),
(59, 47, 11),
(60, 48, 9),
(61, 48, 10),
(62, 49, 8),
(63, 50, 4),
(64, 51, 8),
(65, 52, 12),
(66, 53, 1),
(67, 54, 2),
(68, 55, 12),
(69, 56, 8),
(70, 57, 8),
(71, 58, 4),
(72, 58, 7),
(73, 59, 2),
(74, 60, 8),
(75, 61, 6),
(76, 62, 5),
(77, 62, 6),
(78, 63, 2),
(79, 64, 9),
(80, 65, 10),
(81, 66, 12),
(82, 67, 9),
(83, 67, 10),
(84, 68, 2),
(85, 69, 8),
(86, 70, 9),
(87, 70, 10),
(88, 71, 9),
(89, 71, 10),
(90, 72, 7),
(91, 73, 3),
(92, 73, 4),
(93, 74, 1),
(94, 75, 7),
(95, 76, 7),
(96, 77, 7),
(97, 77, 11),
(98, 78, 7),
(99, 78, 11),
(100, 79, 2),
(101, 80, 6),
(102, 80, 7),
(103, 80, 11),
(104, 81, 6),
(105, 82, 9),
(106, 83, 7),
(107, 84, 7),
(108, 84, 11),
(109, 85, 7),
(110, 86, 8),
(111, 87, 12),
(112, 88, 7),
(113, 88, 11),
(114, 89, 7),
(115, 90, 4),
(116, 91, 6),
(117, 91, 7),
(118, 91, 11),
(119, 92, 8),
(120, 93, 8),
(121, 94, 6),
(122, 94, 8),
(123, 95, 2),
(124, 96, 4),
(125, 97, 2),
(126, 98, 7),
(127, 99, 4),
(128, 99, 5),
(129, 100, 8),
(130, 101, 7),
(131, 102, 7),
(132, 103, 8),
(133, 104, 6),
(134, 105, 12),
(135, 106, 10),
(136, 107, 8),
(137, 108, 8),
(138, 109, 8),
(139, 110, 9),
(140, 110, 10),
(141, 111, 4),
(142, 112, 2),
(143, 113, 7),
(144, 114, 4),
(145, 114, 5),
(146, 115, 9),
(147, 116, 6),
(148, 116, 8),
(149, 117, 8),
(150, 118, 7),
(151, 119, 8),
(152, 120, 7),
(153, 121, 12),
(154, 122, 9),
(155, 122, 10),
(156, 123, 8),
(157, 124, 7),
(158, 125, 1),
(159, 126, 7),
(160, 126, 11),
(161, 127, 7),
(162, 128, 6),
(163, 128, 11),
(164, 129, 9),
(165, 129, 10),
(166, 130, 12),
(167, 131, 10),
(168, 132, 10),
(169, 133, 7),
(170, 134, 3),
(171, 134, 4),
(172, 135, 2),
(173, 136, 10),
(174, 137, 7),
(175, 137, 11),
(176, 138, 3),
(177, 138, 4),
(178, 138, 5),
(179, 139, 7),
(180, 140, 8),
(181, 141, 12),
(182, 142, 3),
(183, 143, 7),
(184, 143, 11),
(185, 144, 8),
(186, 145, 4),
(187, 145, 5),
(188, 146, 8),
(189, 147, 8),
(190, 148, 7),
(191, 149, 3),
(192, 149, 4),
(193, 150, 3),
(194, 150, 4),
(195, 150, 5),
(196, 150, 6),
(197, 151, 12),
(198, 152, 8),
(199, 153, 8),
(200, 154, 7),
(201, 155, 8),
(202, 156, 2),
(203, 156, 6),
(204, 157, 7),
(205, 158, 8),
(206, 159, 10),
(207, 160, 8),
(208, 161, 1),
(209, 162, 2),
(210, 163, 6),
(211, 163, 7),
(212, 163, 11),
(213, 164, 7),
(214, 165, 7),
(215, 166, 8),
(216, 167, 7),
(217, 168, 2),
(218, 169, 8),
(219, 170, 12),
(220, 171, 12),
(221, 172, 9),
(222, 173, 6),
(223, 173, 8),
(224, 174, 4),
(225, 174, 5),
(226, 174, 6),
(227, 174, 11),
(228, 175, 7),
(229, 176, 12),
(230, 177, 8),
(231, 178, 4),
(232, 179, 7),
(233, 179, 11),
(234, 180, 2),
(235, 181, 9),
(236, 182, 10),
(237, 183, 7),
(238, 184, 12),
(239, 185, 6),
(240, 186, 10),
(241, 187, 7),
(242, 188, 7),
(243, 188, 11),
(244, 189, 8),
(245, 190, 8);

-- --------------------------------------------------------

--
-- Table structure for table `tblIngredient`
--

CREATE TABLE IF NOT EXISTS `tblIngredient` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(32) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tblQuestion`
--

CREATE TABLE IF NOT EXISTS `tblQuestion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `authorID` varchar(32) NOT NULL,
  `description` varchar(2048) NOT NULL DEFAULT 'na',
  `recipe` varchar(2048) NOT NULL DEFAULT 'na',
  `categoryID` int(11) NOT NULL DEFAULT '1',
  `statusID` int(11) NOT NULL DEFAULT '2',
  `title` varchar(48) NOT NULL,
  `imgName` varchar(128) NOT NULL DEFAULT 'blank.jpg',
  `adult` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Table structure for table `tblQuestionAnswer`
--

CREATE TABLE IF NOT EXISTS `tblQuestionAnswer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `questionID` int(11) NOT NULL,
  `answerID` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Table structure for table `tblQuestionAnswerExclude`
--

CREATE TABLE IF NOT EXISTS `tblQuestionAnswerExclude` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `questionID` int(11) NOT NULL,
  `answerID` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Table structure for table `tblQuestionCategory`
--

CREATE TABLE IF NOT EXISTS `tblQuestionCategory` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(32) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `tblQuestionCategory`
--

INSERT INTO `tblQuestionCategory` (`id`, `name`) VALUES
(1, 'food');

-- --------------------------------------------------------

--
-- Table structure for table `tblQuestionEuropeana`
--

CREATE TABLE IF NOT EXISTS `tblQuestionEuropeana` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `link` varchar(255) NOT NULL,
  `questionID` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Table structure for table `tblQuestionHint`
--

CREATE TABLE IF NOT EXISTS `tblQuestionHint` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `questionID` int(11) NOT NULL,
  `text` varchar(256) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;


--
-- Table structure for table `tblQuestionIngredient`
--

CREATE TABLE IF NOT EXISTS `tblQuestionIngredient` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `questionID` int(11) NOT NULL,
  `ingredientID` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Table structure for table `tblQuestionLinks`
--

CREATE TABLE IF NOT EXISTS `tblQuestionLinks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `questionID` int(11) NOT NULL,
  `description` varchar(64) NOT NULL,
  `url` varchar(128) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Table structure for table `tblQuestionProvider`
--

CREATE TABLE IF NOT EXISTS `tblQuestionProvider` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `questionID` int(11) NOT NULL,
  `text` varchar(256) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Table structure for table `tblQuestionStatus`
--

CREATE TABLE IF NOT EXISTS `tblQuestionStatus` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(16) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `tblQuestionStatus`
--

INSERT INTO `tblQuestionStatus` (`id`, `name`) VALUES
(1, 'approved'),
(2, 'verification'),
(3, 'flagged'),
(4, 'rejected'),
(5, 'verifyLink');

-- --------------------------------------------------------

--
-- Table structure for table `tblRegion`
--

CREATE TABLE IF NOT EXISTS `tblRegion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(32) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `tblRegion`
--

INSERT INTO `tblRegion` (`id`, `name`) VALUES
(1, 'Scandinavia'),
(2, 'Western Europe'),
(3, 'Central Europe'),
(4, 'Eastern Europe'),
(5, 'The Balkans'),
(6, 'Mediterranean'),
(7, 'Asia'),
(8, 'Africa'),
(9, 'North / Central America'),
(10, 'Latin America'),
(11, 'The Middle East'),
(12, 'Oceania');

-- --------------------------------------------------------

--
-- Table structure for table `tblUser`
--

CREATE TABLE IF NOT EXISTS `tblUser` (
  `id` varchar(20) NOT NULL,
  `name` varchar(32) NOT NULL,
  `surname` varchar(32) DEFAULT NULL,
  `countryID` int(11) NOT NULL DEFAULT '0',
  `gender` varchar(7) NOT NULL DEFAULT 'not_set',
  `currentBadgeID` int(11) NOT NULL DEFAULT '0',
  `rank` varchar(64) NOT NULL DEFAULT 'Hi, I''m new!',
  `statusID` int(11) NOT NULL DEFAULT '1',
  `dob` date DEFAULT NULL,
  `email` varchar(64) NOT NULL DEFAULT 'not_set',
  `shares` int(11) NOT NULL DEFAULT '0',
  `lang` varchar(5) NOT NULL DEFAULT 'en',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Table structure for table `tblUserBadge`
--

CREATE TABLE IF NOT EXISTS `tblUserBadge` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userID` varchar(28) NOT NULL,
  `badgeID` int(11) NOT NULL,
  `seen` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=329 ;

--
-- Table structure for table `tblUserStatus`
--

CREATE TABLE IF NOT EXISTS `tblUserStatus` (
  `statusID` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(16) NOT NULL,
  PRIMARY KEY (`statusID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `tblUserStatus`
--

INSERT INTO `tblUserStatus` (`statusID`, `name`) VALUES
(1, 'user'),
(2, 'admin'),
(3, 'banned'),
(4, 'Guest');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
