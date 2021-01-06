/*
Navicat MySQL Data Transfer

Source Server         : db
Source Server Version : 50625
Source Host           : localhost:3306
Source Database       : campusrecruitmentsystem

Target Server Type    : MYSQL
Target Server Version : 50625
File Encoding         : 65001

Date: 2021-01-06 18:25:18
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for `cmt_m_role`
-- ----------------------------
DROP TABLE IF EXISTS `cmt_m_role`;
CREATE TABLE `cmt_m_role` (
  `roleId` int(10) NOT NULL AUTO_INCREMENT,
  `roleName` varchar(50) NOT NULL,
  `created_by` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_by` varchar(50) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `delFlag` int(5) NOT NULL,
  PRIMARY KEY (`roleId`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of cmt_m_role
-- ----------------------------
INSERT INTO cmt_m_role VALUES ('1', 'TL', 'CR0001', '2020-11-04 17:57:20', null, null, '0');
INSERT INTO cmt_m_role VALUES ('2', 'Developer', 'CR0001', '2020-11-04 17:58:08', null, null, '0');
INSERT INTO cmt_m_role VALUES ('3', 'Programmer', 'CR0001', '2020-11-04 17:58:45', null, null, '0');
INSERT INTO cmt_m_role VALUES ('4', 'Tester', 'CR0001', '2020-11-04 17:59:09', null, null, '0');
