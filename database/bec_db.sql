/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50616
Source Host           : localhost:3306
Source Database       : bec_db

Target Server Type    : MYSQL
Target Server Version : 50616
File Encoding         : 65001

Date: 2016-10-20 16:28:04
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
INSERT INTO `cashtransactiontbl` VALUES ('14', 'B1071019-0001', '236966', '13000');
INSERT INTO `cashtransactiontbl` VALUES ('15', 'B1071020-0001', '12345', '26000');
INSERT INTO `cashtransactiontbl` VALUES ('16', 'B1071020-0002', '1234', '24000');

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
INSERT INTO `credittransactiontbl` VALUES ('23', 'B1071019-0001', '236966', '4111111111111111', 'Mark Joseph', '000000000913254', '1454987', '12360', 'Straight', 'SSS', '12000');
INSERT INTO `credittransactiontbl` VALUES ('24', 'B1071020-0003', '432', '4111111111111111', 'Mark', '00000979654321654', '321654', '514654', 'Straight', 'SSS', '12000');

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
INSERT INTO `employeetbl` VALUES ('3', '123656', 'Tim Joseph', 'Lao', 'Rojas', 'TLR', 'Admin', '', 'BH-001', 'AR-006', '');
INSERT INTO `employeetbl` VALUES ('18', '1-0082-MFC', 'Mark Joseph', 'Flaviano', 'Cinco', 'MFC', 'OIC', '', 'BH-001', '', 'BR-001');
INSERT INTO `employeetbl` VALUES ('19', '1-0083-BDP', 'Big John', 'Dela Torre', 'Pascua', 'BDP', 'Area Manager', '', '', 'AR-004', '');
INSERT INTO `employeetbl` VALUES ('23', '1-0084-RRG', 'Rica Mae', '', 'De Guzman', 'RRG', 'OIC', '', 'BH-002', '', '');
INSERT INTO `employeetbl` VALUES ('26', '1-0085-RQC', 'Raquel', 'Quimada', 'Calderon', 'RQC', 'Area Manager', '', '', 'AR-002', '');
INSERT INTO `employeetbl` VALUES ('27', '1-0086-RRG', 'Rica', '', 'De Guzman', 'RRG', 'Brand Coordinator', '', '', '', 'BR-001');
INSERT INTO `employeetbl` VALUES ('28', '1-0087-RGM', 'Raymond', '', 'Magno', 'RGM', 'Sales Clerk', '', 'BH-001', '', '');

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
INSERT INTO `invtbl` VALUES ('572', '101001', 'Black', '102769923345116', 'B107', '2016-10-19', '10:19 PM', '1-0082-MFC', 'On Hand', '');
INSERT INTO `invtbl` VALUES ('573', '101001', 'Black', '111538148069938', 'B107', '2016-10-19', '10:19 PM', '1-0082-MFC', 'On Hand', '');
INSERT INTO `invtbl` VALUES ('574', '101001', 'Black', '114634386471462', 'B107', '2016-10-19', '10:19 PM', '1-0082-MFC', 'On Hand', '');
INSERT INTO `invtbl` VALUES ('575', '101001', 'Black', '115533726215439', 'B107', '2016-10-19', '10:19 PM', '1-0082-MFC', 'On Hand', '');
INSERT INTO `invtbl` VALUES ('576', '101001', 'Black', '118637617611510', 'B107', '2016-10-19', '10:19 PM', '1-0082-MFC', 'On Hand', '');
INSERT INTO `invtbl` VALUES ('577', '101001', 'Black', '125653854957898', 'B107', '2016-10-19', '10:19 PM', '1-0082-MFC', 'On Hand', '');
INSERT INTO `invtbl` VALUES ('578', '101001', 'Black', '130951714724265', 'B107', '2016-10-19', '10:19 PM', '1-0082-MFC', 'On Hand', '');
INSERT INTO `invtbl` VALUES ('579', '101001', 'Black', '133870332986778', 'B107', '2016-10-19', '10:19 PM', '1-0082-MFC', 'On Hand', '');
INSERT INTO `invtbl` VALUES ('580', '101001', 'Black', '141351334618945', 'B107', '2016-10-19', '10:19 PM', '1-0082-MFC', 'On Hand', '');
INSERT INTO `invtbl` VALUES ('581', '101001', 'Black', '148626558304710', 'B107', '2016-10-19', '10:19 PM', '1-0082-MFC', 'On Hand', '');
INSERT INTO `invtbl` VALUES ('582', '101001', 'Black', '153297892633340', 'B107', '2016-10-19', '10:19 PM', '1-0082-MFC', 'On Hand', '');
INSERT INTO `invtbl` VALUES ('583', '101001', 'Black', '156780969066252', 'B107', '2016-10-19', '10:19 PM', '1-0082-MFC', 'Sold', 'B1071020-0002');
INSERT INTO `invtbl` VALUES ('584', '101001', 'Black', '159173341301953', 'B107', '2016-10-19', '10:19 PM', '1-0082-MFC', 'Sold', 'B1071020-0002');
INSERT INTO `invtbl` VALUES ('585', '101001', 'Black', '102846709567318', 'B107', '2016-10-19', '10:19 PM', '1-0082-MFC', 'On Hand', '');
INSERT INTO `invtbl` VALUES ('586', '101001', 'Black', '111838080311296', 'B107', '2016-10-19', '10:19 PM', '1-0082-MFC', 'On Hand', '');
INSERT INTO `invtbl` VALUES ('587', '101001', 'Black', '114841903340638', 'B107', '2016-10-19', '10:19 PM', '1-0082-MFC', 'On Hand', '');
INSERT INTO `invtbl` VALUES ('588', '101001', 'Black', '115539795475793', 'B107', '2016-10-19', '10:19 PM', '1-0082-MFC', 'On Hand', '');
INSERT INTO `invtbl` VALUES ('589', '101001', 'Black', '120012913837435', 'B107', '2016-10-19', '10:19 PM', '1-0082-MFC', 'On Hand', '');
INSERT INTO `invtbl` VALUES ('590', '101001', 'Black', '127734558721765', 'B107', '2016-10-19', '10:19 PM', '1-0082-MFC', 'On Hand', '');
INSERT INTO `invtbl` VALUES ('591', '101001', 'Black', '132124302625032', 'B107', '2016-10-19', '10:19 PM', '1-0082-MFC', 'On Hand', '');
INSERT INTO `invtbl` VALUES ('592', '101001', 'Black', '133872802375203', 'B107', '2016-10-19', '10:19 PM', '1-0082-MFC', 'On Hand', '');
INSERT INTO `invtbl` VALUES ('593', '101001', 'Black', '146059122591460', 'B107', '2016-10-19', '10:19 PM', '1-0082-MFC', 'On Hand', '');
INSERT INTO `invtbl` VALUES ('594', '101001', 'Black', '150987630457990', 'B107', '2016-10-19', '10:19 PM', '1-0082-MFC', 'On Hand', '');
INSERT INTO `invtbl` VALUES ('595', '101001', 'Black', '154228499276309', 'B107', '2016-10-19', '10:19 PM', '1-0082-MFC', 'On Hand', '');
INSERT INTO `invtbl` VALUES ('596', '101001', 'Black', '158284103360193', 'B107', '2016-10-19', '10:19 PM', '1-0082-MFC', 'On Hand', '');
INSERT INTO `invtbl` VALUES ('597', '101001', 'Black', '159348163707840', 'B107', '2016-10-19', '10:19 PM', '1-0082-MFC', 'On Hand', '');
INSERT INTO `invtbl` VALUES ('598', '101001', 'Black', '107617216206181', 'B107', '2016-10-19', '10:19 PM', '1-0082-MFC', 'On Hand', '');
INSERT INTO `invtbl` VALUES ('599', '101001', 'Black', '114547647037943', 'B107', '2016-10-19', '10:19 PM', '1-0082-MFC', 'On Hand', '');
INSERT INTO `invtbl` VALUES ('600', '101001', 'Black', '115460009144468', 'B107', '2016-10-19', '10:19 PM', '1-0082-MFC', 'On Hand', '');
INSERT INTO `invtbl` VALUES ('601', '101001', 'Black', '116688111282738', 'B107', '2016-10-19', '10:19 PM', '1-0082-MFC', 'Sold', 'B1071019-0001');
INSERT INTO `invtbl` VALUES ('602', '101002', 'White', '122269841875585', 'B107', '2016-10-19', '10:51 PM', '1-0082-MFC', 'Sold', 'B1071019-0001');
INSERT INTO `invtbl` VALUES ('603', '101002', 'White', '130442857219560', 'B107', '2016-10-19', '10:51 PM', '1-0082-MFC', 'On Hand', '');
INSERT INTO `invtbl` VALUES ('604', '101002', 'White', '132533788357224', 'B107', '2016-10-19', '10:51 PM', '1-0082-MFC', 'On Hand', '');
INSERT INTO `invtbl` VALUES ('605', '101002', 'White', '135455470355736', 'B107', '2016-10-19', '10:51 PM', '1-0082-MFC', 'On Hand', '');
INSERT INTO `invtbl` VALUES ('606', '101002', 'White', '146997417003125', 'B107', '2016-10-19', '10:51 PM', '1-0082-MFC', 'On Hand', '');
INSERT INTO `invtbl` VALUES ('607', '101002', 'White', '151639244137432', 'B107', '2016-10-19', '10:51 PM', '1-0082-MFC', 'On Hand', '');
INSERT INTO `invtbl` VALUES ('608', '101002', 'White', '156582202250947', 'B107', '2016-10-19', '10:51 PM', '1-0082-MFC', 'On Hand', '');
INSERT INTO `invtbl` VALUES ('609', '101002', 'White', '158592372126935', 'B107', '2016-10-19', '10:51 PM', '1-0082-MFC', 'Sold', 'B1071020-0001');
INSERT INTO `invtbl` VALUES ('610', '101002', 'White', '164628033163469', 'B107', '2016-10-19', '10:51 PM', '1-0082-MFC', 'Sold', 'B1071020-0001');
INSERT INTO `invtbl` VALUES ('611', '101002', 'White', '164861210109181', 'B107', '2016-10-19', '10:51 PM', '1-0082-MFC', 'On Hand', '');
INSERT INTO `invtbl` VALUES ('612', '101002', 'White', '168402471216672', 'B107', '2016-10-19', '10:51 PM', '1-0082-MFC', 'On Hand', '');
INSERT INTO `invtbl` VALUES ('613', '101002', 'White', '176764868429288', 'B107', '2016-10-19', '10:51 PM', '1-0082-MFC', 'On Hand', '');
INSERT INTO `invtbl` VALUES ('614', '101002', 'White', '179446822006383', 'B107', '2016-10-19', '10:51 PM', '1-0082-MFC', 'On Hand', '');
INSERT INTO `invtbl` VALUES ('615', '101002', 'White', '186945653078556', 'B107', '2016-10-19', '10:51 PM', '1-0082-MFC', 'On Hand', '');
INSERT INTO `invtbl` VALUES ('616', '101002', 'White', '200140197926198', 'B107', '2016-10-19', '10:51 PM', '1-0082-MFC', 'On Hand', '');
INSERT INTO `invtbl` VALUES ('617', '101002', 'White', '206558542607531', 'B107', '2016-10-19', '10:51 PM', '1-0082-MFC', 'On Hand', '');
INSERT INTO `invtbl` VALUES ('618', '101002', 'White', '210478736724283', 'B107', '2016-10-19', '10:51 PM', '1-0082-MFC', 'On Hand', '');
INSERT INTO `invtbl` VALUES ('619', '101002', 'White', '218116672398183', 'B107', '2016-10-19', '10:51 PM', '1-0082-MFC', 'On Hand', '');
INSERT INTO `invtbl` VALUES ('620', '101002', 'White', '222139989066463', 'B107', '2016-10-19', '10:51 PM', '1-0082-MFC', 'On Hand', '');
INSERT INTO `invtbl` VALUES ('621', '101002', 'White', '232175091521924', 'B107', '2016-10-19', '10:51 PM', '1-0082-MFC', 'On Hand', '');
INSERT INTO `invtbl` VALUES ('622', '101002', 'White', '237336227602687', 'B107', '2016-10-19', '10:51 PM', '1-0082-MFC', 'On Hand', '');
INSERT INTO `invtbl` VALUES ('623', '101002', 'White', '245052168740767', 'B107', '2016-10-19', '10:51 PM', '1-0082-MFC', 'On Hand', '');
INSERT INTO `invtbl` VALUES ('624', '101002', 'White', '166228408811287', 'B107', '2016-10-19', '10:51 PM', '1-0082-MFC', 'On Hand', '');
INSERT INTO `invtbl` VALUES ('625', '101002', 'White', '172573890945254', 'B107', '2016-10-19', '10:51 PM', '1-0082-MFC', 'On Hand', '');
INSERT INTO `invtbl` VALUES ('626', '101002', 'White', '177902686860005', 'B107', '2016-10-19', '10:51 PM', '1-0082-MFC', 'On Hand', '');
INSERT INTO `invtbl` VALUES ('627', '101002', 'White', '179447492893730', 'B107', '2016-10-19', '10:51 PM', '1-0082-MFC', 'On Hand', '');
INSERT INTO `invtbl` VALUES ('628', '101002', 'White', '196545447188439', 'B107', '2016-10-19', '10:51 PM', '1-0082-MFC', 'On Hand', '');
INSERT INTO `invtbl` VALUES ('629', '101002', 'White', '202100469201872', 'B107', '2016-10-19', '10:51 PM', '1-0082-MFC', 'On Hand', '');
INSERT INTO `invtbl` VALUES ('630', '101002', 'White', '206559461839986', 'B107', '2016-10-19', '10:51 PM', '1-0082-MFC', 'On Hand', '');
INSERT INTO `invtbl` VALUES ('631', '101002', 'White', '213348994513082', 'B107', '2016-10-19', '10:51 PM', '1-0082-MFC', 'On Hand', '');
INSERT INTO `invtbl` VALUES ('632', '101006', 'White', '219825762440640', 'B107', '2016-10-19', '10:52 PM', '1-0082-MFC', 'On Hand', '');
INSERT INTO `invtbl` VALUES ('633', '101006', 'White', '223871970514541', 'B107', '2016-10-19', '10:52 PM', '1-0082-MFC', 'On Hand', '');
INSERT INTO `invtbl` VALUES ('634', '101006', 'White', '233924917876105', 'B107', '2016-10-19', '10:52 PM', '1-0082-MFC', 'On Hand', '');
INSERT INTO `invtbl` VALUES ('635', '101006', 'White', '240853565275452', 'B107', '2016-10-19', '10:52 PM', '1-0082-MFC', 'On Hand', '');
INSERT INTO `invtbl` VALUES ('636', '101006', 'White', '246188768267005', 'B107', '2016-10-19', '10:52 PM', '1-0082-MFC', 'On Hand', '');
INSERT INTO `invtbl` VALUES ('637', '101006', 'White', '166610321105087', 'B107', '2016-10-19', '10:52 PM', '1-0082-MFC', 'On Hand', '');
INSERT INTO `invtbl` VALUES ('638', '101006', 'White', '176348285220423', 'B107', '2016-10-19', '10:52 PM', '1-0082-MFC', 'On Hand', '');
INSERT INTO `invtbl` VALUES ('639', '101006', 'White', '178568948346923', 'B107', '2016-10-19', '10:52 PM', '1-0082-MFC', 'On Hand', '');
INSERT INTO `invtbl` VALUES ('640', '101006', 'White', '184642655910101', 'B107', '2016-10-19', '10:52 PM', '1-0082-MFC', 'On Hand', '');
INSERT INTO `invtbl` VALUES ('641', '101006', 'White', '199436169571285', 'B107', '2016-10-19', '10:52 PM', '1-0082-MFC', 'On Hand', '');
INSERT INTO `invtbl` VALUES ('642', '101006', 'White', '204962814610497', 'B107', '2016-10-19', '10:52 PM', '1-0082-MFC', 'On Hand', '');
INSERT INTO `invtbl` VALUES ('643', '101006', 'White', '210422971001058', 'B107', '2016-10-19', '10:52 PM', '1-0082-MFC', 'On Hand', '');
INSERT INTO `invtbl` VALUES ('644', '101006', 'White', '216646978676283', 'B107', '2016-10-19', '10:52 PM', '1-0082-MFC', 'On Hand', '');
INSERT INTO `invtbl` VALUES ('645', '101006', 'White', '220615294591302', 'B107', '2016-10-19', '10:52 PM', '1-0082-MFC', 'On Hand', '');
INSERT INTO `invtbl` VALUES ('646', '101006', 'White', '224373148961270', 'B107', '2016-10-19', '10:52 PM', '1-0082-MFC', 'On Hand', '');
INSERT INTO `invtbl` VALUES ('647', '101006', 'White', '236286147447623', 'B107', '2016-10-19', '10:52 PM', '1-0082-MFC', 'On Hand', '');
INSERT INTO `invtbl` VALUES ('648', '101006', 'White', '244026233729459', 'B107', '2016-10-19', '10:52 PM', '1-0082-MFC', 'On Hand', '');
INSERT INTO `invtbl` VALUES ('649', '101006', 'White', '247973913541605', 'B107', '2016-10-19', '10:52 PM', '1-0082-MFC', 'On Hand', '');
INSERT INTO `invtbl` VALUES ('650', '101006', 'White', '249489316883694', 'B107', '2016-10-19', '10:52 PM', '1-0082-MFC', 'On Hand', '');
INSERT INTO `invtbl` VALUES ('651', '101006', 'White', '254691091281376', 'B107', '2016-10-19', '10:52 PM', '1-0082-MFC', 'On Hand', '');
INSERT INTO `invtbl` VALUES ('652', '101006', 'White', '267567674983707', 'B107', '2016-10-19', '10:52 PM', '1-0082-MFC', 'On Hand', '');
INSERT INTO `invtbl` VALUES ('653', '101006', 'White', '274479584265168', 'B107', '2016-10-19', '10:52 PM', '1-0082-MFC', 'On Hand', '');
INSERT INTO `invtbl` VALUES ('654', '101006', 'White', '278998833188149', 'B107', '2016-10-19', '10:52 PM', '1-0082-MFC', 'On Hand', '');
INSERT INTO `invtbl` VALUES ('655', '101006', 'White', '283302758021099', 'B107', '2016-10-19', '10:52 PM', '1-0082-MFC', 'On Hand', '');
INSERT INTO `invtbl` VALUES ('656', '101006', 'White', '290206463460509', 'B107', '2016-10-19', '10:52 PM', '1-0082-MFC', 'On Hand', '');
INSERT INTO `invtbl` VALUES ('657', '101006', 'White', '297847702452287', 'B107', '2016-10-19', '10:52 PM', '1-0082-MFC', 'On Hand', '');
INSERT INTO `invtbl` VALUES ('658', '101006', 'White', '303316020526356', 'B107', '2016-10-19', '10:52 PM', '1-0082-MFC', 'On Hand', '');
INSERT INTO `invtbl` VALUES ('659', '101006', 'White', '306390960643568', 'B107', '2016-10-19', '10:52 PM', '1-0082-MFC', 'On Hand', '');
INSERT INTO `invtbl` VALUES ('660', '101006', 'White', '309861846608075', 'B107', '2016-10-19', '10:52 PM', '1-0082-MFC', 'On Hand', '');
INSERT INTO `invtbl` VALUES ('661', '101006', 'White', '313898018158449', 'B107', '2016-10-19', '10:52 PM', '1-0082-MFC', 'On Hand', '');
INSERT INTO `invtbl` VALUES ('662', '101003', 'White', '320797375113132', 'B107', '2016-10-19', '10:53 PM', '1-0082-MFC', 'On Hand', '');
INSERT INTO `invtbl` VALUES ('663', '101003', 'White', '252470276336287', 'B107', '2016-10-19', '10:53 PM', '1-0082-MFC', 'On Hand', '');
INSERT INTO `invtbl` VALUES ('664', '101003', 'White', '262396736865922', 'B107', '2016-10-19', '10:53 PM', '1-0082-MFC', 'On Hand', '');
INSERT INTO `invtbl` VALUES ('665', '101003', 'White', '268946125266015', 'B107', '2016-10-19', '10:53 PM', '1-0082-MFC', 'On Hand', '');
INSERT INTO `invtbl` VALUES ('666', '101003', 'White', '275154558530440', 'B107', '2016-10-19', '10:53 PM', '1-0082-MFC', 'On Hand', '');
INSERT INTO `invtbl` VALUES ('667', '101003', 'White', '279610626383513', 'B107', '2016-10-19', '10:53 PM', '1-0082-MFC', 'On Hand', '');
INSERT INTO `invtbl` VALUES ('668', '101003', 'White', '286244342139986', 'B107', '2016-10-19', '10:53 PM', '1-0082-MFC', 'On Hand', '');
INSERT INTO `invtbl` VALUES ('669', '101003', 'White', '290261168098418', 'B107', '2016-10-19', '10:53 PM', '1-0082-MFC', 'On Hand', '');
INSERT INTO `invtbl` VALUES ('670', '101003', 'White', '299087467190973', 'B107', '2016-10-19', '10:53 PM', '1-0082-MFC', 'On Hand', '');
INSERT INTO `invtbl` VALUES ('671', '101003', 'White', '303971088143466', 'B107', '2016-10-19', '10:53 PM', '1-0082-MFC', 'On Hand', '');
INSERT INTO `invtbl` VALUES ('672', '101003', 'White', '307341451352488', 'B107', '2016-10-19', '10:53 PM', '1-0082-MFC', 'On Hand', '');
INSERT INTO `invtbl` VALUES ('673', '101003', 'White', '310220616231771', 'B107', '2016-10-19', '10:53 PM', '1-0082-MFC', 'On Hand', '');
INSERT INTO `invtbl` VALUES ('674', '101003', 'White', '314772192787356', 'B107', '2016-10-19', '10:53 PM', '1-0082-MFC', 'On Hand', '');
INSERT INTO `invtbl` VALUES ('675', '101003', 'White', '321276158754804', 'B107', '2016-10-19', '10:53 PM', '1-0082-MFC', 'On Hand', '');
INSERT INTO `invtbl` VALUES ('676', '101003', 'White', '254413190968262', 'B107', '2016-10-19', '10:53 PM', '1-0082-MFC', 'On Hand', '');
INSERT INTO `invtbl` VALUES ('677', '101003', 'White', '263881788450281', 'B107', '2016-10-19', '10:53 PM', '1-0082-MFC', 'On Hand', '');
INSERT INTO `invtbl` VALUES ('678', '101003', 'White', '269774701050416', 'B107', '2016-10-19', '10:53 PM', '1-0082-MFC', 'On Hand', '');
INSERT INTO `invtbl` VALUES ('679', '101003', 'White', '276006521829146', 'B107', '2016-10-19', '10:53 PM', '1-0082-MFC', 'On Hand', '');
INSERT INTO `invtbl` VALUES ('680', '101003', 'White', '282747581642934', 'B107', '2016-10-19', '10:53 PM', '1-0082-MFC', 'On Hand', '');
INSERT INTO `invtbl` VALUES ('681', '101003', 'White', '286726596321560', 'B107', '2016-10-19', '10:53 PM', '1-0082-MFC', 'On Hand', '');
INSERT INTO `invtbl` VALUES ('682', '101003', 'White', '294110322704373', 'B107', '2016-10-19', '10:53 PM', '1-0082-MFC', 'On Hand', '');
INSERT INTO `invtbl` VALUES ('683', '101003', 'White', '301550069167312', 'B107', '2016-10-19', '10:53 PM', '1-0082-MFC', 'On Hand', '');
INSERT INTO `invtbl` VALUES ('684', '101003', 'White', '304542415150165', 'B107', '2016-10-19', '10:53 PM', '1-0082-MFC', 'On Hand', '');
INSERT INTO `invtbl` VALUES ('685', '101003', 'White', '307724748900497', 'B107', '2016-10-19', '10:53 PM', '1-0082-MFC', 'On Hand', '');
INSERT INTO `invtbl` VALUES ('686', '101003', 'White', '310493191671099', 'B107', '2016-10-19', '10:53 PM', '1-0082-MFC', 'On Hand', '');
INSERT INTO `invtbl` VALUES ('687', '101003', 'White', '320120481103411', 'B107', '2016-10-19', '10:53 PM', '1-0082-MFC', 'On Hand', '');
INSERT INTO `invtbl` VALUES ('688', '101003', 'White', '322691412273910', 'B107', '2016-10-19', '10:53 PM', '1-0082-MFC', 'On Hand', '');
INSERT INTO `invtbl` VALUES ('689', '101003', 'White', '323888695658403', 'B107', '2016-10-19', '10:53 PM', '1-0082-MFC', 'On Hand', '');
INSERT INTO `invtbl` VALUES ('690', '101003', 'White', '333207524165628', 'B107', '2016-10-19', '10:53 PM', '1-0082-MFC', 'On Hand', '');
INSERT INTO `invtbl` VALUES ('691', '101003', 'White', '336797843011620', 'B107', '2016-10-19', '10:53 PM', '1-0082-MFC', 'On Hand', '');
INSERT INTO `invtbl` VALUES ('692', '101007', 'Black', '346154458497609', 'B107', '2016-10-19', '10:54 PM', '1-0082-MFC', 'On Hand', '');
INSERT INTO `invtbl` VALUES ('693', '101007', 'Black', '354065972101498', 'B107', '2016-10-19', '10:54 PM', '1-0082-MFC', 'On Hand', '');
INSERT INTO `invtbl` VALUES ('694', '101007', 'Black', '357315256960706', 'B107', '2016-10-19', '10:54 PM', '1-0082-MFC', 'On Hand', '');
INSERT INTO `invtbl` VALUES ('695', '101007', 'Black', '362866026736140', 'B107', '2016-10-19', '10:54 PM', '1-0082-MFC', 'On Hand', '');
INSERT INTO `invtbl` VALUES ('696', '101007', 'Black', '375327988557845', 'B107', '2016-10-19', '10:54 PM', '1-0082-MFC', 'On Hand', '');
INSERT INTO `invtbl` VALUES ('697', '101007', 'Black', '382501569294276', 'B107', '2016-10-19', '10:54 PM', '1-0082-MFC', 'On Hand', '');
INSERT INTO `invtbl` VALUES ('698', '101007', 'Black', '387156899789533', 'B107', '2016-10-19', '10:54 PM', '1-0082-MFC', 'On Hand', '');
INSERT INTO `invtbl` VALUES ('699', '101007', 'Black', '394931723479741', 'B107', '2016-10-19', '10:54 PM', '1-0082-MFC', 'On Hand', '');
INSERT INTO `invtbl` VALUES ('700', '101007', 'Black', '396437527737047', 'B107', '2016-10-19', '10:54 PM', '1-0082-MFC', 'On Hand', '');
INSERT INTO `invtbl` VALUES ('701', '101007', 'Black', '398047177183852', 'B107', '2016-10-19', '10:54 PM', '1-0082-MFC', 'On Hand', '');
INSERT INTO `invtbl` VALUES ('702', '101007', 'Black', '326021507789317', 'B107', '2016-10-19', '10:54 PM', '1-0082-MFC', 'On Hand', '');
INSERT INTO `invtbl` VALUES ('703', '101007', 'Black', '333306352019976', 'B107', '2016-10-19', '10:54 PM', '1-0082-MFC', 'On Hand', '');
INSERT INTO `invtbl` VALUES ('704', '101007', 'Black', '341388761631514', 'B107', '2016-10-19', '10:54 PM', '1-0082-MFC', 'On Hand', '');
INSERT INTO `invtbl` VALUES ('705', '101007', 'Black', '346213499936617', 'B107', '2016-10-19', '10:54 PM', '1-0082-MFC', 'On Hand', '');
INSERT INTO `invtbl` VALUES ('706', '101007', 'Black', '355620604166669', 'B107', '2016-10-19', '10:54 PM', '1-0082-MFC', 'On Hand', '');
INSERT INTO `invtbl` VALUES ('707', '101007', 'Black', '357741421436741', 'B107', '2016-10-19', '10:54 PM', '1-0082-MFC', 'On Hand', '');
INSERT INTO `invtbl` VALUES ('708', '101007', 'Black', '363284143935131', 'B107', '2016-10-19', '10:54 PM', '1-0082-MFC', 'On Hand', '');
INSERT INTO `invtbl` VALUES ('709', '101007', 'Black', '379203809980164', 'B107', '2016-10-19', '10:54 PM', '1-0082-MFC', 'On Hand', '');
INSERT INTO `invtbl` VALUES ('710', '101007', 'Black', '383071162160281', 'B107', '2016-10-19', '10:54 PM', '1-0082-MFC', 'On Hand', '');
INSERT INTO `invtbl` VALUES ('711', '101007', 'Black', '388744590192178', 'B107', '2016-10-19', '10:54 PM', '1-0082-MFC', 'On Hand', '');
INSERT INTO `invtbl` VALUES ('712', '101007', 'Black', '395329848653851', 'B107', '2016-10-19', '10:54 PM', '1-0082-MFC', 'On Hand', '');
INSERT INTO `invtbl` VALUES ('713', '101007', 'Black', '396442723309167', 'B107', '2016-10-19', '10:54 PM', '1-0082-MFC', 'On Hand', '');
INSERT INTO `invtbl` VALUES ('714', '101007', 'Black', '400667892879974', 'B107', '2016-10-19', '10:54 PM', '1-0082-MFC', 'On Hand', '');
INSERT INTO `invtbl` VALUES ('715', '101007', 'Black', '331082352783830', 'B107', '2016-10-19', '10:54 PM', '1-0082-MFC', 'On Hand', '');
INSERT INTO `invtbl` VALUES ('716', '101007', 'Black', '335569447555431', 'B107', '2016-10-19', '10:54 PM', '1-0082-MFC', 'On Hand', '');
INSERT INTO `invtbl` VALUES ('717', '101007', 'Black', '346002561099882', 'B107', '2016-10-19', '10:54 PM', '1-0082-MFC', 'On Hand', '');
INSERT INTO `invtbl` VALUES ('718', '101007', 'Black', '348522558492393', 'B107', '2016-10-19', '10:54 PM', '1-0082-MFC', 'On Hand', '');
INSERT INTO `invtbl` VALUES ('719', '101007', 'Black', '356890768107519', 'B107', '2016-10-19', '10:54 PM', '1-0082-MFC', 'On Hand', '');
INSERT INTO `invtbl` VALUES ('720', '101007', 'Black', '358943731785806', 'B107', '2016-10-19', '10:54 PM', '1-0082-MFC', 'On Hand', '');
INSERT INTO `invtbl` VALUES ('721', '101007', 'Black', '374349178311372', 'B107', '2016-10-19', '10:54 PM', '1-0082-MFC', 'On Hand', '');
INSERT INTO `invtbl` VALUES ('722', '101001', 'Black', '382109399937395', 'B107', '2016-10-19', '10:55 PM', '1-0082-MFC', 'Sold', 'B1071020-0003');
INSERT INTO `invtbl` VALUES ('723', '101001', 'Black', '386353184872473', 'B107', '2016-10-19', '10:55 PM', '1-0082-MFC', 'On Hand', '');
INSERT INTO `invtbl` VALUES ('724', '101001', 'Black', '391013325834110', 'B107', '2016-10-19', '10:55 PM', '1-0082-MFC', 'On Hand', '');
INSERT INTO `invtbl` VALUES ('725', '101001', 'Black', '395928211236122', 'B107', '2016-10-19', '10:55 PM', '1-0082-MFC', 'On Hand', '');
INSERT INTO `invtbl` VALUES ('726', '101001', 'Black', '397140762596994', 'B107', '2016-10-19', '10:55 PM', '1-0082-MFC', 'On Hand', '');
INSERT INTO `invtbl` VALUES ('727', '101001', 'Black', '400857609392313', 'B107', '2016-10-19', '10:55 PM', '1-0082-MFC', 'On Hand', '');
INSERT INTO `invtbl` VALUES ('728', '101001', 'Black', '401002370277518', 'B107', '2016-10-19', '10:55 PM', '1-0082-MFC', 'On Hand', '');
INSERT INTO `invtbl` VALUES ('729', '101001', 'Black', '409062692787741', 'B107', '2016-10-19', '10:55 PM', '1-0082-MFC', 'On Hand', '');
INSERT INTO `invtbl` VALUES ('730', '101001', 'Black', '415917202502549', 'B107', '2016-10-19', '10:55 PM', '1-0082-MFC', 'On Hand', '');
INSERT INTO `invtbl` VALUES ('731', '101001', 'Black', '418120481075852', 'B107', '2016-10-19', '10:55 PM', '1-0082-MFC', 'On Hand', '');
INSERT INTO `invtbl` VALUES ('732', '101001', 'Black', '430378626976160', 'B107', '2016-10-19', '10:55 PM', '1-0082-MFC', 'On Hand', '');
INSERT INTO `invtbl` VALUES ('733', '101001', 'Black', '437315789714633', 'B107', '2016-10-19', '10:55 PM', '1-0082-MFC', 'On Hand', '');
INSERT INTO `invtbl` VALUES ('734', '101001', 'Black', '440141855616830', 'B107', '2016-10-19', '10:55 PM', '1-0082-MFC', 'On Hand', '');
INSERT INTO `invtbl` VALUES ('735', '101001', 'Black', '444429494547213', 'B107', '2016-10-19', '10:55 PM', '1-0082-MFC', 'On Hand', '');
INSERT INTO `invtbl` VALUES ('736', '101001', 'Black', '446312382588615', 'B107', '2016-10-19', '10:55 PM', '1-0082-MFC', 'On Hand', '');
INSERT INTO `invtbl` VALUES ('737', '101001', 'Black', '450853556999475', 'B107', '2016-10-19', '10:55 PM', '1-0082-MFC', 'On Hand', '');
INSERT INTO `invtbl` VALUES ('738', '101001', 'Black', '453250850543709', 'B107', '2016-10-19', '10:55 PM', '1-0082-MFC', 'On Hand', '');
INSERT INTO `invtbl` VALUES ('739', '101001', 'Black', '459431915457008', 'B107', '2016-10-19', '10:55 PM', '1-0082-MFC', 'On Hand', '');
INSERT INTO `invtbl` VALUES ('740', '101001', 'Black', '464439465317108', 'B107', '2016-10-19', '10:55 PM', '1-0082-MFC', 'On Hand', '');
INSERT INTO `invtbl` VALUES ('741', '101001', 'Black', '406681822380594', 'B107', '2016-10-19', '10:55 PM', '1-0082-MFC', 'On Hand', '');
INSERT INTO `invtbl` VALUES ('742', '101001', 'Black', '413484357356164', 'B107', '2016-10-19', '10:55 PM', '1-0082-MFC', 'On Hand', '');
INSERT INTO `invtbl` VALUES ('743', '101001', 'Black', '416732752476202', 'B107', '2016-10-19', '10:55 PM', '1-0082-MFC', 'On Hand', '');
INSERT INTO `invtbl` VALUES ('744', '101001', 'Black', '425420317168249', 'B107', '2016-10-19', '10:55 PM', '1-0082-MFC', 'On Hand', '');
INSERT INTO `invtbl` VALUES ('745', '101001', 'Black', '432094364818289', 'B107', '2016-10-19', '10:55 PM', '1-0082-MFC', 'On Hand', '');
INSERT INTO `invtbl` VALUES ('746', '101001', 'Black', '437623040724010', 'B107', '2016-10-19', '10:55 PM', '1-0082-MFC', 'On Hand', '');
INSERT INTO `invtbl` VALUES ('747', '101001', 'Black', '442265278983033', 'B107', '2016-10-19', '10:55 PM', '1-0082-MFC', 'On Hand', '');
INSERT INTO `invtbl` VALUES ('748', '101001', 'Black', '445515160187604', 'B107', '2016-10-19', '10:55 PM', '1-0082-MFC', 'On Hand', '');
INSERT INTO `invtbl` VALUES ('749', '101001', 'Black', '447845139601352', 'B107', '2016-10-19', '10:55 PM', '1-0082-MFC', 'On Hand', '');
INSERT INTO `invtbl` VALUES ('750', '101001', 'Black', '451111079806508', 'B107', '2016-10-19', '10:55 PM', '1-0082-MFC', 'On Hand', '');
INSERT INTO `invtbl` VALUES ('751', '101001', 'Black', '453608160571739', 'B107', '2016-10-19', '10:55 PM', '1-0082-MFC', 'On Hand', '');
INSERT INTO `invtbl` VALUES ('752', '101006', 'RoseGold', '460512539690315', 'B107', '2016-10-19', '10:56 PM', '1-0082-MFC', 'On Hand', '');
INSERT INTO `invtbl` VALUES ('753', '101006', 'RoseGold', '467822175420566', 'B107', '2016-10-19', '10:56 PM', '1-0082-MFC', 'On Hand', '');
INSERT INTO `invtbl` VALUES ('754', '101006', 'RoseGold', '408044897827035', 'B107', '2016-10-19', '10:56 PM', '1-0082-MFC', 'On Hand', '');
INSERT INTO `invtbl` VALUES ('755', '101006', 'RoseGold', '413708316572534', 'B107', '2016-10-19', '10:56 PM', '1-0082-MFC', 'On Hand', '');
INSERT INTO `invtbl` VALUES ('756', '101006', 'RoseGold', '417574696659810', 'B107', '2016-10-19', '10:56 PM', '1-0082-MFC', 'On Hand', '');
INSERT INTO `invtbl` VALUES ('757', '101006', 'RoseGold', '426361950024888', 'B107', '2016-10-19', '10:56 PM', '1-0082-MFC', 'On Hand', '');
INSERT INTO `invtbl` VALUES ('758', '101006', 'RoseGold', '434508341733621', 'B107', '2016-10-19', '10:56 PM', '1-0082-MFC', 'On Hand', '');
INSERT INTO `invtbl` VALUES ('759', '101006', 'RoseGold', '438593324524572', 'B107', '2016-10-19', '10:56 PM', '1-0082-MFC', 'On Hand', '');
INSERT INTO `invtbl` VALUES ('760', '101006', 'RoseGold', '443274070514095', 'B107', '2016-10-19', '10:56 PM', '1-0082-MFC', 'On Hand', '');
INSERT INTO `invtbl` VALUES ('761', '101006', 'RoseGold', '445721456348217', 'B107', '2016-10-19', '10:56 PM', '1-0082-MFC', 'On Hand', '');
INSERT INTO `invtbl` VALUES ('762', '101006', 'RoseGold', '449703560551275', 'B107', '2016-10-19', '10:56 PM', '1-0082-MFC', 'On Hand', '');
INSERT INTO `invtbl` VALUES ('763', '101006', 'RoseGold', '451466630319054', 'B107', '2016-10-19', '10:56 PM', '1-0082-MFC', 'On Hand', '');
INSERT INTO `invtbl` VALUES ('764', '101006', 'RoseGold', '456607708029478', 'B107', '2016-10-19', '10:56 PM', '1-0082-MFC', 'On Hand', '');
INSERT INTO `invtbl` VALUES ('765', '101006', 'RoseGold', '462772183247168', 'B107', '2016-10-19', '10:56 PM', '1-0082-MFC', 'On Hand', '');
INSERT INTO `invtbl` VALUES ('766', '101006', 'RoseGold', '467928559008920', 'B107', '2016-10-19', '10:56 PM', '1-0082-MFC', 'On Hand', '');
INSERT INTO `invtbl` VALUES ('767', '101006', 'RoseGold', '468572090951494', 'B107', '2016-10-19', '10:56 PM', '1-0082-MFC', 'On Hand', '');
INSERT INTO `invtbl` VALUES ('768', '101006', 'RoseGold', '471801593570917', 'B107', '2016-10-19', '10:56 PM', '1-0082-MFC', 'On Hand', '');
INSERT INTO `invtbl` VALUES ('769', '101006', 'RoseGold', '479897397606478', 'B107', '2016-10-19', '10:56 PM', '1-0082-MFC', 'On Hand', '');
INSERT INTO `invtbl` VALUES ('770', '101006', 'RoseGold', '484874266973633', 'B107', '2016-10-19', '10:56 PM', '1-0082-MFC', 'On Hand', '');
INSERT INTO `invtbl` VALUES ('771', '101006', 'RoseGold', '488600995861893', 'B107', '2016-10-19', '10:56 PM', '1-0082-MFC', 'On Hand', '');
INSERT INTO `invtbl` VALUES ('772', '101006', 'RoseGold', '491439614083941', 'B107', '2016-10-19', '10:56 PM', '1-0082-MFC', 'On Hand', '');
INSERT INTO `invtbl` VALUES ('773', '101006', 'RoseGold', '492655299730528', 'B107', '2016-10-19', '10:56 PM', '1-0082-MFC', 'On Hand', '');
INSERT INTO `invtbl` VALUES ('774', '101006', 'RoseGold', '499191316595969', 'B107', '2016-10-19', '10:56 PM', '1-0082-MFC', 'On Hand', '');
INSERT INTO `invtbl` VALUES ('775', '101006', 'RoseGold', '501221112612571', 'B107', '2016-10-19', '10:56 PM', '1-0082-MFC', 'On Hand', '');
INSERT INTO `invtbl` VALUES ('776', '101006', 'RoseGold', '502121679987643', 'B107', '2016-10-19', '10:56 PM', '1-0082-MFC', 'On Hand', '');
INSERT INTO `invtbl` VALUES ('777', '101006', 'RoseGold', '507316813545030', 'B107', '2016-10-19', '10:56 PM', '1-0082-MFC', 'On Hand', '');
INSERT INTO `invtbl` VALUES ('778', '101006', 'RoseGold', '509969743536857', 'B107', '2016-10-19', '10:56 PM', '1-0082-MFC', 'On Hand', '');
INSERT INTO `invtbl` VALUES ('779', '101006', 'RoseGold', '515938560113696', 'B107', '2016-10-19', '10:56 PM', '1-0082-MFC', 'On Hand', '');
INSERT INTO `invtbl` VALUES ('780', '101006', 'RoseGold', '471388049770485', 'B107', '2016-10-19', '10:56 PM', '1-0082-MFC', 'On Hand', '');
INSERT INTO `invtbl` VALUES ('781', '101006', 'RoseGold', '475694433906363', 'B107', '2016-10-19', '10:56 PM', '1-0082-MFC', 'On Hand', '');

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
INSERT INTO `itemstbl` VALUES ('38', '1', '04', '104001', 'F1s', 'F1s', 'BR-004', 'Unit', '12000', '11500', '20');
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
INSERT INTO `purchaserequestsitemstbl` VALUES ('385', 'PR-B107-1016001', '101001', '30', 'White', '2016-10-19', '296962322', '', '0');
INSERT INTO `purchaserequestsitemstbl` VALUES ('386', 'PR-B107-1016001', '101002', '20', 'White', '2016-10-19', '296962322', '', '0');
INSERT INTO `purchaserequestsitemstbl` VALUES ('387', 'PR-B107-1016002', '101001', '30', 'Black', '2016-10-19', '1167581320', 'Ship to Branch', '30');
INSERT INTO `purchaserequestsitemstbl` VALUES ('388', 'PR-B107-1016003', '101001', '30', 'Black', '2016-10-19', '287624425', 'Ship to Branch', '30');
INSERT INTO `purchaserequestsitemstbl` VALUES ('389', 'PR-B107-1016003', '101002', '30', 'White', '2016-10-19', '287624425', 'Ship to Branch', '30');
INSERT INTO `purchaserequestsitemstbl` VALUES ('390', 'PR-B107-1016003', '101006', '30', 'RoseGold', '2016-10-19', '287624425', 'Ship to Branch', '30');
INSERT INTO `purchaserequestsitemstbl` VALUES ('391', 'PR-B107-1016003', '101006', '30', 'White', '2016-10-19', '287624425', 'Ship to Branch', '30');
INSERT INTO `purchaserequestsitemstbl` VALUES ('392', 'PR-B107-1016003', '101003', '30', 'White', '2016-10-19', '287624425', 'Ship to Branch', '30');
INSERT INTO `purchaserequestsitemstbl` VALUES ('393', 'PR-B107-1016003', '101007', '30', 'Black', '2016-10-19', '287624425', 'Ship to Branch', '30');

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
INSERT INTO `purchaserequeststbl` VALUES ('242', 'PR-B107-1016001', '2016-10-19', 'B107', 'BR-001', 'Rejected', 'Waiting for Approval from Brand Coordinator', '1-0082-MFC', '0', '1-0086-RRG', '1', '0', '1-0083-BDP', '', '', '1-0082-MFC', '08:59 PM', '2016-10-19', '296962322', '', '', '', '');
INSERT INTO `purchaserequeststbl` VALUES ('243', 'PR-B107-1016002', '2016-10-19', 'B107', 'BR-001', 'Completed', 'Already Shipped', '1-0083-BDP', '0', '', '1', '1', '', '1-0086-RRG', '', '1-0083-BDP', '08:59 PM', '2016-10-19', '1167581320', '2016-10-19', '10:13 PM', '', '');
INSERT INTO `purchaserequeststbl` VALUES ('244', 'PR-B107-1016003', '2016-10-19', 'B107', 'BR-001', 'Completed', 'Already Shipped', '1-0082-MFC', '0', '', '1', '1', '1-0083-BDP', '1-0086-RRG', '', '1-0082-MFC', '10:24 PM', '2016-10-19', '287624425', '2016-10-19', '10:25 PM', '', '');

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
INSERT INTO `transactiontbl` VALUES ('72', 'B1071019-0001', '236966', '2016-10-19', '10:59 PM', 'Mark Joseph', '1-0087-RGM', '1-0082-MFC', 'B107', 'Cash CreditCard', 'Active');
INSERT INTO `transactiontbl` VALUES ('73', 'B1071020-0001', '12345', '2016-10-20', '11:30 AM', 'M', '1-0087-RGM', '1-0082-MFC', 'B107', 'Cash', 'Active');
INSERT INTO `transactiontbl` VALUES ('74', 'B1071020-0002', '1234', '2016-10-20', '12:23 PM', 'Qq', '1-0087-RGM', '1-0082-MFC', 'B107', 'Cash', 'Active');
INSERT INTO `transactiontbl` VALUES ('75', 'B1071020-0003', '432', '2016-10-20', '04:20 PM', 'Mark', '1-0087-RGM', '1-0082-MFC', 'B107', 'Credit Card', 'Active');
