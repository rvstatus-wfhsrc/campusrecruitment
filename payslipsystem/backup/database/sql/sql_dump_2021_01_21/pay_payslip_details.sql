/*
Navicat MySQL Data Transfer

Source Server         : demo
Source Server Version : 50625
Source Host           : localhost:3306
Source Database       : payslip

Target Server Type    : MYSQL
Target Server Version : 50625
File Encoding         : 65001

Date: 2021-01-21 17:03:06
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for `pay_payslip_details`
-- ----------------------------
DROP TABLE IF EXISTS `pay_payslip_details`;
CREATE TABLE `pay_payslip_details` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `Emp_Id` varchar(30) NOT NULL,
  `salaryId` int(10) NOT NULL,
  `toMail` varchar(100) NOT NULL,
  `subject` varchar(50) NOT NULL,
  `content` text,
  `year` int(5) NOT NULL,
  `month` int(3) NOT NULL,
  `mailSendStatus` int(5) NOT NULL,
  `created_date_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(100) NOT NULL,
  `updated_by` varchar(100) DEFAULT NULL,
  `updated_date_time` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `delFlag` int(5) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of pay_payslip_details
-- ----------------------------
