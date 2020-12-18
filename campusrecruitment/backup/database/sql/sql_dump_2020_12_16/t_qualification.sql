/*
Navicat MySQL Data Transfer

Source Server         : demo
Source Server Version : 50625
Source Host           : localhost:3306
Source Database       : campusrecruitment

Target Server Type    : MYSQL
Target Server Version : 50625
File Encoding         : 65001

Date: 2020-12-18 09:15:08
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
  `created_date_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` varchar(50) NOT NULL,
  `updated_date_time` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` varchar(50) DEFAULT NULL,
  `delFlag` int(5) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_qualification
-- ----------------------------
INSERT INTO t_qualification VALUES ('1', 'JS0006', '405', '841', '0', '0', '0', '2019', '0', '8', '0', 'Sri Paramakalyani College', '0', '', '2020-12-17 07:29:53', 'JS0006', '2020-12-17 07:29:53', null, '0');
INSERT INTO t_qualification VALUES ('2', 'JS0001', '81', '70', '1', '1', '6', '2019', '5', '7', '4', 'Sri Paramakalyani College', '3', 'PHP', '2020-12-17 17:27:57', 'JS0001', '2020-12-17 17:27:57', 'JS0001', '0');
INSERT INTO t_qualification VALUES ('3', 'JS0001', '78', '67', '2', '7', '1', '2016', '3', '8', '2', 'Parasakthi Arts and Science College', '4', 'Python', '2020-12-18 08:42:22', 'JS0001', null, null, '0');
