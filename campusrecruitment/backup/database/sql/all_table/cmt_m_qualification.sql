/*
Navicat MySQL Data Transfer

Source Server         : db
Source Server Version : 50625
Source Host           : localhost:3306
Source Database       : campusrecruitmentsystem

Target Server Type    : MYSQL
Target Server Version : 50625
File Encoding         : 65001

Date: 2021-01-06 18:25:13
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for `cmt_m_qualification`
-- ----------------------------
DROP TABLE IF EXISTS `cmt_m_qualification`;
CREATE TABLE `cmt_m_qualification` (
  `qualificationId` int(10) NOT NULL AUTO_INCREMENT,
  `qualification` varchar(50) NOT NULL,
  `created_by` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_by` varchar(50) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `delFlag` int(5) NOT NULL,
  PRIMARY KEY (`qualificationId`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of cmt_m_qualification
-- ----------------------------
INSERT INTO cmt_m_qualification VALUES ('1', '+2', 'CR0001', '2020-11-04 17:57:20', null, null, '0');
INSERT INTO cmt_m_qualification VALUES ('2', 'BE', 'CR0001', '2020-11-04 17:58:08', null, null, '0');
INSERT INTO cmt_m_qualification VALUES ('3', 'Any Degree', 'CR0001', '2020-11-04 17:58:45', null, null, '0');
INSERT INTO cmt_m_qualification VALUES ('4', 'MCA', 'CR0001', '2020-11-04 17:59:09', null, null, '0');
INSERT INTO cmt_m_qualification VALUES ('5', 'BCA', 'CR0001', '2020-12-18 13:33:01', null, null, '0');
INSERT INTO cmt_m_qualification VALUES ('6', 'B.Sc', 'CR0001', '2020-12-18 13:33:08', null, null, '0');
INSERT INTO cmt_m_qualification VALUES ('7', 'B.COM', 'CR0001', '2020-12-18 13:33:15', null, null, '0');
INSERT INTO cmt_m_qualification VALUES ('8', 'B.A', 'CR0001', '2020-12-18 13:33:22', null, null, '0');
INSERT INTO cmt_m_qualification VALUES ('9', 'M.Sc', 'CR0001', '2020-12-18 13:33:40', null, null, '0');
INSERT INTO cmt_m_qualification VALUES ('10', 'M.A', 'CR0001', '2020-12-18 13:33:50', null, null, '0');
INSERT INTO cmt_m_qualification VALUES ('11', 'ME', 'CR0001', '2020-12-18 13:33:53', null, null, '0');
