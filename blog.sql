-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 30, 2017 at 04:24 AM
-- Server version: 10.1.25-MariaDB
-- PHP Version: 7.1.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `blog`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `category` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category`) VALUES
(1, 'Competitive Coding'),
(2, 'Web Development'),
(3, 'Gaming'),
(4, 'android dev');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `comment` text NOT NULL,
  `com_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `post_id`, `comment`, `com_date`, `user_id`) VALUES
(1, 2, 'haiii!!!', '2017-08-26 11:16:54', 1),
(2, 1, 'hey !! nice post', '2017-08-27 12:30:02', 1),
(3, 4, 'Woahhh!! Nice One... I Love Paladins too\r\nAdd me IGN : rogue0197 :0 ', '2017-08-28 22:37:42', 1),
(4, 4, 'Sure!!! :)', '2017-08-28 22:38:20', 5),
(14, 4, ' I ll Join You Some Day ', '2017-08-28 22:52:51', 3);

-- --------------------------------------------------------

--
-- Table structure for table `followers`
--

CREATE TABLE `followers` (
  `id` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `follower_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `followers`
--

INSERT INTO `followers` (`id`, `parent_id`, `follower_id`) VALUES
(16, 2, 3),
(17, 1, 3),
(18, 1, 2),
(20, 3, 1),
(21, 1, 5),
(24, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `post_id` int(11) DEFAULT NULL,
  `parent_id` int(11) NOT NULL,
  `notifier_id` int(11) NOT NULL,
  `notification_type` char(1) NOT NULL,
  `notify_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `notification_read` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `post_id`, `parent_id`, `notifier_id`, `notification_type`, `notify_time`, `notification_read`) VALUES
