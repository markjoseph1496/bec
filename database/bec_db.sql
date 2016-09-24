/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50616
Source Host           : localhost:3306
Source Database       : bec_db

Target Server Type    : MYSQL
Target Server Version : 50616
File Encoding         : 65001

Date: 2016-09-23 20:58:21
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `accountstbl`
-- ----------------------------
DROP TABLE IF EXISTS `accountstbl`;
CREATE TABLE `accountstbl` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `aUsername` varchar(255) NOT NULL,
  `aPassword` varchar(255) NOT NULL,
  `aSaltedPassword` varchar(255) NOT NULL,
  `aEmpID` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of accountstbl
-- ----------------------------
INSERT INTO `accountstbl` VALUES ('1', 'CS', '79102cbc65aff576af4ffbb317eaa33c9982b1991612594c98f9de91815d82125256a49b206d0cc072e71803727e4781826b6c217e1443e2e176b2860aad3dee', 'd4a9df7575ff5052ea2494e3b536e8435f1b99ee98c6adeef1c68bfe6912f7bfea52a87cea1d9b7bd4628aa4cc26395723984a9d03833891f0dcc756ca7d6075', '123651');
INSERT INTO `accountstbl` VALUES ('2', 'admin', '79102cbc65aff576af4ffbb317eaa33c9982b1991612594c98f9de91815d82125256a49b206d0cc072e71803727e4781826b6c217e1443e2e176b2860aad3dee', 'd4a9df7575ff5052ea2494e3b536e8435f1b99ee98c6adeef1c68bfe6912f7bfea52a87cea1d9b7bd4628aa4cc26395723984a9d03833891f0dcc756ca7d6075', '123656');
INSERT INTO `accountstbl` VALUES ('3', 'am', '79102cbc65aff576af4ffbb317eaa33c9982b1991612594c98f9de91815d82125256a49b206d0cc072e71803727e4781826b6c217e1443e2e176b2860aad3dee', 'd4a9df7575ff5052ea2494e3b536e8435f1b99ee98c6adeef1c68bfe6912f7bfea52a87cea1d9b7bd4628aa4cc26395723984a9d03833891f0dcc756ca7d6075', '123655');

