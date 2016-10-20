/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50624
Source Host           : 127.0.0.1:3306
Source Database       : bec_db

Target Server Type    : MYSQL
Target Server Version : 50624
File Encoding         : 65001

Date: 2016-10-19 15:51:16
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for itemstbl
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
  PRIMARY KEY (`_count`)
) ENGINE=InnoDB AUTO_INCREMENT=59 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of itemstbl
-- ----------------------------
INSERT INTO `itemstbl` VALUES ('35', '1', '01', '101001', 'Flare S3', 'Flare S3', 'BR-001', 'Unit', '12000', '11500');
INSERT INTO `itemstbl` VALUES ('36', '1', '01', '101002', 'Flare S4', 'Flare S4', 'BR-001', 'Unit', '13000', '12500');
INSERT INTO `itemstbl` VALUES ('37', '1', '02', '102001', 'T2 DTV', 'T2 DTV', 'BR-002', 'Unit', '3000', '2500');
INSERT INTO `itemstbl` VALUES ('38', '1', '04', '104001', 'F1s', 'F1s', 'BR-004', 'Unit', '12000', '11500');
INSERT INTO `itemstbl` VALUES ('39', '1', '01', '101003', 'Revel', 'Revel', 'BR-001', 'Unit', '5000', '4500');
INSERT INTO `itemstbl` VALUES ('40', '1', '01', '101004', 'Zoom', 'Zoom', 'BR-001', 'Unit', '6000', '5500');
INSERT INTO `itemstbl` VALUES ('41', '1', '01', '101005', 'Selfie', 'Selfie', 'BR-001', 'Unit', '7000', '6500');
INSERT INTO `itemstbl` VALUES ('42', '1', '01', '101006', 'M1', 'M1', 'BR-001', 'Unit', '4000', '3500');
INSERT INTO `itemstbl` VALUES ('43', '1', '01', '101007', 'Spin 2', 'Spin 2', 'BR-001', 'Unit', '6500', '6000');
INSERT INTO `itemstbl` VALUES ('44', '1', '01', '101008', 'Flare HD 2', 'Flare HD 2', 'BR-001', 'Unit', '11000', '10500');
INSERT INTO `itemstbl` VALUES ('45', '1', '01', '101009', 'Maia Fone I4', 'Maia Fone I4', 'BR-001', 'Unit', '7000', '6500');
INSERT INTO `itemstbl` VALUES ('46', '1', '01', '101010', 'Aura 2', 'Aura 2', 'BR-001', 'Unit', '7000', '6500');
INSERT INTO `itemstbl` VALUES ('47', '1', '01', '101011', 'Radar LTE', 'Radar LTE', 'BR-001', 'Unit', '9000', '8500');
INSERT INTO `itemstbl` VALUES ('48', '1', '01', '101012', 'Flare J1', 'Flare J1', 'BR-001', 'Unit', '3999', '3499');
INSERT INTO `itemstbl` VALUES ('49', '1', '01', '101013', 'Flare S4 Plus', 'Flare S4 Plus', 'BR-001', 'Unit', '5999', '5499');
INSERT INTO `itemstbl` VALUES ('50', '1', '01', '101014', 'Flare J2', 'Flare J2', 'BR-001', 'Unit', '3000', '2500');
INSERT INTO `itemstbl` VALUES ('51', '1', '01', '101015', 'Flare XL Plus', 'Flare XL Plus', 'BR-001', 'Unit', '3900', '3400');
INSERT INTO `itemstbl` VALUES ('52', '1', '01', '101016', 'Flare S3 Octa', 'Flare S3 Octa', 'BR-001', 'Unit', '3999', '3499');
INSERT INTO `itemstbl` VALUES ('53', '1', '02', '102002', 'My28s', 'My28s', 'BR-002', 'Unit', '988', '488');
INSERT INTO `itemstbl` VALUES ('54', '1', '02', '102003', 'My33', 'My33', 'BR-002', 'Unit', '3999', '3499');
INSERT INTO `itemstbl` VALUES ('55', '1', '02', '102004', 'My32', 'My32', 'BR-002', 'Unit', '3499', '2999');
INSERT INTO `itemstbl` VALUES ('56', '1', '02', '102005', 'My36', 'My36', 'BR-002', 'Unit', '6499', '5999');
INSERT INTO `itemstbl` VALUES ('57', '1', '03', '103001', 'F1', 'F1', 'BR-003', 'Unit', '93000', '8800');
INSERT INTO `itemstbl` VALUES ('58', '1', '03', '103002', 'F1 Plus', 'F1 Plus', 'BR-003', 'Unit', '14999', '14499');
