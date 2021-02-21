-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 16, 2019 at 10:17 AM
-- Server version: 10.1.24-MariaDB
-- PHP Version: 7.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project`
--

-- --------------------------------------------------------

--
-- Table structure for table `advertising`
--

CREATE TABLE `advertising` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `discreption` text NOT NULL,
  `file` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `advertising`
--

INSERT INTO `advertising` (`id`, `title`, `discreption`, `file`) VALUES
(1, ' إعــــــلان لطلاب و طالبات كلية الحقوق\r\n\r\n', 'تقوم العيادة القانونية بكلية الحقوق جامعة الأزهر-غزة بتنفيذ مشروع (رؤى جديدة لتطوير التعليم القانوني) بدعم من برنامج الأمم المتحدة الإنمائي / برنامج مساعدة الشعب الفلسطيني، ويتضمن ذلك تنفيذ أنشطة تهدف إلى بناء قدرات الطلبة وتنمية مهاراتهم في مجالات قانونية متعددة لدعم سيادة القانون وتعزيز العدالة في المجتمع الفلسطيني.\r\n\r\n', ''),
(4, 'دورات مركز التعليم المستمر', ' يعلن مركز التعليم المستمر وخدمة المجتمع عن البدء للتسجيل للدورات التالية\r\n\r\n', '');

-- --------------------------------------------------------

--
-- Table structure for table `discussions`
--

CREATE TABLE `discussions` (
  `id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `place` varchar(255) NOT NULL,
  `duration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `discussions`
--

INSERT INTO `discussions` (`id`, `project_id`, `date`, `place`, `duration`) VALUES
(5, 4, '2019-06-14 03:00:00', 'الازهر', 20);

-- --------------------------------------------------------

--
-- Table structure for table `forms`
--

CREATE TABLE `forms` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `file` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `forms`
--

INSERT INTO `forms` (`id`, `name`, `file`) VALUES
(5, 'استمارة حضور', 'الرابعة-اضافة-الدرس-الثاني.doc');

-- --------------------------------------------------------

--
-- Table structure for table `invitations`
--

CREATE TABLE `invitations` (
  `id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `owner` int(11) NOT NULL,
  `friend` int(11) NOT NULL,
  `accepted` tinyint(1) NOT NULL,
  `viewed` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `invitations`
--

INSERT INTO `invitations` (`id`, `project_id`, `owner`, `friend`, `accepted`, `viewed`) VALUES
(11, 4, 34, 36, 0, 0),
(12, 4, 34, 24, 1, 1),
(13, 4, 34, 32, 1, 1),
(14, 4, 34, 33, 0, 0),
(15, 6, 39, 36, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `submitter` int(11) NOT NULL,
  `discreption` text NOT NULL,
  `pr_type` varchar(255) NOT NULL,
  `teacher` varchar(255) NOT NULL DEFAULT '[]',
  `discussion` int(11) NOT NULL,
  `file_name` varchar(255) NOT NULL,
  `approved` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`id`, `name`, `submitter`, `discreption`, `pr_type`, `teacher`, `discussion`, `file_name`, `approved`) VALUES
(4, 'تطبيق اندرويد', 34, 'disc', 'الجافا وكوتلن', '[\"27\",\"35\"]', 5, 'loginDB.php', 1),
(5, 'تطبيق اندرويد', 33, 'test', 'asd', '[\"26\"]', 0, 'Chatazon-master.zip', 0),
(6, 'تطبيق اندرويد 2', 39, 'تطبيق قران كريم', 'جافا و كوتلن', '[\"37\"]', 0, 'Chatazon-master.zip', 0);

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `st_id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `spec` varchar(255) NOT NULL,
  `mobile` varchar(255) NOT NULL,
  `level` int(11) NOT NULL,
  `project_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `user_id`, `name`, `st_id`, `email`, `spec`, `mobile`, `level`, `project_id`) VALUES
