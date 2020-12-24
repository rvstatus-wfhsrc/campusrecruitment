/*
Navicat MySQL Data Transfer

Source Server         : demo
Source Server Version : 50625
Source Host           : localhost:3306
Source Database       : campusrecruitment

Target Server Type    : MYSQL
Target Server Version : 50625
File Encoding         : 65001

Date: 2020-12-24 15:24:40
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for `job_result_details`
-- ----------------------------
DROP TABLE IF EXISTS `job_result_details`;
CREATE TABLE `job_result_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `jobId` int(11) NOT NULL,
  `companyId` varchar(50) NOT NULL,
  `jobSeekerId` varchar(50) NOT NULL,
  `resultDate` date NOT NULL,
  `totalMark` int(10) DEFAULT NULL,
  `obtainMark` int(10) NOT NULL,
  `resultStatus` int(5) NOT NULL,
  `created_by` varchar(50) NOT NULL,
  `created_date_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_by` varchar(50) DEFAULT NULL,
  `updated_date_time` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `delFlag` int(5) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of job_result_details
-- ----------------------------
