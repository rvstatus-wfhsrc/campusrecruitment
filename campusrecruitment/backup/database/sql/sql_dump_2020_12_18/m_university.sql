/*
Navicat MySQL Data Transfer

Source Server         : demo
Source Server Version : 50625
Source Host           : localhost:3306
Source Database       : campusrecruitment

Target Server Type    : MYSQL
Target Server Version : 50625
File Encoding         : 65001

Date: 2020-12-21 08:44:37
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for `m_university`
-- ----------------------------
DROP TABLE IF EXISTS `m_university`;
CREATE TABLE `m_university` (
  `universityId` int(10) NOT NULL AUTO_INCREMENT,
  `universityName` varchar(50) NOT NULL,
  `created_by` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_by` varchar(50) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `delFlag` int(5) NOT NULL,
  PRIMARY KEY (`universityId`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of m_university
-- ----------------------------
INSERT INTO m_university VALUES ('1', 'Anna University', 'CR0001', '2020-11-04 17:57:20', null, null, '0');
INSERT INTO m_university VALUES ('2', 'Kamaraj University', 'CR0001', '2020-11-04 17:58:08', null, null, '0');
INSERT INTO m_university VALUES ('3', 'University of Madras', 'CR0001', '2020-11-04 17:58:45', null, null, '0');
INSERT INTO m_university VALUES ('4', 'M.S. University', 'CR0001', '2020-11-04 17:59:09', null, null, '0');
INSERT INTO m_university VALUES ('5', 'VOC University', 'CR0001', '2020-12-09 11:44:47', null, null, '0');
INSERT INTO m_university VALUES ('6', 'Alagappa University', 'CR0001', '2020-12-18 13:07:05', null, null, '0');
INSERT INTO m_university VALUES ('7', 'Sathyabama Institute', 'CR0001', '2020-12-18 13:07:13', null, null, '0');
INSERT INTO m_university VALUES ('8', 'SRM Institute', 'CR0001', '2020-12-18 13:07:18', null, null, '0');
INSERT INTO m_university VALUES ('9', 'Thiruvalluvar University', 'CR0001', '2020-12-18 13:08:06', null, null, '0');
INSERT INTO m_university VALUES ('10', 'Vels University', 'CR0001', '2020-12-18 13:08:52', null, null, '0');
