/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 100126
Source Host           : localhost:3306
Source Database       : edenlnx

Target Server Type    : MYSQL
Target Server Version : 100126
File Encoding         : 65001

Date: 2017-09-12 22:18:21
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
  PRIMARY KEY (`b_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of business
-- ----------------------------
INSERT INTO `business` VALUES ('1', '1', 'First Test Tille', 'Hotels', 'MongSil', 'Big', 'Los Angeles', 'Pig', '188021', 'uploads\\test@test.com\\business\\4.png', 'This is first test business product.', '131313221', 'website@outlook.com', 'myemail@oulook.com', 'o_mon=3 AM, c_mon=5 AM, o_tue=1 AM, c_tue=2 AM, o_wed=3 AM, c_wed=4 AM, o_thu=5 AM, c_thu=6 PM, o_fri=, c_fri=8 AM, o_sat=9 PM, c_sat=10 AM, o_sun=11 PM, c_sun=12 AM', null);
INSERT INTO `business` VALUES ('2', '2', 'B2', 'Shops', '222222', 'Satedong', 'Chicago', 'Martine', '2600', 'uploads\\test1@test.com\\business\\5.png', 'This Shop have many 3D Objects', '19845546461', 'shopshop.com', 'shop@shop.com', 'o_mon=6 AM, c_mon=10 PM, o_tue=1 AM, c_tue=4 AM, o_wed=4 AM, c_wed=Closed, o_thu=Closed, c_thu=Closed, o_fri=, c_fri=1 AM, o_sat=1 AM, c_sat=1 AM, o_sun=3 AM, c_sun=3 PM', null);
INSERT INTO `business` VALUES ('3', '2', 'B33', 'Restaurants', 'Resturant', 'WuSa', 'Phoenix', 'School Street', '2617', 'uploads\\test1@test.com\\business\\8.png', 'The Eloquent ORM included with Laravel provides a beautiful, simple ActiveRecord implementation for working with your database. Each database table has a corresponding \"Model\" which is used to interact with that table. Models allow you to query for data in your tables, as well as insert new records into the table.', '5469874589', 'http://resturant.com', 'b33@resturant.com', 'o_mon=1 AM, c_mon=2 AM, o_tue=3 AM, c_tue=4 AM, o_wed=5 AM, c_wed=6 AM, o_thu=Closed, c_thu=7 AM, o_fri=, c_fri=9 AM, o_sat=1 PM, c_sat=2 PM, o_sun=3 PM, c_sun=12 PM', null);
INSERT INTO `business` VALUES ('4', '2', 'B Lastest', 'Events', 'events', 'HHoollaa', 'Austin', 'Hola', '2906', 'uploads\\test1@test.com\\business\\9.png', 'The Eloquent ORM included with Laravel provides a beautiful, simple ActiveRecord implementation for working with your database. Each database table has a corresponding \"Model\" which is used to interact with that table. Models allow you to query for data in your tables, as well as insert new records into the table.', '79876549464', 'http://hola.com', 'Whola@hola.com', 'o_mon=3 AM, c_mon=6 AM, o_tue=Closed, c_tue=2 AM, o_wed=4 AM, c_wed=2 PM, o_thu=4 AM, c_thu=10 AM, o_fri=, c_fri=10 PM, o_sat=3 PM, c_sat=5 PM, o_sun=6 PM, c_sun=11 PM', null);

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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES ('1', 'test', 'test@test.com', '$2y$10$jaIGXoYg/CQ9XcCXy/j9ceeLDUACIT5bugM8sH0NLCiBBfVSSTLE6', '1913449706', 'uploads\\test@test.com\\profile.png', 'free', null, 'dfadsfdgsdg\r\nCustomerID\r\nCustomerID', 'LyuL6QNJrUx4hcZLmFuQq4wzqdCYAekdBeY6nBj7fmugJwUGgByHLzLZ0h6H', '2017-09-06 21:14:10', '2017-09-06 21:14:10');
INSERT INTO `users` VALUES ('2', 'test1', 'test1@test.com', '$2y$10$iFhFHCl20MJ58YLraawMSOrc.2VfqPtjzNZ.XNLOcUjynFAPwM9Sm', '2222222222', 'uploads\\test1@test.com\\profile.png', 'regular', null, '22222222\r\n2\r\n2\r\n2\r\n222222222222', 'PwQrBnQaebzrFYlitM8OM2rAiajWeMgqsNs2VZ7EXqHk3KqliANncnP1lpAN', '2017-09-06 21:39:54', '2017-09-06 21:39:54');
