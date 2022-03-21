-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: mysql
-- Generation Time: Mar 21, 2022 at 03:48 PM
-- Server version: 8.0.28
-- PHP Version: 8.0.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `social`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int NOT NULL,
  `post_body` text NOT NULL,
  `posted_by` varchar(60) NOT NULL,
  `posted_to` varchar(60) NOT NULL,
  `date_added` datetime NOT NULL,
  `removed` varchar(3) NOT NULL,
  `post_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `post_body`, `posted_by`, `posted_to`, `date_added`, `removed`, `post_id`) VALUES
(1, 'Wake up!', 'sarmad_kinany_1', '', '2021-11-05 00:45:37', 'no', 34),
(2, 'Wake up!', 'sarmad_kinany_1', '', '2021-11-05 01:03:41', 'no', 34),
(3, 'Wake up!', 'sarmad_kinany_1', '', '2021-11-05 01:04:08', 'no', 24),
(4, 'A!', 'sarmad_kinany_1', '', '2021-11-05 01:10:27', 'no', 31),
(5, 'Hi!', 'sarmad_kinany_1', '', '2021-11-05 01:15:04', 'no', 34),
(6, 'Wake up!!', 'sarmad_kinany_1', 'georgie_kinany', '2021-11-05 01:18:13', 'no', 34),
(7, 'Never mind!', 'sarmad_kinany_1', 'georgie_kinany', '2021-11-06 16:41:46', 'no', 33),
(8, 'What?', 'sarmad_kinany_1', 'john_bettiol', '2021-11-06 16:42:28', 'no', 32),
(9, 'Huh?', 'sarmad_kinany_1', 'john_bettiol', '2021-11-06 16:42:38', 'no', 30),
(10, 'Ain\'t it so?', 'sarmad_kinany_1', 'sarmad_kinany_1', '2021-11-06 16:43:00', 'no', 25),
(11, 'Another test.', 'sarmad_kinany_1', 'john_bettiol', '2021-11-06 16:51:37', 'no', 28),
(12, 'And another.', 'sarmad_kinany_1', 'john_bettiol', '2021-11-06 16:51:45', 'no', 28),
(13, 'Third comment in a row - Test', 'sarmad_kinany_1', 'john_bettiol', '2021-11-06 16:51:55', 'no', 28),
(14, '', 'sarmad_kinany_1', 'georgie_kinany', '2021-11-06 19:19:36', 'no', 34),
(15, '', 'sarmad_kinany_1', 'georgie_kinany', '2021-11-06 19:38:07', 'no', 33),
(16, 'Comment (TEST)', 'sarmad_kinany_1', 'john_bettiol', '2021-11-06 20:00:58', 'no', 29),
(17, 'Working.', 'sarmad_kinany_1', 'sarmad_kinany_1', '2021-11-06 20:05:59', 'no', 22),
(18, 'Refund initiated successfully. ', 'john_bettiol', 'john_bettiol', '2021-11-09 22:45:00', 'no', 31),
(19, 'Full refund initiated for the customer.', 'john_bettiol', 'georgie_kinany', '2021-11-09 22:47:13', 'no', 34),
(20, 'Customer refund initiated.', 'sarmad_kinany_1', 'georgie_kinany', '2021-11-10 11:15:44', 'no', 37),
(21, 'Refund initiated.', 'sarmad_kinany_1', 'sarmad_kinany_1', '2021-11-10 11:46:54', 'no', 38),
(22, 'Refund initiated', 'john_bettiol', 'sarmad_kinany_1', '2021-11-17 11:13:31', 'no', 40),
(23, 'Seems to be working . . until now', 'wojciech_guła', 'sarmad_kinany_1', '2021-12-13 00:04:01', 'no', 42),
(24, 'Shit is getting real (in a good way). It is working!!', 'john_bettiol', 'wojciech_guła', '2021-12-13 00:06:07', 'no', 43),
(25, 'STILL WORKING!!', 'john_bettiol', 'wojciech_guła', '2021-12-13 00:06:23', 'no', 43),
(26, 'So far so good :)', 'georgie_kinany', 'wojciech_guła', '2021-12-13 00:20:42', 'no', 43),
(27, 'Works now.', 'georgie_kinany', 'wojciech_gula', '2021-12-13 00:21:34', 'no', 46),
(28, 'Still working.', 'sarmad_kinany_1', 'wojciech_gula', '2021-12-18 21:49:59', 'no', 46),
(29, 'Testing comment section again.', 'john_bettiol', 'john_bettiol', '2022-01-16 18:00:05', 'no', 48),
(30, 'Testing comment section from different account.', 'sarmad_kinany_1', 'john_bettiol', '2022-01-16 18:00:46', 'no', 48),
(31, 'Test 456', 'georgie_kinany', 'georgie_kinany', '2022-02-09 18:24:52', 'no', 50),
(32, 'Test Test 321', 'wojciech_gula', 'georgie_kinany', '2022-02-09 18:25:22', 'no', 50),
(33, 'Test 333.', 'sarmad_kinany_1', 'georgie_kinany', '2022-02-13 13:37:52', 'no', 50),
(34, 'Check.', 'georgie_kinany', 'john_bettiol', '2022-02-19 13:58:33', 'no', 53),
(35, 'Check.', 'georgie_kinany', 'john_bettiol', '2022-02-19 13:58:40', 'no', 54),
(36, 'test (NULL) {\"Do not use AUTO_INCREMENT for zero values\" is checked while importing db}', 'john_bettiol', 'john_bettiol', '2022-02-27 17:06:18', 'no', 54),
(37, 'Test comment GULA with non-Polish L', 'wojciech_gula', 'john_bettiol', '2022-02-27 17:39:44', 'no', 57),
(38, '1 confirm by GULA with non-Polish L', 'wojciech_gula', 'john_bettiol', '2022-02-27 17:40:20', 'no', 57),
(39, 'Test comment GUŁA with Polish Ł', 'wojciech_guła', 'john_bettiol', '2022-02-27 17:49:06', 'no', 57),
(40, '', 'georgie_kinany', 'john_bettiol', '2022-02-27 19:24:33', 'no', 54),
(41, 'Testing comment (Wojciech one)', 'wojciech_guła', 'john_bettiol', '2022-03-07 23:59:18', 'no', 63),
(42, 'Testing comment (Wojciech two)', 'wojciech_gula', 'john_bettiol', '2022-03-07 23:59:43', 'no', 63);

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `id` int NOT NULL,
  `username` varchar(60) NOT NULL,
  `post_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `likes`
