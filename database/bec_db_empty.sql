/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50616
Source Host           : localhost:3306
Source Database       : bec_db

Target Server Type    : MYSQL
Target Server Version : 50616
File Encoding         : 65001

Date: 2016-10-23 21:34:42
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `accountstbl`
-- ----------------------------
DROP TABLE IF EXISTS `accountstbl`;
CREATE TABLE `accountstbl` (
  `_count` int(11) NOT NULL AUTO_INCREMENT,
  `aUsername` varchar(20) NOT NULL,
  `aPassword` varchar(255) NOT NULL,
  `aSaltedPassword` varchar(255) NOT NULL,
  `aEmpID` varchar(11) NOT NULL,
  PRIMARY KEY (`_count`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of accountstbl
-- ----------------------------
INSERT INTO `accountstbl` VALUES ('2', 'markjoseph1496', '2ff5cf367a6c6604953a946903ea1ad683c81f9fd3fe89d1743b85565f7ae475259393977375134900f76891b85ec3b77897ecc7911965578a1b7094c8a96068', 'f34891db0469dd4aa7d5a2e302b839f2cb7a83daea011b1e854a1ed496c0e6312a26aaa4327c360e3abff0028efb477592a1bd1c7f292941b7da66ba25c0f445', '1-0086-MFC');

-- ----------------------------
-- Table structure for `areatbl`
-- ----------------------------
DROP TABLE IF EXISTS `areatbl`;
CREATE TABLE `areatbl` (
  `_count` int(6) NOT NULL AUTO_INCREMENT,
  `AreaID` varchar(6) NOT NULL,
  `Area` varchar(20) NOT NULL,
  PRIMARY KEY (`_count`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of areatbl
-- ----------------------------

-- ----------------------------
-- Table structure for `branchtbl`
-- ----------------------------
DROP TABLE IF EXISTS `branchtbl`;
CREATE TABLE `branchtbl` (
  `_count` int(6) NOT NULL AUTO_INCREMENT,
  `BranchID` varchar(6) NOT NULL,
  `BranchCode` varchar(5) NOT NULL,
  `BranchName` varchar(30) NOT NULL,
  `BrandID` varchar(6) NOT NULL,
  `AreaID` varchar(6) NOT NULL,
  PRIMARY KEY (`_count`)
) ENGINE=InnoDB AUTO_INCREMENT=94 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of branchtbl
-- ----------------------------

-- ----------------------------
-- Table structure for `brandtbl`
-- ----------------------------
DROP TABLE IF EXISTS `brandtbl`;
CREATE TABLE `brandtbl` (
  `_count` int(6) NOT NULL AUTO_INCREMENT,
  `BrandID` varchar(6) NOT NULL,
  `BrandCode` varchar(6) NOT NULL,
  `Brand` varchar(20) NOT NULL,
  PRIMARY KEY (`_count`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of brandtbl
-- ----------------------------

-- ----------------------------
-- Table structure for `cashtransactiontbl`
-- ----------------------------
DROP TABLE IF EXISTS `cashtransactiontbl`;
CREATE TABLE `cashtransactiontbl` (
  `_count` int(11) NOT NULL AUTO_INCREMENT,
  `TransactionID` varchar(20) NOT NULL,
  `ORNumber` varchar(20) NOT NULL,
  `Amount` int(7) NOT NULL,
  PRIMARY KEY (`_count`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of cashtransactiontbl
-- ----------------------------

-- ----------------------------
-- Table structure for `categorytbl`
-- ----------------------------
DROP TABLE IF EXISTS `categorytbl`;
CREATE TABLE `categorytbl` (
  `_count` int(6) NOT NULL AUTO_INCREMENT,
  `CategoryID` varchar(10) DEFAULT NULL,
  `CategoryCode` varchar(6) NOT NULL,
  `Category` varchar(20) NOT NULL,
  PRIMARY KEY (`_count`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of categorytbl
-- ----------------------------

-- ----------------------------
-- Table structure for `colortbl`
-- ----------------------------
DROP TABLE IF EXISTS `colortbl`;
CREATE TABLE `colortbl` (
  `_count` int(255) NOT NULL AUTO_INCREMENT,
  `ColorID` varchar(6) DEFAULT NULL,
  `Color` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`_count`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of colortbl
-- ----------------------------

-- ----------------------------
-- Table structure for `credittransactiontbl`
-- ----------------------------
DROP TABLE IF EXISTS `credittransactiontbl`;
CREATE TABLE `credittransactiontbl` (
  `_count` int(11) NOT NULL AUTO_INCREMENT,
  `TransactionID` varchar(20) NOT NULL,
  `ORNumber` varchar(20) NOT NULL,
  `CreditCardNumber` varchar(25) NOT NULL,
  `CardHolderName` varchar(30) NOT NULL,
  `MID` varchar(30) NOT NULL,
  `BatchNum` varchar(20) NOT NULL,
  `ApprCode` varchar(20) NOT NULL,
  `Term` varchar(20) NOT NULL,
  `IDPresented` varchar(40) NOT NULL,
  `Amount` int(11) NOT NULL,
  PRIMARY KEY (`_count`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of credittransactiontbl
-- ----------------------------

-- ----------------------------
-- Table structure for `employeetbl`
-- ----------------------------
DROP TABLE IF EXISTS `employeetbl`;
CREATE TABLE `employeetbl` (
  `_count` int(11) NOT NULL AUTO_INCREMENT,
  `EmpID` varchar(255) NOT NULL,
  `Firstname` varchar(255) NOT NULL,
  `Middlename` varchar(255) NOT NULL,
  `Lastname` varchar(255) NOT NULL,
  `Initials` varchar(255) NOT NULL,
  `Position` varchar(255) NOT NULL,
  `Picture` varchar(255) NOT NULL,
  `BranchID` varchar(255) NOT NULL,
  `AreaID` varchar(255) NOT NULL,
  `BrandID` varchar(255) NOT NULL,
  PRIMARY KEY (`_count`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of employeetbl
-- ----------------------------
INSERT INTO `employeetbl` VALUES ('3', '1-0086-MFC', 'Mark Joseph', 'Flaviano', 'CInco', 'MFC', 'Admin', '', '', '', '');

-- ----------------------------
-- Table structure for `homecredittransactiontbl`
-- ----------------------------
DROP TABLE IF EXISTS `homecredittransactiontbl`;
CREATE TABLE `homecredittransactiontbl` (
  `_count` int(11) NOT NULL AUTO_INCREMENT,
  `TransactionID` varchar(20) NOT NULL,
  `ORNumber` varchar(255) NOT NULL,
  `ReferenceNo` varchar(30) NOT NULL,
  `Amount` int(7) NOT NULL,
  PRIMARY KEY (`_count`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of homecredittransactiontbl
-- ----------------------------

-- ----------------------------
-- Table structure for `invtbl`
-- ----------------------------
DROP TABLE IF EXISTS `invtbl`;
CREATE TABLE `invtbl` (
  `_count` int(11) NOT NULL AUTO_INCREMENT,
  `ItemCode` varchar(11) NOT NULL,
  `ItemColor` varchar(15) NOT NULL,
  `imeisn` varchar(30) NOT NULL,
  `BranchCode` varchar(10) NOT NULL,
  `_DateReceived` varchar(15) NOT NULL,
  `_TimeReceived` varchar(15) NOT NULL,
  `ReceivedBy` varchar(15) NOT NULL,
  `Status` varchar(255) NOT NULL,
  `TransactionID` varchar(255) NOT NULL,
  PRIMARY KEY (`_count`)
) ENGINE=InnoDB AUTO_INCREMENT=782 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of invtbl
-- ----------------------------

-- ----------------------------
-- Table structure for `itemstbl`
-- ----------------------------
DROP TABLE IF EXISTS `itemstbl`;
CREATE TABLE `itemstbl` (
  `_count` int(6) NOT NULL AUTO_INCREMENT,
  `CategoryCode` varchar(6) NOT NULL,
  `BrandCode` varchar(6) NOT NULL,
  `ItemCode` varchar(11) NOT NULL,
  `ModelName` varchar(20) NOT NULL,
  `ItemDescription` varchar(100) NOT NULL,
  `BrandID` varchar(15) NOT NULL,
  `Category` varchar(15) NOT NULL,
  `SRP` int(7) NOT NULL,
  `DP` int(7) NOT NULL,
  `CriticalLevel` int(7) NOT NULL,
  PRIMARY KEY (`_count`)
) ENGINE=InnoDB AUTO_INCREMENT=59 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of itemstbl
-- ----------------------------
INSERT INTO `itemstbl` VALUES ('35', '1', '01', '101001', 'Flare S3', 'FLARE S3', 'BR-001', 'Unit', '12000', '11500', '20');
INSERT INTO `itemstbl` VALUES ('36', '1', '01', '101002', 'Flare S4', 'Flare S4', 'BR-001', 'Unit', '13000', '12500', '20');
INSERT INTO `itemstbl` VALUES ('37', '1', '02', '102001', 'T2 DTV', 'T2 DTV', 'BR-002', 'Unit', '3000', '2500', '20');
INSERT INTO `itemstbl` VALUES ('39', '1', '01', '101003', 'Revel', 'Revel', 'BR-001', 'Unit', '5000', '4500', '20');
INSERT INTO `itemstbl` VALUES ('40', '1', '01', '101004', 'Zoom', 'Zoom', 'BR-001', 'Unit', '6000', '5500', '20');
INSERT INTO `itemstbl` VALUES ('41', '1', '01', '101005', 'Selfie', 'Selfie', 'BR-001', 'Unit', '7000', '6500', '20');
INSERT INTO `itemstbl` VALUES ('42', '1', '01', '101006', 'M1', 'M1', 'BR-001', 'Unit', '4000', '3500', '20');
INSERT INTO `itemstbl` VALUES ('43', '1', '01', '101007', 'Spin 2', 'Spin 2', 'BR-001', 'Unit', '6500', '6000', '20');
INSERT INTO `itemstbl` VALUES ('44', '1', '01', '101008', 'Flare HD 2', 'Flare HD 2', 'BR-001', 'Unit', '11000', '10500', '20');
INSERT INTO `itemstbl` VALUES ('45', '1', '01', '101009', 'Maia Fone I4', 'Maia Fone I4', 'BR-001', 'Unit', '7000', '6500', '20');
INSERT INTO `itemstbl` VALUES ('46', '1', '01', '101010', 'Aura 2', 'AURA 2', 'BR-001', 'Unit', '7000', '6500', '20');
INSERT INTO `itemstbl` VALUES ('47', '1', '01', '101011', 'Radar LTE', 'Radar LTE', 'BR-001', 'Unit', '9000', '8500', '20');
INSERT INTO `itemstbl` VALUES ('48', '1', '01', '101012', 'Flare J1', 'Flare J1', 'BR-001', 'Unit', '3999', '3499', '20');
INSERT INTO `itemstbl` VALUES ('49', '1', '01', '101013', 'Flare S4 Plus', 'Flare S4 Plus', 'BR-001', 'Unit', '5999', '5499', '20');
INSERT INTO `itemstbl` VALUES ('50', '1', '01', '101014', 'Flare J2', 'Flare J2', 'BR-001', 'Unit', '3000', '2500', '20');
INSERT INTO `itemstbl` VALUES ('51', '1', '01', '101015', 'Flare XL Plus', 'Flare XL Plus', 'BR-001', 'Unit', '3900', '3400', '20');
INSERT INTO `itemstbl` VALUES ('52', '1', '01', '101016', 'Flare S3 Octa', 'Flare S3 Octa', 'BR-001', 'Unit', '3999', '3499', '20');
INSERT INTO `itemstbl` VALUES ('53', '1', '02', '102002', 'My28s', 'My28s', 'BR-002', 'Unit', '988', '488', '20');
INSERT INTO `itemstbl` VALUES ('54', '1', '02', '102003', 'My33', 'My33', 'BR-002', 'Unit', '3999', '3499', '20');
INSERT INTO `itemstbl` VALUES ('55', '1', '02', '102004', 'My32', 'My32', 'BR-002', 'Unit', '3499', '2999', '20');
INSERT INTO `itemstbl` VALUES ('56', '1', '02', '102005', 'My36', 'My36', 'BR-002', 'Unit', '6499', '5999', '20');
INSERT INTO `itemstbl` VALUES ('57', '1', '03', '103001', 'F1', 'F1', 'BR-003', 'Unit', '93000', '8800', '20');
INSERT INTO `itemstbl` VALUES ('58', '1', '03', '103002', 'F1 Plus', 'F1 Plus', 'BR-003', 'Unit', '14999', '14499', '20');

-- ----------------------------
-- Table structure for `purchaserequestsitemstbl`
-- ----------------------------
DROP TABLE IF EXISTS `purchaserequestsitemstbl`;
CREATE TABLE `purchaserequestsitemstbl` (
  `_count` int(6) NOT NULL AUTO_INCREMENT,
  `PONumber` varchar(15) NOT NULL,
  `ItemCode` varchar(11) NOT NULL,
  `Qty` int(11) NOT NULL,
  `Color` varchar(20) NOT NULL,
  `DateModified` varchar(15) NOT NULL,
  `ModifyCode` varchar(10) NOT NULL,
  `Remarks` varchar(255) NOT NULL,
  `Received` int(11) NOT NULL,
  PRIMARY KEY (`_count`)
) ENGINE=InnoDB AUTO_INCREMENT=394 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of purchaserequestsitemstbl
-- ----------------------------

-- ----------------------------
-- Table structure for `purchaserequeststbl`
-- ----------------------------
DROP TABLE IF EXISTS `purchaserequeststbl`;
CREATE TABLE `purchaserequeststbl` (
  `_count` int(6) NOT NULL AUTO_INCREMENT,
  `PONumber` varchar(15) NOT NULL,
  `_Date` varchar(10) NOT NULL,
  `BranchCode` varchar(6) NOT NULL,
  `BrandID` varchar(8) NOT NULL,
  `Status` varchar(15) NOT NULL,
  `Remarks` varchar(200) NOT NULL,
  `EmpID` varchar(11) NOT NULL,
  `isDeleted` tinyint(4) NOT NULL,
  `CancelledBy` varchar(11) NOT NULL,
  `isAMApproved` tinyint(4) NOT NULL,
  `isBCApproved` tinyint(4) NOT NULL,
  `CheckedByAM` varchar(11) NOT NULL,
  `CheckedByHO` varchar(11) NOT NULL,
  `NotedBy` varchar(11) NOT NULL,
  `ModifiedBy` varchar(11) NOT NULL,
  `_Time` varchar(11) NOT NULL,
  `LastModified` varchar(11) NOT NULL,
  `ModifyCode` varchar(10) NOT NULL,
  `DateApproved` varchar(11) NOT NULL,
  `TimeApproved` varchar(11) NOT NULL,
  `DateCompleted` varchar(11) NOT NULL,
  `TimeCompleted` varchar(11) NOT NULL,
  PRIMARY KEY (`_count`)
) ENGINE=InnoDB AUTO_INCREMENT=245 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of purchaserequeststbl
-- ----------------------------

-- ----------------------------
-- Table structure for `transactiontbl`
-- ----------------------------
DROP TABLE IF EXISTS `transactiontbl`;
CREATE TABLE `transactiontbl` (
  `_count` int(11) NOT NULL AUTO_INCREMENT,
  `TransactionID` varchar(20) NOT NULL,
  `ORNumber` varchar(20) NOT NULL,
  `_Date` varchar(20) NOT NULL,
  `_Time` varchar(20) NOT NULL,
  `CustomerName` varchar(50) NOT NULL,
  `SalesClerk` varchar(20) NOT NULL,
  `Cashier` varchar(20) NOT NULL,
  `BranchCode` varchar(30) NOT NULL,
  `ModeOfPayment` varchar(30) NOT NULL,
  `Status` varchar(255) NOT NULL,
  PRIMARY KEY (`_count`)
) ENGINE=InnoDB AUTO_INCREMENT=76 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of transactiontbl
-- ----------------------------
