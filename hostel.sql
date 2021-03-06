-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 21, 2018 at 08:55 PM
-- Server version: 10.1.26-MariaDB
-- PHP Version: 7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hostel`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(300) NOT NULL,
  `reg_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updation_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `email`, `password`, `reg_date`, `updation_date`) VALUES
(1, 'admin', 'admin@admin.com', 'admin', '2016-04-04 20:31:45', '2017-11-03');

-- --------------------------------------------------------

--
-- Table structure for table `adminlog`
--

CREATE TABLE `adminlog` (
  `id` int(11) NOT NULL,
  `adminid` int(11) NOT NULL,
  `ip` varbinary(16) NOT NULL,
  `logintime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` int(11) NOT NULL,
  `course_code` varchar(255) NOT NULL,
  `course_sn` varchar(255) NOT NULL,
  `course_fn` varchar(255) NOT NULL,
  `numberOfWeeks` int(11) NOT NULL,
  `posting_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `renewalNotice` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `course_code`, `course_sn`, `course_fn`, `numberOfWeeks`, `posting_date`, `renewalNotice`) VALUES
(9, '(MBA&MHRM)-Term 2', '(MBA&MHRM)-Term 2', '(MBA&MHRM)-Term 2', 11, '2017-11-10 04:57:04', '2018-05-01'),
(10, '(MBA&MHRM)-Term 3', '(MBA&MHRM)-Term 3', '(MBA&MHRM)-Term 3', 10, '2017-11-10 04:57:27', '2018-05-01'),
(11, '(MBA&MHRM)-Term 4', '(MBA&MHRM)-Term 4', '(MBA&MHRM)-Term 4', 10, '2017-11-10 04:57:35', '2018-05-01'),
(12, '(MA TESOL)-Sem 1', '(MA TESOL)-Sem 1', '(MA TESOL)-Sem 1', 16, '2017-11-10 04:57:46', '2018-05-01'),
(13, '(MA TESOL)-Sem 2', '(MA TESOL)-Sem 2', '(MA TESOL)-Sem 2', 16, '2017-11-10 04:57:54', '2018-05-01'),
(14, '(Deg.,Dip.,MEng)-Summer', '(Deg.,Dip.,MEng)-Summer', '(Deg.,Dip.,MEng)-Summer', 8, '2017-11-10 04:58:35', '2018-05-01'),
(15, '(Deg,Dip,MEng)-Sem 1 (New&Cont.)', '(Deg,Dip,MEng)-Sem 1 (New&Cont.)', '(Deg,Dip,MEng)-Sem 1 (New&Cont.)', 17, '2017-11-10 04:58:53', '2018-05-01'),
(16, '(Deg,Dip,MEng)-Sem 1 (If taking Summer Semester)', '(Deg,Dip,MEng)-Sem 1 (If taking Summer Semester)', '(Deg,Dip,MEng)-Sem 1 (If taking Summer Semester)', 16, '2017-11-10 04:59:05', '2018-05-01'),
(17, '(Deg,Dip,MEng)-Winter-(New)', '(Deg,Dip,MEng)-Winter-(New)', '(Deg,Dip,MEng)-Winter-(New)', 8, '2017-11-10 04:59:12', '2018-05-01'),
(18, '(Deg,Dip,MEng)-Winter-(From Sem 1)', '(Deg,Dip,MEng)-Winter-(From Sem 1)', '(Deg,Dip,MEng)-Winter-(From Sem 1)', 7, '2017-11-10 04:59:21', '2018-05-01'),
(19, '(Deg,Dip,MEng)-Sem 2 (New&Cont.)', '(Deg,Dip,MEng)-Sem 2 (New&Cont.)', '(Deg,Dip,MEng)-Sem 2 (New&Cont.)', 17, '2017-11-10 04:59:32', '2018-05-01'),
(20, 'Bachelor Degree (Bus. Oct.) - Sem 1', 'Bachelor Degree (Bus. Oct.) - Sem 1', 'Bachelor Degree (Bus. Oct.) - Sem 1', 9, '2017-11-10 05:00:04', '2018-05-01'),
(21, 'Bachelor Degree (Eng.Oct.) - Sem 1', 'Bachelor Degree (Eng.Oct.) - Sem 1', 'Bachelor Degree (Eng.Oct.) - Sem 1', 17, '2017-11-10 05:00:12', '2018-05-01'),
(22, 'Foundation - Summer Semester', 'Foundation - Summer Semester', 'Foundation - Summer Semester', 8, '2017-11-10 05:00:30', '2018-05-01'),
(23, 'Foundation - Semester 1', 'Foundation - Semester 1', 'Foundation - Semester 1', 16, '2017-11-10 05:00:37', '2018-05-01'),
(24, 'Foundation - Semester 2', 'Foundation - Semester 2', 'Foundation - Semester 2', 16, '2017-11-10 05:00:45', '2018-05-01'),
(25, 'Foundation - October', 'Foundation - October', 'Foundation - October', 11, '2017-11-10 05:00:57', '2018-05-01'),
(26, 'Intensive English - Semester 1', 'Intensive English - Semester 1', 'Intensive English - Semester 1', 11, '2017-11-10 05:01:05', '2018-05-01'),
(27, 'Intensive English - Semester 2', 'Intensive English - Semester 2', 'Intensive English - Semester 2', 11, '2017-11-10 05:01:13', '2018-05-01'),
(28, 'Intensive English - Semester 3', 'Intensive English - Semester 3', 'Intensive English - Semester 3', 11, '2017-11-10 05:01:19', '2018-05-01');

-- --------------------------------------------------------

--
-- Table structure for table `registration`
--

CREATE TABLE `registration` (
  `id` int(11) NOT NULL,
  `roomno` varchar(11) NOT NULL,
  `seater` int(11) NOT NULL,
  `feespm` int(11) NOT NULL,
  `stayfrom` date NOT NULL,
  `duration` int(11) NOT NULL,
  `course` varchar(500) NOT NULL,
  `studentid` int(11) NOT NULL,
  `firstName` varchar(500) NOT NULL,
  `middleName` varchar(500) NOT NULL,
  `lastName` varchar(500) NOT NULL,
  `gender` varchar(250) NOT NULL,
  `contactno` bigint(11) NOT NULL,
  `emailid` varchar(500) NOT NULL,
  `egycontactno` bigint(11) NOT NULL,
  `guardianName` varchar(500) NOT NULL,
  `guardianRelation` varchar(500) NOT NULL,
  `guardianContactno` bigint(11) NOT NULL,
  `corresAddress` varchar(500) NOT NULL,
  `corresCIty` varchar(500) NOT NULL,
  `corresState` varchar(500) NOT NULL,
  `corresPincode` int(11) NOT NULL,
  `pmntAddress` varchar(500) NOT NULL,
  `pmntCity` varchar(500) NOT NULL,
  `pmnatetState` varchar(500) NOT NULL,
  `pmntPincode` int(11) NOT NULL,
  `PreferPerson` varchar(50) NOT NULL,
  `postingDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updateDate` varchar(500) NOT NULL,
  `AcessCardNum` int(11) NOT NULL,
  `CheckinStatus` tinyint(1) NOT NULL,
  `CheckinDate` date NOT NULL,
  `CheckoutStatus` tinyint(4) NOT NULL,
  `CheckoutDate` date NOT NULL,
  `TotalPaymentStatus` int(11) NOT NULL,
  `Continuing` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `registration`
--

INSERT INTO `registration` (`id`, `roomno`, `seater`, `feespm`, `stayfrom`, `duration`, `course`, `studentid`, `firstName`, `middleName`, `lastName`, `gender`, `contactno`, `emailid`, `egycontactno`, `guardianName`, `guardianRelation`, `guardianContactno`, `corresAddress`, `corresCIty`, `corresState`, `corresPincode`, `pmntAddress`, `pmntCity`, `pmnatetState`, `pmntPincode`, `PreferPerson`, `postingDate`, `updateDate`, `AcessCardNum`, `CheckinStatus`, `CheckinDate`, `CheckoutStatus`, `CheckoutDate`, `TotalPaymentStatus`, `Continuing`) VALUES
(16, '1', 2, 95, '0001-01-01', 0, 'Intensive English - Semester 1', 4330111, 'vic', 'asd', 'chin', 'male', 2131, '11111@11111', 123, 'asd', 'asd', 123, 'sa', 'asd', 'Others', 123, 'sa', 'asd', 'Others', 123, 'sda', '2018-04-17 07:20:50', '', 123, 1, '2018-04-13', 0, '2018-04-11', 0, 0),
(17, '4', 1, 232, '2018-04-11', 17, 'Foundation - Semester 2', 123, 'chaehyun', 'asd', 'w\\hwang', 'male', 123, 'asd@asd.com', 123123, 'asdasd', 'asd', 123, 'asd', 'asd', 'Federal Territory of Labuan', 132, 'asd', 'asd', 'Federal Territory of Labuan', 132, 'asd', '2018-04-24 07:04:49', '', 0, 1, '0000-00-00', 0, '0000-00-00', 0, 0),
(18, '2', 1, 95, '0001-01-01', 9, 'Intensive English - Semester 1', 43308701, 'vic1', 'asd1', 'chin1', 'male', 2131, '1111111@ooo.my', 123, 'asd', 'asd', 123, 'sa', 'asd', 'Others', 123, 'sa', 'asd', 'Others', 123, 'sda', '2018-04-17 07:20:50', '', 123, 1, '2018-04-13', 0, '2018-04-11', 0, 0),
(19, '5', 1, 95, '0001-01-01', 9, 'Intensive English - Semester 1', 43308702, 'vic2', 'asd2', 'chin2', 'male', 2131, '222222@ooo.my', 123, 'asd', 'asd', 123, 'sa', 'asd', 'Others', 123, 'sa', 'asd', 'Others', 123, 'sda', '2018-04-17 07:20:50', '', 123, 1, '2018-04-13', 0, '2018-04-11', 0, 0),
(29, 'H001test', 1, 255, '0000-00-00', 11, 'Intensive English - Semester 2', 4330870, 'vic', 'asd', 'chin', 'male', 2131, '4330870@students.swinburne.edu.my', 0, 'asd', 'asd', 0, 'asd', 'das', 'Perak', 0, 'asd', 'das', 'Perak', 0, '', '2018-05-16 09:29:03', '', 1, 1, '2018-05-09', 0, '2018-05-03', 0, 0),
(30, '3', 2, 152, '0000-00-00', 17, '(Deg,Dip,MEng)-Sem 1 (New&Cont.)', 10007059, 'chaehyun', 'test', 'hwang', 'male', 21321, 'hcz931030@gmail.com', 213123, 'asdas', 'asd', 0, 'asd', 'asd', 'Malacca', 0, 'asd', 'asd', 'Malacca', 0, 'simon', '2018-05-21 18:53:51', '', 0, 0, '0000-00-00', 0, '0000-00-00', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `id` int(11) NOT NULL,
  `seater` int(11) NOT NULL,
  `room_no` varchar(11) NOT NULL,
  `fees` int(11) NOT NULL,
  `RoomType` varchar(255) NOT NULL,
  `posting_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `block` varchar(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`id`, `seater`, `room_no`, `fees`, `RoomType`, `posting_date`, `block`) VALUES
(28, 2, '1', 95, 'A- Twin with fan', '2017-11-03 09:28:49', 'H'),
(29, 1, '2', 777, 'B- Single with fan', '2017-11-03 09:28:56', 'H'),
(30, 2, '3', 152, 'C- Twin with Air-Cond', '2017-11-03 09:29:08', 'H'),
(31, 1, '4', 232, 'D- Single with Air-Cond', '2017-11-03 09:29:31', 'H'),
(36, 2, 'h123', 123, 'C- Twin with Air-Cond', '2018-03-20 06:28:34', 'H'),
(37, 2, 'h1234', 123, 'Free Room for Test', '2018-03-20 06:39:45', 'H'),
(38, 1, 'HM001', 323, 'B- Single with fan', '2018-04-24 07:51:02', 'H'),
(39, 2, 'hm54', 444, 'A- Twin with fan', '2018-04-24 07:52:09', 'HL'),
(40, 1, '5', 95, 'Free Room for Test 2', '2017-11-03 09:28:49', 'HL'),
(41, 1, 'H000test1', 225, 'Female Room', '2017-11-03 09:28:49', 'HM'),
(42, 1, 'H001test', 255, '1 Male and 1 Female Room', '2017-11-03 09:28:49', 'H'),
(43, 1, 'H002test', 255, '1 Male and 1 Female Room', '2017-11-03 09:28:49', 'HM');

-- --------------------------------------------------------

--
-- Table structure for table `states`
--

CREATE TABLE `states` (
  `id` int(11) NOT NULL,
  `State` varchar(150) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `states`
--

INSERT INTO `states` (`id`, `State`) VALUES
(1, 'Johor'),
(2, 'Kedah'),
(3, 'Kelantan'),
(4, 'Malacca'),
(5, 'Negeri Sembilan'),
(6, 'Pahang'),
(7, 'Penang'),
(8, 'Perak'),
(9, 'Perlis'),
(10, 'Selangor'),
(11, 'Terengganu'),
(12, 'Sabah'),
(13, 'Sarawak'),
(14, 'Federal Territory of Kuala Lumpur'),
(15, 'Federal Territory of Labuan'),
(16, 'Federal Territory of Putrajaya'),
(17, 'Others');

-- --------------------------------------------------------

--
-- Table structure for table `userlog`
--

CREATE TABLE `userlog` (
  `id` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `userEmail` varchar(255) NOT NULL,
  `userIp` varbinary(16) NOT NULL,
  `city` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `loginTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `userlog`
--

INSERT INTO `userlog` (`id`, `userId`, `userEmail`, `userIp`, `city`, `country`, `loginTime`) VALUES
(83, 36, '100063362@students.swinburne.edu.my', 0x3a3a31, '', '', '2017-11-10 04:05:54'),
(84, 34, 'hcz931030@gmail.com', 0x3a3a31, '', '', '2017-11-10 09:50:42'),
(85, 34, 'hcz931030@gmail.com', 0x3a3a31, '', '', '2017-11-10 10:01:56'),
(86, 34, 'hcz931030@gmail.com', 0x3a3a31, '', '', '2017-11-10 10:13:39'),
(87, 34, 'hcz931030@gmail.com', 0x3a3a31, '', '', '2017-11-10 10:13:54'),
(88, 34, 'hcz931030@gmail.com', 0x3a3a31, '', '', '2017-11-10 10:26:08'),
(89, 34, 'hcz931030@gmail.com', 0x3a3a31, '', '', '2017-11-10 10:37:07'),
(90, 34, 'hcz931030@gmail.com', 0x3132372e302e302e31, '', '', '2017-11-10 11:48:04'),
(117, 38, 'hcz931030@gmail.com', 0x3a3a31, '', '', '2017-11-13 07:01:26'),
(118, 40, 'asd@asd.com', 0x3a3a31, '', '', '2018-03-06 06:00:23'),
(119, 40, 'asd@asd.com', 0x3a3a31, '', '', '2018-03-19 17:59:21'),
(120, 40, 'asd@asd.com', 0x3132372e302e302e31, '', '', '2018-03-20 06:04:38'),
(121, 40, 'asd@asd.com', 0x3a3a31, '', '', '2018-03-27 01:52:20'),
(127, 40, 'asd@asd.com', 0x3a3a31, '', '', '2018-04-17 06:13:05'),
(128, 40, '4330870@students.swinburne.edu.my', 0x3a3a31, '', '', '2018-04-17 06:44:16'),
(129, 40, '4330870@students.swinburne.edu.my', 0x3a3a31, '', '', '2018-04-17 07:05:42'),
(130, 40, 'asd@asd.com', 0x3a3a31, '', '', '2018-04-17 07:06:55'),
(131, 41, '4330870@students.swinburne.edu.my', 0x3a3a31, '', '', '2018-04-17 07:07:41'),
(132, 42, '4330870@students.swinburne.edu.my', 0x3a3a31, '', '', '2018-04-17 07:20:11'),
(133, 40, 'asd@asd.com', 0x3132372e302e302e31, '', '', '2018-04-24 06:58:11'),
(134, 42, '4330870@students.swinburne.edu.my', 0x3a3a31, '', '', '2018-04-24 07:32:24'),
(135, 40, 'asd@asd.com', 0x3a3a31, '', '', '2018-05-02 13:40:47'),
(136, 42, '4330870@students.swinburne.edu.my', 0x3a3a31, '', '', '2018-05-05 05:59:50'),
(139, 42, '4330870@students.swinburne.edu.my', 0x3a3a31, '', '', '2018-05-08 05:58:16'),
(140, 40, 'asd@asd.com', 0x3a3a31, '', '', '2018-05-09 14:35:47'),
(141, 42, '4330870@students.swinburne.edu.my', 0x3a3a31, '', '', '2018-05-16 09:23:30'),
(142, 38, 'hcz931030@gmail.com', 0x3a3a31, '', '', '2018-05-21 18:52:06');

-- --------------------------------------------------------

--
-- Table structure for table `userregistration`
--

CREATE TABLE `userregistration` (
  `id` int(11) NOT NULL,
  `studentid` varchar(255) NOT NULL,
  `firstName` varchar(255) NOT NULL,
  `middleName` varchar(255) NOT NULL,
  `lastName` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `contactNo` bigint(20) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `regDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updateDate` varchar(45) NOT NULL,
  `passUdateDate` varchar(45) NOT NULL,
  `BookingFeeStatus` tinyint(4) NOT NULL,
  `BookedStatus` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `userregistration`
--

INSERT INTO `userregistration` (`id`, `studentid`, `firstName`, `middleName`, `lastName`, `gender`, `contactNo`, `email`, `password`, `regDate`, `updateDate`, `passUdateDate`, `BookingFeeStatus`, `BookedStatus`) VALUES
(22, '100070579', 'hi', 'hi', 'hi', 'male', 0, '2@gmail.com', '2', '2017-11-03 09:35:21', '03-11-2017 03:43:54', '03-11-2017 04:03:51', 0, 0),
(24, '12312', 'we', 'qwe', 'ewqe', 'female', 123, '3@gmail.com', '3', '2017-11-03 10:47:04', '', '', 0, 0),
(25, '123i2301323323', 'hss', 'ihsih', 'sisi', 'others', 213, '4@gmail.com', '4', '2017-11-06 06:15:43', '06-11-2017 11:52:01', '', 0, 0),
(30, '1231', '2asd', 'asd', 'asd', 'female', 213, '5@gmail.com', '5', '2017-11-07 10:44:39', '', '', 0, 0),
(35, 'sd', 'asd', 'adas', 'dasd', 'female', 123, '10@gmail.com', '10', '2017-11-08 18:40:57', '', '', 0, 0),
(36, '100063362', 'jin', 'asd', 'lee', 'male', 1231231234, '100063362@students.swinburne.edu.my', 'jin', '2017-11-10 04:05:37', '', '', 0, 0),
(38, '10007059', 'chaehyun', 'test', 'hwang', 'male', 21321, 'hcz931030@gmail.com', '123', '2017-11-11 12:19:26', '12-11-2017 11:10:32', '', 1, 1),
(39, '231231', 'samuel', '', 'tion', 'male', 12312321, 'samuel@gmail.com', '1234', '2017-11-13 06:42:18', '', '', 0, 0),
(40, '123', 'chaehyun', 'asd', 'w\\hwang', 'male', 123, 'asd@asd.com', 'asd', '2018-03-06 06:00:13', '', '', 1, 1),
(42, '4330870', 'vic', 'asd', 'chin', 'male', 2131, '4330870@students.swinburne.edu.my', 'asd', '2018-04-17 07:19:56', '', '', 1, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `registration`
--
ALTER TABLE `registration`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `states`
--
ALTER TABLE `states`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `userlog`
--
ALTER TABLE `userlog`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `userregistration`
--
ALTER TABLE `userregistration`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `registration`
--
ALTER TABLE `registration`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `states`
--
ALTER TABLE `states`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `userlog`
--
ALTER TABLE `userlog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=143;

--
-- AUTO_INCREMENT for table `userregistration`
--
ALTER TABLE `userregistration`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
