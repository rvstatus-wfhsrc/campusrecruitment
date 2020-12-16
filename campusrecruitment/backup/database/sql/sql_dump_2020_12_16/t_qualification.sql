/*
Navicat MySQL Data Transfer

Source Server         : demo
Source Server Version : 50625
Source Host           : localhost:3306
Source Database       : campusrecruitment

Target Server Type    : MYSQL
Target Server Version : 50625
File Encoding         : 65001

Date: 2020-12-16 17:57:48
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for `t_qualification`
-- ----------------------------
DROP TABLE IF EXISTS `t_qualification`;
CREATE TABLE `t_qualification` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `jobSeekerId` int(10) NOT NULL,
  `tenthMark` int(10) NOT NULL,
  `twelvethMark` int(10) NOT NULL,
  `qualification` varchar(100) NOT NULL,
  `yearOfPassing` int(10) NOT NULL,
  `CGPA` varchar(30) DEFAULT NULL,
  `collegeName` varchar(100) DEFAULT NULL,
  `skill` varchar(200) NOT NULL,
  `extraSkill` varchar(200) DEFAULT NULL,
  `created_date_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` varchar(50) NOT NULL,
  `updated_date_time` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` varchar(50) DEFAULT NULL,
  `delFlag` int(5) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_qualification
-- ----------------------------
INSERT INTO t_qualification VALUES ('1', '0', '405', '841', 'BCA', '2019', '7.9', 'Sri Paramakalyani College', 'General Knowledge', '', '2020-12-16 17:34:59', 'JS0006', null, null, '0');