(16, NULL, 2, 3, 'F', '2017-08-25 12:05:48', 1),
(17, NULL, 1, 3, 'F', '2017-08-25 12:05:51', 1),
(18, NULL, 1, 2, 'F', '2017-08-25 12:06:04', 1),
(20, NULL, 3, 1, 'F', '2017-08-25 13:33:26', 1),
(48, 2, 2, 1, 'C', '2017-08-26 11:16:54', 1),
(50, 1, 1, 1, 'L', '2017-08-26 11:42:22', 1),
(53, 2, 2, 1, 'L', '2017-08-27 12:12:54', 1),
(54, 2, 2, 2, 'L', '2017-08-27 12:14:44', 1),
(55, 1, 1, 1, 'C', '2017-08-27 12:30:02', 1),
(56, 3, 3, 1, 'N', '2017-08-27 12:48:05', 1),
(57, 3, 2, 1, 'N', '2017-08-27 12:48:05', 1),
(74, 3, 1, 2, 'L', '2017-08-27 13:25:58', 1),
(75, 3, 1, 1, 'L', '2017-08-27 19:06:28', 1),
(76, 3, 1, 5, 'L', '2017-08-28 22:19:15', 1),
(77, NULL, 1, 5, 'F', '2017-08-28 22:19:18', 1),
(86, 4, 5, 1, 'C', '2017-08-28 22:47:17', 1),
(87, 4, 5, 3, 'C', '2017-08-28 22:48:15', 1),
(88, 4, 5, 3, 'C', '2017-08-28 22:49:06', 1),
(89, 4, 5, 3, 'C', '2017-08-28 22:50:22', 1),
(90, 4, 5, 3, 'C', '2017-08-28 22:51:25', 1),
(91, 4, 5, 3, 'C', '2017-08-28 22:51:33', 1),
(92, 4, 5, 3, 'C', '2017-08-28 22:52:09', 1),
(93, 4, 5, 3, 'C', '2017-08-28 22:52:51', 1),
(94, 4, 5, 3, 'L', '2017-08-28 22:53:09', 1),
(95, 1, 1, 3, 'L', '2017-08-28 22:53:27', 1),
(96, 3, 1, 3, 'L', '2017-08-28 22:53:30', 1),
(99, 1, 1, 5, 'L', '2017-08-29 13:19:12', 1),
(105, 4, 5, 1, 'L', '2017-08-29 15:02:22', 0),
(106, NULL, 2, 1, 'F', '2017-08-29 15:05:17', 0);

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `title` varchar(150) NOT NULL,
  `body` text NOT NULL,
  `user_id` int(11) NOT NULL,
  `cate_id` int(11) NOT NULL,
  `create_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `title`, `body`, `user_id`, `cate_id`, `create_date`) VALUES
(1, '  How to start competitive coding?  ', 'Start on hacker Earth. Move to hacker rank. then to code chef.\r\nTake part in ICPC. Believe in yourself.Start on hacker Earth. Move to hacker rank. then to code chef.\r\nTake part in ICPC. Believe in yourself.Start on hacker Earth. Move to hacker rank. then to code chef.\r\nTake part in ICPC. Believe in yourself.Start on hacker Earth. Move to hacker rank. then to code chef.\r\nTake part in ICPC. Believe in yourself.Start on hacker Earth. Move to hacker rank. then to code chef.\r\nTake part in ICPC. Believe in yourself.', 1, 1, '2017-08-25 10:28:07'),
(2, 'How to start web development?', 'Know the basics from w3.Work on various projects.Build something with what you have learnt,Even though it is quite smaller one.If you have any query, you can always google it.\r\nKnow the basics from w3.Work on various projects.Build something with what you have learnt,Even though it is quite smaller one.If you have any query, you can always google it.\r\nKnow the basics from w3.Work on various projects.Build something with what you have learnt,Even though it is quite smaller one.If you have any query, you can always google it.\r\n', 2, 2, '2017-08-25 10:30:29'),
(3, 'New QualComm ISP 2nd gen spectra', 'The Module has been developed by QUALCOMM. With the help of this,2D captures can be viewed in 3D. \r\nThe Module has been developed by QUALCOMM. With the help of this,2D captures can be viewed in 3D. \r\nThe Module has been developed by QUALCOMM. With the help of this,2D captures can be viewed in 3D. \r\nThe Module has been developed by QUALCOMM. With the help of this,2D captures can be viewed in 3D. \r\nThe Module has been developed by QUALCOMM. With the help of this,2D captures can be viewed in 3D. ', 1, 2, '2017-08-27 12:48:05'),
(4, 'Paladins Vs Overwatch', 'Paladins And overwatch both may seem alike , given they are both MOBA FPS games, But they are completey different.\r\nIn Paladins You need to set Loadouts and choose legendary which defines your play style.\r\nGraphically Overwatch dominates paladins, but then again Not everyone has high end PC.\r\nPaladins require Good aim, strategic building,team work where as overwatch depends on good aim.\r\nIf you ask me paladins is the best, after who doesnt like a free to play game unlike the other xD.', 5, 3, '2017-08-28 22:23:46');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `email` varchar(64) NOT NULL,
  `password` varchar(255) NOT NULL,
  `admin` int(11) NOT NULL DEFAULT '0',
  `active` int(11) NOT NULL DEFAULT '0',
  `hash` varchar(255) NOT NULL,
  `avatar` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `admin`, `active`, `hash`, `avatar`) VALUES
(1, 'sairam', 'sairam@gmail.com', 'd98bb50e808918dd45a8d92feafc4fa3', 1, 1, '0', '0'),
(2, 'sandeep', 'sandeep@gmail.com', '430da3c041d48ed640348e4f5408fe7b', 0, 1, '0', '0'),
(3, 'test', 'test@gmail.com', 'c861703d2d97e624a2f3f2dc7cf89c17', 0, 1, '0', '0'),
(5, 'damba', 'damba@gmail.com', 'e0c1a735f148b133091586923d527318', 1, 1, '4311359ed4969e8401880e3c1836fbe1', '3eb3e6b90d624340606df22194225bfeb42cad7028f1faa76a0c994fbc32a760.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `post_id` (`post_id`);

--
-- Indexes for table `followers`
--
ALTER TABLE `followers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `parent_id` (`parent_id`),
  ADD KEY `follower_id` (`follower_id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `parent_id` (`parent_id`),
  ADD KEY `notifier_id` (`notifier_id`),
  ADD KEY `post_id` (`post_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `cate_id` (`cate_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `followers`
--
ALTER TABLE `followers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=107;
--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `followers`
--
ALTER TABLE `followers`
  ADD CONSTRAINT `followers_ibfk_1` FOREIGN KEY (`parent_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `followers_ibfk_2` FOREIGN KEY (`follower_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_ibfk_1` FOREIGN KEY (`parent_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `notifications_ibfk_2` FOREIGN KEY (`notifier_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `notifications_ibfk_3` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `posts_ibfk_2` FOREIGN KEY (`cate_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
