/*
Navicat MySQL Data Transfer

Source Server         : db
Source Server Version : 50625
Source Host           : localhost:3306
Source Database       : campusrecruitmentsystem

Target Server Type    : MYSQL
Target Server Version : 50625
File Encoding         : 65001

Date: 2021-01-06 18:25:27
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for `cmt_m_state`
-- ----------------------------
DROP TABLE IF EXISTS `cmt_m_state`;
CREATE TABLE `cmt_m_state` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `stateId` int(11) NOT NULL,
  `stateName` varchar(50) NOT NULL,
  `countryId` int(11) NOT NULL,
  `created_by` varchar(50) NOT NULL,
  `created_date_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_by` varchar(50) DEFAULT NULL,
  `updated_date_time` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `delFlag` int(5) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of cmt_m_state
-- ----------------------------
INSERT INTO cmt_m_state VALUES ('1', '1', 'Tamil Nadu', '1', 'Ragav', '2020-06-08 16:59:24', null, null, '0');
INSERT INTO cmt_m_state VALUES ('2', '2', 'Osaka', '2', 'Ragav', '2020-06-08 17:18:12', null, null, '0');
INSERT INTO cmt_m_state VALUES ('3', '3', 'New York', '3', 'Ragav', '2020-06-08 17:00:14', null, null, '0');
INSERT INTO cmt_m_state VALUES ('4', '4', 'Maharashtra', '1', 'Ragav', '2020-06-08 17:10:56', null, null, '0');
INSERT INTO cmt_m_state VALUES ('5', '5', 'Delhi', '1', 'ragav', '2020-06-08 17:11:15', null, null, '0');
INSERT INTO cmt_m_state VALUES ('6', '6', 'Karnataka', '1', 'ragav', '2020-06-08 17:11:32', null, null, '0');
INSERT INTO cmt_m_state VALUES ('7', '7', 'Andhra Pradesh', '1', 'ragav', '2020-06-08 17:11:49', null, null, '0');
INSERT INTO cmt_m_state VALUES ('8', '8', 'Kerala', '1', 'ragav', '2020-06-08 17:12:22', null, null, '0');
INSERT INTO cmt_m_state VALUES ('9', '9', 'Akita', '2', 'ragav', '2020-06-08 17:17:00', null, null, '0');
INSERT INTO cmt_m_state VALUES ('10', '10', 'Chiba', '2', 'ragav', '2020-06-08 17:17:17', null, null, '0');
INSERT INTO cmt_m_state VALUES ('11', '11', 'Fukui', '2', 'ragav', '2020-06-08 17:17:56', null, null, '0');
INSERT INTO cmt_m_state VALUES ('12', '12', 'Tokyo', '2', 'ragav', '2020-06-08 17:18:45', null, null, '0');
