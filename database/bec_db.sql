/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50616
Source Host           : localhost:3306
Source Database       : bec_db

Target Server Type    : MYSQL
Target Server Version : 50616
File Encoding         : 65001

Date: 2016-10-05 09:49:44
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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of accountstbl
-- ----------------------------
INSERT INTO `accountstbl` VALUES ('1', 'csb108', '2ff5cf367a6c6604953a946903ea1ad683c81f9fd3fe89d1743b85565f7ae475259393977375134900f76891b85ec3b77897ecc7911965578a1b7094c8a96068', 'f34891db0469dd4aa7d5a2e302b839f2cb7a83daea011b1e854a1ed496c0e6312a26aaa4327c360e3abff0028efb477592a1bd1c7f292941b7da66ba25c0f445', '123651');
INSERT INTO `accountstbl` VALUES ('2', 'admin', '2ff5cf367a6c6604953a946903ea1ad683c81f9fd3fe89d1743b85565f7ae475259393977375134900f76891b85ec3b77897ecc7911965578a1b7094c8a96068', 'f34891db0469dd4aa7d5a2e302b839f2cb7a83daea011b1e854a1ed496c0e6312a26aaa4327c360e3abff0028efb477592a1bd1c7f292941b7da66ba25c0f445', '123656');
INSERT INTO `accountstbl` VALUES ('3', 'am', '2ff5cf367a6c6604953a946903ea1ad683c81f9fd3fe89d1743b85565f7ae475259393977375134900f76891b85ec3b77897ecc7911965578a1b7094c8a96068', 'f34891db0469dd4aa7d5a2e302b839f2cb7a83daea011b1e854a1ed496c0e6312a26aaa4327c360e3abff0028efb477592a1bd1c7f292941b7da66ba25c0f445', '123655');
INSERT INTO `accountstbl` VALUES ('4', 'cs', '2ff5cf367a6c6604953a946903ea1ad683c81f9fd3fe89d1743b85565f7ae475259393977375134900f76891b85ec3b77897ecc7911965578a1b7094c8a96068', 'f34891db0469dd4aa7d5a2e302b839f2cb7a83daea011b1e854a1ed496c0e6312a26aaa4327c360e3abff0028efb477592a1bd1c7f292941b7da66ba25c0f445', '1111');

