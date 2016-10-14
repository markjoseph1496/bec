/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50624
Source Host           : 127.0.0.1:3306
Source Database       : bec_db

Target Server Type    : MYSQL
Target Server Version : 50624
File Encoding         : 65001

Date: 2016-10-06 10:55:09
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for categorytbl
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
