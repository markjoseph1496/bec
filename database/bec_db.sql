/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50616
Source Host           : localhost:3306
Source Database       : bec_db

Target Server Type    : MYSQL
Target Server Version : 50616
File Encoding         : 65001

Date: 2016-10-13 00:03:34
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
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of accountstbl
-- ----------------------------
INSERT INTO `accountstbl` VALUES ('2', 'admin', '2ff5cf367a6c6604953a946903ea1ad683c81f9fd3fe89d1743b85565f7ae475259393977375134900f76891b85ec3b77897ecc7911965578a1b7094c8a96068', 'f34891db0469dd4aa7d5a2e302b839f2cb7a83daea011b1e854a1ed496c0e6312a26aaa4327c360e3abff0028efb477592a1bd1c7f292941b7da66ba25c0f445', '123656');
INSERT INTO `accountstbl` VALUES ('6', 'markjoseph1496', '2ff5cf367a6c6604953a946903ea1ad683c81f9fd3fe89d1743b85565f7ae475259393977375134900f76891b85ec3b77897ecc7911965578a1b7094c8a96068', 'f34891db0469dd4aa7d5a2e302b839f2cb7a83daea011b1e854a1ed496c0e6312a26aaa4327c360e3abff0028efb477592a1bd1c7f292941b7da66ba25c0f445', '1-0082-MFC');
INSERT INTO `accountstbl` VALUES ('10', '2', '7754010a58d6b38061bcb5e550c9f667dbd535c848b0e921c28f49265370646c3922d708604ad362b18f90c679640dd2a0e29c864b7cd1801475f02c75eb681c', '1d933a7e0a8bce0d97918685ef6fc9abc6a576ace986a25dcee2a9e0d763047b03e145b20e3be59ec1747e94d421a322cd2354765e8df0f1a30b9fdc5a55daf8', '1-0085-RGM');
INSERT INTO `accountstbl` VALUES ('14', 'bc', '2ff5cf367a6c6604953a946903ea1ad683c81f9fd3fe89d1743b85565f7ae475259393977375134900f76891b85ec3b77897ecc7911965578a1b7094c8a96068', 'f34891db0469dd4aa7d5a2e302b839f2cb7a83daea011b1e854a1ed496c0e6312a26aaa4327c360e3abff0028efb477592a1bd1c7f292941b7da66ba25c0f445', '1-0086-RRG');
INSERT INTO `accountstbl` VALUES ('15', '09968111186', '9797868c508422fc460061e16e0276bfda8091d437c45c1e370f4643e69fbb5755fc3d87d97415b2ed49d60ada3d8f5dc2bd22f31aba0b76c8e9bd312f817b21', 'a0d44f9bd24133e713e6b9efc9c89d59361235d9a4b31001f7e9b30a0b7e0102380a56110f8cd5ee34b8932c23010a1a56e365831add27c211cb7327bf4686c6', '1-0083-BDP');

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
INSERT INTO `branchtbl` VALUES ('86', 'BH-001', 'B107', 'Cherry Mobile North Edsa', 'BR-001', 'AR-004');
INSERT INTO `branchtbl` VALUES ('87', 'BH-002', 'B108', 'Cherry Mobile Megamall', 'BR-001', 'AR-002');
INSERT INTO `branchtbl` VALUES ('88', 'BH-003', 'B207', 'Myphone North Edsa', 'BR-002', 'AR-004');

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
  `CategoryID` varchar(10) DEFAULT NULL,
  `CategoryCode` varchar(6) NOT NULL,
  `Category` varchar(20) NOT NULL,
  PRIMARY KEY (`_count`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of categorytbl
-- ----------------------------
INSERT INTO `categorytbl` VALUES ('1', 'CT-001', '1', 'Unit');
INSERT INTO `categorytbl` VALUES ('2', 'CT-002', '2', 'CLS');
INSERT INTO `categorytbl` VALUES ('3', 'CT-003', '3', 'Acc');
INSERT INTO `categorytbl` VALUES ('4', 'CT-004', '4', 'MD');

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
  `BrandID` varchar(255) NOT NULL,
  PRIMARY KEY (`_count`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of employeetbl
-- ----------------------------
INSERT INTO `employeetbl` VALUES ('3', '123656', 'Tim Joseph', 'Lao', 'Rojas', 'TLR', 'Admin', '', 'BH-001', 'AR-006', '');
INSERT INTO `employeetbl` VALUES ('18', '1-0082-MFC', 'Mark Joseph', 'Flaviano', 'Cinco', 'MFC', 'OIC', '', 'BH-001', '', 'BR-001');
INSERT INTO `employeetbl` VALUES ('19', '1-0083-BDP', 'Big John', 'Dela Torre', 'Pascua', 'BDP', 'Area Manager', '', '', 'AR-004', '');
INSERT INTO `employeetbl` VALUES ('23', '1-0084-RRG', 'Rica Mae', '', 'De Guzman', 'RRG', 'OIC', '', 'BH-002', '', '');
INSERT INTO `employeetbl` VALUES ('26', '1-0085-RQC', 'Raquel', 'Quimada', 'Calderon', 'RQC', 'Area Manager', '', '', 'AR-002', '');
INSERT INTO `employeetbl` VALUES ('27', '1-0086-RRG', 'Rica', '', 'De Guzman', 'RRG', 'Brand Coordinator', '', '', '', 'BR-001');

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
  `Color` varchar(20) NOT NULL,
  `DateModified` varchar(15) NOT NULL,
  `ModifyCode` varchar(10) NOT NULL,
  `Remarks` varchar(255) NOT NULL,
  `Received` int(11) NOT NULL,
  `ReceivedBy` varchar(11) NOT NULL,
  PRIMARY KEY (`_count`)
) ENGINE=InnoDB AUTO_INCREMENT=308 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of purchaserequestsitemstbl
-- ----------------------------
INSERT INTO `purchaserequestsitemstbl` VALUES ('288', 'PR-B107-1016001', 'B0133', '3', 'White', '2016-10-12', '1299000380', '', '0', '');
INSERT INTO `purchaserequestsitemstbl` VALUES ('289', 'PR-B107-1016001', 'B0133', '2', 'Black', '2016-10-12', '1299000380', '', '0', '');
INSERT INTO `purchaserequestsitemstbl` VALUES ('290', 'PR-B107-1016001', 'B0133', '4', 'Red', '2016-10-12', '1299000380', '', '0', '');
INSERT INTO `purchaserequestsitemstbl` VALUES ('291', 'PR-B107-1016001', 'B0133', '2', '', '2016-10-12', '937060068', '', '0', '');
INSERT INTO `purchaserequestsitemstbl` VALUES ('292', 'PR-B107-1016001', 'B0133', '2', '', '2016-10-12', '134216125', '', '0', '');
INSERT INTO `purchaserequestsitemstbl` VALUES ('293', 'PR-B107-1016001', 'B0133', '2', '', '2016-10-12', '820357877', '', '0', '');
INSERT INTO `purchaserequestsitemstbl` VALUES ('294', 'PR-B107-1016001', 'B0134', '4', '', '2016-10-12', '820357877', '', '0', '');
INSERT INTO `purchaserequestsitemstbl` VALUES ('295', 'PR-B107-1016001', 'B0133', '4', '', '2016-10-12', '1219649775', '', '0', '');
INSERT INTO `purchaserequestsitemstbl` VALUES ('296', 'PR-B107-1016001', 'B0134', '2', '', '2016-10-12', '917179385', '', '0', '');
INSERT INTO `purchaserequestsitemstbl` VALUES ('297', 'PR-B107-1016001', 'B0133', '3', 'Red', '2016-10-12', '1240003808', '', '0', '');
INSERT INTO `purchaserequestsitemstbl` VALUES ('298', 'PR-B107-1016002', 'B0133', '3', 'Black', '2016-10-12', '67559896', '', '0', '');
INSERT INTO `purchaserequestsitemstbl` VALUES ('299', 'PR-B107-1016003', 'B0133', '3', 'White', '2016-10-12', '1357480571', '', '0', '');
INSERT INTO `purchaserequestsitemstbl` VALUES ('300', 'PR-B107-1016003', 'B0133', '3', 'Black', '2016-10-12', '58178968', '', '0', '');
INSERT INTO `purchaserequestsitemstbl` VALUES ('301', 'PR-B107-1016003', 'B0133', '3', '', '2016-10-12', '58178968', '', '0', '');
INSERT INTO `purchaserequestsitemstbl` VALUES ('302', 'PR-B207-1016001', 'B0135', '3', 'White', '2016-10-12', '63170654', '', '0', '');
INSERT INTO `purchaserequestsitemstbl` VALUES ('303', 'PR-B107-1016004', 'B0133', '10', 'White', '2016-10-12', '1048942699', 'Ship to Branch', '0', '');
INSERT INTO `purchaserequestsitemstbl` VALUES ('304', 'PR-B107-1016004', 'B0133', '7', 'Black', '2016-10-12', '1048942699', 'Ship to Branch', '0', '');
INSERT INTO `purchaserequestsitemstbl` VALUES ('305', 'PR-B107-1016004', 'B0133', '9', 'Red', '2016-10-12', '1048942699', 'Ship to Branch', '0', '');
INSERT INTO `purchaserequestsitemstbl` VALUES ('306', 'PR-B107-1016005', 'B0133', '10', 'White', '2016-10-12', '463753506', 'Ship to Branch', '0', '');
INSERT INTO `purchaserequestsitemstbl` VALUES ('307', 'PR-B107-1016005', 'B0133', '8', 'Black', '2016-10-12', '463753506', 'Ship to Branch', '0', '');

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
  PRIMARY KEY (`_count`)
) ENGINE=InnoDB AUTO_INCREMENT=231 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of purchaserequeststbl
-- ----------------------------
INSERT INTO `purchaserequeststbl` VALUES ('225', 'PR-B107-1016001', '2016-10-12', 'B107', 'BR-001', 'Cancelled', 'Cancelled', '1-0082-MFC', '0', '1-0083-BDP', '2', '0', '1-0083-BDP', '', '', '1-0083-BDP', '06:10 PM', '2016-10-12', '1240003808', '', '');
INSERT INTO `purchaserequeststbl` VALUES ('226', 'PR-B107-1016002', '2016-10-12', 'B107', 'BR-001', 'Cancelled', 'Cancelled', '1-0083-BDP', '0', '1-0083-BDP', '2', '0', '', '', '', '1-0083-BDP', '06:32 PM', '2016-10-12', '67559896', '', '');
INSERT INTO `purchaserequeststbl` VALUES ('227', 'PR-B107-1016003', '2016-10-12', 'B107', 'BR-001', 'Cancelled', 'Cancelled', '1-0083-BDP', '0', '1-0083-BDP', '2', '0', '1-0083-BDP', '', '', '1-0083-BDP', '06:34 PM', '2016-10-12', '58178968', '', '');
INSERT INTO `purchaserequeststbl` VALUES ('228', 'PR-B207-1016001', '2016-10-12', 'B207', 'BR-002', 'Pending', 'Waiting for Approval from Branch Coordinator', '1-0083-BDP', '0', '', '1', '0', '', '', '', '1-0083-BDP', '06:37 PM', '2016-10-12', '63170654', '', '');
INSERT INTO `purchaserequeststbl` VALUES ('229', 'PR-B107-1016004', '2016-10-12', 'B107', 'BR-001', 'Approved', 'For Delivery', '1-0082-MFC', '0', '', '1', '1', '1-0083-BDP', '1-0086-RRG', '', '1-0082-MFC', '06:39 PM', '2016-10-12', '1048942699', '2016-10-12', '06:41 PM');
INSERT INTO `purchaserequeststbl` VALUES ('230', 'PR-B107-1016005', '2016-10-12', 'B107', 'BR-001', 'Approved', 'For Delivery', '1-0083-BDP', '0', '', '1', '1', '', '1-0086-RRG', '', '1-0083-BDP', '11:59 PM', '2016-10-12', '463753506', '2016-10-13', '12:02 AM');
