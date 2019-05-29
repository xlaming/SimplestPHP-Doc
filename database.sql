SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `user` varchar(50) NOT NULL,
  `pass` varchar(300) NOT NULL,
  `usrtoken` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `admins` (`id`, `user`, `pass`, `usrtoken`) VALUES
(1, 'admin', 'your_hashed_pass', '');

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `icon` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `categories` (`id`, `name`, `icon`) VALUES
(1, 'Getting started', 'home'),
(2, 'Frontend', 'palette'),
(3, 'Security', 'lock'),
(4, 'Database', 'database'),
(5, 'Sessions', 'cookie'),
(6, 'Validation', 'check');

CREATE TABLE `config` (
  `id` int(11) NOT NULL,
  `highlight` enum('0','1') NOT NULL,
  `login` enum('0','1') NOT NULL,
  `down_link` varchar(200) NOT NULL,
  `git_link` varchar(200) NOT NULL,
  `version` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `config` (`id`, `highlight`, `login`, `down_link`, `git_link`, `version`) VALUES
(1, '1', '1', 'http://github.com/xLaming/SimplestPHP/archive/master.zip', 'http://github.com/xLaming/SimplestPHP', '1.2');

CREATE TABLE `pages` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `slug` varchar(50) NOT NULL,
  `content` longtext NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `pages` (`id`, `name`, `slug`, `content`, `category_id`) VALUES
(1, 'Installation', 'installation', '[h1]testing[/h1]\r\n[h2]testing[/h2]\r\n[h3]testing[/h3]\r\n[h4]testing[/h4]\r\n[h5]testing[/h5]\r\n\r\n\r\n[b]Example code[/b]\r\n[code]<?php echo \'test\'; ?>[/code]\r\n\r\n[br][br]\r\n\r\n[b]Another example[/b]\r\n[code]<?php \r\nclass Test {\r\npublic function a() {\r\n        print \"test\";\r\n    }\r\n}\r\n\r\n# init class\r\n$test = new Test();\r\n\r\n$test->a();\r\n?>[/code]', 1);

ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `config`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

ALTER TABLE `config`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

ALTER TABLE `pages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
