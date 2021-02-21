/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 100126
Source Host           : localhost:3306
Source Database       : update1

Target Server Type    : MYSQL
Target Server Version : 100126
File Encoding         : 65001

Date: 2017-09-23 15:28:09
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for adminmessage
-- ----------------------------
DROP TABLE IF EXISTS `adminmessage`;
CREATE TABLE `adminmessage` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `subject` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `message` longtext COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of adminmessage
-- ----------------------------

-- ----------------------------
-- Table structure for business
-- ----------------------------
DROP TABLE IF EXISTS `business`;
CREATE TABLE `business` (
  `b_id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL,
  `b_title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `b_category` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `b_keyword` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `state` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `city` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `postcode` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `b_image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `b_description` varchar(3000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `b_phone` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `b_website` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `b_email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `openinghours` varchar(3000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `rating` float DEFAULT NULL,
  `latitude` float DEFAULT NULL,
  `longitude` float DEFAULT NULL,
  `update` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `updatestart` date DEFAULT NULL,
  `updateend` date DEFAULT NULL,
  PRIMARY KEY (`b_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of business
-- ----------------------------
INSERT INTO `business` VALUES ('5', '9', 'Business1', 'Eat & Drink', 'Business1', 'Satedong', 'Los Angeles', 'kalmacco', '116400', 'uploads/business/business1@hotmail.com.png', 'This is Business1', '19845546461', 'website@outlook.com', 'myemail@oulook.com', 'o_mon=1 AM, c_mon=3 AM, o_tue=2 AM, c_tue=4 AM, o_wed=5 AM, c_wed=9 AM, o_thu=10 AM, c_thu=1 PM, o_fri=12 AM, c_fri=1 PM, o_sat=10 AM, c_sat=7 PM, o_sun=10 AM, c_sun=10 PM', null, '39.6807', '122.967', 'false', null, null);
INSERT INTO `business` VALUES ('6', '10', 'Business2', 'Hotels', 'Business2', 'Kal Kel', 'New York', 'address1', '198752', 'uploads/business/business2@hotmail.com.png', 'This is business2', '19845546461', 'com.com', 'chong@chong.com', 'o_mon=1 AM, c_mon=2 AM, o_tue=1 AM, c_tue=3 AM, o_wed=2 AM, c_wed=7 AM, o_thu=3 AM, c_thu=9 AM, o_fri=4 AM, c_fri=1 PM, o_sat=9 AM, c_sat=6 PM, o_sun=2 PM, c_sun=10 PM', null, '1.30354', '103.86', 'false', null, null);

-- ----------------------------
-- Table structure for message
-- ----------------------------
DROP TABLE IF EXISTS `message`;
CREATE TABLE `message` (
  `b_userid` int(11) NOT NULL,
  `c_userid` int(11) NOT NULL,
  `p_id` int(11) NOT NULL,
  `message` longtext COLLATE utf8_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of message
-- ----------------------------

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of migrations
-- ----------------------------
INSERT INTO `migrations` VALUES ('1', '2014_10_12_000000_create_users_table', '1');
INSERT INTO `migrations` VALUES ('2', '2014_10_12_100000_create_password_resets_table', '1');

-- ----------------------------
-- Table structure for order
-- ----------------------------
DROP TABLE IF EXISTS `order`;
CREATE TABLE `order` (
  `p_id` int(11) NOT NULL,
  `b_userid` int(11) NOT NULL,
  `c_userid` int(11) NOT NULL,
  `o_state` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  KEY `orderid` (`p_id`),
  KEY `orderb` (`b_userid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of order
-- ----------------------------

-- ----------------------------
-- Table structure for password_resets
-- ----------------------------
DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of password_resets
-- ----------------------------

-- ----------------------------
-- Table structure for project
-- ----------------------------
DROP TABLE IF EXISTS `project`;
CREATE TABLE `project` (
  `p_id` int(11) NOT NULL AUTO_INCREMENT,
  `b_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `p_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `p_image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `p_description` varchar(3000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `p_state` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`p_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of project
-- ----------------------------

-- ----------------------------
-- Table structure for review
-- ----------------------------
DROP TABLE IF EXISTS `review`;
CREATE TABLE `review` (
  `r_id` int(11) NOT NULL AUTO_INCREMENT,
  `r_bid` int(11) NOT NULL,
  `r_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `r_email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `r_review` longtext COLLATE utf8_unicode_ci,
  `r_rating` int(11) NOT NULL,
  `r_image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `r_created_at` date DEFAULT NULL,
  PRIMARY KEY (`r_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of review
-- ----------------------------
INSERT INTO `review` VALUES ('1', '1', 'first', 'first@hotmail.com', 'Commodo est luctus eget. Proin in nunc laoreet justo volutpat blandit enim. Sem felis, ullamcorper vel aliquam non, varius eget justo. Duis quis nunc tellus sollicitudin mauris.', '5', null, '2017-09-10');
INSERT INTO `review` VALUES ('2', '2', 'second', 'second@outlook.com', 'Morbi velit eros, sagittis in facilisis non, rhoncus et erat. Nam posuere tristique sem, eu ultricies tortor imperdiet vitae. Curabitur lacinia neque non metus', '4', 'uploads\\test1@test.com\\profile.png', '2017-09-10');
INSERT INTO `review` VALUES ('3', '2', 'train', 'train@yandex.com', 'Morbi velit eros, sagittis in facilisis non, rhoncus et erat. Nam posuere tristique sem, eu ultricies tortor imperdiet vitae. Curabitur lacinia neque non metus', '5', null, '2017-09-10');
INSERT INTO `review` VALUES ('4', '3', 'test', 'test@test.com', 'Great Image', '3', 'uploads\\test@test.com\\profile.png', '2017-09-10');
INSERT INTO `review` VALUES ('5', '3', 'sdfsfs', 'dfasf@hotmai.com', 'Final review', '5', 'uploads\\test@test.com\\profile.png', '2017-09-10');
INSERT INTO `review` VALUES ('6', '1', 'dfgaf', 'second@outlook.com', 'sdfasfdsaf', '5', 'uploads\\test@test.com\\profile.png', '2017-09-10');

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `userrole` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `userphone` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `userprofile` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `package` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `companyname` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `notes` longtext COLLATE utf8_unicode_ci,
  `remember_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_useremail_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES ('9', 'business1', 'business1@hotmail.com', '$2y$10$wF4CxLPiV4GJgLvpGMk5oejcomwwq8LWaaj6OTgOk226yTMQW6w.S', 'business', '15464511', 'uploads/profile/business1@hotmail.com.png', 'free', 'business1', null, 'faYXPvmo87qNttkIuHZ4huqhG7Ez220zydj9ezVTrrExlB6JNfll16J1E3Re', '2017-09-23 03:56:56', '2017-09-23 03:56:56');
INSERT INTO `users` VALUES ('10', 'business2', 'business2@hotmail.com', '$2y$10$y4rfF0cfL1d./kHkGXNWnemDS.0xWNAr6TF4HcJTxGcMxDV2nPQVW', 'business', '2222222222', 'uploads/profile/business2@hotmail.com.png', 'free', 'business2', null, null, '2017-09-23 07:04:00', '2017-09-23 07:04:00');
