-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 04, 2014 at 08:47 AM
-- Server version: 5.6.16
-- PHP Version: 5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `opentutorial`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
`Admin_ID` int(5) NOT NULL,
  `Admin_Name` varchar(100) NOT NULL,
  `Admin_Picture` varchar(20) DEFAULT NULL,
  `Admin_Level` varchar(6) NOT NULL,
  `Admin_Username` varchar(50) NOT NULL,
  `Admin_Password` varchar(50) NOT NULL,
  `Admin_Email` varchar(50) NOT NULL,
  `Admin_Mobile` varchar(11) NOT NULL,
  `isDelete` tinyint(1) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10007 ;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`Admin_ID`, `Admin_Name`, `Admin_Picture`, `Admin_Level`, `Admin_Username`, `Admin_Password`, `Admin_Email`, `Admin_Mobile`, `isDelete`) VALUES
(1002, 'Nazrin Putra', 'Profile/1002.jpg', 'Master', 'nazrinputra', 'b0d95843f37210890812e3b5942bd354', 'putra_naz94@yahoo.com', '013-5711937', 0),
(10001, 'Ahmad Bin Abu', 'Profile/1002.png', 'Master', 'ahmadabu', 'e8655e6121453ff5f08db9f7634ba6ef', 'ahmadabu@gmail.com', '012-3456789', 0),
(10005, 'Nisa Sabrina Md Alashari', 'Profile/10005.jpg', 'Normal', 'nisasabrina', '6dece9a0f1bd1b509610244240ba79c8', 'nisa.sabrina94@yahoo.com', '0135711047', 0),
(10006, 'Mohana', NULL, 'Normal', 'mohana', '1c87681886661598fd51ad9b14bf8748', 'mohana94@yahoo.com', '0123456789', 0);

-- --------------------------------------------------------

--
-- Table structure for table `announcement`
--

