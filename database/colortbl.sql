/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50624
Source Host           : 127.0.0.1:3306
Source Database       : bec_db

Target Server Type    : MYSQL
Target Server Version : 50624
File Encoding         : 65001

Date: 2016-09-29 11:50:22
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for colortbl
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
