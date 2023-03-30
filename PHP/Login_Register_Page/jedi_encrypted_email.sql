-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Mar 09, 2022 at 07:52 PM
-- Server version: 5.7.34
-- PHP Version: 7.4.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `jedi_encrypted_email`
--

-- --------------------------------------------------------

--
-- Table structure for table `je_email_sentdrafts`
--

CREATE TABLE `je_email_sentdrafts` (
  `je_sentdraft_id` int(11) NOT NULL,
  `je_sentdraft_to_email` varchar(128) NOT NULL,
  `je_sentdraft_from_id` int(11) NOT NULL,
  `je_sentdraft_subject` varchar(256) NOT NULL,
  `je_sentdraft_content` text NOT NULL,
  `je_sentdraft_draft` int(11) NOT NULL COMMENT '0: sent (not draft),\r\n1: draft',
  `je_sentdraft_enc` int(11) NOT NULL COMMENT '0: not encrypted,\r\n1: encrypted',
  `je_sentdraft_datetime` datetime NOT NULL COMMENT 'Latest date the email was sent or saved'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `je_email_sentdrafts`
--

INSERT INTO `je_email_sentdrafts` (`je_sentdraft_id`, `je_sentdraft_to_email`, `je_sentdraft_from_id`, `je_sentdraft_subject`, `je_sentdraft_content`, `je_sentdraft_draft`, `je_sentdraft_enc`, `je_sentdraft_datetime`) VALUES
(3, 'rey@jediacademy.org', 4, 'Re: Help!!', 'Rey,\r\n\r\nConflicted, are you? Talk, we should. Things to share, I have.\r\n\r\nMay the Force be with you.\r\n\r\nY', 0, 0, '2022-03-08 15:49:21'),
(4, 'rey@jediacademy.org', 4, 'Re: Greetings!', 'Luke,\r\n\r\nParty on mind you have, do you? Talk, we should. Things to share, I have.\r\n\r\nGood to see Obi-wan, it will be.\r\n\r\nMay the Force be with you.\r\n\r\nY\r\n\r\n\r\n', 0, 0, '2022-03-09 19:49:21');

-- --------------------------------------------------------

--
-- Table structure for table `je_inbox`
--

CREATE TABLE `je_inbox` (
  `je_email_id` int(11) NOT NULL,
  `je_email_from_email` varchar(128) NOT NULL,
  `je_email_to_id` int(11) NOT NULL,
  `je_email_subject` varchar(256) NOT NULL,
  `je_email_content` text NOT NULL,
  `je_email_enc` int(11) NOT NULL COMMENT '0: not encrypted\r\n1: encrypted',
  `je_date_received` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `je_inbox`
--

INSERT INTO `je_inbox` (`je_email_id`, `je_email_from_email`, `je_email_to_id`, `je_email_subject`, `je_email_content`, `je_email_enc`, `je_date_received`) VALUES
(1, 'rey@jediacademy.org', 4, 'Help!!', 'Master Yoda,\r\n\r\nI\'m conflicted about the Force. Please help me!\r\n\r\nMay the Force be with you!\r\nRey', 0, '2022-03-01 15:30:28'),
(2, 'luke@jediacademy.org', 4, 'Greetings!', 'Master Yoda,\r\n\r\nLong time no see! It\'ll be good to hang out and chat. Let me know what day and time works best for you and we can plan something. I\'ll try to bring Force ghost Obi-wan too :)\r\n\r\nMay the Force be with you!\r\nLuke', 0, '2022-03-04 15:30:28');

-- --------------------------------------------------------

--
-- Table structure for table `je_login`
--

CREATE TABLE `je_login` (
  `je_login_id` int(11) NOT NULL,
  `je_login_email` varchar(256) NOT NULL,
  `je_login_password` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `je_login`
--

INSERT INTO `je_login` (`je_login_id`, `je_login_email`, `je_login_password`) VALUES
(1, 'rey@jediacademy.org', 'balance'),
(2, 'luke@jediacademy.org', 'luke123'),
(3, 'leia@jediacademy.org', 'balance'),
(4, 'yoda@jediacademy.org', 'yoda'),
(5, 'hansolo@falcon.org', 'chewie');

-- --------------------------------------------------------

--
-- Table structure for table `je_users`
--

CREATE TABLE `je_users` (
  `je_user_id` int(11) NOT NULL,
  `je_user_firstname` varchar(256) NOT NULL,
  `je_user_lastname` varchar(256) NOT NULL,
  `je_user_login_id` int(11) NOT NULL,
  `je_user_role` int(11) NOT NULL COMMENT '0: Admin (PRIVAC), and 1: User',
  `je_user_suspended` int(11) NOT NULL COMMENT '0: active, \r\n1: suspended'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `je_users`
--

INSERT INTO `je_users` (`je_user_id`, `je_user_firstname`, `je_user_lastname`, `je_user_login_id`, `je_user_role`, `je_user_suspended`) VALUES
(1, 'Rey', 'Skywalker', 1, 0, 0),
(2, 'Luke', 'Skywalker', 2, 1, 0),
(3, 'Leia', 'Organa', 3, 1, 0),
(4, 'Yoda', '', 4, 0, 0),
(5, 'Han', 'Solo', 5, 1, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `je_email_sentdrafts`
--
ALTER TABLE `je_email_sentdrafts`
  ADD PRIMARY KEY (`je_sentdraft_id`),
  ADD KEY `je_sent_by` (`je_sentdraft_from_id`);

--
-- Indexes for table `je_inbox`
--
ALTER TABLE `je_inbox`
  ADD PRIMARY KEY (`je_email_id`),
  ADD KEY `je_inbox_received_by` (`je_email_to_id`);

--
-- Indexes for table `je_login`
--
ALTER TABLE `je_login`
  ADD PRIMARY KEY (`je_login_id`);

--
-- Indexes for table `je_users`
--
ALTER TABLE `je_users`
  ADD PRIMARY KEY (`je_user_id`),
  ADD KEY `je_user_login` (`je_user_login_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `je_email_sentdrafts`
--
ALTER TABLE `je_email_sentdrafts`
  MODIFY `je_sentdraft_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `je_inbox`
--
ALTER TABLE `je_inbox`
  MODIFY `je_email_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `je_login`
--
ALTER TABLE `je_login`
  MODIFY `je_login_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `je_users`
--
ALTER TABLE `je_users`
  MODIFY `je_user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `je_email_sentdrafts`
--
ALTER TABLE `je_email_sentdrafts`
  ADD CONSTRAINT `je_sent_by` FOREIGN KEY (`je_sentdraft_from_id`) REFERENCES `je_login` (`je_login_id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `je_inbox`
--
ALTER TABLE `je_inbox`
  ADD CONSTRAINT `je_inbox_received_by` FOREIGN KEY (`je_email_to_id`) REFERENCES `je_login` (`je_login_id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `je_users`
--
ALTER TABLE `je_users`
  ADD CONSTRAINT `je_user_login` FOREIGN KEY (`je_user_login_id`) REFERENCES `je_login` (`je_login_id`) ON DELETE CASCADE ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
