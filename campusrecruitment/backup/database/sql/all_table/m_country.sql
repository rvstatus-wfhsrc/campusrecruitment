/*
Navicat MySQL Data Transfer

Source Server         : db
Source Server Version : 50625
Source Host           : localhost:3306
Source Database       : campusrecruitmentsystem

Target Server Type    : MYSQL
Target Server Version : 50625
File Encoding         : 65001

Date: 2021-01-06 10:26:34
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for `m_country`
-- ----------------------------
DROP TABLE IF EXISTS `m_country`;
CREATE TABLE `m_country` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `countryId` int(11) NOT NULL,
  `countryName` varchar(50) NOT NULL,
  `created_by` varchar(50) NOT NULL,
  `created_date_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_by` varchar(50) DEFAULT NULL,
  `updated_date_time` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `delFlag` int(5) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of m_country
-- ----------------------------
INSERT INTO m_country VALUES ('1', '1', 'India', 'Ragav', '2020-06-08 16:56:10', null, '2020-12-09 17:39:27', '0');
INSERT INTO m_country VALUES ('2', '2', 'Japan', 'Ragav', '2020-06-08 16:57:24', null, null, '0');
INSERT INTO m_country VALUES ('3', '3', 'America', 'Ragav', '2020-06-08 16:57:25', null, null, '0');
INSERT INTO m_country VALUES ('4', '4', 'Russia', 'Ragav', '2020-06-08 17:07:53', null, null, '0');
INSERT INTO m_country VALUES ('5', '5', 'Canada', 'Ragav', '2020-06-08 17:08:32', null, null, '0');
