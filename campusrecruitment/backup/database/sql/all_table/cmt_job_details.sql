/*
Navicat MySQL Data Transfer

Source Server         : db
Source Server Version : 50625
Source Host           : localhost:3306
Source Database       : campusrecruitmentsystem

Target Server Type    : MYSQL
Target Server Version : 50625
File Encoding         : 65001

Date: 2021-01-06 18:24:32
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for `cmt_job_details`
-- ----------------------------
DROP TABLE IF EXISTS `cmt_job_details`;
CREATE TABLE `cmt_job_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `companyId` varchar(50) DEFAULT NULL,
  `jobCategory` int(10) NOT NULL,
  `jobType` int(5) NOT NULL,
  `requiredSkill` int(10) NOT NULL,
  `extraSkill` varchar(200) DEFAULT NULL,
  `role` int(10) NOT NULL,
  `minQualification` int(10) NOT NULL,
  `maxAge` int(10) NOT NULL,
  `salary` varchar(30) NOT NULL,
  `jobLocation` int(10) NOT NULL,
  `workingHour` int(10) NOT NULL,
  `jobDescription` text,
  `lastApplyDate` date NOT NULL,
  `created_date_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(50) NOT NULL,
  `updated_date_time` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` varchar(50) DEFAULT NULL,
  `delFlag` int(5) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of cmt_job_details
-- ----------------------------