(1, 24, 'Ahmed Fa', 123, '', 'SE', '', 4, 4),
(2, 32, 'أحمد فايز', 20163477, '', 'SE', '', 4, 4),
(3, 33, 'moh', 66, '', 'هندسة', '', 3, 5),
(4, 34, 'أحمد', 20160899, '', 'SE', '', 4, 4),
(5, 36, 'أحمد', 20163477, '', 'SE', '', 2, 0),
(6, 38, '', 0, '', '', '', 0, 0),
(7, 39, 'محمد الخالدي', 20162122, '', 'SE', '', 4, 6);

-- --------------------------------------------------------

--
-- Table structure for table `teachers`
--

CREATE TABLE `teachers` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `te_id` varchar(20) NOT NULL,
  `projects` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `teachers`
--

INSERT INTO `teachers` (`id`, `user_id`, `name`, `te_id`, `projects`) VALUES
(2, 26, 'asd', '', ''),
(3, 27, 'Dr Bob', '2012', ''),
(6, 30, '', '', ''),
(7, 31, 'asdas', '2012', ''),
(8, 35, 'أحمد محمود', '0222', ''),
(9, 37, 'عبدالباسط المصري', '123', '');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(20) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `token` varchar(255) NOT NULL,
  `u_level` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `phone`, `token`, `u_level`) VALUES
(24, 'AhmedFa', '202cb962ac59075b964b07152d234b70', 'a@a.com', '059', 'a5da779ff9b059b0f250942181f45fe6', 3),
(25, 'Admin', '202cb962ac59075b964b07152d234b70', 'a@a.com', '059', 'bd0737cc5197001f077ae793b4785740', 1),
(26, 'asd', '202cb962ac59075b964b07152d234b70', 'a@a.com', '059', '0f93736e2b9f9522a12ee9039ddd75ee', 2),
(27, 'bob', '202cb962ac59075b964b07152d234b70', 'd@d.com', '0595', '2c223e373593817cb3a19bc798c669a8', 2),
(31, 'das', '32832606886ee83d907a82e8e63b85a0', 'asdad@asd.com', 'das', 'a91423dd5edc8677f62a8a9d9f1e0405', 2),
(32, 'ahmedfa2', '202cb962ac59075b964b07152d234b70', 'Ahmed@ahmed.com', '0595064223', '62a6faa047a5e6a5f0d7b3b21d559225', 3),
(33, 'abujamel', '202cb962ac59075b964b07152d234b70', 'abugamel_hwot@hotmai', '123', 'b665fff369f17ad71c06ad7866105fdd', 3),
(34, 'aaaa', '202cb962ac59075b964b07152d234b70', 'a7mad7050@gmail.com', '0597212499', 'c4e892ebd95c7245f3c8bb92f804b88a', 3),
(35, 'ahmed1', '202cb962ac59075b964b07152d234b70', 'ahmed@a.com', '0599705591', 'a345fb0c136c3e8fba4d1b9ab25ca971', 2),
(36, 'ahmed_ra', '202cb962ac59075b964b07152d234b70', 'test@test.com', '0597857597', '2d667d0df897cb15f74e4ec1df73b4f4', 3),
(37, 'abd', '202cb962ac59075b964b07152d234b70', 'abd@a.com', '123', 'd3780413a9f3042d68b409773de44f84', 2),
(38, '', 'd41d8cd98f00b204e9800998ecf8427e', '', '', '74be16979710d4c4e7c6647856088456', 3),
(39, 'MHMD123', '202cb962ac59075b964b07152d234b70', 'AA@QA.COM', '05950', 'e3e45f44878cfb4925f12644782b08dd', 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `advertising`
--
ALTER TABLE `advertising`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `discussions`
--
ALTER TABLE `discussions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `forms`
--
ALTER TABLE `forms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invitations`
--
ALTER TABLE `invitations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teachers`
--
ALTER TABLE `teachers`
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
-- AUTO_INCREMENT for table `advertising`
--
ALTER TABLE `advertising`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `discussions`
--
ALTER TABLE `discussions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `forms`
--
ALTER TABLE `forms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `invitations`
--
ALTER TABLE `invitations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `teachers`
--
ALTER TABLE `teachers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