--

INSERT INTO `likes` (`id`, `username`, `post_id`) VALUES
(7, 'georgie_kinany', 32),
(11, 'georgie_kinany', 31),
(13, 'georgie_kinany', 25),
(14, 'georgie_kinany', 20),
(15, 'georgie_kinany', 19),
(16, 'georgie_kinany', 33),
(27, 'georgie_kinany', 35),
(30, 'john_bettiol', 34),
(39, 'georgie_kinany', 34),
(40, 'sarmad_kinany_1', 37),
(42, 'sarmad_kinany_1', 38),
(43, 'john_bettiol', 40),
(44, 'john_bettiol', 18),
(46, 'john_bettiol', 27),
(48, 'wojciech_guła', 42),
(49, 'john_bettiol', 43),
(50, 'wojciech_gula', 43),
(51, 'wojciech_gula', 44),
(52, 'wojciech_gula', 47),
(53, 'georgie_kinany', 43),
(54, 'georgie_kinany', 46),
(55, 'sarmad_kinany_1', 44),
(56, 'sarmad_kinany_1', 48),
(57, 'sarmad_kinany_1', 43),
(58, 'wojciech_gula', 50),
(59, 'sarmad_kinany_1', 50),
(60, 'sarmad_kinany_1', 49),
(64, 'georgie_kinany', 53),
(65, 'wojciech_gula', 46),
(68, '', 51),
(69, '', 37),
(77, 'georgie_kinany', 57),
(78, 'georgie_kinany', 54),
(80, 'georgie_kinany', 27),
(81, 'georgie_kinany', 28),
(82, 'georgie_kinany', 12),
(83, 'georgie_kinany', 63);

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int NOT NULL,
  `body` text NOT NULL,
  `added_by` varchar(60) NOT NULL,
  `user_to` varchar(60) NOT NULL,
  `date_added` datetime NOT NULL,
  `user_closed` varchar(3) NOT NULL,
  `deleted` varchar(3) NOT NULL,
  `likes` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `body`, `added_by`, `user_to`, `date_added`, `user_closed`, `deleted`, `likes`) VALUES
