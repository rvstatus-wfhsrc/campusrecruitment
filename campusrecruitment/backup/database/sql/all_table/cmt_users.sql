/*
Navicat MySQL Data Transfer

Source Server         : db
Source Server Version : 50625
Source Host           : localhost:3306
Source Database       : campusrecruitmentsystem

Target Server Type    : MYSQL
Target Server Version : 50625
File Encoding         : 65001

Date: 2021-01-06 18:25:42
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for `cmt_users`
-- ----------------------------
DROP TABLE IF EXISTS `cmt_users`;
CREATE TABLE `cmt_users` (
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
-- Records of cmt_users
-- ----------------------------