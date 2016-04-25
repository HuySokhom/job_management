/*
Navicat MySQL Data Transfer

Source Server         : MySQL
Source Server Version : 50617
Source Host           : localhost:3306
Source Database       : job

Target Server Type    : MYSQL
Target Server Version : 50617
File Encoding         : 65001

Date: 2016-04-08 11:58:39
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `category`
-- ----------------------------
DROP TABLE IF EXISTS `category`;
CREATE TABLE `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(127) DEFAULT NULL,
  `description` varchar(550) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of category
-- ----------------------------
INSERT INTO `category` VALUES ('1', 'It', 'it job');
INSERT INTO `category` VALUES ('2', 'Account', 'Account Job');
INSERT INTO `category` VALUES ('3', 'Marketing', 'description with marketing \nOOO');
INSERT INTO `category` VALUES ('5', 'Test Category', 'MOMO\nMOMO\nsagsadg');
INSERT INTO `category` VALUES ('7', 'asdgasg', '34qgg\nsa\ndg\nawgsd');

-- ----------------------------
-- Table structure for `job`
-- ----------------------------
DROP TABLE IF EXISTS `job`;
CREATE TABLE `job` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(127) DEFAULT NULL,
  `id_category` int(11) DEFAULT NULL,
  `description` varchar(550) DEFAULT NULL,
  `post_date` datetime DEFAULT NULL,
  `closing_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of job
-- ----------------------------
INSERT INTO `job` VALUES ('1', 'Programmer 12', '3', 'angular js 123c12ec', '2016-04-01 00:00:00', '2016-04-30 00:00:00');
INSERT INTO `job` VALUES ('2', 'Accountant', '2', 'account ', '2016-04-08 11:22:07', '2016-04-29 11:22:11');
INSERT INTO `job` VALUES ('3', 'Maketing 123', '5', 'dsmv,sdva\ngd\nasd\ngwrgr', '2016-04-08 11:22:24', '2016-04-30 11:22:27');
