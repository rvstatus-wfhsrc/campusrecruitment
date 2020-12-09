/*
Navicat MySQL Data Transfer

Source Server         : demo
Source Server Version : 50625
Source Host           : localhost:3306
Source Database       : campusrecruitment

Target Server Type    : MYSQL
Target Server Version : 50625
File Encoding         : 65001

Date: 2020-12-09 17:22:39
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for `job_details`
-- ----------------------------
DROP TABLE IF EXISTS `job_details`;
CREATE TABLE `job_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `companyId` varchar(50) DEFAULT NULL,
  `jobCategory` int(10) NOT NULL,
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
  `created_date_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` varchar(50) NOT NULL,
  `updated_date_time` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` varchar(50) DEFAULT NULL,
  `delFlag` int(5) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of job_details
-- ----------------------------
INSERT INTO job_details VALUES ('1', 'CY0012', '2', '2', 'Accounts', '1', '3', '25', '25000 - 30000', '1', '10', 'Good Job', '2020-12-18', '2020-12-09 17:21:20', 'CY0012', '2020-12-09 17:21:20', null, '0');
INSERT INTO job_details VALUES ('2', 'CY0012', '3', '3', 'Logical Skill,Accounts', '4', '3', '23', '20000 - 25000', '1', '8', 'Nice Job', '2020-12-25', '2020-12-09 13:49:03', 'CY0012', null, null, '0');
INSERT INTO job_details VALUES ('3', 'CY0012', '4', '1', '', '1', '1', '21', '15000 - 20000', '1', '8', 'Basic Job', '2020-12-30', '2020-12-09 13:50:55', 'CY0012', null, null, '0');