(1, 'This is the first announcement! (7th attempt!)', 'sarmad_kinany_1', 'none', '2021-08-01 16:09:40', 'no', 'no', 0),
(2, 'This is the first announcement! (7th attempt!)', 'sarmad_kinany_1', 'none', '2021-08-01 16:09:57', 'no', 'no', 0),
(3, 'This is the second announcement!', 'sarmad_kinany_1', 'none', '2021-08-01 16:10:17', 'no', 'no', 0),
(4, 'This is the second announcement!', 'sarmad_kinany_1', 'none', '2021-08-02 10:10:19', 'no', 'no', 0),
(5, 'This is the second announcement!', 'sarmad_kinany_1', 'none', '2021-08-03 18:37:16', 'no', 'no', 0),
(6, 'This is the second announcement!', 'sarmad_kinany_1', 'none', '2021-08-05 12:29:26', 'no', 'no', 0),
(7, 'This is the second announcement!', 'sarmad_kinany_1', 'none', '2021-08-06 00:30:33', 'no', 'no', 0),
(8, 'Hello there!\n\nDB\n\nRS', 'sarmad_kinany_1', 'none', '2021-08-06 00:38:01', 'no', 'no', 0),
(9, 'Hello there!\n\nDB\n\nRS', 'sarmad_kinany_1', 'none', '2021-08-06 00:38:05', 'no', 'no', 0),
(10, 'DB la malawaya?', 'sarmad_kinany_1', 'none', '2021-08-06 00:44:00', 'no', 'no', 0),
(11, 'Hello!\n', 'georgie_kinany', 'none', '2021-08-08 00:15:51', 'no', 'yes', 0),
(12, 'Hey!!', 'michael_feinbier', 'none', '2021-08-08 00:28:51', 'no', 'no', 1),
(13, 'O21-1989721010525656 arrived. ', 'georgie_kinany', 'none', '2021-09-29 12:05:12', 'no', 'yes', 0),
(14, 'O20-946628409898703 has arrived.', 'michael_feinbier', 'none', '2021-09-29 12:11:04', 'no', 'no', 0),
(15, 'O21-27370262631311 arrived in warehouse.', 'sarmad_kinany_1', 'none', '2021-09-29 12:14:46', 'no', 'no', 0),
(16, 'O21-14327818069412 received.\n', 'sarmad_kinany_1', 'none', '2021-09-29 13:29:08', 'no', 'yes', 0),
(17, 'O21-73327810069455 arrived at 8:35 in Duisburg warehouse.', 'sarmad_kinany_1', 'none', '2021-10-18 23:37:20', 'no', 'yes', 0),
(18, 'O19-643328409898919 arrived at 8:40 in Marl warehouse.\nNote: package damaged in multiple areas. Content is safe and intact.', 'sarmad_kinany_1', 'none', '2021-10-18 23:41:56', 'no', 'no', 1),
(19, 'O20-910928349218344 arrived at 7:50 in Madrid warehouse.', 'georgie_kinany', 'none', '2021-10-19 21:47:19', 'no', 'yes', 1),
(20, 'O21-2366278459869245 arrived at 9:10 in Duisburg warehouse. \nNote: Product has correct serial number, but not in original package.', 'john_bettiol', 'none', '2021-10-19 22:20:17', 'no', 'no', 1),
(21, 'TEST', 'sarmad_kinany_1', 'none', '2021-10-20 00:13:10', 'no', 'yes', 0),
(22, 'TEST', 'sarmad_kinany_1', 'none', '2021-10-20 00:14:37', 'no', 'no', 0),
(23, 'TEST', 'sarmad_kinany_1', 'none', '2021-10-20 00:14:41', 'no', 'yes', 0),
(24, 'TEST', 'sarmad_kinany_1', 'none', '2021-10-20 00:23:00', 'no', 'yes', 0),
(25, 'TEST', 'sarmad_kinany_1', 'none', '2021-10-20 00:25:02', 'no', 'yes', 1),
(26, 'Test 1', 'john_bettiol', 'none', '2021-10-20 00:26:23', 'no', 'yes', 0),
(27, 'Test 2\n', 'john_bettiol', 'none', '2021-10-20 00:26:59', 'no', 'no', 2),
(28, 'Test 3', 'john_bettiol', 'none', '2021-10-20 00:27:04', 'no', 'no', 1),
(29, 'Test 4', 'john_bettiol', 'none', '2021-10-20 00:27:09', 'no', 'no', 0),
(30, 'Test 5', 'john_bettiol', 'none', '2021-10-20 00:27:13', 'no', 'no', 0),
(31, 'Test #6', 'john_bettiol', 'none', '2021-10-20 00:28:16', 'no', 'yes', 1),
(32, 'O21-2366278459869245 arrived at 9:10 in Duisburg warehouse. Note: Product has correct serial number, but not in original package.\n', 'john_bettiol', 'none', '2021-10-20 00:28:39', 'no', 'no', 1),
(33, 'O21-1953721012525612 arrived at 7:50 at Marl warehouse.', 'georgie_kinany', 'none', '2021-10-20 23:15:35', 'no', 'no', 1),
(34, 'O21-1989723434527272 arrived at 8:20 in Madrid warehouse.', 'georgie_kinany', 'none', '2021-10-20 23:16:38', 'no', 'no', 3),
(35, 'TOTD', 'georgie_kinany', 'none', '2021-11-07 21:46:06', 'no', 'yes', 1),
(36, 'O20-910928349218344 arrived at 7:50 in Madrid warehouse.', 'georgie_kinany', 'none', '2021-11-10 00:49:37', 'no', 'yes', 0),
(37, 'O21-1989723434527272 arrived at 7:50 at Marl warehouse.', 'georgie_kinany', 'none', '2021-11-10 00:50:26', 'no', 'no', 2),
(38, 'O21-1989723434527272 has arrived at our Vidaxl warehouse.', 'sarmad_kinany_1', 'none', '2021-11-10 11:46:16', 'no', 'no', 1),
(39, 'O21-20846993434521824 has arrived at Schneider GmbH warehouse. Customer\'s refund to be initiated.', 'sarmad_kinany_1', 'none', '2021-11-14 23:27:24', 'no', 'no', 0),
(40, 'O20-53846663134128 has arrived at MAX GmbH warehouse. Customer\'s refund to be initiated.', 'sarmad_kinany_1', 'none', '2021-11-14 23:29:09', 'no', 'no', 1),
(41, 'Testing', 'john_bettiol', 'none', '2021-12-02 17:13:53', 'no', 'yes', 0),
(42, 'Testing after setting up Namespaces', 'sarmad_kinany_1', 'none', '2021-12-12 23:59:26', 'no', 'no', 1),
(43, 'Classes modification test. TO BE CONFIRMED FOR TESTING', 'wojciech_guła', 'none', '2021-12-13 00:04:49', 'no', 'no', 4),
(44, 'Test #2', 'wojciech_guła', 'none', '2021-12-13 00:08:27', 'no', 'no', 2),
(45, 'Test #2 (part two). To be deleted.', 'wojciech_guła', 'none', '2021-12-13 00:08:51', 'no', 'yes', 0),
(46, 'Testing second account with the name Wojciech to test the profile page (last name containing all English letters for this second account). TO BE CONFIRMED. ', 'wojciech_gula', 'none', '2021-12-13 00:19:04', 'no', 'no', 2),
(47, 'Test 2 DELECT\n', 'wojciech_gula', 'none', '2021-12-13 00:19:24', 'no', 'yes', 1),
(48, 'Config dir moved (next to src)', 'john_bettiol', 'none', '2022-01-16 17:59:32', 'no', 'no', 1),
(49, 'TST (new)', 'wojciech_gula', 'none', '2022-01-26 11:24:42', 'no', 'no', 1),
(50, 'Test 123.', 'georgie_kinany', 'none', '2022-02-09 18:24:40', 'no', 'no', 2),
(51, 'Ajax files updated.', 'sarmad_kinany_1', 'none', '2022-02-19 12:57:59', 'no', 'no', 1),
(52, 'Header clean-up test . . .', 'john_bettiol', 'none', '2022-02-19 13:54:54', 'no', 'yes', 0),
(53, 'Header clean-up test . . .', 'john_bettiol', 'none', '2022-02-19 13:57:24', 'no', 'no', 1),
(54, 'Header clean-up test . . ', 'john_bettiol', 'none', '2022-02-19 13:57:37', 'no', 'no', 1),
(55, 'Header clean-up test . ', 'john_bettiol', 'none', '2022-02-19 13:57:44', 'no', 'yes', 0),
(56, 'Header clean-up test \n', 'john_bettiol', 'none', '2022-02-19 13:57:50', 'no', 'yes', 0),
(57, 'Test 17:36', 'john_bettiol', 'none', '2022-02-27 17:36:52', 'no', 'no', 1),
(58, 'Test to be deleted.', 'georgie_kinany', 'none', '2022-02-27 18:10:26', 'no', 'yes', 0),
(59, 'Announcements fixed.', 'georgie_kinany', 'none', '2022-02-28 08:33:06', 'no', 'no', 0),
(60, 'Comments fixed.', 'georgie_kinany', 'none', '2022-02-28 08:33:12', 'no', 'no', 0),
(61, 'Confirms fixed.', 'georgie_kinany', 'none', '2022-02-28 08:33:24', 'no', 'no', 0),
(62, 'ProfilePage_nginx_404 not yet fixed.', 'michael_feinbier', 'none', '2022-03-01 13:30:38', 'no', 'no', 0),
(63, 'href\'s fixed on index, header, comment_frame, Post', 'john_bettiol', 'none', '2022-03-07 23:58:16', 'no', 'no', 1),
(64, 'Test.', 'wojciech_guła', 'none', '2022-03-08 14:11:17', 'no', 'yes', 0);

