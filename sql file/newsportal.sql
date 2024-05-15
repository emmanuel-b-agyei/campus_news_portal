-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
<<<<<<< HEAD
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

=======
--
-- Database: `newsportal`

--
>>>>>>> cc795f0fbeab16400178e1d944b96bdd18ff321a
-- Table structure for table `tbladmin`
--

CREATE TABLE `tbladmin` (
  `id` int(11) NOT NULL,
  `AdminUserName` varchar(255) DEFAULT NULL,
  `AdminPassword` varchar(255) DEFAULT NULL,
  `AdminEmailId` varchar(255) DEFAULT NULL,
  `userType` int(11) DEFAULT NULL,
  `CreationDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `UpdationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbladmin`
--

INSERT INTO `tbladmin` (`id`, `AdminUserName`, `AdminPassword`, `AdminEmailId`, `userType`, `CreationDate`, `UpdationDate`) VALUES
(1, 'elmino', 'f925916e2754e5e03f75dd58a5733251', 'emmanuel.agyei@ashesi.edu.gh', 1, '2024-03-21 18:30:00', '2024-03-21 05:42:52'),
(3, 'emmanuel', 'f925916e2754e5e03f75dd58a5733251', 'agyeibrewuemmanuel@gmail.in', 0, '2024-03-21 18:40:00', '2024-03-21 05:43:01');

--
-- Table structure for table `tblcategory`
--

CREATE TABLE `tblcategory` (
  `id` int(11) NOT NULL,
  `CategoryName` varchar(200) DEFAULT NULL,
  `Description` mediumtext DEFAULT NULL,
  `PostingDate` timestamp NULL DEFAULT current_timestamp(),
  `UpdationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `Is_Active` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tblcategory`
--

INSERT INTO `tblcategory` (`id`, `CategoryName`, `Description`, `PostingDate`, `UpdationDate`, `Is_Active`) VALUES
(3, 'Sports', 'Related to sports news', '2024-01-11 18:30:00', '2024-01-31 05:43:16', 1),
(5, 'Entertainment', 'Entertainment related  News', '2024-01-11 18:30:00', '2024-01-31 05:43:25', 1),
(6, 'Politics', 'Politics', '2024-01-11 18:30:00', '2024-01-31 05:43:25', 1),
(7, 'Business', 'Business', '2024-01-11 18:30:00', '2024-01-31 05:43:25', 1),
(8, 'COVID-19', 'COVID-19', '2024-01-11 18:30:00', '2024-01-31 05:43:25', 1);
--
-- Table structure for table `tblcomments`
--

CREATE TABLE `tblcomments` (
  `id` int(11) NOT NULL,
  `postId` int(11) DEFAULT NULL,
  `name` varchar(120) DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `comment` mediumtext DEFAULT NULL,
  `postingDate` timestamp NULL DEFAULT current_timestamp(),
  `status` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tblcomments`
--

INSERT INTO `tblcomments` (`id`, `postId`, `name`, `email`, `comment`, `postingDate`, `status`) VALUES
(1, 1, "Emmanuel", "elminosunshine@gmail.com", "Is that really?", CURRENT_TIMESTAMP, 1);
<<<<<<< HEAD

-- --------------------------------------------------------
=======
>>>>>>> cc795f0fbeab16400178e1d944b96bdd18ff321a

--
-- Table structure for table `tblpages`
--

CREATE TABLE `tblpages` (
  `id` int(11) NOT NULL,
  `PageName` varchar(200) DEFAULT NULL,
  `PageTitle` mediumtext DEFAULT NULL,
  `Description` longtext DEFAULT NULL,
  `PostingDate` timestamp NULL DEFAULT current_timestamp(),
  `UpdationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tblpages`
--

INSERT INTO `tblpages` (`id`, `PageName`, `PageTitle`, `Description`, `PostingDate`, `UpdationDate`) VALUES 
(1, 'aboutus', 'About Us - Campus News Portal', "Welcome to the Campus News Portal, a project developed by Emmanuel Brewu Agyei. This platform is designed to provide students with a seamless experience for sharing and accessing news articles related to campus life and global updates. With user roles and authentication in place, including admins, editors, and registered users, we ensure a secure and engaging environment for news submission and publication. Our  mission is to enhance communication and information sharing within the Ashesi community and beyond. Join us in exploring the latest news, engaging in discussions, and staying informed about campus matters and the world around us.", CURRENT_TIMESTAMP, NULL);

-- Table structure for table `tblposts`

CREATE TABLE `tblposts` (
  `id` int(11) NOT NULL,
  `PostTitle` longtext DEFAULT NULL,
  `CategoryId` int(11) DEFAULT NULL,
  `PostDetails` longtext CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `PostingDate` timestamp NULL DEFAULT current_timestamp(),
  `UpdationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `Is_Active` int(1) DEFAULT NULL,
  `PostUrl` mediumtext DEFAULT NULL,
  `PostImage` varchar(255) DEFAULT NULL,
  `viewCounter` int(11) DEFAULT NULL,
  `postedBy` varchar(255) DEFAULT NULL,
  `lastUpdatedBy` varchar(255) DEFAULT NULL,
  `Is_Approved` int(1) DEFAULT 0, -- New column for approval status, default is 0 (not approved)
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table `tblposts`

INSERT INTO `tblposts` (`id`, `PostTitle`, `CategoryId`, `PostDetails`, `PostingDate`, `UpdationDate`, `Is_Active`, `Is_Approved`, `PostUrl`, `PostImage`, `viewCounter`, `postedBy`, `lastUpdatedBy`) VALUES
(1, "Ghana's Economy Shows Resilience Amid Global Challenges", 101,  "Accra, Ghana - Despite the ongoing global economic challenges, Ghana's economy has demonstrated remarkable resilience. The country's GDP growth rate for the first quarter of 2024 exceeded expectations, reaching 6.5%. Key sectors such as agriculture, mining, and services have contributed significantly to this growth. The government's prudent fiscal policies and investment in infrastructure projects have played a crucial role in sustaining economic momentum. Experts predict that Ghana's economy will continue to thrive, attracting foreign investors and fostering job creation. As the nation celebrates its 65th independence anniversary, citizens are optimistic about the future.", '2024-04-03 10:00:00', '2024-04-03 14:30:00', 1, 1, 'https://ghananews.com/economy-resilience', 'ghananews_economy.jpg', 1200, 'Ghana News Agency', 'Economic Analyst');

<<<<<<< HEAD

-- --------------------------------------------------------
=======
>>>>>>> cc795f0fbeab16400178e1d944b96bdd18ff321a
--
-- Indexes for table `tbladmin`
--
ALTER TABLE `tbladmin`
  ADD PRIMARY KEY (`id`),
  ADD KEY `AdminUserName` (`AdminUserName`);

--
-- Indexes for table `tblcategory`
--
ALTER TABLE `tblcategory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblcomments`
--
ALTER TABLE `tblcomments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`),
  ADD KEY `postId` (`postId`);

--
-- Indexes for table `tblpages`
--
ALTER TABLE `tblpages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblposts`
--
ALTER TABLE `tblposts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`),
  ADD KEY `postcatid` (`CategoryId`),
  ADD KEY `subadmin` (`postedBy`);


--
-- AUTO_INCREMENT for dumped tables
--
--
-- AUTO_INCREMENT for table `tbladmin`
--
ALTER TABLE `tbladmin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tblcategory`
--
ALTER TABLE `tblcategory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tblcomments`
--
ALTER TABLE `tblcomments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tblpages`
--
ALTER TABLE `tblpages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tblposts`
--
ALTER TABLE `tblposts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for table `tblcomments`
--
ALTER TABLE `tblcomments`
  ADD CONSTRAINT `pid` FOREIGN KEY (`postId`) REFERENCES `tblposts` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tblposts`
--
ALTER TABLE `tblposts`
  ADD CONSTRAINT `postcatid` FOREIGN KEY (`CategoryId`) REFERENCES `tblcategory` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `subadmin` FOREIGN KEY (`postedBy`) REFERENCES `tbladmin` (`AdminUserName`) ON DELETE NO ACTION ON UPDATE NO ACTION;

