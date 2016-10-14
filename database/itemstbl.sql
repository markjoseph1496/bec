/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50624
Source Host           : 127.0.0.1:3306
Source Database       : bec_db

Target Server Type    : MYSQL
Target Server Version : 50624
File Encoding         : 65001

Date: 2016-10-12 13:04:04
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for itemstbl
-- ----------------------------
DROP TABLE IF EXISTS `itemstbl`;
CREATE TABLE `itemstbl` (
  `_count` int(6) NOT NULL AUTO_INCREMENT,
  `CategoryCode` varchar(15) NOT NULL,
  `BrandCode` varchar(15) NOT NULL,
  `ItemCode` varchar(11) NOT NULL,
  `ModelName` varchar(20) NOT NULL,
  `ItemDescription` varchar(100) NOT NULL,
  `SRP` int(7) NOT NULL,
  `DP` int(7) NOT NULL,
  PRIMARY KEY (`_count`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of itemstbl
-- ----------------------------
INSERT INTO `itemstbl` VALUES ('26', '1', '01', '101001', 'Flare S3', 'Flare S3', '8000', '7500');
INSERT INTO `itemstbl` VALUES ('27', '1', '01', '101002', 'Flare S4', 'Flare S4', '10000', '9000');
INSERT INTO `itemstbl` VALUES ('28', '1', '02', '102001', 'T2 DTV', 'T2 DTV', '3000', '2500');
INSERT INTO `itemstbl` VALUES ('29', '1', '04', '104001', 'F1s', 'F1s', '6000', '5500');
INSERT INTO `itemstbl` VALUES ('30', '1', '01', '101003', 'Revel', 'Revel', '5000', '4000');
INSERT INTO `itemstbl` VALUES ('31', '1', '01', '101004', 'Zoom', 'Zoom', '9000', '8000');
INSERT INTO `itemstbl` VALUES ('32', '1', '01', '101005', 'Selfie', 'Selfie', '8000', '7000');
INSERT INTO `itemstbl` VALUES ('33', '1', '01', '101006', 'M1', 'M1', '4000', '3500');
INSERT INTO `itemstbl` VALUES ('34', '1', '01', '101007', 'Spin 2', 'Spin 2', '4000', '3500');
INSERT INTO `itemstbl` VALUES ('35', '1', '01', '101008', 'Flare HD 2', 'Flare HD 2', '12000', '11000');
