/*
Navicat MySQL Data Transfer

Source Server         : db
Source Server Version : 50625
Source Host           : localhost:3306
Source Database       : campusrecruitmentsystem

Target Server Type    : MYSQL
Target Server Version : 50625
File Encoding         : 65001

Date: 2021-01-06 18:24:58
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for `cmt_m_department`
-- ----------------------------
DROP TABLE IF EXISTS `cmt_m_department`;
CREATE TABLE `cmt_m_department` (
  `departmentId` int(10) NOT NULL AUTO_INCREMENT,
  `departmentName` varchar(50) NOT NULL,
  `created_by` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_by` varchar(50) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `delFlag` int(5) NOT NULL,
  PRIMARY KEY (`departmentId`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of cmt_m_department
-- ----------------------------
INSERT INTO cmt_m_department VALUES ('1', 'Computer Science', 'CR0001', '2020-11-04 17:57:20', null, null, '0');
INSERT INTO cmt_m_department VALUES ('2', 'Chemistry', 'CR0001', '2020-11-04 17:58:08', null, null, '0');
INSERT INTO cmt_m_department VALUES ('3', 'Mechanical Engineering', 'CR0001', '2020-11-04 17:58:45', null, null, '0');
INSERT INTO cmt_m_department VALUES ('4', 'Physics', 'CR0001', '2020-11-04 17:59:09', null, null, '0');
INSERT INTO cmt_m_department VALUES ('5', 'Maths', 'CR0001', '2020-12-09 11:44:47', null, null, '0');
INSERT INTO cmt_m_department VALUES ('6', 'EEE', 'CR0001', '2020-12-18 13:07:05', null, null, '0');
INSERT INTO cmt_m_department VALUES ('7', 'Civil Engineering', 'CR0001', '2020-12-18 13:07:13', null, null, '0');
INSERT INTO cmt_m_department VALUES ('8', 'English', 'CR0001', '2020-12-18 13:07:18', null, null, '0');
INSERT INTO cmt_m_department VALUES ('9', 'ECE', 'CR0001', '2020-12-18 13:08:06', null, null, '0');
INSERT INTO cmt_m_department VALUES ('10', 'CSE', 'CR0001', '2020-12-18 13:08:52', null, null, '0');
