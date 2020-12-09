/*
Navicat MySQL Data Transfer

Source Server         : demo
Source Server Version : 50625
Source Host           : localhost:3306
Source Database       : campusrecruitment

Target Server Type    : MYSQL
Target Server Version : 50625
File Encoding         : 65001

Date: 2020-12-09 17:28:03
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for `m_designation`
-- ----------------------------
DROP TABLE IF EXISTS `m_designation`;
CREATE TABLE `m_designation` (
  `designationId` int(10) NOT NULL AUTO_INCREMENT,
  `designationName` varchar(50) NOT NULL,
  `created_by` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_by` varchar(50) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `delFlag` int(5) NOT NULL,
  PRIMARY KEY (`designationId`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of m_designation
-- ----------------------------
INSERT INTO m_designation VALUES ('1', 'Finance', 'CR0001', '2020-11-04 17:57:20', null, null, '0');
INSERT INTO m_designation VALUES ('2', 'IT & Engineering', 'CR0001', '2020-11-04 17:58:08', null, null, '0');
INSERT INTO m_designation VALUES ('3', 'Education/Training', 'CR0001', '2020-11-04 17:58:45', null, null, '0');
INSERT INTO m_designation VALUES ('4', 'Art/Design', 'CR0001', '2020-11-04 17:59:09', null, null, '0');
INSERT INTO m_designation VALUES ('5', 'Sale/Markting', 'CR0001', '2020-12-09 11:44:47', null, null, '0');
