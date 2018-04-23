-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 23, 2018 at 12:44 PM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 7.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `app`
--

-- --------------------------------------------------------

--
-- Table structure for table `cards`
--

CREATE TABLE `cards` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `category` int(11) NOT NULL,
  `sub_category` int(11) NOT NULL DEFAULT '0',
  `tag` varchar(1) NOT NULL DEFAULT '0' COMMENT '0:free,1:paid',
  `price` float(8,2) NOT NULL DEFAULT '0.00',
  `link` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` varchar(1) NOT NULL DEFAULT '1' COMMENT '0:deleted,1:active'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cards`
--

INSERT INTO `cards` (`id`, `name`, `category`, `sub_category`, `tag`, `price`, `link`, `created_at`, `status`) VALUES
(1, 'card_5ad0495561543', 2, 0, '0', 0.00, 'img/test/5ad049556154a.jpg', '2018-04-13 06:08:21', '1'),
(2, 'card_5ad04b390d4df', 3, 0, '0', 0.00, 'img/sfvs/5ad6f77cac415.jpg', '2018-04-13 06:16:25', '0'),
(3, 'test_0', 4, 0, '0', 0.00, 'img/terg/5ad04ba418c8b.jpg', '2018-04-13 06:18:12', '0'),
(4, 'test_1', 4, 0, '0', 0.00, 'img/terg/5ad04ba43bb21.jpg', '2018-04-13 06:18:12', '0'),
(5, 'test_2', 4, 0, '0', 0.00, 'img/terg/5ad04ba460ea2.jpg', '2018-04-13 06:18:12', '0'),
(6, 'test_3', 4, 0, '0', 0.00, 'img/terg/5ad04ba499fe7.jpg', '2018-04-13 06:18:12', '0'),
(7, 'card_5ad04d8f80549', 3, 0, '0', 0.00, 'img/sfvs/5ad6f7464d1d1.jpg', '2018-04-13 06:26:23', '0'),
(8, 'multiple_0', 3, 0, '0', 0.00, 'img/sfvs/5ad6f5ff914b5.jpg', '2018-04-18 07:38:39', '0'),
(9, 'multiple_1', 3, 0, '0', 0.00, 'img/sfvs/5ad6f5ffc6c52.jpg', '2018-04-18 07:38:39', '0'),
(10, 'multiple_2', 3, 0, '0', 0.00, 'img/sfvs/5ad6f5ffde18d.jpg', '2018-04-18 07:38:39', '0'),
(11, 'card_5ad6fe0fe5d7c', 3, 0, '0', 0.00, 'img/sfv/5ad6fe0fe5d88.jpg', '2018-04-18 08:13:03', '0'),
(12, 'card_5ad6fe100c62d', 3, 0, '0', 0.00, 'img/sfv/5ad6fe100c63e.jpg', '2018-04-18 08:13:04', '0'),
(13, 'card_5ad7062a4ff0f', 2, 0, '0', 0.00, 'img/test/5ad7062a4ff1b.jpg', '2018-04-18 08:47:38', '1'),
(14, 'card_5ad7062a754e4', 2, 0, '0', 0.00, 'img/test/5ad70736f2493.jpg', '2018-04-18 08:47:38', '1'),
(15, 'card_5ad7062a8426f', 2, 0, '0', 0.00, 'img/test/5ad7062a8427e.jpg', '2018-04-18 08:47:38', '1'),
(16, 'wedding_0', 1, 0, '0', 0.00, 'img/weddingw/5adda85c9a028.jpg', '2018-04-23 09:33:16', '1'),
(17, 'wedding_1', 1, 0, '0', 0.00, 'img/weddingw/5adda85ccc780.jpg', '2018-04-23 09:33:16', '1'),
(18, 'wedding_2', 1, 0, '0', 0.00, 'img/weddingw/5adda85cd76ed.jpg', '2018-04-23 09:33:16', '1'),
(19, 'wedding_3', 1, 0, '0', 0.00, 'img/weddingw/5adda85cebdbe.jpg', '2018-04-23 09:33:16', '1'),
(20, 'wedding_4', 1, 0, '0', 0.00, 'img/weddingw/5adda85d197e9.jpg', '2018-04-23 09:33:17', '1'),
(21, 'wedding_5', 1, 0, '0', 0.00, 'img/weddingw/5adda85d2f2b1.jpg', '2018-04-23 09:33:17', '1');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `icon` varchar(255) NOT NULL,
  `order_by` varchar(10) NOT NULL,
  `status` varchar(1) NOT NULL DEFAULT '1' COMMENT '1:active,0:deleted'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `created_at`, `icon`, `order_by`, `status`) VALUES
