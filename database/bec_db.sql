/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50616
Source Host           : localhost:3306
Source Database       : bec_db

Target Server Type    : MYSQL
Target Server Version : 50616
File Encoding         : 65001

Date: 2016-10-26 11:50:11
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
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of accountstbl
-- ----------------------------
INSERT INTO `accountstbl` VALUES ('2', 'markjoseph1496', '2ff5cf367a6c6604953a946903ea1ad683c81f9fd3fe89d1743b85565f7ae475259393977375134900f76891b85ec3b77897ecc7911965578a1b7094c8a96068', 'f34891db0469dd4aa7d5a2e302b839f2cb7a83daea011b1e854a1ed496c0e6312a26aaa4327c360e3abff0028efb477592a1bd1c7f292941b7da66ba25c0f445', '1-0086-MFC');
INSERT INTO `accountstbl` VALUES ('18', '09968111187', 'dc67aea64febf7822a8923b8dfb44202d4d1a9288732c9e959c5e2f96fabdbc63031f8385296c2917c6a11f4e59c2d3f731a10c1fddafb644c94120dd76c4fd3', 'f3213278bbd26bb4e6e317038f0d60c226b8cf377aaafe7230f4c76f233fa45b247f7c0361b12364f736f25a9d32d8886736e97e603b270aaea5ace7c3c9a0dd', '1-0066-RRG');
INSERT INTO `accountstbl` VALUES ('19', '09968111186', '9664777b2fcdb67f8a7efb29c19c70dd3339d1445b54d836c08a2548099fdf7de33ee4ba783e7ac8dfb56f608bac8f75c323e25bbdda7c881ee949a7d6407c2d', 'bdfed502908e9efe636f5985a143cc404a96ac91cb1c9a826f556270c0e04988bea784851262f88b76224d473ec61f0a400b932255349be7534bd572710e39a9', '1-0069-BDP');
INSERT INTO `accountstbl` VALUES ('23', '09968111183', '90f84b1b03dc4f21639b9aa5b5020b745bb85f62b9aa5d1494912ab0cab923871b6dd23b51f1528478e0ee63b78ad1aad3e6f624539c04d058b8795421b21b73', 'c2f56c1b01e29db291d77a81489f8e971bef3bff3f4c584486449c9a3f9689c2b441f589facfe8e09f2a0797991acc74f3de1170e094de446b7922f22ac1866f', '1-0085-MFC');
INSERT INTO `accountstbl` VALUES ('26', '11111111', '7d446fbde9ea90d74f98b796ed7bca77adf368c6f7758e4e5723c8578da7cff3f58ed90d72daf4d35a48af55cb1a2105101c3760992ad7529efe22bb6ec0f21f', '9250d777bc36efc2fb5aec4b674319fd871804a997e78a2428c7a5e0f88ca8b36ee185ec8338e2d9025e06bd9a5c0caba8cbfbcb7fafd0fff6039c181f42a5c5', '1-0092-PCG');

