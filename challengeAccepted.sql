-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 09, 2016 at 08:26 AM
-- Server version: 10.1.10-MariaDB
-- PHP Version: 7.0.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `challengeAccepted`
--

-- --------------------------------------------------------

--
-- Table structure for table `Person`
--

CREATE TABLE `Person` (
  `studentID` varchar(50) NOT NULL,
  `rollNumber` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `batch` varchar(20) NOT NULL,
  `role` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Person`
--

INSERT INTO `Person` (`studentID`, `rollNumber`, `name`, `batch`, `role`) VALUES
('daemondestudent', 1234, 'Daemon Student', 'A', 'student');

-- --------------------------------------------------------

--
-- Table structure for table `Question`
--

CREATE TABLE `Question` (
  `questionCode` varchar(50) NOT NULL,
  `questionStatement` text NOT NULL,
  `numberInput` int(11) NOT NULL,
  `inputVariable` varchar(200) NOT NULL,
  `inputVariableType` varchar(200) NOT NULL,
  `numberOutput` int(11) NOT NULL,
  `outputVariable` varchar(200) NOT NULL,
  `outputVariableType` varchar(200) NOT NULL,
  `questionCreator` varchar(100) NOT NULL,
  `isInAssignment` varchar(10) NOT NULL DEFAULT 'False',
  `createTime` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Question`
--

INSERT INTO `Question` (`questionCode`, `questionStatement`, `numberInput`, `inputVariable`, `inputVariableType`, `numberOutput`, `outputVariable`, `outputVariableType`, `questionCreator`, `isInAssignment`, `createTime`) VALUES
('And', 'Write a program to simulate a circuit that gives the result after AND of two one bit inputs', 2, 'a:2:{i:0;s:1:"a";i:1;s:1:"b";}', 'a:2:{i:0;s:6:"Binary";i:1;s:6:"Binary";}', 1, 'a:1:{i:0;s:3:"out";}', 'a:1:{i:0;s:6:"Binary";}', 'daemon', 'False', 1461508550),
('And16', 'Create an HDL program for simulating a circuit that ANDs two 16 bit inputs', 2, 'a:2:{i:0;s:1:"a";i:1;s:1:"b";}', 'a:2:{i:0;s:6:"Binary";i:1;s:6:"Binary";}', 1, 'a:1:{i:0;s:1:"c";}', 'a:1:{i:0;s:6:"Binary";}', 'daemon', 'False', 1461507504);

-- --------------------------------------------------------

--
-- Table structure for table `Session`
--

CREATE TABLE `Session` (
  `sessionCode` varchar(200) NOT NULL,
  `sessionStart` int(11) NOT NULL,
  `sessionStop` int(11) NOT NULL,
  `sessionQuestionCode` varchar(1000) NOT NULL,
  `sessionQuestionMarks` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Session`
--

INSERT INTO `Session` (`sessionCode`, `sessionStart`, `sessionStop`, `sessionQuestionCode`, `sessionQuestionMarks`) VALUES
('test1', 1261592800, 1461607200, 'a:2:{i:0;s:3:"And";i:1;s:5:"And16";}', 'a:2:{i:0;s:1:"5";i:1;s:1:"5";}');

-- --------------------------------------------------------

--
-- Table structure for table `Submission`
--

CREATE TABLE `Submission` (
  `studentID` varchar(50) NOT NULL,
  `questionCode` varchar(100) NOT NULL,
  `submissionTime` int(11) NOT NULL,
  `uploadedCode` varchar(4096) NOT NULL,
  `result` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Submission`
--

INSERT INTO `Submission` (`studentID`, `questionCode`, `submissionTime`, `uploadedCode`, `result`) VALUES
('daemondestudent', 'And', 1461536472, '// This file is part of www.nand2tetris.org\r\n// and the book "The Elements of Computing Systems"\r\n// by Nisan and Schocken, MIT Press.\r\n// File name: projects/01/And.hdl\r\n\r\n/**\r\n * And gate: \r\n * out = 1 if (a == 1 and b == 1)\r\n *       0 otherwise\r\n */\r\n\r\nCHIP And {\r\n    IN a, b;\r\n    OUT out;\r\n\r\n    PARTS:\r\n    Nand (a=a, b=b, out=AnandB);\r\n    Not(in=AnandB, out=out);\r\n}\r\n', 'TestCase #0 Output correct\nTestCase #1 Output correct\nTestCase #2 Output correct\nTestCase #3 Output correct\n'),
('daemondestudent', 'And16', 1461540398, '// This file is part of www.nand2tetris.org\r\n// and the book "The Elements of Computing Systems"\r\n// by Nisan and Schocken, MIT Press.\r\n// File name: projects/01/And16.hdl\r\n\r\n/**\r\n * 16-bit bitwise And:\r\n * for i = 0..15: out[i] = (a[i] and b[i])\r\n */\r\n\r\nCHIP And16 {\r\n    IN a[16], b[16];\r\n    OUT out[16];\r\n\r\n    PARTS:\r\n    And (a=a[0], b=b[0], out=out[0]);\r\n    And (a=a[1], b=b[1], out=out[1]);\r\n    And (a=a[2], b=b[2], out=out[2]);\r\n    And (a=a[3], b=b[3], out=out[3]);\r\n    And (a=a[4], b=b[4], out=out[4]);\r\n    And (a=a[5], b=b[5], out=out[5]);\r\n    And (a=a[6], b=b[6], out=out[6]);\r\n    And (a=a[7], b=b[7], out=out[7]);\r\n    And (a=a[8], b=b[8], out=out[8]);\r\n    And (a=a[9], b=b[9], out=out[9]);\r\n    And (a=a[10], b=b[10], out=out[10]);\r\n    And (a=a[11], b=b[11], out=out[11]);\r\n    And (a=a[12], b=b[12], out=out[12]);\r\n    And (a=a[13], b=b[13], out=out[13]);\r\n    And (a=a[14], b=b[14], out=out[14]);\r\n    And (a=a[15], b=b[15], out=out[15]);\r\n}\r\n', 'TestCase #0 Output incorrect\nTestCase #1 Output incorrect\nTestCase #2 Output incorrect\nTestCase #3 Output incorrect\nTestCase #4 Output incorrect\nTestCase #5 Output incorrect\nTestCase #6 Output incorrect\nTestCase #7 Output incorrect\nTestCase #8 Output incorrect\nTestCase #9 Output incorrect\n'),
('daemondestudent', 'And16', 1461540431, '// This file is part of www.nand2tetris.org\r\n// and the book "The Elements of Computing Systems"\r\n// by Nisan and Schocken, MIT Press.\r\n// File name: projects/01/And16.hdl\r\n\r\n/**\r\n * 16-bit bitwise And:\r\n * for i = 0..15: out[i] = (a[i] and b[i])\r\n */\r\n\r\nCHIP And16 {\r\n    IN a[16], b[16];\r\n    OUT out[16];\r\n\r\n    PARTS:\r\n    And (a=a[0], b=b[0], out=out[0]);\r\n    And (a=a[1], b=b[1], out=out[1]);\r\n    And (a=a[2], b=b[2], out=out[2]);\r\n    And (a=a[3], b=b[3], out=out[3]);\r\n    And (a=a[4], b=b[4], out=out[4]);\r\n    And (a=a[5], b=b[5], out=out[5]);\r\n    And (a=a[6], b=b[6], out=out[6]);\r\n    And (a=a[7], b=b[7], out=out[7]);\r\n    And (a=a[8], b=b[8], out=out[8]);\r\n    And (a=a[9], b=b[9], out=out[9]);\r\n    And (a=a[10], b=b[10], out=out[10]);\r\n    And (a=a[11], b=b[11], out=out[11]);\r\n    And (a=a[12], b=b[12], out=out[12]);\r\n    And (a=a[13], b=b[13], out=out[13]);\r\n    And (a=a[14], b=b[14], out=out[14]);\r\n    And (a=a[15], b=b[15], out=out[15]);\r\n}\r\n', 'TestCase #0 Output incorrect\nTestCase #1 Output incorrect\nTestCase #2 Output incorrect\nTestCase #3 Output incorrect\nTestCase #4 Output incorrect\nTestCase #5 Output incorrect\nTestCase #6 Output incorrect\nTestCase #7 Output incorrect\nTestCase #8 Output incorrect\nTestCase #9 Output incorrect\n');

-- --------------------------------------------------------

--
-- Table structure for table `TestCase`
--

CREATE TABLE `TestCase` (
  `questionCode` varchar(50) NOT NULL,
  `testCaseNumber` int(11) NOT NULL,
  `inputData` varchar(4096) NOT NULL,
  `outputData` varchar(4096) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `TestCase`
--

INSERT INTO `TestCase` (`questionCode`, `testCaseNumber`, `inputData`, `outputData`) VALUES
('And', 0, 'a:2:{i:0;s:7:"   0   ";i:1;s:7:"   0   ";}', 'a:1:{i:0;s:7:"   0   ";}'),
('And', 1, 'a:2:{i:0;s:7:"   0   ";i:1;s:7:"   1   ";}', 'a:1:{i:0;s:7:"   0   ";}'),
('And', 2, 'a:2:{i:0;s:7:"   1   ";i:1;s:7:"   0   ";}', 'a:1:{i:0;s:7:"   0   ";}'),
('And', 3, 'a:2:{i:0;s:7:"   1   ";i:1;s:7:"   1   ";}', 'a:1:{i:0;s:7:"   1   ";}'),
('And16', 0, 'a:2:{i:0;s:18:" 0000000000000000 ";i:1;s:18:" 0000000000000000 ";}', 'a:1:{i:0;s:18:" 0000000000000000 ";}'),
('And16', 1, 'a:2:{i:0;s:18:" 0000000000000000 ";i:1;s:18:" 1111111111111111 ";}', 'a:1:{i:0;s:18:" 0000000000000000 ";}'),
('And16', 2, 'a:2:{i:0;s:18:" 1111111111111111 ";i:1;s:18:" 0000000000000000 ";}', 'a:1:{i:0;s:18:" 0000000000000000 ";}'),
('And16', 3, 'a:2:{i:0;s:18:" 1111111111111111 ";i:1;s:18:" 1111111111111111 ";}', 'a:1:{i:0;s:18:" 1111111111111111 ";}'),
('And16', 4, 'a:2:{i:0;s:18:" 1010101010101010 ";i:1;s:18:" 0101010101010101 ";}', 'a:1:{i:0;s:18:" 0000000000000000 ";}'),
('And16', 5, 'a:2:{i:0;s:18:" 0011110011000011 ";i:1;s:18:" 0000111111110000 ";}', 'a:1:{i:0;s:18:" 0000110011000000 ";}'),
('And16', 6, 'a:2:{i:0;s:18:" 0001001000110100 ";i:1;s:18:" 1001100001110110 ";}', 'a:1:{i:0;s:18:" 0001000000110100 ";}'),
('And16', 7, 'a:2:{i:0;s:18:" 0101010101010101 ";i:1;s:18:" 0011001100110011 ";}', 'a:1:{i:0;s:18:" 0001000100010001 ";}'),
('And16', 8, 'a:2:{i:0;s:18:" 1111111111111111 ";i:1;s:18:" 0001110001110001 ";}', 'a:1:{i:0;s:18:" 0001110001110001 ";}'),
('And16', 9, 'a:2:{i:0;s:18:" 0101000101010011 ";i:1;s:18:" 1010001011011000 ";}', 'a:1:{i:0;s:18:" 0000000001010000 ";}');

-- --------------------------------------------------------

--
-- Table structure for table `TestResult`
--

CREATE TABLE `TestResult` (
  `studentID` varchar(50) NOT NULL,
  `sessionCode` int(200) NOT NULL,
  `questionCode` varchar(200) NOT NULL,
  `result` varchar(1000) NOT NULL,
  `marks` int(11) NOT NULL,
  `submissionTime` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Person`
--
ALTER TABLE `Person`
  ADD PRIMARY KEY (`studentID`);

--
-- Indexes for table `Question`
--
ALTER TABLE `Question`
  ADD PRIMARY KEY (`questionCode`);

--
-- Indexes for table `Session`
--
ALTER TABLE `Session`
  ADD PRIMARY KEY (`sessionCode`),
  ADD KEY `SESSIONQUESTIONCODEINDEX` (`sessionQuestionCode`(767));

--
-- Indexes for table `Submission`
--
ALTER TABLE `Submission`
  ADD KEY `STUDENTIDINDEX` (`studentID`,`questionCode`),
  ADD KEY `SESSIONQUESTIONCODEINDEX` (`studentID`),
  ADD KEY `QUESTIONCODESUBMISSIONQUESTION` (`questionCode`);

--
-- Indexes for table `TestCase`
--
ALTER TABLE `TestCase`
  ADD PRIMARY KEY (`questionCode`,`testCaseNumber`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Submission`
--
ALTER TABLE `Submission`
  ADD CONSTRAINT `QUESTIONCODESUBMISSIONQUESTION` FOREIGN KEY (`questionCode`) REFERENCES `Question` (`questionCode`),
  ADD CONSTRAINT `STUDENTIDSUBMISSIONPERSON` FOREIGN KEY (`studentID`) REFERENCES `Person` (`studentID`);

--
-- Constraints for table `TestCase`
--
ALTER TABLE `TestCase`
  ADD CONSTRAINT `QUESTIONCODEQUESTIONTESTCASE` FOREIGN KEY (`questionCode`) REFERENCES `Question` (`questionCode`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