(1, 'wedding', '2018-04-23 10:24:03', 'img/icons/5add990fbd7f0.jpg', '3', '1'),
(2, 'test', '2018-04-23 10:42:58', 'img/icons/5ad0490604125.jpg', '5', '1'),
(3, 'sfv', '2018-04-23 10:24:02', 'img/icons/5ad6fdc5c54a2.jpg', '2', '1'),
(4, 'tergwd', '2018-04-23 09:30:46', 'img/icons/5ad05f592164f.jpg', '6', '1'),
(5, 'birth', '2018-04-23 08:28:12', 'img/icons/5add70385205e.jpg', '0', '1'),
(6, 'class', '2018-04-23 09:27:31', 'img/icons/5add7048eb558.jpg', '1', '1'),
(7, 'uniben', '2018-04-23 10:42:58', 'img/icons/5add70607bfc1.jpg', '4', '1');

-- --------------------------------------------------------

--
-- Table structure for table `link`
--

CREATE TABLE `link` (
  `id` int(11) NOT NULL,
  `link` text NOT NULL,
  `cateted_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `link`
--

INSERT INTO `link` (`id`, `link`, `cateted_at`) VALUES
(1, 'efeerf', '2018-04-23 11:15:12');

-- --------------------------------------------------------

--
-- Table structure for table `sub_categories`
--

CREATE TABLE `sub_categories` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `parent` varchar(11) NOT NULL,
  `icon` varchar(200) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `order_by` varchar(10) NOT NULL,
  `status` varchar(1) NOT NULL DEFAULT '1' COMMENT '0:deleted,1:active'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sub_categories`
--

INSERT INTO `sub_categories` (`id`, `name`, `parent`, `icon`, `created_at`, `order_by`, `status`) VALUES
(1, 'tradwe', '1', 'img/icons/5ad05bc5f31de.jpg', '2018-04-13 07:01:12', '2', '1'),
(2, 'sub wedding tra', '1', 'img/icons/5add98540b871.jpg', '2018-04-23 09:24:52', '0', '1'),
(3, 'white', '1', 'img/icons/5add98732d96f.jpg', '2018-04-23 09:25:23', '1', '1'),
(4, 'a', '1', 'img/icons/5adda35091b8d.jpg', '2018-04-23 10:11:44', '3', '1'),
(5, 'b', '1', 'img/icons/5adda3683334f.jpg', '2018-04-23 10:12:08', '5', '1'),
(6, 'c', '1', 'img/icons/5adda37dea450.jpg', '2018-04-23 10:12:29', '6', '1'),
(7, 'd', '1', 'img/icons/5adda39603e0d.jpg', '2018-04-23 10:12:54', '4', '1'),
(8, 'ab', '5', 'img/icons/5adda3da2782d.jpg', '2018-04-23 10:14:02', '0', '1'),
(9, 'ac', '5', 'img/icons/5adda3f583dd3.jpg', '2018-04-23 10:14:29', '1', '1'),
(10, 'e', '1', 'img/icons/5adda46a0c4a4.jpg', '2018-04-23 10:16:26', '8', '1'),
(11, 'f', '1', 'img/icons/5adda7801b742.jpg', '2018-04-23 10:29:36', '7', '1');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(60) NOT NULL,
  `email` varchar(60) NOT NULL,
  `password` varchar(64) NOT NULL,
  `salt` varchar(32) NOT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `pic` varchar(100) NOT NULL,
  `status` varchar(1) NOT NULL DEFAULT '1' COMMENT '1 active, 0 inactive(deleted), 2 leave, 3 sick'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `salt`, `created`, `pic`, `status`) VALUES