-- ----------------------------
-- Table structure for `areatbl`
-- ----------------------------
DROP TABLE IF EXISTS `areatbl`;
CREATE TABLE `areatbl` (
  `_count` int(6) NOT NULL AUTO_INCREMENT,
  `AreaID` varchar(6) NOT NULL,
  `Area` varchar(20) NOT NULL,
  PRIMARY KEY (`_count`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of areatbl
-- ----------------------------
INSERT INTO `areatbl` VALUES ('1', 'AR-001', 'Central Luzon');
INSERT INTO `areatbl` VALUES ('2', 'AR-002', 'NCR Central');
INSERT INTO `areatbl` VALUES ('3', 'AR-003', 'NCR Mandaluyong');
INSERT INTO `areatbl` VALUES ('4', 'AR-004', 'NCR North');
INSERT INTO `areatbl` VALUES ('5', 'AR-005', 'NCR South');
INSERT INTO `areatbl` VALUES ('6', 'AR-006', 'Cebu');
INSERT INTO `areatbl` VALUES ('7', 'AR-007', 'Baguio');

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
) ENGINE=InnoDB AUTO_INCREMENT=89 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of branchtbl
-- ----------------------------
INSERT INTO `branchtbl` VALUES ('86', 'BH-001', 'B107', 'CHERRY MOBILE NORTH EDSA', 'BR-001', 'AR-004');
INSERT INTO `branchtbl` VALUES ('87', 'BH-002', 'B108', 'CHERRY MOBILE MEGAMALL', 'BR-001', 'AR-002');
INSERT INTO `branchtbl` VALUES ('88', 'BH-003', 'B207', 'MYPHONE NORTH EDSA', 'BR-002', 'AR-004');

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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of brandtbl
-- ----------------------------
INSERT INTO `brandtbl` VALUES ('1', 'BR-001', '01', 'Cherry Mobile');
INSERT INTO `brandtbl` VALUES ('2', 'BR-002', '02', 'MyPhone');
INSERT INTO `brandtbl` VALUES ('3', 'BR-003', '03', 'Oppo');
INSERT INTO `brandtbl` VALUES ('4', 'BR-004', '04', 'Huawei');

-- ----------------------------
-- Table structure for `categorytbl`
-- ----------------------------
DROP TABLE IF EXISTS `categorytbl`;
CREATE TABLE `categorytbl` (
  `_count` int(6) NOT NULL AUTO_INCREMENT,
  `CategoryCode` varchar(6) NOT NULL,
  `Catergory` varchar(20) NOT NULL,
  PRIMARY KEY (`_count`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of categorytbl
-- ----------------------------
INSERT INTO `categorytbl` VALUES ('1', '1', 'Unit');
INSERT INTO `categorytbl` VALUES ('2', '2', 'CLS');
INSERT INTO `categorytbl` VALUES ('3', '3', 'Acc');
INSERT INTO `categorytbl` VALUES ('4', '4', 'MD');

-- ----------------------------
-- Table structure for `colortbl`
-- ----------------------------
DROP TABLE IF EXISTS `colortbl`;
CREATE TABLE `colortbl` (
  `_count` int(255) NOT NULL AUTO_INCREMENT,
  `ColorID` varchar(6) DEFAULT NULL,
  `Color` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`_count`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of colortbl
-- ----------------------------
INSERT INTO `colortbl` VALUES ('1', 'CR-001', 'White');
INSERT INTO `colortbl` VALUES ('2', 'CR-002', 'Black');
INSERT INTO `colortbl` VALUES ('3', 'CR-003', 'Red');
INSERT INTO `colortbl` VALUES ('4', 'CR-004', 'RoseGold');
INSERT INTO `colortbl` VALUES ('5', 'CR-005', 'RoseSilver');

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
  PRIMARY KEY (`_count`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of employeetbl
-- ----------------------------
INSERT INTO `employeetbl` VALUES ('1', '123651', 'Mark Joseph', 'Flaviano', 'Cinco', 'MFC', 'Cashier', '', 'BH-001', 'AR-004');
INSERT INTO `employeetbl` VALUES ('2', '123655', 'Mark Joseph', 'Flaviano', 'Cinco', 'MFC', 'Area Manager', '', '', 'AR-004');
INSERT INTO `employeetbl` VALUES ('3', '123656', 'Tim Joseph', 'Lao', 'Rojas', 'TLR', 'Admin', '', 'BH-003', 'AR-003');
INSERT INTO `employeetbl` VALUES ('4', '1111', 'Camille', 'reyes', 'pajulio', 'crp', 'Cashier', '', 'BH-001', 'AR-004');

-- ----------------------------
-- Table structure for `itemstbl`
-- ----------------------------
DROP TABLE IF EXISTS `itemstbl`;
CREATE TABLE `itemstbl` (
  `_count` int(6) NOT NULL AUTO_INCREMENT,
  `ItemCode` varchar(11) NOT NULL,
  `ModelName` varchar(20) NOT NULL,
  `ItemDescription` varchar(100) NOT NULL,
  `BrandID` varchar(15) NOT NULL,
  `Category` varchar(15) NOT NULL,
  `SRP` int(7) NOT NULL,
  `DP` int(7) NOT NULL,
  PRIMARY KEY (`_count`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of itemstbl
-- ----------------------------
INSERT INTO `itemstbl` VALUES ('1', 'B0133', 'Flare S3', 'Flare S3', 'BR-001', 'Unit', '2999', '2500');
INSERT INTO `itemstbl` VALUES ('2', 'B0134', 'Flare S4', 'Flare S4', 'BR-001', 'Unit', '3999', '3500');
INSERT INTO `itemstbl` VALUES ('3', 'B0135', 'T2 DTV', 'T2 DTV', 'BR-002', 'Unit', '2999', '2500');
INSERT INTO `itemstbl` VALUES ('4', 'B0136', 'F1s', 'F1s', 'BR-003', 'Unit', '12990', '12500');
INSERT INTO `itemstbl` VALUES ('5', 'B0137', 'Revel', 'Revel', 'BR-001', 'Unit', '1999', '1500');
INSERT INTO `itemstbl` VALUES ('6', 'B0138', 'Zoom', 'Zoom', 'BR-001', 'Unit', '4999', '4500');
INSERT INTO `itemstbl` VALUES ('7', 'B0139', 'Selfie', 'Selfie', 'BR-001', 'Unit', '5999', '5500');
INSERT INTO `itemstbl` VALUES ('8', 'B0140', 'M1', 'M1', 'BR-001', 'Unit', '11999', '11500');
INSERT INTO `itemstbl` VALUES ('9', 'B0141', 'Spin 2', 'Spin 2', 'BR-001', 'Unit', '1699', '1400');
INSERT INTO `itemstbl` VALUES ('10', 'B0142', 'Flare HD 2', 'Flare HD 2', 'BR-001', 'Unit', '4999', '4500');
INSERT INTO `itemstbl` VALUES ('11', 'B0143', 'Maia Fone i4', 'Maia Fone i4', 'BR-001', 'Unit', '1499', '1000');
INSERT INTO `itemstbl` VALUES ('12', 'B0144', 'Aura 2', 'Aura 2', 'BR-001', 'Unit', '1999', '1500');
INSERT INTO `itemstbl` VALUES ('13', 'B0145', 'Radar LTE', 'Radar LTE', 'BR-001', 'Unit', '4999', '4500');

-- ----------------------------
-- Table structure for `purchaserequestsitemstbl`
-- ----------------------------
DROP TABLE IF EXISTS `purchaserequestsitemstbl`;
CREATE TABLE `purchaserequestsitemstbl` (
  `_count` int(6) NOT NULL AUTO_INCREMENT,
  `PONumber` varchar(15) NOT NULL,
  `ItemCode` varchar(11) NOT NULL,
  `Qty` int(11) NOT NULL,
  `DateModified` varchar(15) NOT NULL,
  `ModifyCode` varchar(10) NOT NULL,
  PRIMARY KEY (`_count`)
) ENGINE=InnoDB AUTO_INCREMENT=241 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of purchaserequestsitemstbl
-- ----------------------------
INSERT INTO `purchaserequestsitemstbl` VALUES ('214', 'PR-B107-1016001', 'B0137', '3', '2016-10-04', '1110693305');
INSERT INTO `purchaserequestsitemstbl` VALUES ('215', 'PR-B107-1016001', 'B0137', '3', '2016-10-04', '1146366652');
INSERT INTO `purchaserequestsitemstbl` VALUES ('216', 'PR-B107-1016001', 'B0137', '6', '2016-10-04', '1277570553');
INSERT INTO `purchaserequestsitemstbl` VALUES ('217', 'PR-B107-1016001', 'B0137', '9', '2016-10-04', '575119756');
INSERT INTO `purchaserequestsitemstbl` VALUES ('218', 'PR-B107-1016001', 'B0137', '9', '2016-10-04', '184950595');
INSERT INTO `purchaserequestsitemstbl` VALUES ('219', 'PR-B107-1016001', 'B0134', '3', '2016-10-04', '184950595');
INSERT INTO `purchaserequestsitemstbl` VALUES ('220', 'PR-B107-1016001', 'B0134', '3', '2016-10-04', '1082120203');
INSERT INTO `purchaserequestsitemstbl` VALUES ('221', 'PR-B107-1016001', 'B0134', '3', '2016-10-05', '1380803796');
INSERT INTO `purchaserequestsitemstbl` VALUES ('222', 'PR-B107-1016001', 'B0142', '10', '2016-10-05', '1380803796');
INSERT INTO `purchaserequestsitemstbl` VALUES ('223', 'PR-B107-1016001', 'B0142', '10', '2016-10-05', '1274816519');
INSERT INTO `purchaserequestsitemstbl` VALUES ('224', 'PR-B107-1016001', 'B0142', '14', '2016-10-05', '1113232180');
INSERT INTO `purchaserequestsitemstbl` VALUES ('225', 'PR-B107-1016002', 'B0134', '3', '2016-10-05', '699008254');
INSERT INTO `purchaserequestsitemstbl` VALUES ('226', 'PR-B107-1016002', 'B0134', '10', '2016-10-05', '1043133409');
INSERT INTO `purchaserequestsitemstbl` VALUES ('227', 'PR-B207-1016001', 'B0135', '4', '', '');
INSERT INTO `purchaserequestsitemstbl` VALUES ('228', 'PR-B107-1016003', 'B0141', '9', '2016-10-05', '1229245863');
INSERT INTO `purchaserequestsitemstbl` VALUES ('229', 'PR-B207-1016001', 'B0135', '7', '2016-10-05', '1225459066');
INSERT INTO `purchaserequestsitemstbl` VALUES ('230', 'PR-B107-1016003', 'B0141', '13', '2016-10-05', '1251665421');
INSERT INTO `purchaserequestsitemstbl` VALUES ('231', 'PR-B107-1016003', 'B0141', '10', '2016-10-05', '32187772');
INSERT INTO `purchaserequestsitemstbl` VALUES ('232', 'PR-B207-1016001', 'B0135', '1', '2016-10-05', '955176448');
INSERT INTO `purchaserequestsitemstbl` VALUES ('233', 'PR-B107-1016003', 'B0141', '9', '2016-10-05', '1135651738');
INSERT INTO `purchaserequestsitemstbl` VALUES ('234', 'PR-B107-1016004', 'B0137', '9', '2016-10-05', '138949621');
INSERT INTO `purchaserequestsitemstbl` VALUES ('235', 'PR-B107-1016005', 'B0142', '13', '2016-10-05', '1113404308');
INSERT INTO `purchaserequestsitemstbl` VALUES ('236', 'PR-B107-1016006', 'B0137', '1', '2016-10-05', '1292846835');
INSERT INTO `purchaserequestsitemstbl` VALUES ('237', 'PR-B107-1016007', 'B0133', '7', '2016-10-05', '216320764');
INSERT INTO `purchaserequestsitemstbl` VALUES ('238', 'PR-B107-1016008', 'B0134', '3', '2016-10-05', '601756429');
INSERT INTO `purchaserequestsitemstbl` VALUES ('239', 'PR-B107-1016009', 'B0138', '2', '2016-10-05', '710282581');
INSERT INTO `purchaserequestsitemstbl` VALUES ('240', 'PR-B107-1016010', 'B0137', '8', '2016-10-05', '618926109');

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
  PRIMARY KEY (`_count`)
) ENGINE=InnoDB AUTO_INCREMENT=197 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of purchaserequeststbl
-- ----------------------------
INSERT INTO `purchaserequeststbl` VALUES ('182', 'PR-B107-1016001', '2016-10-04', 'B107', 'BR-001', 'Rejected', '', '123651', '0', '', '2', '0', '', '', '', '123651', '12:35 AM', '2016-10-05', '1113232180');
INSERT INTO `purchaserequeststbl` VALUES ('183', 'PR-B107-1016002', '2016-10-05', 'B107', 'BR-001', 'Cancelled', 'Cancelled', '123651', '0', '123655', '2', '0', '', '', '', '123651', '01:35 AM', '2016-10-05', '1043133409');
INSERT INTO `purchaserequeststbl` VALUES ('184', 'PR-B207-1016001', '2016-10-05', 'B207', 'BR-002', 'Pending', 'Waiting for Approval from Brand Coordinator', '123655', '0', '', '1', '0', '123655', '', '', '123655', '02:20 AM', '2016-10-05', '955176448');
INSERT INTO `purchaserequeststbl` VALUES ('185', 'PR-B107-1016003', '2016-10-05', 'B107', 'BR-001', 'Cancelled', 'Cancelled', '123651', '1', '123651', '0', '0', '', '', '', '123651', '02:21 AM', '2016-10-05', '1135651738');
INSERT INTO `purchaserequeststbl` VALUES ('186', 'PR-B107-1016004', '2016-10-05', 'B107', 'BR-001', 'Cancelled', 'Cancelled', '123651', '1', '123651', '0', '0', '', '', '', '123651', '02:39 AM', '2016-10-05', '138949621');
INSERT INTO `purchaserequeststbl` VALUES ('187', 'PR-B107-1016005', '2016-10-05', 'B107', 'BR-001', 'Cancelled', 'Cancelled', '123651', '1', '123651', '0', '0', '', '', '', '123651', '02:39 AM', '2016-10-05', '1113404308');
INSERT INTO `purchaserequeststbl` VALUES ('188', 'PR-B107-1016006', '2016-10-05', 'B107', 'BR-001', 'Pending', 'Waiting for Approval from Area Manager', '123651', '0', '', '0', '0', '', '', '', '123651', '03:20 AM', '2016-10-05', '1292846835');
INSERT INTO `purchaserequeststbl` VALUES ('189', 'PR-B107-1016007', '2016-10-05', 'B107', 'BR-001', 'Cancelled', 'Cancelled', '123651', '1', '123651', '0', '0', '', '', '', '123651', '03:55 AM', '2016-10-05', '216320764');
INSERT INTO `purchaserequeststbl` VALUES ('190', 'PR-B107-1016008', '2016-10-05', 'B107', 'BR-001', 'Cancelled', 'Cancelled', '123651', '1', '123651', '0', '0', '', '', '', '123651', '03:56 AM', '2016-10-05', '601756429');
INSERT INTO `purchaserequeststbl` VALUES ('195', 'PR-B107-1016009', '2016-10-05', 'B107', 'BR-001', 'Cancelled', 'Cancelled', '123651', '1', '123651', '0', '0', '', '', '', '123651', '04:01 AM', '2016-10-05', '710282581');
INSERT INTO `purchaserequeststbl` VALUES ('196', 'PR-B107-1016010', '2016-10-05', 'B107', 'BR-001', 'Pending', 'Waiting for Approval from Area Manager', '123651', '0', '', '0', '0', '', '', '', '123651', '09:07 AM', '2016-10-05', '618926109');