-- ----------------------------
-- Table structure for `branchtbl`
-- ----------------------------
DROP TABLE IF EXISTS `branchtbl`;
CREATE TABLE `branchtbl` (
  `BranchID` int(11) NOT NULL AUTO_INCREMENT,
  `BranchCode` varchar(255) NOT NULL,
  `BranchName` varchar(255) NOT NULL,
  `Brand` varchar(255) NOT NULL,
  `Area` varchar(255) NOT NULL,
  `BranchType` varchar(255) NOT NULL,
  PRIMARY KEY (`BranchID`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of branchtbl
-- ----------------------------
INSERT INTO `branchtbl` VALUES ('22', 'B108', 'CH SM Cubao', 'Cherry Mobile', 'NCR-Central', 'Inline');
INSERT INTO `branchtbl` VALUES ('23', 'B205', 'MP San Fernando', 'My Phone', 'NCR-Central', 'Inline');

-- ----------------------------
-- Table structure for `employeetbl`
-- ----------------------------
DROP TABLE IF EXISTS `employeetbl`;
CREATE TABLE `employeetbl` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `EmpID` varchar(255) NOT NULL,
  `Firstname` varchar(255) NOT NULL,
  `Middlename` varchar(255) NOT NULL,
  `Lastname` varchar(255) NOT NULL,
  `Initials` varchar(255) NOT NULL,
  `Position` varchar(255) NOT NULL,
  `Picture` varchar(255) NOT NULL,
  `Branch` varchar(255) NOT NULL,
  `Area` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of employeetbl
-- ----------------------------
INSERT INTO `employeetbl` VALUES ('1', '123651', 'Camille', 'Reyes', 'Pajulio', 'MFC', 'Cashier', '', 'B108', 'NCR-Central');
INSERT INTO `employeetbl` VALUES ('2', '123655', 'Mark Joseph', 'Flaviano', 'Cinco', 'MFC', 'Area Manager', '', '', 'NCR-Central');
INSERT INTO `employeetbl` VALUES ('3', '123656', 'Tim Joseph', 'Lao', 'Rojas', 'TLR', 'Admin', '', 'B000', 'Regalia');

-- ----------------------------
-- Table structure for `itemstbl`
-- ----------------------------
DROP TABLE IF EXISTS `itemstbl`;
CREATE TABLE `itemstbl` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ItemCode` varchar(255) NOT NULL,
  `ModelName` varchar(255) NOT NULL,
  `ItemDescription` varchar(255) NOT NULL,
  `Brand` varchar(255) NOT NULL,
  `Color` varchar(255) NOT NULL,
  `Category` varchar(255) NOT NULL,
  `ItemType` varchar(255) NOT NULL,
  `SRP` int(255) NOT NULL,
  `DP` int(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of itemstbl
-- ----------------------------
INSERT INTO `itemstbl` VALUES ('1', 'B0133', 'Flare S3', 'Flare S3', 'Cherry Mobile', 'Black', 'Android', 'Unit', '2999', '2500');
INSERT INTO `itemstbl` VALUES ('2', 'B0134', 'Flare S4', 'Flare S4', 'Cherry Mobile', 'Blue', 'Android', 'Unit', '3999', '3500');
INSERT INTO `itemstbl` VALUES ('3', 'B0135', 'T2 DTV', 'T2 DTV', 'Myphone ', 'Black', 'Tablet', 'Unit', '2999', '2500');
INSERT INTO `itemstbl` VALUES ('4', 'B0136', 'F1s', 'F1s', 'Oppo', 'Rose Gold', 'Android', 'Unit', '12990', '12500');

-- ----------------------------
-- Table structure for `purchaserequestsitemstbl`
-- ----------------------------
DROP TABLE IF EXISTS `purchaserequestsitemstbl`;
CREATE TABLE `purchaserequestsitemstbl` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `PONumber` varchar(255) NOT NULL,
  `ItemCode` varchar(255) NOT NULL,
  `Qty` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=70 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of purchaserequestsitemstbl
-- ----------------------------
INSERT INTO `purchaserequestsitemstbl` VALUES ('65', 'PO-B108-0916001', 'B0134', '100');
INSERT INTO `purchaserequestsitemstbl` VALUES ('66', 'PO-B108-0916002', 'B0134', '200');
INSERT INTO `purchaserequestsitemstbl` VALUES ('67', 'PO-B108-0916001', 'B0134', '100');
INSERT INTO `purchaserequestsitemstbl` VALUES ('68', 'PO-B108-0916001', 'B0135', '200');
INSERT INTO `purchaserequestsitemstbl` VALUES ('69', 'PO-B108-0916002', 'B0133', '100');

-- ----------------------------
-- Table structure for `purchaserequeststbl`
-- ----------------------------
DROP TABLE IF EXISTS `purchaserequeststbl`;
CREATE TABLE `purchaserequeststbl` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `PONumber` varchar(255) NOT NULL,
  `_Date` varchar(255) NOT NULL,
  `Branch` varchar(255) NOT NULL,
  `Status` varchar(255) NOT NULL,
  `Remarks` varchar(255) NOT NULL,
  `EmpID` varchar(255) NOT NULL,
  `isDeleted` varchar(255) NOT NULL,
  `isAMApproved` tinyint(4) NOT NULL,
  `isHOApproved` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=66 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of purchaserequeststbl
-- ----------------------------
INSERT INTO `purchaserequeststbl` VALUES ('64', 'PO-B108-0916001', '2016-09-23', 'B108', 'Pending', 'Waiting for Approval from Area Manager', '123651', '0', '0', '0');
INSERT INTO `purchaserequeststbl` VALUES ('65', 'PO-B108-0916002', '2016-09-23', 'B108', 'Pending', 'Waiting for Approval from Area Manager', '123655', '0', '0', '0');

-- ----------------------------
-- Table structure for `salesclerktbl`
-- ----------------------------
DROP TABLE IF EXISTS `salesclerktbl`;
CREATE TABLE `salesclerktbl` (
  `ClerkID` int(11) NOT NULL AUTO_INCREMENT,
  `EmployeeID` varchar(255) DEFAULT NULL,
  `EmployeeName` varchar(255) DEFAULT NULL,
  `Initial` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`ClerkID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of salesclerktbl
-- ----------------------------
INSERT INTO `salesclerktbl` VALUES ('1', 'qweq', 'eqwe', 'qeq');
INSERT INTO `salesclerktbl` VALUES ('2', 'asad', 'asfa', 'fasaf');
INSERT INTO `salesclerktbl` VALUES ('3', 'asfasd', 'adsasd', 'asdasfas');
