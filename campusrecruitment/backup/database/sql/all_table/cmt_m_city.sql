/*
Navicat MySQL Data Transfer

Source Server         : db
Source Server Version : 50625
Source Host           : localhost:3306
Source Database       : campusrecruitmentsystem

Target Server Type    : MYSQL
Target Server Version : 50625
File Encoding         : 65001

Date: 2021-01-06 18:24:48
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for `cmt_m_city`
-- ----------------------------
DROP TABLE IF EXISTS `cmt_m_city`;
CREATE TABLE `cmt_m_city` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cityId` int(11) NOT NULL,
  `cityName` varchar(50) NOT NULL,
  `stateId` int(11) NOT NULL,
  `created_by` varchar(50) NOT NULL,
  `created_date_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_by` varchar(50) DEFAULT NULL,
  `updated_date_time` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `delFlag` int(5) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of cmt_m_city
-- ----------------------------
INSERT INTO cmt_m_city VALUES ('1', '1', 'Madurai', '1', 'ragav', '2020-06-08 17:13:27', null, null, '0');
INSERT INTO cmt_m_city VALUES ('2', '2', 'Chennai', '1', 'ragav', '2020-06-08 17:13:48', null, null, '0');
INSERT INTO cmt_m_city VALUES ('3', '3', 'Tirunelveli', '1', 'ragav', '2020-06-08 17:14:03', null, null, '0');
INSERT INTO cmt_m_city VALUES ('4', '4', 'Tokyo City', '12', 'ragav', '2020-06-08 17:16:10', null, null, '0');
INSERT INTO cmt_m_city VALUES ('5', '5', 'Osaka City', '2', 'ragav', '2020-06-08 17:16:26', null, null, '0');
INSERT INTO cmt_m_city VALUES ('6', '6', 'Combatore', '1', 'ragav', '2020-06-08 17:17:38', null, null, '0');
INSERT INTO cmt_m_city VALUES ('7', '7', 'Thanjavur', '1', 'ragav', '2020-06-08 17:21:05', null, null, '0');
INSERT INTO cmt_m_city VALUES ('8', '8', 'Vellore', '1', 'ragav', '2020-06-08 17:21:23', null, null, '0');
INSERT INTO cmt_m_city VALUES ('9', '9', 'Erode', '1', 'ragav', '2020-06-08 17:21:37', null, null, '0');
INSERT INTO cmt_m_city VALUES ('10', '10', 'Bangaluru', '6', 'ragav', '2020-06-08 17:21:55', null, null, '0');
INSERT INTO cmt_m_city VALUES ('11', '11', 'Mangalore', '6', 'ragav', '2020-06-08 17:22:17', null, null, '0');
INSERT INTO cmt_m_city VALUES ('12', '12', 'Balakadu', '8', 'ragav', '2020-06-08 17:22:43', null, null, '0');
