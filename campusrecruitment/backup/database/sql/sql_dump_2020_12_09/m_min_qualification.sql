/*
Navicat MySQL Data Transfer

Source Server         : demo
Source Server Version : 50625
Source Host           : localhost:3306
Source Database       : campusrecruitment

Target Server Type    : MYSQL
Target Server Version : 50625
File Encoding         : 65001

Date: 2020-12-09 17:27:20
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for `m_min_qualification`
-- ----------------------------
DROP TABLE IF EXISTS `m_min_qualification`;
CREATE TABLE `m_min_qualification` (
  `minQualificationId` int(10) NOT NULL AUTO_INCREMENT,
  `minQualification` varchar(50) NOT NULL,
  `created_by` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_by` varchar(50) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `delFlag` int(5) NOT NULL,
  PRIMARY KEY (`minQualificationId`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of m_min_qualification
-- ----------------------------
INSERT INTO m_min_qualification VALUES ('1', '+2', 'CR0001', '2020-11-04 17:57:20', null, '2020-12-02 12:07:52', '0');
INSERT INTO m_min_qualification VALUES ('2', 'BE', 'CR0001', '2020-11-04 17:58:08', null, '2020-12-02 12:07:59', '0');
INSERT INTO m_min_qualification VALUES ('3', 'Any Degree', 'CR0001', '2020-11-04 17:58:45', null, '2020-12-02 12:08:20', '0');
INSERT INTO m_min_qualification VALUES ('4', 'MCA', 'CR0001', '2020-11-04 17:59:09', null, '2020-12-02 12:08:35', '0');