-- --------------------------------------------------------

--
-- Table structure for table `test`
--

CREATE TABLE `test` (
  `id` int NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `first_name` varchar(25) NOT NULL,
  `last_name` varchar(25) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `signup_date` date NOT NULL,
  `profile_pic` varchar(255) NOT NULL,
  `num_posts` int NOT NULL,
  `num_likes` int NOT NULL,
  `user_closed` varchar(3) NOT NULL,
  `friend_array` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `username`, `email`, `password`, `signup_date`, `profile_pic`, `num_posts`, `num_likes`, `user_closed`, `friend_array`) VALUES
(1, 'Sarmad', 'Kinany', 'sarmad_kinany', 'sarmad@gmail.com', 'Password', '2021-03-09', 'gccvjv', 1, 1, 'no', ''),
(2, 'Sarmad', 'Kinany', 'sarmad_kinany_1', 'Dsarmad@gmail.com', 'dc647eb65e6711e155375218212b3964', '2021-07-18', '', 10, 6, 'no', ','),
(3, 'Michael', 'Feinbier', 'michael_feinbier', 'Michael@gmail.com', 'dc647eb65e6711e155375218212b3964', '2021-07-19', '', 1, 1, 'no', ','),
(4, 'Georgie', 'Kinany', 'georgie_kinany', 'Georgie@gmail.com', 'dc647eb65e6711e155375218212b3964', '2021-07-19', '', 10, 9, 'no', ''),
(5, 'John', 'Bettiol', 'john_bettiol', 'John@gmail.com', 'dc647eb65e6711e155375218212b3964', '2021-10-19', '', 16, 11, 'no', ','),
(6, 'Wojciech', 'Guła', 'wojciech_guła', 'Wojciech@gmail.com', 'dc647eb65e6711e155375218212b3964', '2021-12-13', '', 4, 6, 'no', ','),
(7, 'Wojciech', 'Gula', 'wojciech_gula', 'Wojciech2@gmail.com', 'dc647eb65e6711e155375218212b3964', '2021-12-13', '', 4, 4, 'no', ',');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
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
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