(1, 'okoro efe', 'efe@gmail.com', 'ce2c692ee0f0a5f94ef530094c215ba2ebee1c42627cc77eac924162423ef2e8', '<+q9U,eãÊ`[ôVÄ½W+KDyL5L	', '2017-12-14 18:05:43', '5ad03ca2e1047.jpg', '1'),
(2, 'Junior', 'junior@gmail.com', '0a094c536487ef71679431feb27b4ac71f1883dbee705d443e607221895203be', '–¢Å:Ìï#Æ¾_ª\\ìƒœ8ù\Z|f–OQN|3à£', '2017-12-20 16:38:06', '', '1'),
(3, 'john', 'john@gmail.com', 'e7bc9ccb1eb79a6999d1aca7de1979fce16c397043fad5c0b636ed9ead36b5d2', 'âð¸ ëçíæ)‹¤fØÄÜˆ‡=Ów&nŠq€ªS?', '2018-01-05 07:30:25', '', '1'),
(4, 'okoro chris', 'chris@gmail.com', '25b2137df8b05edd781bc670aad5657e8db7df5090c9f2b7dda83fef099319aa', ';¹y½–b	Âæ~ªLtä|6’N0\0Øèxñø‰eŒ}', '2018-01-06 06:28:09', '', '1'),
(5, 'elo', 'elo@gmail.com', 'addbc85c467da8dfc07c90a40110dc57c80e554c6182ccf18acc9d2761f2e845', 'ŒEõý´º‡?ú0÷GÆ¾æ;l`uCh‘,³ƒ', '2018-01-06 06:31:08', '', '1'),
(6, 'Andrew', 'andrew@gmail.com', 'c9ccbe77cc0107b344270a0629c8138558088fbf1897c4bc2dc296019fc87e7e', '„w»db“-ø8[›‚ûÚÆ®ˆ³C\r…Ë€5pB', '2018-01-16 13:56:33', '', '1'),
(7, 'peter', 'peter@gmail.com', 'efbaf7e8a7727cfdf2a8250e1cd249710f8c6adade8242a0089ee111d0b7aca1', 'Ué°áøT\ZQ®½J¯\r÷é²ý^Z‚3éÎ7Šp£', '2018-01-16 13:59:01', '', '1'),
(8, 'new admin', 'admin@admin.com', '5c5a800b87b0ce3d254b8ff36aff26eb9d2e64b63aa9af7ea416b27889c20096', 'PKFMY0,N*Pn5fAo??xW#:vo5&g%^c9Go', '2018-04-10 15:19:42', '', '1'),
(9, 'new admin2', 'admin2@admin.com', 'cd0150c543bb15001f6c06e50acd07f03814ff19066842682b8c611066a6a5b7', '50Uq9YTa%lD*SaycL-&_+&HAKeI.8B=;', '2018-04-10 15:27:43', '', '1'),
(10, 'maylite2', 'may@gmail.co', '55aa77325589d5ba1dcc296cd647a6d3d806c345e399b8d4f7637e040a0c63fb', '2sfnjq=@7FJzY.X)G^7d;qDt8==UzDCU', '2018-04-10 16:41:28', '5acce1aa14a40.jpg', '1'),
(11, 'solo', 'solo@gmail.com', '99a61788307ca06af3465bad25b9005a0ac108d120c0ce7deca28e5012831e97', '0Qr3pwk=;J:nPuT^PoT$?orf?;kdwl_.', '2018-04-10 17:11:53', '5acce2d44746a.jpg', '1'),
(12, 'oga', 'oga@gmail.com', '20ff8644ec5c3afeb71d4fa8fc3f66930737fb8d90567e08602afdd2096c2c0c', '(%=UESrq^!K3iXD2_b!6#G7.=85C8Jh;', '2018-04-13 07:25:30', '5ad04d7d594e8.jpg', '1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cards`
--
ALTER TABLE `cards`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `link`
--
ALTER TABLE `link`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sub_categories`
--
ALTER TABLE `sub_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cards`
--
ALTER TABLE `cards`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `link`
--
ALTER TABLE `link`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `sub_categories`
--
ALTER TABLE `sub_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
