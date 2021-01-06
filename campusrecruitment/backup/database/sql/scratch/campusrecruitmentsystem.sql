/*
Navicat MySQL Data Transfer

Source Server         : db
Source Server Version : 50625
Source Host           : localhost:3306
Source Database       : campusrecruitmentsystem

Target Server Type    : MYSQL
Target Server Version : 50625
File Encoding         : 65001

Date: 2021-01-06 10:30:11
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for `apply_job_details`
-- ----------------------------
DROP TABLE IF EXISTS `apply_job_details`;
CREATE TABLE `apply_job_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `jobId` int(11) NOT NULL,
  `companyId` varchar(50) NOT NULL,
  `jobSeekerId` varchar(50) NOT NULL,
  `applyDate` date NOT NULL,
  `created_by` varchar(50) NOT NULL,
  `created_date_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_by` varchar(50) DEFAULT NULL,
  `updated_date_time` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `delFlag` int(5) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of apply_job_details
-- ----------------------------

-- ----------------------------
-- Table structure for `company`
-- ----------------------------
DROP TABLE IF EXISTS `company`;
CREATE TABLE `company` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `companyName` varchar(50) NOT NULL,
  `address` varchar(255) NOT NULL,
  `incharge` varchar(50) NOT NULL,
  `contact` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `website` varchar(50) NOT NULL,
  `userName` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `entryDate` date NOT NULL,
  `created_by` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_by` varchar(50) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `delFlag` int(5) NOT NULL,
  `flag` int(5) DEFAULT '2',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of company
-- ----------------------------

-- ----------------------------
-- Table structure for `job_details`
-- ----------------------------
DROP TABLE IF EXISTS `job_details`;
CREATE TABLE `job_details` (
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
-- Records of job_details
-- ----------------------------

-- ----------------------------
-- Table structure for `job_result_details`
-- ----------------------------
DROP TABLE IF EXISTS `job_result_details`;
CREATE TABLE `job_result_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `jobId` int(11) NOT NULL,
  `applyJobId` int(5) NOT NULL,
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

-- ----------------------------
-- Table structure for `m_city`
-- ----------------------------
DROP TABLE IF EXISTS `m_city`;
CREATE TABLE `m_city` (
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
-- Records of m_city
-- ----------------------------
INSERT INTO m_city VALUES ('1', '1', 'Madurai', '1', 'ragav', '2020-06-08 17:13:27', null, null, '0');
INSERT INTO m_city VALUES ('2', '2', 'Chennai', '1', 'ragav', '2020-06-08 17:13:48', null, null, '0');
INSERT INTO m_city VALUES ('3', '3', 'Tirunelveli', '1', 'ragav', '2020-06-08 17:14:03', null, null, '0');
INSERT INTO m_city VALUES ('4', '4', 'Tokyo City', '12', 'ragav', '2020-06-08 17:16:10', null, null, '0');
INSERT INTO m_city VALUES ('5', '5', 'Osaka City', '2', 'ragav', '2020-06-08 17:16:26', null, null, '0');
INSERT INTO m_city VALUES ('6', '6', 'Combatore', '1', 'ragav', '2020-06-08 17:17:38', null, null, '0');
INSERT INTO m_city VALUES ('7', '7', 'Thanjavur', '1', 'ragav', '2020-06-08 17:21:05', null, null, '0');
INSERT INTO m_city VALUES ('8', '8', 'Vellore', '1', 'ragav', '2020-06-08 17:21:23', null, null, '0');
INSERT INTO m_city VALUES ('9', '9', 'Erode', '1', 'ragav', '2020-06-08 17:21:37', null, null, '0');
INSERT INTO m_city VALUES ('10', '10', 'Bangaluru', '6', 'ragav', '2020-06-08 17:21:55', null, null, '0');
INSERT INTO m_city VALUES ('11', '11', 'Mangalore', '6', 'ragav', '2020-06-08 17:22:17', null, null, '0');
INSERT INTO m_city VALUES ('12', '12', 'Balakadu', '8', 'ragav', '2020-06-08 17:22:43', null, null, '0');

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

-- ----------------------------
-- Table structure for `m_department`
-- ----------------------------
DROP TABLE IF EXISTS `m_department`;
CREATE TABLE `m_department` (
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
-- Records of m_department
-- ----------------------------
INSERT INTO m_department VALUES ('1', 'Computer Science', 'CR0001', '2020-11-04 17:57:20', null, null, '0');
INSERT INTO m_department VALUES ('2', 'Chemistry', 'CR0001', '2020-11-04 17:58:08', null, null, '0');
INSERT INTO m_department VALUES ('3', 'Mechanical Engineering', 'CR0001', '2020-11-04 17:58:45', null, null, '0');
INSERT INTO m_department VALUES ('4', 'Physics', 'CR0001', '2020-11-04 17:59:09', null, null, '0');
INSERT INTO m_department VALUES ('5', 'Maths', 'CR0001', '2020-12-09 11:44:47', null, null, '0');
INSERT INTO m_department VALUES ('6', 'EEE', 'CR0001', '2020-12-18 13:07:05', null, null, '0');
INSERT INTO m_department VALUES ('7', 'Civil Engineering', 'CR0001', '2020-12-18 13:07:13', null, null, '0');
INSERT INTO m_department VALUES ('8', 'English', 'CR0001', '2020-12-18 13:07:18', null, null, '0');
INSERT INTO m_department VALUES ('9', 'ECE', 'CR0001', '2020-12-18 13:08:06', null, null, '0');
INSERT INTO m_department VALUES ('10', 'CSE', 'CR0001', '2020-12-18 13:08:52', null, null, '0');

-- ----------------------------
-- Table structure for `m_designation`
-- ----------------------------
DROP TABLE IF EXISTS `m_designation`;
CREATE TABLE `m_designation` (
  `designationId` int(10) NOT NULL AUTO_INCREMENT,
  `designationName` varchar(50) NOT NULL,
  `created_by` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_by` varchar(50) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `delFlag` int(5) NOT NULL,
  PRIMARY KEY (`designationId`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of m_designation
-- ----------------------------
INSERT INTO m_designation VALUES ('1', 'Web Designer', 'CR0001', '2020-11-04 17:57:20', null, null, '0');
INSERT INTO m_designation VALUES ('2', 'IT & Engineering', 'CR0001', '2020-11-04 17:58:08', null, null, '0');
INSERT INTO m_designation VALUES ('3', 'Education/Training', 'CR0001', '2020-11-04 17:58:45', null, null, '0');
INSERT INTO m_designation VALUES ('4', 'Art/Design', 'CR0001', '2020-11-04 17:59:09', null, null, '0');
INSERT INTO m_designation VALUES ('5', 'Sale/Markting', 'CR0001', '2020-12-09 11:44:47', null, null, '0');

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
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of m_min_qualification
-- ----------------------------
INSERT INTO m_min_qualification VALUES ('1', '+2', 'CR0001', '2020-11-04 17:57:20', null, null, '0');
INSERT INTO m_min_qualification VALUES ('2', 'BE', 'CR0001', '2020-11-04 17:58:08', null, null, '0');
INSERT INTO m_min_qualification VALUES ('3', 'Any Degree', 'CR0001', '2020-11-04 17:58:45', null, null, '0');
INSERT INTO m_min_qualification VALUES ('4', 'MCA', 'CR0001', '2020-11-04 17:59:09', null, null, '0');
INSERT INTO m_min_qualification VALUES ('5', 'BCA', 'CR0001', '2020-12-18 13:33:01', null, null, '0');
INSERT INTO m_min_qualification VALUES ('6', 'B.Sc', 'CR0001', '2020-12-18 13:33:08', null, null, '0');
INSERT INTO m_min_qualification VALUES ('7', 'B.COM', 'CR0001', '2020-12-18 13:33:15', null, null, '0');
INSERT INTO m_min_qualification VALUES ('8', 'B.A', 'CR0001', '2020-12-18 13:33:22', null, null, '0');
INSERT INTO m_min_qualification VALUES ('9', 'M.Sc', 'CR0001', '2020-12-18 13:33:40', null, null, '0');
INSERT INTO m_min_qualification VALUES ('10', 'M.A', 'CR0001', '2020-12-18 13:33:50', null, null, '0');
INSERT INTO m_min_qualification VALUES ('11', 'ME', 'CR0001', '2020-12-18 13:33:53', null, null, '0');

-- ----------------------------
-- Table structure for `m_qualification`
-- ----------------------------
DROP TABLE IF EXISTS `m_qualification`;
CREATE TABLE `m_qualification` (
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
-- Records of m_qualification
-- ----------------------------
INSERT INTO m_qualification VALUES ('1', '+2', 'CR0001', '2020-11-04 17:57:20', null, null, '0');
INSERT INTO m_qualification VALUES ('2', 'BE', 'CR0001', '2020-11-04 17:58:08', null, null, '0');
INSERT INTO m_qualification VALUES ('3', 'Any Degree', 'CR0001', '2020-11-04 17:58:45', null, null, '0');
INSERT INTO m_qualification VALUES ('4', 'MCA', 'CR0001', '2020-11-04 17:59:09', null, null, '0');
INSERT INTO m_qualification VALUES ('5', 'BCA', 'CR0001', '2020-12-18 13:33:01', null, null, '0');
INSERT INTO m_qualification VALUES ('6', 'B.Sc', 'CR0001', '2020-12-18 13:33:08', null, null, '0');
INSERT INTO m_qualification VALUES ('7', 'B.COM', 'CR0001', '2020-12-18 13:33:15', null, null, '0');
INSERT INTO m_qualification VALUES ('8', 'B.A', 'CR0001', '2020-12-18 13:33:22', null, null, '0');
INSERT INTO m_qualification VALUES ('9', 'M.Sc', 'CR0001', '2020-12-18 13:33:40', null, null, '0');
INSERT INTO m_qualification VALUES ('10', 'M.A', 'CR0001', '2020-12-18 13:33:50', null, null, '0');
INSERT INTO m_qualification VALUES ('11', 'ME', 'CR0001', '2020-12-18 13:33:53', null, null, '0');

-- ----------------------------
-- Table structure for `m_role`
-- ----------------------------
DROP TABLE IF EXISTS `m_role`;
CREATE TABLE `m_role` (
  `roleId` int(10) NOT NULL AUTO_INCREMENT,
  `roleName` varchar(50) NOT NULL,
  `created_by` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_by` varchar(50) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `delFlag` int(5) NOT NULL,
  PRIMARY KEY (`roleId`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of m_role
-- ----------------------------
INSERT INTO m_role VALUES ('1', 'TL', 'CR0001', '2020-11-04 17:57:20', null, null, '0');
INSERT INTO m_role VALUES ('2', 'Developer', 'CR0001', '2020-11-04 17:58:08', null, null, '0');
INSERT INTO m_role VALUES ('3', 'Programmer', 'CR0001', '2020-11-04 17:58:45', null, null, '0');
INSERT INTO m_role VALUES ('4', 'Tester', 'CR0001', '2020-11-04 17:59:09', null, null, '0');

-- ----------------------------
-- Table structure for `m_skill`
-- ----------------------------
DROP TABLE IF EXISTS `m_skill`;
CREATE TABLE `m_skill` (
  `skillId` int(10) NOT NULL AUTO_INCREMENT,
  `skillName` varchar(50) NOT NULL,
  `created_by` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_by` varchar(50) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `delFlag` int(5) NOT NULL,
  PRIMARY KEY (`skillId`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of m_skill
-- ----------------------------
INSERT INTO m_skill VALUES ('1', 'C', 'CR0001', '2020-11-04 17:57:20', null, null, '0');
INSERT INTO m_skill VALUES ('2', 'C++', 'CR0001', '2020-11-04 17:58:08', null, null, '0');
INSERT INTO m_skill VALUES ('3', 'Java', 'CR0001', '2020-11-04 17:58:45', null, null, '0');
INSERT INTO m_skill VALUES ('4', 'PHP', 'CR0001', '2020-11-04 17:59:09', null, null, '0');

-- ----------------------------
-- Table structure for `m_state`
-- ----------------------------
DROP TABLE IF EXISTS `m_state`;
CREATE TABLE `m_state` (
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
-- Records of m_state
-- ----------------------------
INSERT INTO m_state VALUES ('1', '1', 'Tamil Nadu', '1', 'Ragav', '2020-06-08 16:59:24', null, null, '0');
INSERT INTO m_state VALUES ('2', '2', 'Osaka', '2', 'Ragav', '2020-06-08 17:18:12', null, null, '0');
INSERT INTO m_state VALUES ('3', '3', 'New York', '3', 'Ragav', '2020-06-08 17:00:14', null, null, '0');
INSERT INTO m_state VALUES ('4', '4', 'Maharashtra', '1', 'Ragav', '2020-06-08 17:10:56', null, null, '0');
INSERT INTO m_state VALUES ('5', '5', 'Delhi', '1', 'ragav', '2020-06-08 17:11:15', null, null, '0');
INSERT INTO m_state VALUES ('6', '6', 'Karnataka', '1', 'ragav', '2020-06-08 17:11:32', null, null, '0');
INSERT INTO m_state VALUES ('7', '7', 'Andhra Pradesh', '1', 'ragav', '2020-06-08 17:11:49', null, null, '0');
INSERT INTO m_state VALUES ('8', '8', 'Kerala', '1', 'ragav', '2020-06-08 17:12:22', null, null, '0');
INSERT INTO m_state VALUES ('9', '9', 'Akita', '2', 'ragav', '2020-06-08 17:17:00', null, null, '0');
INSERT INTO m_state VALUES ('10', '10', 'Chiba', '2', 'ragav', '2020-06-08 17:17:17', null, null, '0');
INSERT INTO m_state VALUES ('11', '11', 'Fukui', '2', 'ragav', '2020-06-08 17:17:56', null, null, '0');
INSERT INTO m_state VALUES ('12', '12', 'Tokyo', '2', 'ragav', '2020-06-08 17:18:45', null, null, '0');

-- ----------------------------
-- Table structure for `m_university`
-- ----------------------------
DROP TABLE IF EXISTS `m_university`;
CREATE TABLE `m_university` (
  `universityId` int(10) NOT NULL AUTO_INCREMENT,
  `universityName` varchar(50) NOT NULL,
  `created_by` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_by` varchar(50) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `delFlag` int(5) NOT NULL,
  PRIMARY KEY (`universityId`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of m_university
-- ----------------------------
INSERT INTO m_university VALUES ('1', 'Anna University', 'CR0001', '2020-11-04 17:57:20', null, null, '0');
INSERT INTO m_university VALUES ('2', 'Kamaraj University', 'CR0001', '2020-11-04 17:58:08', null, null, '0');
INSERT INTO m_university VALUES ('3', 'University of Madras', 'CR0001', '2020-11-04 17:58:45', null, null, '0');
INSERT INTO m_university VALUES ('4', 'M.S. University', 'CR0001', '2020-11-04 17:59:09', null, null, '0');
INSERT INTO m_university VALUES ('5', 'VOC University', 'CR0001', '2020-12-09 11:44:47', null, null, '0');
INSERT INTO m_university VALUES ('6', 'Alagappa University', 'CR0001', '2020-12-18 13:07:05', null, null, '0');
INSERT INTO m_university VALUES ('7', 'Sathyabama Institute', 'CR0001', '2020-12-18 13:07:13', null, null, '0');
INSERT INTO m_university VALUES ('8', 'SRM Institute', 'CR0001', '2020-12-18 13:07:18', null, null, '0');
INSERT INTO m_university VALUES ('9', 'Thiruvalluvar University', 'CR0001', '2020-12-18 13:08:06', null, null, '0');
INSERT INTO m_university VALUES ('10', 'Vels University', 'CR0001', '2020-12-18 13:08:52', null, null, '0');

-- ----------------------------
-- Table structure for `password_resets`
-- ----------------------------
DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_date_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_date_time` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `password_resets_email_index` (`email`),
  KEY `password_resets_token_index` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of password_resets
-- ----------------------------

-- ----------------------------
-- Table structure for `t_qualification`
-- ----------------------------
DROP TABLE IF EXISTS `t_qualification`;
CREATE TABLE `t_qualification` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `jobSeekerId` varchar(50) NOT NULL,
  `tenthMark` varchar(10) NOT NULL,
  `twelvethMark` varchar(10) NOT NULL,
  `specification` int(10) NOT NULL,
  `qualification` int(10) NOT NULL,
  `branch` int(10) NOT NULL,
  `yearOfPassing` int(10) NOT NULL,
  `monthOfPassing` int(10) NOT NULL,
  `CGPA` varchar(10) NOT NULL,
  `university` int(10) NOT NULL,
  `collegeName` varchar(100) NOT NULL,
  `skill` int(10) NOT NULL,
  `extraSkill` varchar(200) DEFAULT NULL,
  `created_date_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(50) NOT NULL,
  `updated_date_time` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` varchar(50) DEFAULT NULL,
  `delFlag` int(5) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_qualification
-- ----------------------------

-- ----------------------------
-- Table structure for `users`
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `userName` varchar(30) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `gender` int(5) NOT NULL,
  `address` varchar(200) NOT NULL,
  `country` int(10) NOT NULL,
  `state` int(10) NOT NULL,
  `city` int(10) NOT NULL,
  `pincode` varchar(20) NOT NULL,
  `contact` varchar(20) NOT NULL,
  `image` longblob,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_by` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_by` varchar(50) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `delFlag` int(5) NOT NULL,
  `adminFlag` int(5) NOT NULL,
  `flag` int(5) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of users
-- ----------------------------