CREATE TABLE IF NOT EXISTS `announcement` (
`Announcement_ID` int(11) NOT NULL,
  `Announcement_Title` varchar(100) NOT NULL,
  `Announcement_Content` varchar(255) NOT NULL,
  `Admin_ID` int(11) NOT NULL,
  `isDelete` tinyint(1) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `announcement`
--

INSERT INTO `announcement` (`Announcement_ID`, `Announcement_Title`, `Announcement_Content`, `Admin_ID`, `isDelete`) VALUES
(2, 'Tutorial 1', 'owner of tutorial 1 please check your mailbox', 1002, 0),
(3, 'Best Seller', 'that tutorial is a best seller.\r\ntq', 1002, 1),
(4, 'My Tutorial', 'anyone seen my new tutorial?', 10001, 0),
(5, 'All User', 'please report any problem you encountered with us.. tq', 1002, 0),
(6, 'this is an extra long announcement title', 'this is an extra long announcement message. repeatedly.\r\nthis is an extra long announcement message. repeatedly.\r\nthis is an extra long announcement message. repeatedly.\r\nthis is an extra long announcement message. repeatedly.\r\nthis is an extra long annou', 10005, 1);

-- --------------------------------------------------------

--
-- Table structure for table `buy`
--

CREATE TABLE IF NOT EXISTS `buy` (
`Buy_ID` int(11) NOT NULL,
  `Buy_Item` varchar(100) NOT NULL,
  `Buy_Price` decimal(5,2) NOT NULL,
  `Buy_Date` varchar(50) NOT NULL,
  `Member_ID` int(11) NOT NULL,
  `Tutorial_ID` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=23 ;

--
-- Dumping data for table `buy`
--

INSERT INTO `buy` (`Buy_ID`, `Buy_Item`, `Buy_Price`, `Buy_Date`, `Member_ID`, `Tutorial_ID`) VALUES
(3, 'Best Seller', '0.00', '2014-08-18 16:39:21', 1012, 43),
(4, 'My Tutorial', '10.00', '2014-08-18 16:49:10', 1012, 41),
(5, 'New Tutorial', '1.00', '2014-08-18 16:49:22', 1012, 42),
(6, 'My Tutorial', '10.00', '2014-08-22 14:07:30', 1017, 41),
(7, 'New Tutorial', '1.00', '2014-08-27 08:04:22', 1012, 42),
(8, 'New Tutorial', '1.00', '2014-09-01 14:19:16', 1017, 42),
(9, 'Assignment 2 Data Struct', '1.00', '2014-09-01 14:19:37', 1017, 44),
(10, 'English Coursework', '1.50', '2014-09-01 14:19:48', 1017, 45),
(11, 'New Tutorial', '1.00', '2014-09-02 03:36:45', 1012, 42),
(12, 'New Tutorial', '1.00', '2014-09-02 03:38:52', 1012, 42),
(13, 'Best Seller', '0.00', '2014-09-02 12:47:23', 1017, 43),
(14, 'Coursework', '1.50', '2014-09-02 12:51:59', 1017, 45),
(18, 'New Tutorial', '1.00', '2014-09-03 11:35:26', 1012, 42),
(19, 'New Tutorial', '1.00', '2014-09-03 11:36:04', 1012, 42),
(20, 'Assignment DS', '1.00', '2014-09-03 11:39:24', 1012, 55),
(21, 'Assignment 1 - Guideline', '0.00', '2014-09-03 16:53:17', 1012, 51),
(22, 'Assignment DS', '1.00', '2014-09-04 08:27:00', 1027, 55);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE IF NOT EXISTS `category` (
`Category_ID` int(11) NOT NULL,
  `Category_Name` varchar(50) NOT NULL,
  `Category_Desc` varchar(50) NOT NULL,
  `isDelete` tinyint(1) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`Category_ID`, `Category_Name`, `Category_Desc`, `isDelete`) VALUES
(1, 'Degree', 'Bachelors undergraduate', 0),
(2, 'Diploma', 'Diploma undergraduate', 0),
(3, 'Foundation', 'Alpha undergraduate', 0),
(4, 'Master', 'Master postgraduate', 1);

-- --------------------------------------------------------

--
-- Table structure for table `follow`
--

CREATE TABLE IF NOT EXISTS `follow` (
`Follow_ID` int(11) NOT NULL,
  `Follow_Status` tinyint(1) NOT NULL,
  `Follow_Member` int(11) NOT NULL,
  `Follow_Follower` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `follow`
--

INSERT INTO `follow` (`Follow_ID`, `Follow_Status`, `Follow_Member`, `Follow_Follower`) VALUES
(2, 1, 1012, 1017),
(3, 1, 1013, 1017),
(4, 1, 1001, 1012),
(6, 1, 1012, 1023),
(7, 1, 1017, 1027);

-- --------------------------------------------------------

--
-- Table structure for table `material`
--

CREATE TABLE IF NOT EXISTS `material` (
`Material_ID` int(11) NOT NULL,
  `Material_Name` varchar(100) NOT NULL,
  `Material_Detail` varchar(100) NOT NULL,
  `Material_Icon` varchar(100) NOT NULL,
  `isDelete` tinyint(1) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `material`
--

INSERT INTO `material` (`Material_ID`, `Material_Name`, `Material_Detail`, `Material_Icon`, `isDelete`) VALUES
(1, 'PDF', 'pdf files', 'pdf_icon.png', 0),
(2, 'DOC', 'doc files', 'doc_icon.png', 0),
(3, 'PPT', 'ppt files', 'ppt_icon.png', 0),
(4, 'XLS', 'Excel files', 'xls_icon.png', 0);

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE IF NOT EXISTS `member` (
`Member_ID` int(10) NOT NULL,
  `Member_Name` varchar(100) NOT NULL,
  `Member_Profile` varchar(100) NOT NULL,
  `Member_Username` varchar(100) NOT NULL,
  `Member_Password` varchar(50) NOT NULL,
  `Member_Email` varchar(50) NOT NULL,
  `Member_Mobile` varchar(11) NOT NULL,
  `Member_Credit` decimal(5,2) NOT NULL,
  `Member_Profit` decimal(5,2) NOT NULL,
  `Rating_ID` int(11) NOT NULL,
  `isDelete` tinyint(1) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1028 ;

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`Member_ID`, `Member_Name`, `Member_Profile`, `Member_Username`, `Member_Password`, `Member_Email`, `Member_Mobile`, `Member_Credit`, `Member_Profit`, `Rating_ID`, `isDelete`) VALUES
(1001, 'Ali bin Abu', '1001.png', 'aliabu', 'dbcff85b4ad32c7ee6e56b33f9c687e6', 'ali@gmail.com', '1234567891', '0.00', '6.00', 4, 0),
(1012, 'Nazrin Putra', '1012.jpg', 'nazrinputra', 'b0d95843f37210890812e3b5942bd354', 'putra_naz94@yahoo.com', '135711938', '26.50', '4.00', 5, 0),
(1013, 'Mohana', '1013.jpg', 'mohana', '1bbd886460827015e5d605ed44252251', 'mohana@mmu.edu.my', '0123456789', '0.00', '6.00', 6, 0),
(1017, 'Nisa Sabrina', '1017.jpg', 'nisasabrina', '6dece9a0f1bd1b509610244240ba79c8', 'nisa.sabrina94@yahoo.com', '135711048', '5.00', '2.00', 8, 0),
(1021, 'Bukhari Shafiq', '', 'edrial', 'b5978f9c07fff6329df77104a99d5437', 'edrial.bs@gmail.com', '196519402', '0.00', '0.00', 12, 0),
(1023, 'Elifa Dania', '', 'elifadania', '167d0e7b582b74a87ae79510aaec0548', 'elifadania@gmail.com', '196226463', '0.00', '0.00', 14, 0),
(1024, 'Mary', '', 'mary1', '9f26a7a195e3c3c059ded7cdf86193eb', 'mary@gmail.com', '127243370', '0.00', '0.00', 15, 0),
(1025, 'New User', '', 'newuser', '8539aca683a7ab931d168f535ae96578', 'putra_naz94@icloud.com', '135711937', '0.00', '0.00', 16, 0),
(1027, 'Minaashini', '1027.jpg', 'mins92', '6bf1b6cf41b33d385e5969046c4150de', 'minaa_mins92@yahoo.com', '177750144', '9.00', '0.00', 18, 0);

-- --------------------------------------------------------

--
-- Table structure for table `member_rating`
--

CREATE TABLE IF NOT EXISTS `member_rating` (
`Member_Rating_ID` int(4) NOT NULL,
  `Member_Rating_1` int(1) NOT NULL,
  `Member_Rating_2` int(1) NOT NULL,
  `Member_Rating_3` int(1) NOT NULL,
  `Member_Rating_4` int(1) NOT NULL,
  `Member_Rating_5` int(1) NOT NULL,
  `Member_Rating_Total` int(4) NOT NULL,
  `Member_Rating_Average` decimal(3,2) NOT NULL,
  `Member_ID` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `member_rating`
--

INSERT INTO `member_rating` (`Member_Rating_ID`, `Member_Rating_1`, `Member_Rating_2`, `Member_Rating_3`, `Member_Rating_4`, `Member_Rating_5`, `Member_Rating_Total`, `Member_Rating_Average`, `Member_ID`) VALUES
(4, 1, 0, 0, 10, 8, 19, '4.28', 1001),
(5, 0, 0, 0, 1, 1, 2, '4.00', 1012),
(6, 1, 0, 1, 0, 0, 2, '1.00', 1013),
(8, 0, 0, 1, 1, 1, 3, '4.50', 1017),
(10, 0, 0, 0, 0, 0, 0, '0.00', 1019),
(11, 0, 0, 0, 0, 0, 0, '0.00', 1020),
(12, 0, 0, 0, 0, 0, 0, '0.00', 1021),
(13, 0, 0, 0, 0, 0, 0, '0.00', 1022),
(14, 0, 0, 0, 1, 0, 1, '4.00', 1023),
(15, 0, 0, 0, 0, 0, 0, '0.00', 1024),
(16, 0, 0, 0, 0, 0, 0, '0.00', 1025),
(17, 0, 0, 0, 0, 0, 0, '0.00', 1026),
(18, 0, 0, 0, 0, 0, 0, '0.00', 1027);

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE IF NOT EXISTS `message` (
`Message_ID` int(11) NOT NULL,
  `Message_Title` varchar(50) NOT NULL,
  `Message_Text` varchar(255) NOT NULL,
  `Member_ID` int(11) NOT NULL,
  `isDelete` tinyint(1) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`Message_ID`, `Message_Title`, `Message_Text`, `Member_ID`, `isDelete`) VALUES
(3, 'add new subject', 'please add a new subject for me.\r\nsubject name: Malaysian Studies', 1012, 1),
(4, 'new category', 'i need a new category to upload my tutorial', 1017, 0),
(12, 'Profit Claim', 'Profit claim from member named nazrinputra for RM 3.00. Available profit balance for this member: RM 4.00', 1012, 0);

-- --------------------------------------------------------

--
-- Table structure for table `rating`
--

CREATE TABLE IF NOT EXISTS `rating` (
`Rating_ID` int(11) NOT NULL,
  `Rating_Level` int(1) NOT NULL,
  `Rating_Desc` varchar(100) NOT NULL,
  `isDelete` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rating`
--

INSERT INTO `rating` (`Rating_ID`, `Rating_Level`, `Rating_Desc`, `isDelete`) VALUES
(1, 1, '1 star, poor rating', 0),
(2, 2, '2 stars, moderate rating', 0),
(3, 3, '3 stars, medium rating', 0),
(4, 4, '4 stars, good rating', 0),
(5, 5, '5 stars, great rating', 0);

-- --------------------------------------------------------

--
-- Table structure for table `rating_detail`
--

CREATE TABLE IF NOT EXISTS `rating_detail` (
`Rating_Detail_ID` int(11) NOT NULL,
  `Rating_Detail_Comment` varchar(255) NOT NULL,
  `Rating_Detail_Level` int(1) NOT NULL,
  `Rating_Detail_Member` int(11) NOT NULL,
  `Rating_Detail_Tutorial` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=31 ;

--
-- Dumping data for table `rating_detail`
--

INSERT INTO `rating_detail` (`Rating_Detail_ID`, `Rating_Detail_Comment`, `Rating_Detail_Level`, `Rating_Detail_Member`, `Rating_Detail_Tutorial`) VALUES
(19, 'this is good!', 2, 1012, 41),
(21, 'good quality upload', 4, 1001, 43),
(22, 'this is ok', 1, 1012, 43),
(23, 'good', 5, 1017, 45),
(24, 'this is the latest review', 5, 1012, 42),
(25, '', 5, 1012, 42),
(26, '', 5, 1012, 42),
(27, '', 5, 1012, 42),
(28, 'this is good', 5, 1012, 51),
(30, 'Everything is Awesome', 1, 1027, 55);

-- --------------------------------------------------------

--
-- Table structure for table `rating_detail_member`
--

CREATE TABLE IF NOT EXISTS `rating_detail_member` (
`Rating_Detail_ID` int(11) NOT NULL,
  `Rating_Detail_Comment` varchar(100) NOT NULL,
  `Rating_Detail_Level` int(1) NOT NULL,
  `Member_ID` int(11) NOT NULL,
  `Rater_ID` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `rating_detail_member`
--

INSERT INTO `rating_detail_member` (`Rating_Detail_ID`, `Rating_Detail_Comment`, `Rating_Detail_Level`, `Member_ID`, `Rater_ID`) VALUES
(7, 'he is good', 4, 1001, 1012),
(12, 'this is a great uploader', 5, 1012, 1017),
(13, 'testing', 1, 1013, 1017),
(14, 'last edit', 4, 1017, 1012),
(15, 'the best', 5, 1017, 1013),
(16, 'ok', 3, 1013, 1012),
(17, 'for fun', 4, 1023, 1012),
(18, 'You are Awesome ', 3, 1017, 1027);

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

CREATE TABLE IF NOT EXISTS `subject` (
`Subject_ID` int(11) NOT NULL,
  `Subject_Name` varchar(50) NOT NULL,
  `Subject_Course` varchar(50) NOT NULL,
  `Subject_Desc` varchar(50) NOT NULL,
  `isDelete` tinyint(1) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `subject`
--

INSERT INTO `subject` (`Subject_ID`, `Subject_Name`, `Subject_Course`, `Subject_Desc`, `isDelete`) VALUES
(2, 'English', 'Engineering', 'English for engineers', 0),
(3, 'Mathematics', 'Law', 'Math for law students', 0),
(4, 'Programming', 'Information Technology', 'Programming for beginners', 0),
(5, 'Management', 'Business', 'Management for business student', 0),
(6, 'Islamic Studies', 'Programming', 'Diploma ', 0);

-- --------------------------------------------------------

--
-- Table structure for table `topup`
--

CREATE TABLE IF NOT EXISTS `topup` (
`Topup_ID` int(11) NOT NULL,
  `Topup_Amount` decimal(5,2) NOT NULL,
  `Topup_Date` varchar(100) NOT NULL,
  `Member_ID` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `topup`
--

INSERT INTO `topup` (`Topup_ID`, `Topup_Amount`, `Topup_Date`, `Member_ID`) VALUES
(4, '10.00', '2014-09-01 11:33:37', 1017),
(5, '30.00', '2014-09-01 12:08:51', 1017),
(6, '10.00', '2014-09-01 14:18:46', 1017),
(7, '10.00', '2014-09-04 08:26:36', 1027);

-- --------------------------------------------------------

--
-- Table structure for table `tutorial`
--

CREATE TABLE IF NOT EXISTS `tutorial` (
`Tutorial_ID` int(10) NOT NULL,
  `Tutorial_Title` varchar(100) NOT NULL,
  `Tutorial_Size` int(10) NOT NULL,
  `Tutorial_Type` varchar(20) NOT NULL,
  `Tutorial_Price` decimal(5,2) NOT NULL,
  `Tutorial_Location` varchar(255) NOT NULL,
  `Subject_ID` int(11) NOT NULL,
  `Category_ID` int(11) NOT NULL,
  `Material_ID` int(11) NOT NULL,
  `Member_ID` int(11) NOT NULL,
  `isDelete` tinyint(1) NOT NULL,
  `Tutorial_Bar` varchar(100) NOT NULL,
  `isActive` tinyint(1) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=58 ;

--
-- Dumping data for table `tutorial`
--

INSERT INTO `tutorial` (`Tutorial_ID`, `Tutorial_Title`, `Tutorial_Size`, `Tutorial_Type`, `Tutorial_Price`, `Tutorial_Location`, `Subject_ID`, `Category_ID`, `Material_ID`, `Member_ID`, `isDelete`, `Tutorial_Bar`, `isActive`) VALUES
(40, 'Tutorial One', 202003, 'application/pdf', '0.00', 'Upload/1001.Tutorial 1.pdf', 2, 2, 1, 1001, 0, '', 0),
(41, 'My Tutorial', 243357, 'application/pdf', '2.00', 'Upload/1012.Tutorial 1.pdf', 3, 1, 3, 1012, 0, '', 1),
(42, 'New Tutorial', 202003, 'application/pdf', '2.00', 'Upload/1001.New.pdf', 3, 3, 1, 1001, 0, '', 1),
(43, 'Best Seller', 63488, 'application/msword', '0.00', 'Upload/1001.gone.doc', 2, 1, 2, 1001, 0, '', 1),
(44, 'Data Struct', 289826, 'application/pdf', '2.00', 'Upload/1012.Assignment 2 Data Struct.pdf', 4, 2, 1, 1012, 0, '', 1),
(45, 'Coursework', 14332, 'application/vnd.open', '3.00', 'Upload/1012.English Coursework.xlsx', 2, 4, 4, 1012, 0, '', 1),
(46, 'Management Chapter 4', 19704, 'application/vnd.open', '0.00', 'Upload/1013.Management Chapter 4.docx', 5, 1, 2, 1013, 0, '', 1),
(48, 'Grade Calculation', 20182, 'application/vnd.open', '0.00', 'Upload/1013.Grade Calculation.xlsx', 3, 3, 4, 1013, 0, '', 1),
(49, 'Assignment guideline', 33052, 'application/vnd.open', '0.00', 'Upload/1017.Assignment guideline.docx', 5, 2, 2, 1017, 0, '', 1),
(50, 'Chapter 1 ', 117248, 'application/msword', '1.00', 'Upload/1017.Chapter 1 .doc', 6, 2, 2, 1017, 0, '', 1),
(51, 'Assignment 1 - Guideline', 118784, 'application/vnd.ms-p', '0.00', 'Upload/1017.Assignment 1 - Guideline.ppt', 6, 2, 3, 1017, 0, '', 1),
(52, 'Uploads', 202003, 'application/pdf', '0.00', 'Upload/1012.Uploads.pdf', 4, 2, 1, 1012, 0, '', 1),
(53, 'Latihan', 243357, 'application/pdf', '2.00', 'Upload/1012.Latihan.pdf', 3, 4, 1, 1012, 0, '', 1),
(55, 'Assignment DS', 132860, 'application/vnd.open', '1.00', 'Upload/1017.Assignment DS.docx', 4, 2, 2, 1017, 0, '', 1),
(56, 'Final Test', 53465, 'application/pdf', '0.00', 'Upload/1012.Final Test.pdf', 6, 1, 1, 1012, 0, '', 1),
(57, 'Java', 58625, 'application/pdf', '2.00', 'Upload/1027.Java.pdf', 4, 2, 1, 1027, 0, '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tutorial_rating`
--

CREATE TABLE IF NOT EXISTS `tutorial_rating` (
`Tutorial_Rating_ID` int(11) NOT NULL,
  `Tutorial_Rating_1` int(11) NOT NULL,
  `Tutorial_Rating_2` int(11) NOT NULL,
  `Tutorial_Rating_3` int(11) NOT NULL,
  `Tutorial_Rating_4` int(11) NOT NULL,
  `Tutorial_Rating_5` int(11) NOT NULL,
  `Tutorial_Rating_Total` int(11) NOT NULL,
  `Tutorial_Rating_Average` decimal(3,2) NOT NULL,
  `Tutorial_ID` int(11) NOT NULL,
  `Rating_ID` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=23 ;

--
-- Dumping data for table `tutorial_rating`
--

INSERT INTO `tutorial_rating` (`Tutorial_Rating_ID`, `Tutorial_Rating_1`, `Tutorial_Rating_2`, `Tutorial_Rating_3`, `Tutorial_Rating_4`, `Tutorial_Rating_5`, `Tutorial_Rating_Total`, `Tutorial_Rating_Average`, `Tutorial_ID`, `Rating_ID`) VALUES
(5, 0, 0, 1, 4, 4, 9, '4.38', 40, 4),
(6, 0, 1, 4, 0, 13, 18, '4.53', 41, 5),
(7, 0, 2, 10, 2, 6, 22, '3.32', 42, 3),
(8, 1, 1, 0, 1, 0, 4, '2.50', 43, 3),
(9, 0, 0, 0, 0, 0, 0, '0.00', 44, 0),
(10, 0, 0, 0, 0, 1, 1, '0.00', 45, 0),
(11, 0, 0, 0, 0, 0, 0, '0.00', 46, 0),
(12, 0, 0, 0, 0, 0, 0, '0.00', 47, 0),
(13, 0, 0, 0, 0, 0, 0, '0.00', 48, 0),
(14, 0, 0, 0, 0, 0, 0, '0.00', 49, 0),
(15, 0, 0, 0, 0, 0, 0, '0.00', 50, 0),
(16, 0, 0, 0, 0, 1, 2, '4.50', 51, 5),
(17, 0, 0, 0, 0, 0, 0, '0.00', 52, 0),
(18, 0, 0, 0, 0, 0, 0, '0.00', 53, 0),
(19, 0, 0, 0, 0, 0, 0, '0.00', 54, 0),
(20, 1, 0, 0, 0, 1, 3, '3.67', 55, 4),
(21, 0, 0, 0, 0, 0, 0, '0.00', 56, 0),
(22, 0, 0, 0, 0, 0, 0, '0.00', 57, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
 ADD PRIMARY KEY (`Admin_ID`), ADD UNIQUE KEY `Admin_Username` (`Admin_Username`,`Admin_Email`), ADD UNIQUE KEY `Admin_Mobile` (`Admin_Mobile`), ADD UNIQUE KEY `Admin_Mobile_2` (`Admin_Mobile`);

--
-- Indexes for table `announcement`
--
ALTER TABLE `announcement`
 ADD PRIMARY KEY (`Announcement_ID`);

--
-- Indexes for table `buy`
--
ALTER TABLE `buy`
 ADD PRIMARY KEY (`Buy_ID`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
 ADD PRIMARY KEY (`Category_ID`);

--
-- Indexes for table `follow`
--
ALTER TABLE `follow`
 ADD PRIMARY KEY (`Follow_ID`);

--
-- Indexes for table `material`
--
ALTER TABLE `material`
 ADD PRIMARY KEY (`Material_ID`);

--
-- Indexes for table `member`
--
ALTER TABLE `member`
 ADD PRIMARY KEY (`Member_ID`), ADD UNIQUE KEY `Member_Username` (`Member_Username`,`Member_Email`,`Member_Mobile`);

--
-- Indexes for table `member_rating`
--
ALTER TABLE `member_rating`
 ADD PRIMARY KEY (`Member_Rating_ID`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
 ADD PRIMARY KEY (`Message_ID`);

--
-- Indexes for table `rating`
--
ALTER TABLE `rating`
 ADD PRIMARY KEY (`Rating_ID`);

--
-- Indexes for table `rating_detail`
--
ALTER TABLE `rating_detail`
 ADD PRIMARY KEY (`Rating_Detail_ID`);

--
-- Indexes for table `rating_detail_member`
--
ALTER TABLE `rating_detail_member`
 ADD PRIMARY KEY (`Rating_Detail_ID`);

--
-- Indexes for table `subject`
--
ALTER TABLE `subject`
 ADD PRIMARY KEY (`Subject_ID`);

--
-- Indexes for table `topup`
--
ALTER TABLE `topup`
 ADD PRIMARY KEY (`Topup_ID`);

--
-- Indexes for table `tutorial`
--
ALTER TABLE `tutorial`
 ADD PRIMARY KEY (`Tutorial_ID`);

--
-- Indexes for table `tutorial_rating`
--
ALTER TABLE `tutorial_rating`
 ADD PRIMARY KEY (`Tutorial_Rating_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
MODIFY `Admin_ID` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10007;
--
-- AUTO_INCREMENT for table `announcement`
--
ALTER TABLE `announcement`
MODIFY `Announcement_ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `buy`
--
ALTER TABLE `buy`
MODIFY `Buy_ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
MODIFY `Category_ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `follow`
--
ALTER TABLE `follow`
MODIFY `Follow_ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `material`
--
ALTER TABLE `material`
MODIFY `Material_ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `member`
--
ALTER TABLE `member`
MODIFY `Member_ID` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=1028;
--
-- AUTO_INCREMENT for table `member_rating`
--
ALTER TABLE `member_rating`
MODIFY `Member_Rating_ID` int(4) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
MODIFY `Message_ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `rating`
--
ALTER TABLE `rating`
MODIFY `Rating_ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `rating_detail`
--
ALTER TABLE `rating_detail`
MODIFY `Rating_Detail_ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=31;
--
-- AUTO_INCREMENT for table `rating_detail_member`
--
ALTER TABLE `rating_detail_member`
MODIFY `Rating_Detail_ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `subject`
--
ALTER TABLE `subject`
MODIFY `Subject_ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `topup`
--
ALTER TABLE `topup`
MODIFY `Topup_ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `tutorial`
--
ALTER TABLE `tutorial`
MODIFY `Tutorial_ID` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=58;
--
-- AUTO_INCREMENT for table `tutorial_rating`
--
ALTER TABLE `tutorial_rating`
MODIFY `Tutorial_Rating_ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=23;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
