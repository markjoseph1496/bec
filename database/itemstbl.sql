/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50624
Source Host           : 127.0.0.1:3306
Source Database       : bec_db

Target Server Type    : MYSQL
Target Server Version : 50624
File Encoding         : 65001

Date: 2016-10-04 14:20:39
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for itemstbl
-- ----------------------------
DROP TABLE IF EXISTS `itemstbl`;
CREATE TABLE `itemstbl` (
  `_count` int(6) NOT NULL AUTO_INCREMENT,
  `CategoryID` varchar(15) NOT NULL,
  `BrandID` varchar(15) NOT NULL,
  `ItemCode` varchar(11) NOT NULL,
  `ModelName` varchar(20) NOT NULL,
  `ItemDescription` varchar(100) NOT NULL,
  `SRP` int(7) NOT NULL,
  `DP` int(7) NOT NULL,
  PRIMARY KEY (`_count`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of itemstbl
-- ----------------------------
INSERT INTO `itemstbl` VALUES ('1', 'CT-001', 'BR-001', '1010001', 'FLARE S3', 'FLARE S3', '14000', '3000');
