/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50624
Source Host           : localhost:3306
Source Database       : praca2

Target Server Type    : MYSQL
Target Server Version : 50624
File Encoding         : 65001

Date: 2016-02-25 19:24:51
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for aukcje
-- ----------------------------
DROP TABLE IF EXISTS `aukcje`;
CREATE TABLE `aukcje` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` datetime DEFAULT NULL,
  `date2` varchar(22) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `desc` varchar(400) DEFAULT NULL,
  `uid` int(11) DEFAULT NULL,
  `kat1` int(2) DEFAULT NULL,
  `kat2` int(2) DEFAULT NULL,
  `price` int(15) DEFAULT NULL,
  `reward` int(15) DEFAULT NULL,
  `place` varchar(32) DEFAULT NULL,
  `input1` varchar(220) DEFAULT NULL,
  `input2` varchar(220) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of aukcje
-- ----------------------------
INSERT INTO `aukcje` VALUES ('1', '2016-02-24 19:48:47', null, 'fdgdf', 'fdgd', '1', '1', '2', '33', null, null, 'gd', 'dfg');
INSERT INTO `aukcje` VALUES ('2', '2016-01-16 16:46:12', null, 'bsdfcb', 'dvfvs\r\nbfgbfg\r\nmjmjmj', '1', '2', '7', '7657', null, null, null, null);
INSERT INTO `aukcje` VALUES ('3', '2016-01-16 19:48:47', null, 'cdfvgn', 'xbvcb</br>sdfsdf', '1', '3', '8', '657', null, null, null, null);
INSERT INTO `aukcje` VALUES ('4', '2016-01-16 16:46:12', null, 'dsdfcb', 'dvfvs\r\nbfgbfg\r\nmjmjmj', '1', '4', '7', '6546', null, null, null, null);
INSERT INTO `aukcje` VALUES ('5', '2016-01-17 19:48:47', null, 'edfvgn', 'xbvcb</br>sdfsdz', '1', '5', '8', '876', null, null, null, null);
INSERT INTO `aukcje` VALUES ('6', '2016-01-17 16:46:12', null, 'fsdfcb', 'dvfvs\r\nbfgbfg\r\nmjmjmj', '1', '6', '7', '86786', null, null, null, null);
INSERT INTO `aukcje` VALUES ('7', '2016-01-17 19:48:47', null, 'gdfvgn', 'xbvcb</br>sdfsdf', '1', '7', '8', '867', null, null, null, null);
INSERT INTO `aukcje` VALUES ('8', '2016-01-18 16:46:12', null, 'hsdfcb', 'dvfvs\r\nbfgbfg\r\nmjmjmj', '1', '8', '7', '543', null, null, null, null);
INSERT INTO `aukcje` VALUES ('9', '2016-01-18 19:48:47', null, 'idfvgn', 'xbvcb</br>sdfsdf', '1', '9', '8', '45', null, null, null, null);
INSERT INTO `aukcje` VALUES ('10', '2016-01-18 16:46:12', null, 'jsdfcb', 'dvfvs\r\nbfgbfg\r\nmjmjmj', '1', '10', '7', '43534', null, null, null, null);
INSERT INTO `aukcje` VALUES ('11', '2016-01-18 19:48:47', null, 'kdfvgn', 'xbvcb</br>sdfsdf', '1', '11', '8', '45', null, null, null, null);
INSERT INTO `aukcje` VALUES ('12', '2016-01-18 16:46:12', null, 'lsdfcb', 'dvfvs\r\nbfgbfg\r\nmjmjmj', '1', '12', '7', '34543', null, null, null, null);
INSERT INTO `aukcje` VALUES ('13', '2016-01-19 19:48:47', null, 'mdfvgn', 'xbvcb</br>sdfsdf', '1', '13', '8', '345', null, null, null, null);
INSERT INTO `aukcje` VALUES ('14', '2016-01-19 16:46:12', null, 'nsdfcb', 'dvfvs\r\nbfgbfg\r\nmjmjmj', '1', '14', '7', '34', null, null, null, null);
INSERT INTO `aukcje` VALUES ('15', '2016-01-19 19:48:47', null, 'odfvgn', 'xbvcb</br>sdfsdf', '1', '15', '8', '5345', null, null, null, null);
INSERT INTO `aukcje` VALUES ('16', '2016-01-19 16:46:12', null, 'psdfcb', 'dvfvs\r\nbfgbfg\r\nmjmjmj', '1', '16', '7', '534', null, null, null, null);
INSERT INTO `aukcje` VALUES ('17', '2016-01-19 19:48:47', null, 'rdfvgn', 'xbvcb</br>sdfsdf', '1', '1', '8', '345', null, null, null, null);
INSERT INTO `aukcje` VALUES ('18', '2016-01-19 16:46:12', null, 'ssdfcb', 'dvfvs\r\nbfgbfg\r\nmjmjmj', '1', '2', '7', '4535', null, null, null, null);
INSERT INTO `aukcje` VALUES ('19', '2016-01-19 19:48:47', null, 'tdfvgn', 'xbvcb</br>sdfsdf', '1', '3', '8', '3454', null, null, null, null);
INSERT INTO `aukcje` VALUES ('20', '2016-01-19 16:46:12', null, 'usdfcb', 'dvfvs\r\nbfgbfg\r\nmjmjmj', '1', '4', '7', '45', null, null, null, null);
INSERT INTO `aukcje` VALUES ('21', '2016-01-19 17:29:07', null, 'sdasdasdasdas', 'sdcsdcsdc\r\ndfvdfvdf\r\nvdfvdfvdfv', '1', '3', '7', '5345', null, null, null, null);
INSERT INTO `aukcje` VALUES ('22', '2016-01-19 17:58:53', null, 'sdasdasdajuju', 'sdcsdcsdc\r\ndfvdfvdf\r\njujuju', '1', '1', '1', '545', null, null, null, null);
INSERT INTO `aukcje` VALUES ('23', '2016-01-19 16:49:05', null, 'sdsad', 'asdsad', '1', '3', '8', '543', null, null, null, null);
INSERT INTO `aukcje` VALUES ('24', '2016-01-19 16:50:41', null, 'dgdfgghfg', 'hgfhgfh', '1', '1', '1', '45', null, null, null, null);
INSERT INTO `aukcje` VALUES ('25', '2016-01-19 17:51:35', null, 'dgdfgghfg', 'hgfhgfh', '1', '2', '2', '453453', null, null, null, null);
INSERT INTO `aukcje` VALUES ('26', '2016-01-19 17:51:45', null, 'dgfdgfd', 'gdfgdfg', '1', '4', '5', '454', null, null, 'mmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmm', null);
INSERT INTO `aukcje` VALUES ('30', '2016-01-19 18:21:45', null, 'gbfgbgnmngvhb', 'Semiotics Vice Wes Anderson Bushwick organic. Chambray twee Banksy, asymmetrical disrupt bitters selfies Helvetica. Gentrify direct trade disrupt Odd Future. Bespoke tote bag small batch, try-hard drinking vinegar cronut beard migas ethical.', '1', '5', '4', '53454', null, null, 'dvfvs\r\nbfgbfg\r\nmjmjmj', null);
INSERT INTO `aukcje` VALUES ('32', '2016-01-19 19:08:33', null, 'retyjchvchg', 'dfhxcgnchgcghngh\r\nn\r\nghxjngfnfg\r\nnhxfgnh', '11', '2', '4', '465757', null, null, 'fghxgfhxfgh\r\n\r\nghxfghxfgh\r\nfhfgxh', 'gfxhxfgh\r\nfghfxg\r\nhfgh\r\nf\r\ngjfgj');
INSERT INTO `aukcje` VALUES ('33', '2016-01-21 18:43:01', null, 'dsgdfgdfg', 'edfgdfgfhdfghghdf\r\ngdfgdfhdfhfhfgj\r\nfgjgfjgjfgjkk', '11', '10', '8', '43654', null, null, 'fdhfdhdfhdfh\r\ndfhdfhdfh\r\nfdhf', 'dfhfdhdfh\r\nfdhdfhdfh\r\ngdfgfd');
INSERT INTO `aukcje` VALUES ('34', '2016-02-25 19:04:21', '2016 02 26 godz 19', 'afdfsdgdfgd', 'sgdgsrvdfgdfhgfhjvefbver\r\nbbervgergvergvergredvdfgvdfgdf', '13', '4', '4', '465', '235467', null, 'gjghkhlh\r\nhgjghjgh\r\nhkghmghm', 'fhfghfgj\r\nghghjg\r\nghjghjg');
INSERT INTO `aukcje` VALUES ('35', '2016-02-25 19:08:41', '2016 02 26', 'Heathermt', 'rfsgbsgbsfbfgbhgnghnghnhg\r\nngdhndgndgdgndf', '14', '4', '6', '643', '6645', null, 'trgrfgvfsbsf\r\nbgsfgbsfgsf\r\ngbsfgfsfbsf', 'bsgfsfgbsfgb\r\nsfgbsfgnghnh\r\nyumyumyum');
INSERT INTO `aukcje` VALUES ('36', '2016-02-25 19:21:11', '2016 03 29', 'xcbvcbcvbcvbc9', 'dfgvdfgdfgfggfhfgh99', '14', '8', '8', '23539', '234569', 'restdgyd9', 'fghfghfghh\r\nhjhh\r\nghjghjg9', 'fghfghfg\r\nhjghjghjg9');
INSERT INTO `aukcje` VALUES ('37', '2016-02-25 19:23:06', '2016 05 29', 'frwterhtrh', 'hrthrthrhhrthrthrt\r\nhrthrtht', '14', '5', '4', '43534', '35345', 'restdgydhth', 'rthrthtrh\r\njyujyuj\r\ntjtyjy', 'rthrthrthrthjyuj\r\ntjtyjty\r\njtyjtyjtyjt\r\nyjtyjtyj');

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `index` int(10) NOT NULL AUTO_INCREMENT,
  `email` varchar(80) NOT NULL,
  `pass` varchar(32) NOT NULL,
  `date` datetime DEFAULT NULL,
  `input1` varchar(60) DEFAULT NULL,
  `ip` varchar(20) DEFAULT NULL,
  `phone` varchar(12) DEFAULT NULL,
  PRIMARY KEY (`index`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES ('1', 'lololo@lolo.lo', '80ef61a9478f668711adb7df30543230', '2015-11-04 19:29:44', 'zazg hfaza', '127.0.0.1', null);
INSERT INTO `users` VALUES ('7', 'kikiki@kiki.ki', '6eed97a9ea85259504c1192bdf0d56d7', '2015-11-29 13:17:44', 'hyhy fgdfh', '127.0.0.1', null);
INSERT INTO `users` VALUES ('11', 'aqaqaq1@aqaq.aq', '9d803addda5fcb9e91d4a31718294344', '2016-01-17 18:35:29', 'aqaq aqaq', '127.0.0.1', null);
INSERT INTO `users` VALUES ('12', 'aqaqaq2@aqaq.aq', 'f793308292be18e56f1b96c3d08b4c63', '2016-02-24 19:16:49', 'aqaq aqaq', '127.0.0.1', null);
INSERT INTO `users` VALUES ('13', 'aqaqaq4@aqaq.aq', 'f793308292be18e56f1b96c3d08b4c63', '2016-02-25 19:03:06', 'swsw swsw', '127.0.0.1', null);
INSERT INTO `users` VALUES ('14', 'aqaqaq5@aqaq.aq', 'f793308292be18e56f1b96c3d08b4c63', '2016-02-25 19:07:51', 'aqaq aqaqs', '127.0.0.1', '3456785795');
