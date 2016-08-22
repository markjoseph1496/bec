/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50616
Source Host           : localhost:3306
Source Database       : becdb

Target Server Type    : MYSQL
Target Server Version : 50616
File Encoding         : 65001

Date: 2016-08-20 17:59:56
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `cashtransactiontbl`
-- ----------------------------
DROP TABLE IF EXISTS `cashtransactiontbl`;
CREATE TABLE `cashtransactiontbl` (
  `TransactionID` int(11) NOT NULL AUTO_INCREMENT,
  `ORNumber` varchar(255) NOT NULL,
  `CustomerName` varchar(255) NOT NULL,
  `Downpayment` int(11) NOT NULL,
  `Total` int(11) NOT NULL,
  PRIMARY KEY (`TransactionID`)
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of cashtransactiontbl
-- ----------------------------
INSERT INTO `cashtransactiontbl` VALUES ('49', '654', 'Mark Joseph', '412', '66390');

-- ----------------------------
-- Table structure for `tblbranch`
-- ----------------------------
DROP TABLE IF EXISTS `tblbranch`;
CREATE TABLE `tblbranch` (
  `brid` int(11) NOT NULL AUTO_INCREMENT,
  `BranchName` varchar(255) NOT NULL,
  `BranchCode` varchar(255) NOT NULL,
  `BranchArea` varchar(255) NOT NULL,
  `BranchType` varchar(255) NOT NULL,
  `BranchLocation` varchar(255) NOT NULL,
  PRIMARY KEY (`brid`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tblbranch
-- ----------------------------
INSERT INTO `tblbranch` VALUES ('1', 'Head Office', 'B000', 'NCR C', 'Head Office', 'Regalia');
INSERT INTO `tblbranch` VALUES ('2', 'Berlein Mobile', 'B003', 'Central Luzon', 'Concept Store', 'SM Apalit');
INSERT INTO `tblbranch` VALUES ('3', 'Berlein Mobile', 'B004', 'Central Luzon', 'Concept Store', 'SM Pampanga');
INSERT INTO `tblbranch` VALUES ('4', 'Berlein Mobile', 'B006', 'NCR E', 'Concept Store', 'SM Fairview');
INSERT INTO `tblbranch` VALUES ('5', 'Berlein Mobile', 'B009', 'NCR C', 'Concept Store', 'Ali Mall');
INSERT INTO `tblbranch` VALUES ('6', 'Berlein Mobile', 'B031', 'NCR M', 'Concept Store', 'SM Light');
INSERT INTO `tblbranch` VALUES ('8', 'Cherry Mobile', 'B119', 'NCR C', 'Concept Store', 'Ali Mall');
INSERT INTO `tblbranch` VALUES ('9', 'Cherry Mobile ', 'B131', 'NCR M', 'Concept Store', 'SM Light');
INSERT INTO `tblbranch` VALUES ('10', 'Cherry Mobile', 'B111', 'NCR S', 'Kiosk', 'SM Manila');
INSERT INTO `tblbranch` VALUES ('11', 'Cherry Mobile', 'B108', 'NCR M', 'Concept Store', 'SM Megamall');
INSERT INTO `tblbranch` VALUES ('12', 'Myphone', 'B207', 'NCR S', 'Concept Store', 'SM North');
INSERT INTO `tblbranch` VALUES ('13', 'Myphone', 'B210', 'NCR E', 'Concept Store', 'SM Masinag');
INSERT INTO `tblbranch` VALUES ('14', 'Myphone', 'B205', 'Central Luzon', 'Concept Store', 'SM San Fernando Downtown');
INSERT INTO `tblbranch` VALUES ('15', 'Cherry Mobile ', 'B115', 'Central Luzon', 'Concept Store', 'SM San Fernando Downtown');
INSERT INTO `tblbranch` VALUES ('16', 'Myphone ', 'B212', 'NCR S', 'Kiosk', 'SM Manila');

-- ----------------------------
-- Table structure for `tblemployeeinfo`
-- ----------------------------
DROP TABLE IF EXISTS `tblemployeeinfo`;
CREATE TABLE `tblemployeeinfo` (
  `EmployeeID` int(255) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `FirstName` varchar(255) NOT NULL,
  `MiddleName` varchar(255) NOT NULL,
  `LastName` varchar(255) NOT NULL,
  `Province` varchar(255) NOT NULL,
  `City` varchar(255) NOT NULL,
  `Barangay` varchar(255) NOT NULL,
  `Street` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `MobileNumber` varchar(255) NOT NULL,
  `CivilStatus` varchar(255) NOT NULL,
  `Gender` varchar(255) NOT NULL,
  `Age` varchar(255) NOT NULL,
  `Spouse` varchar(255) NOT NULL,
  `Occupation` varchar(255) NOT NULL,
  `NumOfChildren` varchar(255) NOT NULL,
  `ProvinceofSpouse` varchar(255) NOT NULL,
  `Religion` varchar(255) NOT NULL,
  `Birthdate` varchar(255) NOT NULL,
  `BirthPlace` varchar(255) NOT NULL,
  `Father` varchar(255) NOT NULL,
  `FOccupation` varchar(255) NOT NULL,
  `FAddress` varchar(255) NOT NULL,
  `FContactNumber` varchar(255) NOT NULL,
  `Mother` varchar(255) NOT NULL,
  `MAddress` varchar(255) NOT NULL,
  `MContactNumber` varchar(255) NOT NULL,
  PRIMARY KEY (`EmployeeID`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tblemployeeinfo
-- ----------------------------

-- ----------------------------
-- Table structure for `unitmodeltransaction`
-- ----------------------------
DROP TABLE IF EXISTS `unitmodeltransaction`;
CREATE TABLE `unitmodeltransaction` (
  `ModelID` int(11) NOT NULL AUTO_INCREMENT,
  `ORNumber` varchar(255) NOT NULL,
  `ModelUnit` varchar(255) NOT NULL,
  `Quantity` int(11) NOT NULL,
  `TotalPrice` int(255) NOT NULL,
  PRIMARY KEY (`ModelID`)
) ENGINE=InnoDB AUTO_INCREMENT=78 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of unitmodeltransaction
-- ----------------------------
INSERT INTO `unitmodeltransaction` VALUES ('65', '65656', 'Mirror 5', '1', '6990');
INSERT INTO `unitmodeltransaction` VALUES ('66', '28996', 'Mirror 3', '1', '5490');
INSERT INTO `unitmodeltransaction` VALUES ('67', '28996', 'Mirror 5', '2', '13980');
INSERT INTO `unitmodeltransaction` VALUES ('68', '4', 'Mirror 5', '1', '6990');
INSERT INTO `unitmodeltransaction` VALUES ('69', '4', 'Mirror 5', '1', '6990');
INSERT INTO `unitmodeltransaction` VALUES ('70', '4', 'Mirror 5', '1', '6990');
INSERT INTO `unitmodeltransaction` VALUES ('71', '4', 'Mirror 5', '1', '6990');
INSERT INTO `unitmodeltransaction` VALUES ('72', '2312', 'Mirror 3', '1', '5490');
INSERT INTO `unitmodeltransaction` VALUES ('73', '2312', 'Mirror 5', '6', '41940');
INSERT INTO `unitmodeltransaction` VALUES ('74', '2312', 'Mirror 5', '2', '13980');
INSERT INTO `unitmodeltransaction` VALUES ('75', '654', 'Mirror 3', '4', '21960');
INSERT INTO `unitmodeltransaction` VALUES ('76', '654', 'Mirror 5', '4', '27960');
INSERT INTO `unitmodeltransaction` VALUES ('77', '654', 'Mirror 3', '3', '16470');

-- ----------------------------
-- Table structure for `unitstbl`
-- ----------------------------
DROP TABLE IF EXISTS `unitstbl`;
CREATE TABLE `unitstbl` (
  `UnitID` int(11) NOT NULL AUTO_INCREMENT,
  `Model` varchar(255) NOT NULL,
  `Brand` varchar(255) NOT NULL,
  `DP` int(11) NOT NULL,
  `SRP` int(11) NOT NULL,
  PRIMARY KEY (`UnitID`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of unitstbl
-- ----------------------------
INSERT INTO `unitstbl` VALUES ('1', 'Mirror 3', 'Oppo', '0', '5490');
INSERT INTO `unitstbl` VALUES ('2', 'Mirror 5', 'Oppo', '0', '6990');
INSERT INTO `unitstbl` VALUES ('3', 'R5', 'Oppo', '0', '8990');
INSERT INTO `unitstbl` VALUES ('4', 'Joy 3', 'Oppo', '0', '3990');
INSERT INTO `unitstbl` VALUES ('5', 'Joy Plus', 'Oppo', '0', '2990');
INSERT INTO `unitstbl` VALUES ('6', 'Find 7a', 'Oppo', '0', '9990');
INSERT INTO `unitstbl` VALUES ('7', 'R1x', 'Oppo', '0', '7990');
INSERT INTO `unitstbl` VALUES ('8', 'R2001', 'Oppo', '0', '3990');
INSERT INTO `unitstbl` VALUES ('9', 'R827', 'Oppo', '0', '4490');
INSERT INTO `unitstbl` VALUES ('10', 'R831k', 'Oppo', '0', '2990');
