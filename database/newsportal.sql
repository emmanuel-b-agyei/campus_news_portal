--
-- Database: `newsportal`
--

-- Table structure for table `tbladmin`
CREATE TABLE `tbladmin` (
  `id` int(11) NOT NULL AUTO_INCREMENT, -- Primary key
  `AdminUserName` varchar(255) DEFAULT NULL,
  `AdminPassword` varchar(255) DEFAULT NULL,
  `AdminEmailId` varchar(255) DEFAULT NULL,
  `userType` int(11) DEFAULT NULL,
  `CreationDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `UpdationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table `tbladmin`
INSERT INTO `tbladmin` (`id`, `AdminUserName`, `AdminPassword`, `AdminEmailId`, `userType`, `CreationDate`, `UpdationDate`) VALUES
(1, 'elmino', 'f925916e2754e5e03f75dd58a5733251', 'emmanuel.agyei@ashesi.edu.gh', 1, '2024-05-21 18:30:00', '2024-05-21 05:42:52'),
(3, 'emmanuel', 'f925916e2754e5e03f75dd58a5733251', 'agyeibrewuemmanuel@gmail.in', 0, '2024-05-21 18:40:00', '2024-05-21 05:43:01');

-- Table structure for table `tblcategory`
CREATE TABLE `tblcategory` (
  `id` int(11) NOT NULL AUTO_INCREMENT, -- Primary key
  `CategoryName` varchar(200) DEFAULT NULL,
  `Description` mediumtext DEFAULT NULL,
  `PostingDate` timestamp NULL DEFAULT current_timestamp(),
  `UpdationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `Is_Active` int(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table `tblcategory`
INSERT INTO `tblcategory` (`id`, `CategoryName`, `Description`, `PostingDate`, `UpdationDate`, `Is_Active`) VALUES
(3, 'Sports', 'Related to sports news', '2024-05-11 18:30:00', '2024-05-31 05:43:16', 1),
(5, 'Entertainment', 'Entertainment related News', '2024-05-11 18:30:00', '2024-05-31 05:43:25', 1),
(6, 'Politics', 'Politics', '2024-05-11 18:30:00', '2024-05-31 05:43:25', 1),
(7, 'Business', 'Business', '2024-05-11 18:30:00', '2024-05-31 05:43:25', 1),
(8, 'COVID-19', 'COVID-19', '2024-05-11 18:30:00', '2024-05-31 05:43:25', 1);

-- Table structure for table `tblposts`
CREATE TABLE `tblposts` (
  `id` int(11) NOT NULL AUTO_INCREMENT, -- Primary key
  `PostTitle` longtext DEFAULT NULL,
  `CategoryId` int(11) DEFAULT NULL, -- Foreign key referencing tblcategory
  `PostDetails` longtext CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `PostingDate` timestamp NULL DEFAULT current_timestamp(),
  `UpdationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `Is_Active` int(1) DEFAULT NULL,
  `PostUrl` mediumtext DEFAULT NULL,
  `PostImage` varchar(255) DEFAULT NULL,
  `viewCounter` int(11) DEFAULT NULL,
  `postedBy` varchar(255) DEFAULT NULL,
  `lastUpdatedBy` varchar(255) DEFAULT NULL,
  `Is_Approved` int(1) DEFAULT 0, -- Approval status, default is 0 (not approved)
  PRIMARY KEY (`id`),
  FOREIGN KEY (`CategoryId`) REFERENCES `tblcategory`(`id`) -- Foreign key relationship
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table `tblposts`
INSERT INTO `tblposts` (`id`, `PostTitle`, `CategoryId`, `PostDetails`, `PostingDate`, `UpdationDate`, `Is_Active`, `Is_Approved`, `PostUrl`, `PostImage`, `viewCounter`, `postedBy`, `lastUpdatedBy`) VALUES
(1, "Ghana's Economy Shows Resilience Amid Global Challenges", 7,  "Accra, Ghana - Despite the ongoing global economic challenges, Ghana's economy has demonstrated remarkable resilience. The country's GDP growth rate for the first quarter of 2024 exceeded expectations, reaching 6.5%. Key sectors such as agriculture, mining, and services have contributed significantly to this growth. The government's prudent fiscal policies and investment in infrastructure projects have played a crucial role in sustaining economic momentum. Experts predict that Ghana's economy will continue to thrive, attracting foreign investors and fostering job creation. As the nation celebrates its 65th independence anniversary, citizens are optimistic about the future.", '2024-05-03 10:00:00', '2024-05-03 14:30:00', 1, 1, 'https://ghananews.com/economy-resilience', 'ghananews_economy.jpg', 1200, 'Ghana News Agency', 'Economic Analyst');
 