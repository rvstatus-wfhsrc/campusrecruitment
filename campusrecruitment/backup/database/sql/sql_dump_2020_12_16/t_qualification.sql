/*
Navicat MySQL Data Transfer

Source Server         : demo
Source Server Version : 50625
Source Host           : localhost:3306
Source Database       : campusrecruitment

Target Server Type    : MYSQL
Target Server Version : 50625
File Encoding         : 65001

Date: 2020-12-21 08:40:14
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for `t_qualification`
-- ----------------------------
DROP TABLE IF EXISTS `t_qualification`;
CREATE TABLE `t_qualification` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `jobSeekerId` varchar(50) NOT NULL,
  `tenthMark` int(10) NOT NULL,
  `twelvethMark` int(10) NOT NULL,
  `specification` int(10) NOT NULL,
  `qualification` int(10) NOT NULL,
  `branch` int(10) NOT NULL,
  `yearOfPassing` int(10) NOT NULL,
  `monthOfPassing` int(10) NOT NULL,
  `CGPA` float(10,0) NOT NULL,
  `university` int(10) NOT NULL,
  `collegeName` varchar(100) NOT NULL,
  `skill` int(10) NOT NULL,
  `extraSkill` varchar(200) DEFAULT NULL,
  `created_date_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(50) NOT NULL,
  `updated_date_time` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` varchar(50) DEFAULT NULL,
  `delFlag` int(5) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_qualification
-- ----------------------------
