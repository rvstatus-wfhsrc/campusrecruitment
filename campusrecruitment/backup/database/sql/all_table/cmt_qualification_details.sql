/*
Navicat MySQL Data Transfer

Source Server         : db
Source Server Version : 50625
Source Host           : localhost:3306
Source Database       : campusrecruitmentsystem

Target Server Type    : MYSQL
Target Server Version : 50625
File Encoding         : 65001

Date: 2021-01-06 18:25:37
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for `cmt_qualification_details`
-- ----------------------------
DROP TABLE IF EXISTS `cmt_qualification_details`;
CREATE TABLE `cmt_qualification_details` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `jobSeekerId` varchar(50) NOT NULL,
  `tenthMark` varchar(10) NOT NULL,
  `twelvethMark` varchar(10) NOT NULL,
  `specification` int(10) NOT NULL,
  `qualification` int(10) NOT NULL,
  `branch` int(10) NOT NULL,
  `yearOfPassing` int(10) NOT NULL,
  `monthOfPassing` int(10) NOT NULL,
  `CGPA` varchar(10) NOT NULL,
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
-- Records of cmt_qualification_details
-- ----------------------------
