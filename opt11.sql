-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 09, 2018 at 03:57 PM
-- Server version: 5.7.14
-- PHP Version: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `opt11`
--

-- --------------------------------------------------------

--
-- Table structure for table `battingstyle`
--

CREATE TABLE `battingstyle` (
  `btsId` tinyint(4) NOT NULL,
  `btsStyle` varchar(100) NOT NULL,
  `btsStatus` tinyint(1) NOT NULL COMMENT '1-Active, 2-Inactive',
  `btsAddedBy` bigint(20) NOT NULL,
  `btsDateAdded` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `btsUpdatedBy` bigint(20) NOT NULL,
  `btsDateUpdated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `battingstyle`
--

INSERT INTO `battingstyle` (`btsId`, `btsStyle`, `btsStatus`, `btsAddedBy`, `btsDateAdded`, `btsUpdatedBy`, `btsDateUpdated`) VALUES
(1, 'Right arm batsman', 1, 1, '2018-01-30 05:56:24', 1, '2018-01-30 05:56:24'),
(2, 'Left hand batsman', 1, 1, '2018-01-30 05:56:24', 1, '2018-01-30 05:56:24'),
(3, 'N/A', 1, 1, '2018-02-03 06:32:37', 1, '2018-02-04 10:43:11');

-- --------------------------------------------------------

--
-- Table structure for table `bowlingstyle`
--

CREATE TABLE `bowlingstyle` (
  `bwsId` tinyint(4) NOT NULL,
  `bwsStyle` varchar(100) NOT NULL,
  `bwsStatus` tinyint(1) NOT NULL COMMENT '1-Active, 2-Inactive',
  `bwsAddedBy` bigint(20) NOT NULL,
  `bwsDateAdded` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `bwsUpdatedBy` bigint(20) NOT NULL,
  `bwsDateUpdated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bowlingstyle`
--

INSERT INTO `bowlingstyle` (`bwsId`, `bwsStyle`, `bwsStatus`, `bwsAddedBy`, `bwsDateAdded`, `bwsUpdatedBy`, `bwsDateUpdated`) VALUES
(1, 'Right arm fast', 1, 1, '2018-01-30 05:31:56', 1, '2018-01-30 05:31:56'),
(2, 'Right arm fast medium', 1, 1, '2018-01-30 05:32:55', 1, '2018-01-30 05:31:56'),
(3, 'Right arm medium', 1, 1, '2018-01-30 05:32:54', 1, '2018-01-30 05:31:56'),
(4, 'Right arm offbreak', 1, 1, '2018-01-30 05:32:54', 1, '2018-01-30 05:31:56'),
(5, 'Right arm legbreak', 1, 1, '2018-01-30 05:31:56', 1, '2018-01-30 05:31:56'),
(6, 'Left arm fast', 1, 1, '2018-01-30 05:34:07', 1, '2018-01-30 05:31:56'),
(7, 'Left arm fast medium', 1, 1, '2018-01-30 05:34:07', 1, '2018-01-30 05:31:56'),
(8, 'Left arm medium', 1, 1, '2018-01-30 05:34:08', 1, '2018-01-30 05:31:56'),
(9, 'Left arm orthodox', 1, 1, '2018-01-30 05:34:08', 1, '2018-01-30 05:31:56'),
(10, 'Left arm chinaman', 1, 1, '2018-01-30 05:34:09', 1, '2018-01-30 05:31:56'),
(11, 'N/A', 1, 1, '2018-02-04 15:04:56', 1, '2018-02-04 15:10:55');

-- --------------------------------------------------------

--
-- Table structure for table `codelistmaster`
--

CREATE TABLE `codelistmaster` (
  `cdlId` bigint(20) NOT NULL,
  `cdlName` varchar(100) NOT NULL,
  `cdlStatus` tinyint(1) NOT NULL,
  `cdlAddedBy` bigint(20) NOT NULL,
  `cdlDateAdded` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `cdlUpdatedBy` bigint(20) NOT NULL,
  `cdlDateUpdated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `codelistmaster`
--

INSERT INTO `codelistmaster` (`cdlId`, `cdlName`, `cdlStatus`, `cdlAddedBy`, `cdlDateAdded`, `cdlUpdatedBy`, `cdlDateUpdated`) VALUES
(1, 'Status', 1, 1, '2018-02-07 05:36:26', 1, '2018-02-08 05:29:27'),
(2, 'Gender', 1, 1, '2018-02-07 06:58:14', 1, '2018-02-08 05:29:43'),
(3, 'Team Type', 1, 1, '2018-02-08 05:06:15', 1, '2018-02-08 05:06:15');

-- --------------------------------------------------------

--
-- Table structure for table `codelistvalue`
--

CREATE TABLE `codelistvalue` (
  `clvId` bigint(20) NOT NULL,
  `clvCdlId` bigint(20) NOT NULL,
  `clvValue` smallint(6) NOT NULL,
  `clvDisplayText` varchar(100) NOT NULL,
  `clvOrder` smallint(6) NOT NULL,
  `clvStatus` tinyint(1) NOT NULL,
  `clvAddedBy` bigint(20) NOT NULL,
  `clvDateAdded` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `clvUpdatedBy` bigint(20) NOT NULL,
  `clvDateUpdated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `codelistvalue`
--

INSERT INTO `codelistvalue` (`clvId`, `clvCdlId`, `clvValue`, `clvDisplayText`, `clvOrder`, `clvStatus`, `clvAddedBy`, `clvDateAdded`, `clvUpdatedBy`, `clvDateUpdated`) VALUES
(1, 3, 1, 'International', 10, 1, 1, '2018-02-08 04:18:49', 1, '2018-02-08 05:06:15'),
(2, 3, 2, 'Club', 20, 1, 1, '2018-02-08 04:18:49', 1, '2018-02-08 05:06:15'),
(3, 3, 3, 'National', 30, 1, 1, '2018-02-08 04:18:49', 1, '2018-02-08 05:06:15'),
(4, 3, 4, 'State', 40, 1, 1, '2018-02-08 04:18:49', 1, '2018-02-08 05:06:15'),
(5, 3, 5, 'Other', 50, 1, 1, '2018-02-08 05:06:06', 1, '2018-02-08 05:06:15'),
(6, 1, 1, 'Active', 10, 1, 1, '2018-02-08 05:29:27', 1, '2018-02-08 05:29:27'),
(7, 1, 2, 'Inactive', 20, 1, 1, '2018-02-08 05:29:27', 1, '2018-02-08 05:29:27'),
(8, 2, 1, 'Male', 10, 1, 1, '2018-02-08 05:29:44', 1, '2018-02-08 05:29:44'),
(9, 2, 2, 'Female', 20, 1, 1, '2018-02-08 05:29:44', 1, '2018-02-08 05:29:44');

-- --------------------------------------------------------

--
-- Table structure for table `playermaster`
--

CREATE TABLE `playermaster` (
  `plrId` bigint(20) NOT NULL,
  `plrName` varchar(250) NOT NULL,
  `plrShortName` varchar(100) NOT NULL,
  `plrDisplayName` varchar(100) NOT NULL,
  `plrDOB` date NOT NULL,
  `plrBatStyle` tinyint(4) NOT NULL,
  `plrBowlStyle` tinyint(4) NOT NULL,
  `plrMajorRole` tinyint(4) NOT NULL,
  `plrStatus` tinyint(1) NOT NULL COMMENT '1-Active, 2-Inactive',
  `plrAddedBy` bigint(20) NOT NULL,
  `plrDateAdded` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `plrUpdatedBy` bigint(20) NOT NULL,
  `plrDateUpdated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `playermaster`
--

INSERT INTO `playermaster` (`plrId`, `plrName`, `plrShortName`, `plrDisplayName`, `plrDOB`, `plrBatStyle`, `plrBowlStyle`, `plrMajorRole`, `plrStatus`, `plrAddedBy`, `plrDateAdded`, `plrUpdatedBy`, `plrDateUpdated`) VALUES
(1, 'Mahendra Singh Dhoni', 'MSD', 'MS Dhoni', '1981-07-07', 1, 3, 6, 1, 1, '2018-01-30 05:54:15', 1, '2018-01-30 05:54:15'),
(2, 'Virat Kohli', 'VK', 'V Kohli', '1988-11-05', 1, 3, 1, 1, 1, '2018-01-30 05:47:50', 1, '2018-01-30 05:47:50'),
(3, 'Rohit Gurunath Sharma', 'Rohit', 'R Sharma', '1987-04-30', 1, 4, 1, 1, 1, '2018-01-30 05:47:50', 1, '2018-01-30 05:47:50'),
(4, 'Hardik Himanshu Pandya', 'Hardik', 'H Pandya', '1993-10-11', 1, 3, 3, 1, 1, '2018-01-30 05:53:08', 1, '2018-01-30 05:53:08'),
(5, 'Jasprit Jasbirsingh Bumrah', 'Bumrah', 'J Bumrah', '1993-12-06', 1, 2, 2, 1, 1, '2018-01-30 05:47:50', 1, '2018-01-30 05:47:50'),
(6, 'Francois du Plessis', 'Faf', 'Faf du Plessis', '1984-07-13', 1, 5, 1, 1, 1, '2018-01-30 06:05:13', 1, '2018-01-30 06:05:13'),
(7, 'Abraham Benjamin de Villiers', 'ABD', 'AB de Villiers', '1984-02-17', 1, 3, 1, 1, 1, '2018-01-30 06:08:34', 1, '2018-01-30 06:05:13'),
(8, 'Quinton de Kock', 'QDK', 'Q de Kock', '1992-12-17', 2, 9, 6, 1, 1, '2018-01-30 06:05:13', 1, '2018-01-30 06:05:13'),
(9, 'Vernon Darryl Philander', 'Pro', 'V Philander', '1985-06-24', 1, 2, 5, 1, 1, '2018-01-30 06:05:13', 1, '2018-01-30 06:05:13'),
(10, 'Morne Morkel', 'Morkel', 'M Morkel', '1984-10-06', 2, 1, 2, 1, 1, '2018-01-30 06:05:13', 1, '2018-01-30 06:05:13'),
(11, 'Hashim Mahomed Amla', 'Amla', 'H Amla', '1983-03-31', 1, 3, 1, 1, 1, '2018-02-05 04:44:28', 1, '2018-02-08 05:31:32'),
(12, 'Bhuvneshwar Kumar Singh', 'Bhuvi', 'B Kumar', '1980-02-05', 1, 2, 2, 1, 1, '2018-02-05 06:43:49', 1, '2018-02-08 05:31:35');

-- --------------------------------------------------------

--
-- Table structure for table `playerroles`
--

CREATE TABLE `playerroles` (
  `prlId` tinyint(4) NOT NULL,
  `prlRole` varchar(100) NOT NULL,
  `prlStatus` tinyint(1) NOT NULL COMMENT '1-Active, 2-Inactive',
  `prlAddedBy` bigint(20) NOT NULL,
  `prlDateAdded` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `prlUpdatedBy` bigint(20) NOT NULL,
  `prlDateUpdated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `playerroles`
--

INSERT INTO `playerroles` (`prlId`, `prlRole`, `prlStatus`, `prlAddedBy`, `prlDateAdded`, `prlUpdatedBy`, `prlDateUpdated`) VALUES
(1, 'Batsman', 1, 1, '2018-01-30 05:18:18', 1, '2018-01-30 05:18:18'),
(2, 'Bowler', 1, 1, '2018-01-30 05:19:13', 1, '2018-01-30 05:19:13'),
(3, 'Allrounder', 1, 1, '2018-01-30 05:19:21', 1, '2018-01-30 05:19:21'),
(4, 'Batting Allrounder', 1, 1, '2018-01-30 05:19:33', 1, '2018-02-04 16:18:41'),
(5, 'Bowling Allrounder', 1, 1, '2018-01-30 05:53:42', 1, '2018-01-30 05:53:42'),
(6, 'Wicketkeeper Batsman', 1, 1, '2018-01-30 05:54:08', 1, '2018-01-30 05:54:08'),
(7, 'Wicketkeeper', 1, 1, '2018-01-30 05:54:09', 1, '2018-01-30 05:54:09'),
(8, 'N/A', 1, 1, '2018-02-04 15:31:31', 1, '2018-02-04 15:34:29');

-- --------------------------------------------------------

--
-- Table structure for table `seriesmaster`
--

CREATE TABLE `seriesmaster` (
  `serId` bigint(20) NOT NULL,
  `serName` varchar(250) NOT NULL,
  `serShortName` varchar(50) NOT NULL,
  `serDisplayName` varchar(100) NOT NULL,
  `serStartDt` date NOT NULL,
  `serEndDt` date NOT NULL,
  `serVisibleStartDt` date NOT NULL,
  `serVisibleEndDt` date NOT NULL,
  `serStatus` tinyint(1) NOT NULL,
  `serAddedBy` bigint(20) NOT NULL,
  `serDateAdded` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `serUpdatedBy` bigint(20) NOT NULL,
  `serDateUpdated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `seriesmaster`
--

INSERT INTO `seriesmaster` (`serId`, `serName`, `serShortName`, `serDisplayName`, `serStartDt`, `serEndDt`, `serVisibleStartDt`, `serVisibleEndDt`, `serStatus`, `serAddedBy`, `serDateAdded`, `serUpdatedBy`, `serDateUpdated`) VALUES
(8, 'South Africa vs India ODI 2018', 'SA vs IND ODI 2018', 'SA vs IND ODI 2018', '2018-01-15', '2018-01-31', '2018-01-10', '2018-02-05', 1, 1, '2018-02-09 04:30:46', 1, '2018-02-09 05:59:22'),
(9, 'Indian Premier League 2018', 'IPL 2018', 'IPL 2018', '2018-04-05', '2018-05-25', '2018-04-01', '2018-05-30', 1, 1, '2018-02-09 05:45:24', 1, '2018-02-09 06:27:47');

-- --------------------------------------------------------

--
-- Table structure for table `seriesteamxref`
--

CREATE TABLE `seriesteamxref` (
  `stxId` bigint(20) NOT NULL,
  `stxSerId` bigint(20) NOT NULL,
  `stxTemId` bigint(20) NOT NULL,
  `stxStatus` tinyint(1) NOT NULL,
  `stxAddedBy` bigint(20) NOT NULL,
  `stxDateAdded` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `stxUpdatedBy` bigint(20) NOT NULL,
  `stxDateUpdated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `seriesteamxref`
--

INSERT INTO `seriesteamxref` (`stxId`, `stxSerId`, `stxTemId`, `stxStatus`, `stxAddedBy`, `stxDateAdded`, `stxUpdatedBy`, `stxDateUpdated`) VALUES
(3, 8, 1, 1, 1, '2018-02-09 04:30:47', 1, '2018-02-09 04:30:47'),
(4, 8, 2, 1, 1, '2018-02-09 04:30:47', 1, '2018-02-09 04:30:47'),
(5, 9, 4, 1, 1, '2018-02-09 05:45:24', 1, '2018-02-09 05:45:24'),
(6, 9, 5, 1, 1, '2018-02-09 05:45:24', 1, '2018-02-09 05:45:24'),
(7, 9, 6, 1, 1, '2018-02-09 06:27:47', 1, '2018-02-09 06:27:47');

-- --------------------------------------------------------

--
-- Table structure for table `squadmaster`
--

CREATE TABLE `squadmaster` (
  `sqdId` bigint(20) NOT NULL,
  `sqdStxId` bigint(20) NOT NULL,
  `sqdPlrId` bigint(20) NOT NULL,
  `sqdprlId` tinyint(4) NOT NULL,
  `sqdPrice` double NOT NULL,
  `sqdPoints` double NOT NULL,
  `sqdStatus` tinyint(1) NOT NULL,
  `sqdAddedBy` bigint(20) NOT NULL,
  `sqdDateAdded` timestamp NOT NULL,
  `sqdUpdatedBy` bigint(20) NOT NULL,
  `sqdDateUpdated` timestamp NOT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `teammaster`
--

CREATE TABLE `teammaster` (
  `temId` bigint(20) NOT NULL,
  `temName` varchar(100) NOT NULL,
  `temShortName` varchar(50) NOT NULL,
  `temDisplayName` varchar(50) NOT NULL,
  `temStatus` tinyint(1) NOT NULL COMMENT '1-Active, 2-Inactive',
  `temAddedBy` bigint(20) NOT NULL,
  `temDateAdded` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `temUpdatedBy` bigint(20) NOT NULL,
  `temDateUpdated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `teammaster`
--

INSERT INTO `teammaster` (`temId`, `temName`, `temShortName`, `temDisplayName`, `temStatus`, `temAddedBy`, `temDateAdded`, `temUpdatedBy`, `temDateUpdated`) VALUES
(1, 'India', 'Ind', 'India', 1, 1, '2018-01-30 06:21:38', 1, '2018-01-30 06:21:32'),
(2, 'South Africa', 'SA', 'South Africa', 1, 1, '2018-01-30 06:21:32', 1, '2018-01-30 06:21:32'),
(3, 'West Indies', 'WI', 'West Indies', 1, 1, '2018-02-04 16:16:25', 1, '2018-02-04 16:16:25'),
(4, 'Chennai Super Kings', 'CSK', 'CSK', 1, 1, '2018-02-04 16:17:04', 1, '2018-02-05 06:46:52'),
(5, 'Royal Chellenger Bangalore', 'RCB', 'RCB', 1, 1, '2018-02-05 06:47:39', 1, '2018-02-05 06:47:39'),
(6, 'Sun Risers Hydrabad', 'SRH', 'SRH', 1, 1, '2018-02-09 05:44:35', 1, '2018-02-09 05:44:35');

-- --------------------------------------------------------

--
-- Table structure for table `usermaster`
--

CREATE TABLE `usermaster` (
  `usrId` bigint(20) NOT NULL,
  `usrFullName` varchar(250) NOT NULL,
  `usrFirstName` varchar(150) NOT NULL,
  `usrLastName` varchar(150) NOT NULL,
  `usrEmail` varchar(250) NOT NULL,
  `usrFacebookId` varchar(250) DEFAULT NULL,
  `usrGoogleId` varchar(250) DEFAULT NULL,
  `usrTwitterId` varchar(250) DEFAULT NULL,
  `usrType` tinyint(2) NOT NULL COMMENT '1-User(FB, Google & Twitter), 2-Admin',
  `usrStatus` tinyint(1) NOT NULL COMMENT '1-Active, 2-Inactive',
  `usrDateAdded` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `usrDateUpdated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `usermaster`
--

INSERT INTO `usermaster` (`usrId`, `usrFullName`, `usrFirstName`, `usrLastName`, `usrEmail`, `usrFacebookId`, `usrGoogleId`, `usrTwitterId`, `usrType`, `usrStatus`, `usrDateAdded`, `usrDateUpdated`) VALUES
(1, 'Sasidaran Shanmugam', 'Sasidaran', 'Shanmugam', 'sasidaran.s@gmail.com', NULL, NULL, NULL, 2, 1, '2018-01-30 05:15:58', '2018-01-30 05:15:58'),
(2, 'Anandaraja Angamuthu', 'Anandraja', 'Angamuthu', 'anandelex@gmail.com', NULL, NULL, NULL, 2, 1, '2018-01-30 05:18:18', '2018-01-30 05:18:18'),
(3, 'Rathinam Johnson', 'Rathinam', 'Johnson', 'rathinam.j@gmail.com', NULL, NULL, NULL, 2, 1, '2018-01-30 05:15:58', '2018-01-30 05:15:58');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `battingstyle`
--
ALTER TABLE `battingstyle`
  ADD PRIMARY KEY (`btsId`),
  ADD UNIQUE KEY `IK_btsStyle` (`btsStyle`),
  ADD KEY `FK_btsAddedBy` (`btsAddedBy`),
  ADD KEY `FK_btsUpdatedBy` (`btsUpdatedBy`);

--
-- Indexes for table `bowlingstyle`
--
ALTER TABLE `bowlingstyle`
  ADD PRIMARY KEY (`bwsId`),
  ADD UNIQUE KEY `IK_bwsStyle` (`bwsStyle`),
  ADD KEY `FK_bwsAddedBy` (`bwsAddedBy`),
  ADD KEY `FK_bwsUpdatedBy` (`bwsUpdatedBy`);

--
-- Indexes for table `codelistmaster`
--
ALTER TABLE `codelistmaster`
  ADD PRIMARY KEY (`cdlId`),
  ADD UNIQUE KEY `IK_cdlName` (`cdlName`),
  ADD KEY `FK_cdlAddedBy` (`cdlAddedBy`),
  ADD KEY `FK_cdlUpdatedBy` (`cdlUpdatedBy`);

--
-- Indexes for table `codelistvalue`
--
ALTER TABLE `codelistvalue`
  ADD PRIMARY KEY (`clvId`),
  ADD KEY `clvCdlId` (`clvCdlId`),
  ADD KEY `clvAddedBy` (`clvAddedBy`),
  ADD KEY `clvUpdatedBy` (`clvUpdatedBy`),
  ADD KEY `IK_clvValue` (`clvValue`),
  ADD KEY `IK_clvDisplayText` (`clvDisplayText`);

--
-- Indexes for table `playermaster`
--
ALTER TABLE `playermaster`
  ADD PRIMARY KEY (`plrId`),
  ADD KEY `IK_plrFullName` (`plrName`),
  ADD KEY `IK_plrShortName` (`plrShortName`),
  ADD KEY `IK_plrDisplayName` (`plrDisplayName`),
  ADD KEY `IK_plrDOB` (`plrDOB`),
  ADD KEY `FK_plrAddedBy` (`plrAddedBy`),
  ADD KEY `FK_plrUpdatedBy` (`plrUpdatedBy`),
  ADD KEY `FK_plrMajorRole` (`plrMajorRole`),
  ADD KEY `FK_plrBatStyle` (`plrBatStyle`),
  ADD KEY `FK_plrBowlStyle` (`plrBowlStyle`);

--
-- Indexes for table `playerroles`
--
ALTER TABLE `playerroles`
  ADD PRIMARY KEY (`prlId`),
  ADD KEY `FK_prlAddedBy` (`prlAddedBy`),
  ADD KEY `FK_prlUpdatedBy` (`prlUpdatedBy`),
  ADD KEY `IK_prlRole` (`prlRole`);

--
-- Indexes for table `seriesmaster`
--
ALTER TABLE `seriesmaster`
  ADD PRIMARY KEY (`serId`),
  ADD KEY `FK_serAddedBy` (`serAddedBy`),
  ADD KEY `FK_serUpdatedBy` (`serUpdatedBy`),
  ADD KEY `IK_serName` (`serName`),
  ADD KEY `IK_serShortName` (`serShortName`),
  ADD KEY `IK_serDisplayName` (`serDisplayName`);

--
-- Indexes for table `seriesteamxref`
--
ALTER TABLE `seriesteamxref`
  ADD PRIMARY KEY (`stxId`),
  ADD KEY `FK_stxSerId` (`stxSerId`),
  ADD KEY `FK_stxTemId` (`stxTemId`),
  ADD KEY `FK_stxAddedBy` (`stxAddedBy`),
  ADD KEY `FK_stxUpdatedBy` (`stxUpdatedBy`);

--
-- Indexes for table `squadmaster`
--
ALTER TABLE `squadmaster`
  ADD PRIMARY KEY (`sqdId`),
  ADD KEY `FK_sqdStxId` (`sqdStxId`),
  ADD KEY `FK_sqdPlrId` (`sqdPlrId`),
  ADD KEY `FK_sqdAddedBy` (`sqdAddedBy`),
  ADD KEY `FK_sqdUpdatedBy` (`sqdUpdatedBy`),
  ADD KEY `FK_sqdprlId` (`sqdprlId`);

--
-- Indexes for table `teammaster`
--
ALTER TABLE `teammaster`
  ADD PRIMARY KEY (`temId`),
  ADD KEY `FK_temAddedBy` (`temAddedBy`),
  ADD KEY `FK_temUpdatedBy` (`temUpdatedBy`),
  ADD KEY `IK_temTeamName` (`temName`),
  ADD KEY `IK_temTeamShortName` (`temShortName`),
  ADD KEY `IK_temTeamDisplayName` (`temDisplayName`);

--
-- Indexes for table `usermaster`
--
ALTER TABLE `usermaster`
  ADD PRIMARY KEY (`usrId`),
  ADD UNIQUE KEY `IK_usrEmail` (`usrEmail`),
  ADD KEY `IK_usrFullName` (`usrFullName`),
  ADD KEY `IK_usrFacebookId` (`usrFacebookId`),
  ADD KEY `IK_usrGoogleId` (`usrGoogleId`),
  ADD KEY `IK_usrTwitterId` (`usrTwitterId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `battingstyle`
--
ALTER TABLE `battingstyle`
  MODIFY `btsId` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `bowlingstyle`
--
ALTER TABLE `bowlingstyle`
  MODIFY `bwsId` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `codelistmaster`
--
ALTER TABLE `codelistmaster`
  MODIFY `cdlId` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `codelistvalue`
--
ALTER TABLE `codelistvalue`
  MODIFY `clvId` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `playermaster`
--
ALTER TABLE `playermaster`
  MODIFY `plrId` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `playerroles`
--
ALTER TABLE `playerroles`
  MODIFY `prlId` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `seriesmaster`
--
ALTER TABLE `seriesmaster`
  MODIFY `serId` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `seriesteamxref`
--
ALTER TABLE `seriesteamxref`
  MODIFY `stxId` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `squadmaster`
--
ALTER TABLE `squadmaster`
  MODIFY `sqdId` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `teammaster`
--
ALTER TABLE `teammaster`
  MODIFY `temId` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `usermaster`
--
ALTER TABLE `usermaster`
  MODIFY `usrId` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `battingstyle`
--
ALTER TABLE `battingstyle`
  ADD CONSTRAINT `FK_btsAddedBy` FOREIGN KEY (`btsAddedBy`) REFERENCES `usermaster` (`usrId`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_btsUpdatedBy` FOREIGN KEY (`btsUpdatedBy`) REFERENCES `usermaster` (`usrId`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `bowlingstyle`
--
ALTER TABLE `bowlingstyle`
  ADD CONSTRAINT `FK_bwsAddedBy` FOREIGN KEY (`bwsAddedBy`) REFERENCES `usermaster` (`usrId`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_bwsUpdatedBy` FOREIGN KEY (`bwsUpdatedBy`) REFERENCES `usermaster` (`usrId`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `codelistmaster`
--
ALTER TABLE `codelistmaster`
  ADD CONSTRAINT `FK_cdlAddedBy` FOREIGN KEY (`cdlAddedBy`) REFERENCES `usermaster` (`usrId`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_cdlUpdatedBy` FOREIGN KEY (`cdlUpdatedBy`) REFERENCES `usermaster` (`usrId`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `codelistvalue`
--
ALTER TABLE `codelistvalue`
  ADD CONSTRAINT `clvCdlId` FOREIGN KEY (`clvCdlId`) REFERENCES `codelistmaster` (`cdlId`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `codelistvalue_ibfk_1` FOREIGN KEY (`clvAddedBy`) REFERENCES `usermaster` (`usrId`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `codelistvalue_ibfk_2` FOREIGN KEY (`clvUpdatedBy`) REFERENCES `usermaster` (`usrId`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `playermaster`
--
ALTER TABLE `playermaster`
  ADD CONSTRAINT `FK_plrAddedBy` FOREIGN KEY (`plrAddedBy`) REFERENCES `usermaster` (`usrId`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_plrBatStyle` FOREIGN KEY (`plrBatStyle`) REFERENCES `battingstyle` (`btsId`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_plrBowlStyle` FOREIGN KEY (`plrBowlStyle`) REFERENCES `bowlingstyle` (`bwsId`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_plrMajorRole` FOREIGN KEY (`plrMajorRole`) REFERENCES `playerroles` (`prlId`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_plrUpdatedBy` FOREIGN KEY (`plrUpdatedBy`) REFERENCES `usermaster` (`usrId`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `playerroles`
--
ALTER TABLE `playerroles`
  ADD CONSTRAINT `FK_prlAddedBy` FOREIGN KEY (`prlAddedBy`) REFERENCES `usermaster` (`usrId`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_prlUpdatedBy` FOREIGN KEY (`prlUpdatedBy`) REFERENCES `usermaster` (`usrId`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `seriesmaster`
--
ALTER TABLE `seriesmaster`
  ADD CONSTRAINT `FK_serAddedBy` FOREIGN KEY (`serAddedBy`) REFERENCES `usermaster` (`usrId`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_serUpdatedBy` FOREIGN KEY (`serUpdatedBy`) REFERENCES `usermaster` (`usrId`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `seriesteamxref`
--
ALTER TABLE `seriesteamxref`
  ADD CONSTRAINT `FK_stxAddedBy` FOREIGN KEY (`stxAddedBy`) REFERENCES `usermaster` (`usrId`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_stxSerId` FOREIGN KEY (`stxSerId`) REFERENCES `seriesmaster` (`serId`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_stxTemId` FOREIGN KEY (`stxTemId`) REFERENCES `teammaster` (`temId`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_stxUpdatedBy` FOREIGN KEY (`stxUpdatedBy`) REFERENCES `usermaster` (`usrId`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `squadmaster`
--
ALTER TABLE `squadmaster`
  ADD CONSTRAINT `FK_sqdAddedBy` FOREIGN KEY (`sqdAddedBy`) REFERENCES `usermaster` (`usrId`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_sqdPlrId` FOREIGN KEY (`sqdPlrId`) REFERENCES `playermaster` (`plrId`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_sqdStxId` FOREIGN KEY (`sqdStxId`) REFERENCES `seriesteamxref` (`stxId`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_sqdUpdatedBy` FOREIGN KEY (`sqdUpdatedBy`) REFERENCES `usermaster` (`usrId`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_sqdprlId` FOREIGN KEY (`sqdprlId`) REFERENCES `playerroles` (`prlId`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `teammaster`
--
ALTER TABLE `teammaster`
  ADD CONSTRAINT `FK_temAddedBy` FOREIGN KEY (`temAddedBy`) REFERENCES `usermaster` (`usrId`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_temUpdatedBy` FOREIGN KEY (`temUpdatedBy`) REFERENCES `usermaster` (`usrId`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