-- ----------------------------
-- Table structure for `areatbl`
-- ----------------------------
DROP TABLE IF EXISTS `areatbl`;
CREATE TABLE `areatbl` (
  `_count` int(6) NOT NULL AUTO_INCREMENT,
  `AreaID` varchar(6) NOT NULL,
  `Area` varchar(20) NOT NULL,
  PRIMARY KEY (`_count`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of areatbl
-- ----------------------------
INSERT INTO `areatbl` VALUES ('1', 'AR-001', 'Baguio');
INSERT INTO `areatbl` VALUES ('2', 'AR-002', 'Central Luzon');
INSERT INTO `areatbl` VALUES ('3', 'AR-003', 'NCR South');
INSERT INTO `areatbl` VALUES ('4', 'AR-004', 'NCR North');
INSERT INTO `areatbl` VALUES ('5', 'AR-005', 'NCR East');
INSERT INTO `areatbl` VALUES ('6', 'AR-006', 'NCR Mandaluyong');
INSERT INTO `areatbl` VALUES ('7', 'AR-007', 'NCR Central');
INSERT INTO `areatbl` VALUES ('8', 'AR-008', 'Cebu');

-- ----------------------------
-- Table structure for `b807cashtransactiontbl`
-- ----------------------------
DROP TABLE IF EXISTS `b807cashtransactiontbl`;
CREATE TABLE `b807cashtransactiontbl` (
  `_count` int(7) NOT NULL AUTO_INCREMENT,
  `TransactionID` varchar(20) NOT NULL,
  `ORNumber` varchar(20) NOT NULL,
  `Amount` varchar(7) NOT NULL,
  PRIMARY KEY (`_count`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of b807cashtransactiontbl
-- ----------------------------

-- ----------------------------
-- Table structure for `b807credittransactiontbl`
-- ----------------------------
DROP TABLE IF EXISTS `b807credittransactiontbl`;
CREATE TABLE `b807credittransactiontbl` (
  `_count` int(7) NOT NULL AUTO_INCREMENT,
  `TransactionID` varchar(20) NOT NULL,
  `ORNumber` varchar(20) NOT NULL,
  `CreditCardNumber` varchar(20) NOT NULL,
  `CardHolderName` varchar(20) NOT NULL,
  `MID` varchar(20) NOT NULL,
  `BatchNum` varchar(20) NOT NULL,
  `ApprCode` varchar(20) NOT NULL,
  `Term` varchar(20) NOT NULL,
  `IDPresented` varchar(20) NOT NULL,
  `Amount` varchar(20) NOT NULL,
  PRIMARY KEY (`_count`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of b807credittransactiontbl
-- ----------------------------

-- ----------------------------
-- Table structure for `b807homecredittransactiontbl`
-- ----------------------------
DROP TABLE IF EXISTS `b807homecredittransactiontbl`;
CREATE TABLE `b807homecredittransactiontbl` (
  `_count` int(7) NOT NULL AUTO_INCREMENT,
  `TransactionID` varchar(20) NOT NULL,
  `ORNumber` varchar(20) NOT NULL,
  `ReferenceNo` varchar(20) NOT NULL,
  `Amount` varchar(20) NOT NULL,
  PRIMARY KEY (`_count`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of b807homecredittransactiontbl
-- ----------------------------

-- ----------------------------
-- Table structure for `b807invtbl`
-- ----------------------------
DROP TABLE IF EXISTS `b807invtbl`;
CREATE TABLE `b807invtbl` (
  `_count` int(7) NOT NULL AUTO_INCREMENT,
  `ItemCode` varchar(11) NOT NULL,
  `ItemColor` varchar(15) NOT NULL,
  `imeisn` varchar(30) NOT NULL,
  PRIMARY KEY (`_count`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of b807invtbl
-- ----------------------------

-- ----------------------------
-- Table structure for `b807receivedtbl`
-- ----------------------------
DROP TABLE IF EXISTS `b807receivedtbl`;
CREATE TABLE `b807receivedtbl` (
  `_count` int(7) NOT NULL AUTO_INCREMENT,
  `ItemCode` varchar(11) NOT NULL,
  `ItemColor` varchar(15) NOT NULL,
  `imeisn` varchar(30) NOT NULL,
  `_DateReceived` varchar(15) NOT NULL,
  `_TimeReceived` varchar(15) NOT NULL,
  `ReceivedBy` varchar(15) NOT NULL,
  `DRnumber` varchar(15) NOT NULL,
  PRIMARY KEY (`_count`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of b807receivedtbl
-- ----------------------------

-- ----------------------------
-- Table structure for `b807soldunitstbl`
-- ----------------------------
DROP TABLE IF EXISTS `b807soldunitstbl`;
CREATE TABLE `b807soldunitstbl` (
  `_count` int(7) NOT NULL AUTO_INCREMENT,
  `ItemCode` varchar(11) NOT NULL,
  `ItemColor` varchar(15) NOT NULL,
  `imeisn` varchar(30) NOT NULL,
  `TransactionID` varchar(20) NOT NULL,
  PRIMARY KEY (`_count`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of b807soldunitstbl
-- ----------------------------
INSERT INTO `b807soldunitstbl` VALUES ('15', '104002', 'Gold', '151639244137432', 'B8071026-0002');

-- ----------------------------
-- Table structure for `b807transactiontbl`
-- ----------------------------
DROP TABLE IF EXISTS `b807transactiontbl`;
CREATE TABLE `b807transactiontbl` (
  `_count` int(7) NOT NULL AUTO_INCREMENT,
  `TransactionID` varchar(20) NOT NULL,
  `ORNumber` varchar(20) NOT NULL,
  `_Date` varchar(20) NOT NULL,
  `_Time` varchar(20) NOT NULL,
  `CustomerName` varchar(20) NOT NULL,
  `SalesClerk` varchar(20) NOT NULL,
  `Cashier` varchar(20) NOT NULL,
  `ModeOfPayment` varchar(30) NOT NULL,
  `Status` varchar(15) NOT NULL,
  PRIMARY KEY (`_count`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of b807transactiontbl
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
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of branchtbl
-- ----------------------------
INSERT INTO `branchtbl` VALUES ('23', 'BH-003', 'B807', 'Oppo SM North Edsa', 'BR-004', 'AR-004');

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
INSERT INTO `brandtbl` VALUES ('2', 'BR-002', '02', 'Myphone');
INSERT INTO `brandtbl` VALUES ('3', 'BR-003', '03', 'Huawei');
INSERT INTO `brandtbl` VALUES ('4', 'BR-004', '04', 'Oppo');

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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of categorytbl
-- ----------------------------
INSERT INTO `categorytbl` VALUES ('1', 'CT-001', '1', 'Unit');
INSERT INTO `categorytbl` VALUES ('2', 'CT-002', '2', 'Acc');

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
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of employeetbl
-- ----------------------------
INSERT INTO `employeetbl` VALUES ('3', '1-0086-MFC', 'Mark Joseph', 'Flaviano', 'CInco', 'MFC', 'Admin', '', '', '', '');
INSERT INTO `employeetbl` VALUES ('29', '1-0069-BDP', 'Big John', 'Dela Torre', 'Pascua', 'BDP', 'Area Manager', '', '', 'AR-004', '');
INSERT INTO `employeetbl` VALUES ('30', '1-0092-PCG', 'Pia', 'Carmona', 'Garcia', 'PCG', 'OIC', '', 'BH-003', '', '');
INSERT INTO `employeetbl` VALUES ('31', '1-0066-RRG', 'Rica Mae', 'Raquel', 'De Guzman', 'RRG', 'Area Manager', '', '', 'AR-004', '');
INSERT INTO `employeetbl` VALUES ('32', '1-0089-AAE', 'Alvin', 'Agustin', 'Espiritu', 'AAE', 'OIC', '', 'BH-002', '', '');
INSERT INTO `employeetbl` VALUES ('33', '1-0087-NAM', 'Nelebie', 'Arizobal', 'Magabili', 'NAM', 'Brand Coordinator', '', '', '', 'BR-004');
INSERT INTO `employeetbl` VALUES ('34', '1-0085-MFC', 'Mark Joseph', 'Flaviano', 'Cinco', 'MFC', 'Brand Coordinator', '', '', '', 'BR-004');
INSERT INTO `employeetbl` VALUES ('35', '1-0099-RGM', 'Raymond', '', 'Magno', 'RGM', 'Sales Clerk', '', 'BH-003', '', '');
INSERT INTO `employeetbl` VALUES ('36', '1-0100-TLR', 'Tim Joseph', 'Lao', 'Rojas', 'TLR', 'Sales Clerk', '', 'BH-003', '', '');

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
  `AvailableColor` varchar(500) DEFAULT NULL,
  `BrandID` varchar(15) NOT NULL,
  `Category` varchar(15) NOT NULL,
  `SRP` int(7) NOT NULL,
  `DP` int(7) NOT NULL,
  `CriticalLevel` int(7) NOT NULL,
  PRIMARY KEY (`_count`)
) ENGINE=InnoDB AUTO_INCREMENT=96 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of itemstbl
-- ----------------------------
INSERT INTO `itemstbl` VALUES ('73', '1', '04', '104001', 'A37', 'A37', 'Gold, Rose Gold', 'BR-004', 'Unit', '8990', '8000', '20');
INSERT INTO `itemstbl` VALUES ('74', '1', '04', '104002', 'F1', 'F1', 'Gold', 'BR-004', 'Unit', '11990', '10670', '20');
INSERT INTO `itemstbl` VALUES ('75', '1', '04', '104003', 'F1 Plus', 'F1 Plus', 'Gold', 'BR-004', 'Unit', '19990', '17790', '20');
INSERT INTO `itemstbl` VALUES ('76', '1', '04', '104004', 'F1 S', 'F1 S', 'Gold, Rose Gold', 'BR-004', 'Unit', '12990', '11560', '20');
INSERT INTO `itemstbl` VALUES ('77', '1', '04', '104005', 'Find 5 Mini R827', 'Find 5 Mini R827', 'White, Black', 'BR-004', 'Unit', '4990', '4390', '20');
INSERT INTO `itemstbl` VALUES ('78', '1', '04', '104006', 'Oppo Find A7 X9006', 'Oppo Find A7 X9006', 'White, Black', 'BR-004', 'Unit', '10990', '9670', '20');
INSERT INTO `itemstbl` VALUES ('79', '1', '04', '104007', 'Joy Plus R1011', 'Joy Plus R1011', 'White, Blue', 'BR-004', 'Unit', '3990', '3670', '20');
INSERT INTO `itemstbl` VALUES ('80', '1', '04', '104008', 'Joy R1001', 'Joy R1001', 'White, Black', 'BR-004', 'Unit', '3990', '3630', '20');
INSERT INTO `itemstbl` VALUES ('81', '1', '04', '104009', 'Joy 3 A11w', 'Joy 3 A11w', 'White, Gray', 'BR-004', 'Unit', '4590', '4176', '20');
INSERT INTO `itemstbl` VALUES ('82', '1', '04', '104010', 'Mirror 3 3006', 'Mirror 3 3006', 'White, Blue', 'BR-004', 'Unit', '6990', '6150', '20');
INSERT INTO `itemstbl` VALUES ('83', '1', '04', '104011', 'Mirror 5', 'Mirror 5', 'White, Blue', 'BR-004', 'Unit', '12990', '11690', '20');
INSERT INTO `itemstbl` VALUES ('84', '1', '04', '104012', 'N1 Mini', 'N1 Mini', 'White', 'BR-004', 'Unit', '19990', '16990', '20');
INSERT INTO `itemstbl` VALUES ('85', '1', '04', '104013', 'N3', 'N3', 'White', 'BR-004', 'Unit', '29990', '26090', '20');
INSERT INTO `itemstbl` VALUES ('86', '1', '04', '104014', 'Neo 3', 'Neo 3', 'White, Black', 'BR-004', 'Unit', '3990', '3550', '20');
INSERT INTO `itemstbl` VALUES ('87', '1', '04', '104015', 'Neo 5', 'Neo 5', 'White, Black', 'BR-004', 'Unit', '4990', '4490', '20');
INSERT INTO `itemstbl` VALUES ('88', '1', '04', '104016', 'Neo 5 16 GB', 'Neo 5 16 GB', 'Black, White', 'BR-004', 'Unit', '4990', '4490', '20');
INSERT INTO `itemstbl` VALUES ('89', '1', '04', '104017', 'Neo 7', 'Neo 7', 'Black, White', 'BR-004', 'Unit', '5990', '5450', '20');
INSERT INTO `itemstbl` VALUES ('90', '1', '04', '104018', 'R1X', 'R1X', 'Dark Blue, White', 'BR-004', 'Unit', '5990', '5450', '20');
INSERT INTO `itemstbl` VALUES ('91', '1', '04', '104019', 'R5', 'R5', 'Silver, Gold', 'BR-004', 'Unit', '11990', '10550', '20');
INSERT INTO `itemstbl` VALUES ('92', '1', '04', '104020', 'R7 Lite', 'R7 Lite', 'Golden, Silver', 'BR-004', 'Unit', '11990', '10550', '20');
INSERT INTO `itemstbl` VALUES ('93', '1', '04', '104021', 'R7 Plus', 'R7 Plus', 'Gold', 'BR-004', 'Unit', '21990', '19570', '20');
INSERT INTO `itemstbl` VALUES ('94', '1', '04', '104022', 'Yoyo R2001', 'Yoyo R2001', 'White, Black', 'BR-004', 'Unit', '7990', '6990', '20');
INSERT INTO `itemstbl` VALUES ('95', '1', '01', '101001', 'Flare S3', 'Flare S3', 'Black, Red', 'BR-001', 'Unit', '3999', '3500', '20');

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
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of purchaserequeststbl
-- ----------------------------
