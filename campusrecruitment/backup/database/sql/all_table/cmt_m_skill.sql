/*
Navicat MySQL Data Transfer

Source Server         : db
Source Server Version : 50625
Source Host           : localhost:3306
Source Database       : campusrecruitmentsystem

Target Server Type    : MYSQL
Target Server Version : 50625
File Encoding         : 65001

Date: 2021-01-06 18:25:23
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for `cmt_m_skill`
-- ----------------------------
DROP TABLE IF EXISTS `cmt_m_skill`;
CREATE TABLE `cmt_m_skill` (
  `skillId` int(10) NOT NULL AUTO_INCREMENT,
  `skillName` varchar(50) NOT NULL,
  `created_by` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_by` varchar(50) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `delFlag` int(5) NOT NULL,
  PRIMARY KEY (`skillId`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of cmt_m_skill
-- ----------------------------
INSERT INTO cmt_m_skill VALUES ('1', 'C', 'CR0001', '2020-11-04 17:57:20', null, null, '0');
INSERT INTO cmt_m_skill VALUES ('2', 'C++', 'CR0001', '2020-11-04 17:58:08', null, null, '0');
INSERT INTO cmt_m_skill VALUES ('3', 'Java', 'CR0001', '2020-11-04 17:58:45', null, null, '0');
INSERT INTO cmt_m_skill VALUES ('4', 'PHP', 'CR0001', '2020-11-04 17:59:09', null, null, '0');
