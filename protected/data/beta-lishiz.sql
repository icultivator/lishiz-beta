/*
Navicat MySQL Data Transfer

Source Server         : local
Source Server Version : 50620
Source Host           : localhost:3306
Source Database       : beta-lishiz

Target Server Type    : MYSQL
Target Server Version : 50620
File Encoding         : 65001

Date: 2014-12-01 15:26:05
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `lsz_book`
-- ----------------------------
DROP TABLE IF EXISTS `lsz_book`;
CREATE TABLE `lsz_book` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `content` text NOT NULL,
  `cover` varchar(100) NOT NULL,
  `author` varchar(100) DEFAULT NULL,
  `url` varchar(200) DEFAULT NULL,
  `tags` varchar(100) DEFAULT NULL,
  `votes` int(10) unsigned DEFAULT '0',
  `views` int(10) unsigned DEFAULT '0',
  `collects` int(10) unsigned DEFAULT '0',
  `comments` int(10) unsigned DEFAULT '0',
  `user_id` int(10) unsigned DEFAULT '0',
  `status` tinyint(1) unsigned DEFAULT '0',
  `create_time` int(10) unsigned DEFAULT '0',
  `last_update` int(10) unsigned DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`title`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of lsz_book
-- ----------------------------
INSERT INTO `lsz_book` VALUES ('1', '史记(1-10)(套装共10册)(二十四史繁体竖排)', '<span style=\"color:#333333;font-family:Arial, sans-serif;font-size:14px;line-height:22.3999996185303px;background-color:#FFFFFF;\">《史记(套装共10册)》是中国历史上一部伟大的史学著作，同时也是一部伟大的传记文学巨著，对中国后世的史学和文学影响深远。其诞生于公元前1世纪中国西汉时候，它记载了从中国上古开始到西汉时期，长达3000年的政治、经济、文化、历史。是中国第一部以写人物为中心的纪传体通史，同时也开创了中国的传记文学。</span>', '/images/user/2014/11/30/55d16c7a0b86696d18c4d74f6bd2d27e.jpg', '司马迁', 'http://www.amazon.cn/gp/product/B00C11OM28/ref=s9_acsd_al_bw_tabc_lsts_2_i?pf_rd_m=A1AJ19PSB66TGU&pf', '史记', '2', '22', '1', '7', '1', '1', '1417315010', '1417315010');

-- ----------------------------
-- Table structure for `lsz_comment`
-- ----------------------------
DROP TABLE IF EXISTS `lsz_comment`;
CREATE TABLE `lsz_comment` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `obj_type` tinyint(1) unsigned NOT NULL,
  `obj_id` int(10) unsigned NOT NULL,
  `parent_id` int(10) unsigned DEFAULT '0',
  `comment_to` int(10) unsigned DEFAULT '0',
  `content` text NOT NULL,
  `votes` int(10) unsigned DEFAULT '0',
  `comments` int(10) unsigned DEFAULT '0',
  `user_id` int(10) unsigned DEFAULT '0',
  `status` tinyint(1) unsigned DEFAULT '1',
  `comment_time` int(10) unsigned DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of lsz_comment
-- ----------------------------
INSERT INTO `lsz_comment` VALUES ('1', '2', '1', '0', '0', '不错！', '1', '0', '1', '1', '1417073197');
INSERT INTO `lsz_comment` VALUES ('2', '2', '1', '0', '0', '呵呵', '1', '0', '1', '1', '1417073383');
INSERT INTO `lsz_comment` VALUES ('3', '2', '1', '2', '1', '嘻嘻', '1', '0', '1', '1', '1417073511');
INSERT INTO `lsz_comment` VALUES ('4', '2', '1', '2', '1', '你妹啊', '1', '0', '1', '1', '1417073775');
INSERT INTO `lsz_comment` VALUES ('5', '7', '1', '0', '1', '不一样吧', '0', '0', '1', '1', '1417151355');
INSERT INTO `lsz_comment` VALUES ('6', '7', '1', '0', '1', '不一样呢', '0', '0', '1', '1', '1417151383');
INSERT INTO `lsz_comment` VALUES ('7', '7', '1', '6', '1', '是啊', '0', '0', '1', '1', '1417151513');
INSERT INTO `lsz_comment` VALUES ('8', '7', '1', '5', '1', '哇咔咔', '0', '0', '1', '1', '1417151529');
INSERT INTO `lsz_comment` VALUES ('9', '3', '1', '0', '1', '挺好的！', '0', '0', '1', '1', '1417323678');
INSERT INTO `lsz_comment` VALUES ('10', '3', '1', '9', '1', '哈哈', '0', '0', '1', '1', '1417323702');
INSERT INTO `lsz_comment` VALUES ('11', '3', '1', '9', '1', '哈哈', '0', '0', '1', '1', '1417323706');
INSERT INTO `lsz_comment` VALUES ('12', '3', '1', '9', '1', '哈哈', '0', '0', '1', '1', '1417323722');
INSERT INTO `lsz_comment` VALUES ('13', '3', '1', '9', '1', '哈哈哈', '0', '0', '1', '1', '1417323784');
INSERT INTO `lsz_comment` VALUES ('14', '5', '1', '0', '1', '沙发！', '0', '0', '2', '1', '1417324316');
INSERT INTO `lsz_comment` VALUES ('15', '3', '1', '9', '1', '哈哈哈', '0', '0', '2', '1', '1417326546');
INSERT INTO `lsz_comment` VALUES ('16', '2', '2', '0', '1', '哈哈，原来如此啊', '0', '0', '2', '1', '1417328314');
INSERT INTO `lsz_comment` VALUES ('17', '2', '2', '16', '1', '呵呵', '0', '0', '1', '1', '1417328354');
INSERT INTO `lsz_comment` VALUES ('18', '2', '2', '16', '1', '帝王帝王', '1', '0', '1', '1', '1417328727');
INSERT INTO `lsz_comment` VALUES ('19', '2', '2', '16', '1', '啊哈哈', '0', '0', '1', '1', '1417329188');
INSERT INTO `lsz_comment` VALUES ('20', '2', '2', '16', '2', '啊哈哈', '0', '0', '1', '1', '1417329202');

-- ----------------------------
-- Table structure for `lsz_image`
-- ----------------------------
DROP TABLE IF EXISTS `lsz_image`;
CREATE TABLE `lsz_image` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `cover` varchar(100) NOT NULL,
  `content` text,
  `status` tinyint(3) unsigned DEFAULT '1',
  `views` int(10) unsigned DEFAULT '0',
  `votes` int(10) unsigned DEFAULT '0',
  `collects` int(10) unsigned DEFAULT '0',
  `comments` int(10) unsigned DEFAULT '0',
  `user_id` int(10) unsigned DEFAULT '0',
  `create_time` int(10) unsigned DEFAULT '0',
  `last_update` int(10) unsigned DEFAULT '0',
  `tags` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `title` (`title`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of lsz_image
-- ----------------------------

-- ----------------------------
-- Table structure for `lsz_image_upload`
-- ----------------------------
DROP TABLE IF EXISTS `lsz_image_upload`;
CREATE TABLE `lsz_image_upload` (
  `image_id` int(10) unsigned NOT NULL,
  `upload_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`image_id`,`upload_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of lsz_image_upload
-- ----------------------------

-- ----------------------------
-- Table structure for `lsz_post`
-- ----------------------------
DROP TABLE IF EXISTS `lsz_post`;
CREATE TABLE `lsz_post` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `summary` text,
  `content` text NOT NULL,
  `cover` varchar(100) DEFAULT NULL,
  `cover_in_post` tinyint(1) unsigned DEFAULT '1',
  `url` varchar(200) DEFAULT NULL,
  `tags` varchar(100) DEFAULT NULL,
  `collects` int(10) unsigned DEFAULT '0',
  `votes` int(10) unsigned DEFAULT '0',
  `views` int(10) unsigned DEFAULT '0',
  `comments` int(10) unsigned DEFAULT '0',
  `user_id` int(10) unsigned DEFAULT '0',
  `status` tinyint(1) unsigned DEFAULT '1',
  `create_time` int(10) unsigned DEFAULT '0',
  `last_update` int(10) unsigned DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `title` (`title`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of lsz_post
-- ----------------------------
INSERT INTO `lsz_post` VALUES ('1', '十恶不赦”中的十恶指的是哪十恶？', '', '<p style=\"color:#444444;text-indent:30px;font-size:15px;font-family:doublevregular, \'Microsoft YaHei\', \'Trebuchet MS\', Verdana, Tahoma, Arial, sans-serif;background-color:#FFFFFF;\">\r\n	在现代汉语中，常用“十恶不赦”来形容一个人罪大恶极、不可饶恕。但该成语中的“十恶”并非实指，而是泛指重大的罪行。然而，在我国古代，该成语中的“十恶”却是实有所指的。古代的“十恶”指的是律法规定的十条大罪，它是在西汉的“大逆不道不敬”罪的基础上发展起来的。\r\n</p>\r\n<p style=\"color:#444444;text-indent:30px;font-size:15px;font-family:doublevregular, \'Microsoft YaHei\', \'Trebuchet MS\', Verdana, Tahoma, Arial, sans-serif;background-color:#FFFFFF;\">\r\n	北齐河清三年，尚书令、赵郡王等奏上《齐律》十二篇，“列重罪十条：一曰反逆，二曰大逆，三曰叛，四曰降，五曰恶逆，六曰不道，七曰不敬，八曰不孝，九曰不义，十曰内乱。其犯此十者，不在八议论赎之限。”\r\n</p>\r\n<p style=\"color:#444444;text-indent:30px;font-size:15px;font-family:doublevregular, \'Microsoft YaHei\', \'Trebuchet MS\', Verdana, Tahoma, Arial, sans-serif;background-color:#FFFFFF;\">\r\n	而到了隋朝开皇初年，随着佛教的兴盛，封建统治者遂将佛教之中的“十恶”之名引入律法，以之代替了《齐律》中的“重罪十条”，“十恶”之罪名遂正式出现。如《隋书·刑法志》卷二十五卷即载：“开皇元年……更定新律（指《开皇律》）……又置十恶之条，多采后齐之制，而颇有损益。一曰谋反，二曰谋大逆，三曰谋叛，四曰恶逆，五曰不道，六曰大不敬，七曰不孝，八曰不睦，九曰不义，十曰内乱。犯十恶及故杀人狱成者，虽会赦犹除名。”\r\n</p>\r\n<p style=\"color:#444444;text-indent:30px;font-size:15px;font-family:doublevregular, \'Microsoft YaHei\', \'Trebuchet MS\', Verdana, Tahoma, Arial, sans-serif;background-color:#FFFFFF;\">\r\n	“十恶”之罪的具体内容，《唐律疏议》中也有详细的规定。由于“十恶”之罪直接危害了君主专制制度的核心——君权、父权、神权和夫权，所以自隋代在《开皇律》中首次确立“十恶”之罪以后，历朝历代律法皆将之作为不赦之重罪，因此，遂有“十恶不赦”之说。\r\n</p>\r\n<p style=\"color:#444444;text-indent:30px;font-size:15px;font-family:doublevregular, \'Microsoft YaHei\', \'Trebuchet MS\', Verdana, Tahoma, Arial, sans-serif;background-color:#FFFFFF;\">\r\n	另外，“十”在语境中表示最多、全了、满了。十恶不赦，那就是恶贯满盈了。“十恶不赦”，常用来形容罪大恶极、不可宽恕的人。古人往往给敌人列上十大罪名，以便出师有名。\r\n</p>', '/images/user/2014/11/27/a86fbf07f2fc6e63973e2f295579bfa8.jpg', '1', '', '文化,典故', '1', '0', '66', '3', '1', '1', '1417073172', '1417160274');
INSERT INTO `lsz_post` VALUES ('2', '古代处决犯人为什么大多选在午时三刻？', '', '<p style=\"color:#444444;text-indent:30px;font-size:15px;font-family:doublevregular, \'Microsoft YaHei\', \'Trebuchet MS\', Verdana, Tahoma, Arial, sans-serif;background-color:#FFFFFF;\">\r\n	古代刑法中处决犯人时，不但在季节上有要求，并且还具体到一天当中的某一时刻。\r\n</p>\r\n<p style=\"color:#444444;text-indent:30px;font-size:15px;font-family:doublevregular, \'Microsoft YaHei\', \'Trebuchet MS\', Verdana, Tahoma, Arial, sans-serif;background-color:#FFFFFF;\">\r\n	季节上是统一到秋季，即秋后问斩。“秋后问斩”顾名思义，是指在秋季处死犯人。而处斩犯人的具体时间，则选在了秋季的某一天的“午时三刻”，为什么要选中这一时刻呢？因为根据阴阳五行学说，一年之中，秋季是阳气下降、阴气上升的时期，是属于死亡的季节；同样，一日之中，午时三刻以后，阳气下降、阴气上升，因此是死亡的时辰。\r\n</p>\r\n<p style=\"color:#444444;text-indent:30px;font-size:15px;font-family:doublevregular, \'Microsoft YaHei\', \'Trebuchet MS\', Verdana, Tahoma, Arial, sans-serif;background-color:#FFFFFF;\">\r\n	<strong>“午时三刻”具体指的是哪个时间段？</strong> \r\n</p>\r\n<p style=\"color:#444444;text-indent:30px;font-size:15px;font-family:doublevregular, \'Microsoft YaHei\', \'Trebuchet MS\', Verdana, Tahoma, Arial, sans-serif;background-color:#FFFFFF;\">\r\n	“午时三刻”是在百刻制使用期间制定出来的。如果令一个时辰等于八刻的话，这一天就多出四刻。为此，有人提出在十二时辰中，子、卯、午、酉各九刻，其余的则为八刻；还有另一种提法则是，子、午各十刻，其余则八刻等。两种说法结合起来分析的话，都是中午以前和中午以后的半天将各分到二刻。这样一来，午时三刻加上前半天分到的二刻，就相当于午时五刻，也就是相当于全部午时（11：00～13：00）的一半，这个时间正好是中午十二点。\r\n</p>', '/images/user/2014/11/28/3cf6dde9ed1a0936d1689aea26769755.jpg', '1', 'http://www.lishiz.com/article/5416.html', '时间,行刑', '1', '0', '48', '5', '1', '1', '1417160175', '1417161029');
INSERT INTO `lsz_post` VALUES ('3', '扒一扒“陛下”一词的由来', '', '哈哈哈哈', '/images/user/2014/12/01/c823949ed5ca263327e0c6ac691fd22a.jpg', '1', '', '陛下', '0', '0', '2', '0', '1', '1', '1417413121', '1417413121');

-- ----------------------------
-- Table structure for `lsz_tags`
-- ----------------------------
DROP TABLE IF EXISTS `lsz_tags`;
CREATE TABLE `lsz_tags` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(32) NOT NULL,
  `nums` int(10) unsigned DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of lsz_tags
-- ----------------------------
INSERT INTO `lsz_tags` VALUES ('1', '汉朝', '1');
INSERT INTO `lsz_tags` VALUES ('2', '唐朝', '1');
INSERT INTO `lsz_tags` VALUES ('3', '文化', '12');
INSERT INTO `lsz_tags` VALUES ('4', '典故', '12');
INSERT INTO `lsz_tags` VALUES ('6', '时间', '12');
INSERT INTO `lsz_tags` VALUES ('7', '行刑', '12');
INSERT INTO `lsz_tags` VALUES ('8', '史记', '1');
INSERT INTO `lsz_tags` VALUES ('9', '都嘟', '1');
INSERT INTO `lsz_tags` VALUES ('10', '马未都', '1');
INSERT INTO `lsz_tags` VALUES ('11', '彩票', '1');
INSERT INTO `lsz_tags` VALUES ('12', '赌博', '1');
INSERT INTO `lsz_tags` VALUES ('13', '衙门', '1');
INSERT INTO `lsz_tags` VALUES ('14', '官府', '1');
INSERT INTO `lsz_tags` VALUES ('15', '陛下', '1');

-- ----------------------------
-- Table structure for `lsz_topic`
-- ----------------------------
DROP TABLE IF EXISTS `lsz_topic`;
CREATE TABLE `lsz_topic` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `content` text NOT NULL,
  `tags` varchar(100) DEFAULT NULL,
  `votes` int(10) unsigned DEFAULT '0',
  `views` int(10) unsigned DEFAULT '0',
  `follows` int(10) unsigned NOT NULL DEFAULT '0',
  `comments` int(10) unsigned DEFAULT '0',
  `user_id` int(10) unsigned DEFAULT '0',
  `status` tinyint(1) unsigned DEFAULT '0',
  `create_time` int(10) unsigned DEFAULT '0',
  `last_update` int(10) unsigned DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `title` (`title`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of lsz_topic
-- ----------------------------
INSERT INTO `lsz_topic` VALUES ('1', '古时候官府为什么又被称为“衙门”？', '<span style=\"color:#444444;font-family:doublevregular, \'Microsoft YaHei\', \'Trebuchet MS\', Verdana, Tahoma, Arial, sans-serif;font-size:15px;line-height:25.5px;background-color:#FFFFFF;\">尽管中国古代是一个皇权高度集中的社会，但是毕竟皇帝精力有限，他不可能事必躬亲，于是便在全国各地设立了很多的机构来协助其治理国家，这些机构便称为官府。但是，根据现有史料的记载，古代官府还有另外一种说法——衙门。这是为什么呢？</span>', '衙门,官府', '1', '8', '1', '1', '1', '1', '1417319235', '1417319235');

-- ----------------------------
-- Table structure for `lsz_user`
-- ----------------------------
DROP TABLE IF EXISTS `lsz_user`;
CREATE TABLE `lsz_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(16) NOT NULL,
  `email` varchar(32) NOT NULL,
  `pass` varchar(32) NOT NULL,
  `avatar` varchar(100) DEFAULT NULL,
  `follows` int(10) unsigned DEFAULT '0',
  `intro` varchar(200) DEFAULT NULL,
  `role` tinyint(1) unsigned DEFAULT '1',
  `level` tinyint(3) unsigned DEFAULT '0',
  `point` int(10) unsigned DEFAULT '0',
  `qq` varchar(16) DEFAULT NULL,
  `weixin` varchar(32) DEFAULT NULL,
  `weibo` varchar(100) DEFAULT NULL,
  `site` varchar(100) DEFAULT NULL,
  `status` tinyint(1) unsigned DEFAULT '0',
  `register_time` int(10) unsigned DEFAULT '0',
  `last_update` int(10) unsigned DEFAULT '0',
  `last_login` int(10) unsigned DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `qq` (`qq`),
  UNIQUE KEY `weixin` (`weixin`),
  UNIQUE KEY `weibo` (`weibo`),
  UNIQUE KEY `site` (`site`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of lsz_user
-- ----------------------------
INSERT INTO `lsz_user` VALUES ('1', 'admin', 'admin@lishiz.com', 'c193b40010f0fac20bc869ba50f003e6', '/images/user/2014/12/01/d245e2c15775950070e127790fc87859.jpg', '1', null, '1', '0', '0', null, null, null, null, '0', '1417066194', '0', '0');
INSERT INTO `lsz_user` VALUES ('2', 'test', 'test@lishiz.com', 'e10adc3949ba59abbe56e057f20f883e', null, '1', null, '1', '0', '0', null, null, null, null, '0', '1417323848', '0', '0');

-- ----------------------------
-- Table structure for `lsz_user_collect`
-- ----------------------------
DROP TABLE IF EXISTS `lsz_user_collect`;
CREATE TABLE `lsz_user_collect` (
  `user_id` int(10) unsigned NOT NULL,
  `obj_id` int(10) unsigned NOT NULL,
  `obj_type` tinyint(3) unsigned NOT NULL,
  PRIMARY KEY (`user_id`,`obj_id`,`obj_type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of lsz_user_collect
-- ----------------------------
INSERT INTO `lsz_user_collect` VALUES ('1', '2', '2');
INSERT INTO `lsz_user_collect` VALUES ('2', '1', '3');

-- ----------------------------
-- Table structure for `lsz_user_flow`
-- ----------------------------
DROP TABLE IF EXISTS `lsz_user_flow`;
CREATE TABLE `lsz_user_flow` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `obj_id` int(10) unsigned NOT NULL,
  `obj_title` varchar(100) NOT NULL,
  `obj_type` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `opt_type` tinyint(1) unsigned DEFAULT '0',
  `obj_status` tinyint(1) unsigned DEFAULT '0',
  `log_time` int(10) unsigned DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=60 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of lsz_user_flow
-- ----------------------------
INSERT INTO `lsz_user_flow` VALUES ('16', '1', '2', '古代处决犯人为什么大多选在午时三刻？', '2', '1', '1', '1417161030');
INSERT INTO `lsz_user_flow` VALUES ('17', '1', '1', '十恶不赦”中的十恶指的是哪十恶？', '2', '5', '1', '1417250375');
INSERT INTO `lsz_user_flow` VALUES ('18', '1', '1', '十恶不赦”中的十恶指的是哪十恶？', '2', '6', '1', '1417281122');
INSERT INTO `lsz_user_flow` VALUES ('19', '1', '1', '十恶不赦”中的十恶指的是哪十恶？', '2', '5', '1', '1417288204');
INSERT INTO `lsz_user_flow` VALUES ('20', '1', '1', '十恶不赦”中的十恶指的是哪十恶？', '2', '6', '1', '1417289987');
INSERT INTO `lsz_user_flow` VALUES ('21', '1', '1', '十恶不赦”中的十恶指的是哪十恶？', '2', '5', '1', '1417289999');
INSERT INTO `lsz_user_flow` VALUES ('22', '1', '1', '十恶不赦”中的十恶指的是哪十恶？', '2', '6', '1', '1417290060');
INSERT INTO `lsz_user_flow` VALUES ('23', '1', '1', '十恶不赦”中的十恶指的是哪十恶？', '2', '5', '1', '1417290092');
INSERT INTO `lsz_user_flow` VALUES ('24', '1', '1', '十恶不赦”中的十恶指的是哪十恶？', '2', '6', '1', '1417290109');
INSERT INTO `lsz_user_flow` VALUES ('25', '1', '1', '十恶不赦”中的十恶指的是哪十恶？', '2', '5', '1', '1417290125');
INSERT INTO `lsz_user_flow` VALUES ('26', '1', '1', '十恶不赦”中的十恶指的是哪十恶？', '2', '6', '1', '1417290126');
INSERT INTO `lsz_user_flow` VALUES ('27', '1', '1', '十恶不赦”中的十恶指的是哪十恶？', '2', '5', '1', '1417290128');
INSERT INTO `lsz_user_flow` VALUES ('28', '1', '1', '十恶不赦”中的十恶指的是哪十恶？', '2', '6', '1', '1417290129');
INSERT INTO `lsz_user_flow` VALUES ('29', '1', '1', '十恶不赦”中的十恶指的是哪十恶？', '2', '3', '1', '1417290923');
INSERT INTO `lsz_user_flow` VALUES ('30', '1', '1', '十恶不赦”中的十恶指的是哪十恶？', '2', '4', '1', '1417290925');
INSERT INTO `lsz_user_flow` VALUES ('31', '1', '1', '十恶不赦”中的十恶指的是哪十恶？', '2', '3', '1', '1417290926');
INSERT INTO `lsz_user_flow` VALUES ('32', '1', '1', '十恶不赦”中的十恶指的是哪十恶？', '2', '4', '1', '1417290927');
INSERT INTO `lsz_user_flow` VALUES ('33', '1', '1', '史记(1-10)(套装共10册)(二十四史繁体竖排)', '3', '1', '1', '1417315010');
INSERT INTO `lsz_user_flow` VALUES ('34', '1', '1', '史记(1-10)(套装共10册)(二十四史繁体竖排)', '3', '5', '1', '1417317117');
INSERT INTO `lsz_user_flow` VALUES ('35', '1', '1', '史记(1-10)(套装共10册)(二十四史繁体竖排)', '3', '6', '1', '1417317119');
INSERT INTO `lsz_user_flow` VALUES ('36', '1', '1', '史记(1-10)(套装共10册)(二十四史繁体竖排)', '3', '5', '1', '1417317119');
INSERT INTO `lsz_user_flow` VALUES ('37', '1', '1', '《都嘟》第4期【中国好赌徒】', '4', '1', '1', '1417318777');
INSERT INTO `lsz_user_flow` VALUES ('38', '1', '1', '古时候官府为什么又被称为“衙门”？', '5', '1', '1', '1417319235');
INSERT INTO `lsz_user_flow` VALUES ('39', '1', '2', '古代处决犯人为什么大多选在午时三刻？', '2', '5', '1', '1417322862');
INSERT INTO `lsz_user_flow` VALUES ('40', '1', '2', '古代处决犯人为什么大多选在午时三刻？', '2', '6', '1', '1417322863');
INSERT INTO `lsz_user_flow` VALUES ('41', '1', '1', '史记(1-10)(套装共10册)(二十四史繁体竖排)', '3', '9', '1', '1417323678');
INSERT INTO `lsz_user_flow` VALUES ('42', '1', '1', '史记(1-10)(套装共10册)(二十四史繁体竖排)', '3', '9', '1', '1417323702');
INSERT INTO `lsz_user_flow` VALUES ('43', '1', '1', '史记(1-10)(套装共10册)(二十四史繁体竖排)', '3', '9', '1', '1417323706');
INSERT INTO `lsz_user_flow` VALUES ('44', '1', '1', '史记(1-10)(套装共10册)(二十四史繁体竖排)', '3', '9', '1', '1417323722');
INSERT INTO `lsz_user_flow` VALUES ('45', '1', '1', '史记(1-10)(套装共10册)(二十四史繁体竖排)', '3', '9', '1', '1417323784');
INSERT INTO `lsz_user_flow` VALUES ('46', '2', '1', '古时候官府为什么又被称为“衙门”？', '5', '5', '1', '1417324242');
INSERT INTO `lsz_user_flow` VALUES ('47', '2', '1', '古时候官府为什么又被称为“衙门”？', '5', '7', '1', '1417324244');
INSERT INTO `lsz_user_flow` VALUES ('48', '2', '1', '古时候官府为什么又被称为“衙门”？', '5', '9', '1', '1417324317');
INSERT INTO `lsz_user_flow` VALUES ('49', '2', '1', '十恶不赦”中的十恶指的是哪十恶？', '2', '9', '1', '1417325343');
INSERT INTO `lsz_user_flow` VALUES ('50', '2', '1', '史记(1-10)(套装共10册)(二十四史繁体竖排)', '3', '9', '1', '1417325648');
INSERT INTO `lsz_user_flow` VALUES ('51', '2', '1', '史记(1-10)(套装共10册)(二十四史繁体竖排)', '3', '9', '1', '1417326546');
INSERT INTO `lsz_user_flow` VALUES ('52', '2', '1', '史记(1-10)(套装共10册)(二十四史繁体竖排)', '3', '3', '1', '1417326737');
INSERT INTO `lsz_user_flow` VALUES ('53', '2', '1', '史记(1-10)(套装共10册)(二十四史繁体竖排)', '3', '5', '1', '1417326743');
INSERT INTO `lsz_user_flow` VALUES ('54', '2', '2', '古代处决犯人为什么大多选在午时三刻？', '2', '9', '1', '1417328314');
INSERT INTO `lsz_user_flow` VALUES ('55', '1', '2', '古代处决犯人为什么大多选在午时三刻？', '2', '9', '1', '1417328354');
INSERT INTO `lsz_user_flow` VALUES ('56', '1', '2', '古代处决犯人为什么大多选在午时三刻？', '2', '9', '1', '1417328727');
INSERT INTO `lsz_user_flow` VALUES ('57', '1', '2', '古代处决犯人为什么大多选在午时三刻？', '2', '9', '1', '1417329188');
INSERT INTO `lsz_user_flow` VALUES ('58', '1', '2', '古代处决犯人为什么大多选在午时三刻？', '2', '9', '1', '1417329202');
INSERT INTO `lsz_user_flow` VALUES ('59', '1', '3', '扒一扒“陛下”一词的由来', '2', '1', '1', '1417413121');

-- ----------------------------
-- Table structure for `lsz_user_follow`
-- ----------------------------
DROP TABLE IF EXISTS `lsz_user_follow`;
CREATE TABLE `lsz_user_follow` (
  `user_id` int(10) unsigned NOT NULL,
  `obj_id` int(10) unsigned NOT NULL,
  `obj_type` tinyint(3) unsigned NOT NULL,
  PRIMARY KEY (`user_id`,`obj_id`,`obj_type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of lsz_user_follow
-- ----------------------------
INSERT INTO `lsz_user_follow` VALUES ('1', '2', '1');
INSERT INTO `lsz_user_follow` VALUES ('2', '1', '1');
INSERT INTO `lsz_user_follow` VALUES ('2', '1', '5');

-- ----------------------------
-- Table structure for `lsz_user_message`
-- ----------------------------
DROP TABLE IF EXISTS `lsz_user_message`;
CREATE TABLE `lsz_user_message` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `subject` varchar(100) NOT NULL,
  `content` text NOT NULL,
  `status` tinyint(1) unsigned DEFAULT '0',
  `send_time` int(10) unsigned DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of lsz_user_message
-- ----------------------------
INSERT INTO `lsz_user_message` VALUES ('1', '1', '您于2014-11-29 11:10:38重置密码', '', '0', '1417255838');
INSERT INTO `lsz_user_message` VALUES ('2', '1', '您于2014-11-29 17:38:19重置密码', '', '0', '1417279099');
INSERT INTO `lsz_user_message` VALUES ('3', '1', '您的图书有了新点赞', 'admin点赞您的图书：<a href=\"/book/1\">史记(1-10)(套装共10册)(二十四史繁体竖排)</a>', '0', '1417317117');
INSERT INTO `lsz_user_message` VALUES ('4', '1', '您的图书有了新取消点赞', 'admin取消点赞您的图书：<a href=\"/book/1\">史记(1-10)(套装共10册)(二十四史繁体竖排)</a>', '0', '1417317119');
INSERT INTO `lsz_user_message` VALUES ('5', '1', '您的图书有了新点赞', 'admin点赞您的图书：<a href=\"/book/1\">史记(1-10)(套装共10册)(二十四史繁体竖排)</a>', '1', '1417317119');
INSERT INTO `lsz_user_message` VALUES ('6', '1', '您的视频有了新创建', 'admin创建您的视频：<a href=\"/video/1\">《都嘟》第4期【中国好赌徒】</a>', '0', '1417318777');
INSERT INTO `lsz_user_message` VALUES ('7', '1', '您的小组有了新创建', 'admin创建您的小组：<a href=\"/topic/1\">古时候官府为什么又被称为“衙门”？</a>', '0', '1417319235');
INSERT INTO `lsz_user_message` VALUES ('8', '1', '您有一条新回复', 'admin于2014-11-30 06:03:04回复了您的评论：<a href=\"/book/1\">史记(1-10)(套装共10册)(二十四史繁体竖排)</a>', '1', '1417323784');
INSERT INTO `lsz_user_message` VALUES ('9', '1', '您的话题有了新点赞', 'test点赞您的话题：<a href=\"/topic/1\">古时候官府为什么又被称为“衙门”？</a>', '0', '1417324242');
INSERT INTO `lsz_user_message` VALUES ('10', '1', '您的话题有了新关注', 'test关注您的话题：<a href=\"/topic/1\">古时候官府为什么又被称为“衙门”？</a>', '1', '1417324244');
INSERT INTO `lsz_user_message` VALUES ('11', '1', '您的话题有了新评论', 'test评论您的话题：<a href=\"/topic/1\">古时候官府为什么又被称为“衙门”？</a>', '0', '1417324317');
INSERT INTO `lsz_user_message` VALUES ('12', '1', '您的文章有了新评论', 'test评论您的文章：<a href=\"/post/1\">十恶不赦”中的十恶指的是哪十恶？</a>', '0', '1417325343');
INSERT INTO `lsz_user_message` VALUES ('13', '1', '您的图书有了新评论', 'test评论您的图书：<a href=\"/book/1\">史记(1-10)(套装共10册)(二十四史繁体竖排)</a>', '0', '1417325648');
INSERT INTO `lsz_user_message` VALUES ('14', '1', '您的图书有了新评论', 'test评论您的图书：<a href=\"/book/1\">史记(1-10)(套装共10册)(二十四史繁体竖排)</a>', '1', '1417326546');
INSERT INTO `lsz_user_message` VALUES ('15', '1', '您有一条新回复', 'test于2014-11-30 06:49:06回复了您的评论：<a href=\"/book/1\">史记(1-10)(套装共10册)(二十四史繁体竖排)</a>', '1', '1417326546');
INSERT INTO `lsz_user_message` VALUES ('16', '1', '您的图书有了新收藏', 'test收藏您的图书：<a href=\"/book/1\">史记(1-10)(套装共10册)(二十四史繁体竖排)</a>', '0', '1417326737');
INSERT INTO `lsz_user_message` VALUES ('17', '1', '您的图书有了新点赞', 'test点赞您的图书：<a href=\"/book/1\">史记(1-10)(套装共10册)(二十四史繁体竖排)</a>', '0', '1417326743');
INSERT INTO `lsz_user_message` VALUES ('18', '2', '新用户关注', 'admin于2014-11-30 07:16:55关注了您！', '1', '1417328215');
INSERT INTO `lsz_user_message` VALUES ('19', '2', '新用户关注', 'admin于2014-11-30 07:16:57关注了您！', '1', '1417328217');
INSERT INTO `lsz_user_message` VALUES ('20', '1', '您的文章有了新评论', 'test评论您的文章：<a href=\"/post/2\">古代处决犯人为什么大多选在午时三刻？</a>', '1', '1417328314');
INSERT INTO `lsz_user_message` VALUES ('21', '1', '您有一条新回复', 'admin于2014-11-30 07:19:14回复了您的评论：<a href=\"/post/2\">古代处决犯人为什么大多选在午时三刻？</a>', '0', '1417328354');
INSERT INTO `lsz_user_message` VALUES ('22', '1', '您有一条新回复', 'admin于2014-11-30 07:25:27回复了您的评论：<a href=\"/post/2\">古代处决犯人为什么大多选在午时三刻？</a>', '0', '1417328727');
INSERT INTO `lsz_user_message` VALUES ('23', '1', '您有一条新回复', 'admin于2014-11-30 07:33:08回复了您的评论：<a href=\"/post/2\">古代处决犯人为什么大多选在午时三刻？</a>', '0', '1417329188');
INSERT INTO `lsz_user_message` VALUES ('24', '2', '您有一条新回复', 'admin于2014-11-30 07:33:22回复了您的评论：<a href=\"/post/2\">古代处决犯人为什么大多选在午时三刻？</a>', '0', '1417329202');
INSERT INTO `lsz_user_message` VALUES ('25', '1', '修改头像', '您于2014-12-01 06:45:31修改了头像', '1', '1417412731');
INSERT INTO `lsz_user_message` VALUES ('26', '1', '您有一个新点赞', 'admin于2014-12-01 07:46:58点赞了您的评论：<a href=\"/post/1\">十恶不赦”中的十恶指的是哪十恶？</a>', '0', '1417416418');
INSERT INTO `lsz_user_message` VALUES ('27', '1', '您有一个新点赞', 'admin于2014-12-01 08:03:12点赞了您的评论：<a href=\"/post/1\">十恶不赦”中的十恶指的是哪十恶？</a>', '0', '1417417392');
INSERT INTO `lsz_user_message` VALUES ('28', '1', '您有一个新点赞', 'admin于2014-12-01 08:03:12点赞了您的评论：<a href=\"/post/1\">十恶不赦”中的十恶指的是哪十恶？</a>', '0', '1417417392');
INSERT INTO `lsz_user_message` VALUES ('29', '1', '您有一个新点赞', 'admin于2014-12-01 08:03:12点赞了您的评论：<a href=\"/post/1\">十恶不赦”中的十恶指的是哪十恶？</a>', '0', '1417417392');
INSERT INTO `lsz_user_message` VALUES ('30', '1', '您有一个新点赞', 'admin于2014-12-01 08:08:09点赞了您的评论：<a href=\"/post/2\">古代处决犯人为什么大多选在午时三刻？</a>', '1', '1417417689');
INSERT INTO `lsz_user_message` VALUES ('31', '1', '您有一个新点赞', 'admin于2014-12-01 08:08:12点赞了您的评论：<a href=\"/post/2\">古代处决犯人为什么大多选在午时三刻？</a>', '0', '1417417692');
INSERT INTO `lsz_user_message` VALUES ('32', '1', '您有一个新点赞', 'admin于2014-12-01 08:08:13点赞了您的评论：<a href=\"/post/2\">古代处决犯人为什么大多选在午时三刻？</a>', '0', '1417417693');

-- ----------------------------
-- Table structure for `lsz_user_upload`
-- ----------------------------
DROP TABLE IF EXISTS `lsz_user_upload`;
CREATE TABLE `lsz_user_upload` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `path` varchar(100) NOT NULL,
  `title` varchar(100) DEFAULT NULL,
  `description` text,
  `media_type` tinyint(1) unsigned DEFAULT '1',
  `upload_time` int(10) unsigned DEFAULT '0',
  `last_update` int(10) unsigned DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of lsz_user_upload
-- ----------------------------
INSERT INTO `lsz_user_upload` VALUES ('1', '1', '/images/user/2014/12/01/c823949ed5ca263327e0c6ac691fd22a.jpg', null, null, '1', '1417413097', '1417413097');

-- ----------------------------
-- Table structure for `lsz_user_vote`
-- ----------------------------
DROP TABLE IF EXISTS `lsz_user_vote`;
CREATE TABLE `lsz_user_vote` (
  `user_id` int(10) unsigned NOT NULL,
  `obj_id` int(10) unsigned NOT NULL,
  `obj_type` tinyint(3) unsigned NOT NULL,
  PRIMARY KEY (`user_id`,`obj_id`,`obj_type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of lsz_user_vote
-- ----------------------------
INSERT INTO `lsz_user_vote` VALUES ('1', '1', '3');
INSERT INTO `lsz_user_vote` VALUES ('1', '1', '7');
INSERT INTO `lsz_user_vote` VALUES ('1', '2', '7');
INSERT INTO `lsz_user_vote` VALUES ('1', '3', '7');
INSERT INTO `lsz_user_vote` VALUES ('1', '4', '7');
INSERT INTO `lsz_user_vote` VALUES ('1', '18', '7');
INSERT INTO `lsz_user_vote` VALUES ('2', '1', '3');
INSERT INTO `lsz_user_vote` VALUES ('2', '1', '5');
INSERT INTO `lsz_user_vote` VALUES ('2', '1', '6');
INSERT INTO `lsz_user_vote` VALUES ('2', '9', '6');

-- ----------------------------
-- Table structure for `lsz_video`
-- ----------------------------
DROP TABLE IF EXISTS `lsz_video`;
CREATE TABLE `lsz_video` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `category` tinyint(1) unsigned NOT NULL,
  `cover` varchar(100) NOT NULL,
  `title` varchar(100) NOT NULL,
  `content` text NOT NULL,
  `actor` varchar(100) DEFAULT NULL,
  `url` varchar(200) DEFAULT NULL,
  `tags` varchar(100) DEFAULT NULL,
  `votes` int(10) unsigned DEFAULT '0',
  `views` int(10) unsigned DEFAULT '0',
  `collects` int(10) unsigned DEFAULT '0',
  `comments` int(10) unsigned DEFAULT '0',
  `user_id` int(10) unsigned DEFAULT '0',
  `status` tinyint(1) unsigned DEFAULT '0',
  `create_time` int(10) unsigned DEFAULT '0',
  `last_update` int(10) unsigned DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`title`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of lsz_video
-- ----------------------------
INSERT INTO `lsz_video` VALUES ('1', '4', '/images/user/2014/11/30/b7ff9d5649fa0ba58cb34ee05a46c637.jpg', '《都嘟》第4期【中国好赌徒】', '<span style=\"color:#909090;font-family:\'Microsoft YaHei\', 微软雅黑, helvetica, arial, verdana, tahoma, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">听马未都“都嘟”奇怪的彩票制度。</span>', '马未都', 'http://v.youku.com/v_show/id_XODM3MTI3Nzc2.html?from=y1.3-movie-grid-1095-9921.86981.1-3', '都嘟,马未都,彩票,赌博', '0', '5', '0', '0', '1', '1', '1417318777', '1417318777');

-- ----------------------------
-- Table structure for `tbl_migration`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_migration`;
CREATE TABLE `tbl_migration` (
  `version` varchar(255) NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbl_migration
-- ----------------------------
INSERT INTO `tbl_migration` VALUES ('m000000_000000_base', '1416981706');
INSERT INTO `tbl_migration` VALUES ('m141126_021055_create_user_table', '1417066140');
INSERT INTO `tbl_migration` VALUES ('m141126_021137_create_post_table', '1417066140');
INSERT INTO `tbl_migration` VALUES ('m141126_021215_create_group_table', '1417066140');
INSERT INTO `tbl_migration` VALUES ('m141126_021425_create_ask_table', '1417066140');
INSERT INTO `tbl_migration` VALUES ('m141126_021549_create_book_table', '1417066141');
INSERT INTO `tbl_migration` VALUES ('m141126_021653_create_video_table', '1417066141');
INSERT INTO `tbl_migration` VALUES ('m141126_021741_create_comment_table', '1417066141');
INSERT INTO `tbl_migration` VALUES ('m141126_071943_create_tags_table', '1417066141');
INSERT INTO `tbl_migration` VALUES ('m141126_083827_create_topic_table', '1417066141');
INSERT INTO `tbl_migration` VALUES ('m141127_041852_create_user_vote_table', '1417066142');
INSERT INTO `tbl_migration` VALUES ('m141127_062024_create_group_member_table', '1417069560');
INSERT INTO `tbl_migration` VALUES ('m141127_062051_create_user_collect_table', '1417069560');
INSERT INTO `tbl_migration` VALUES ('m141127_062129_create_user_follow_table', '1417069560');
INSERT INTO `tbl_migration` VALUES ('m141128_065200_create_user_flow_table', '1417158612');
INSERT INTO `tbl_migration` VALUES ('m141128_070255_create_user_message_table', '1417158612');
INSERT INTO `tbl_migration` VALUES ('m141201_020735_create_image_table', '1417409533');
INSERT INTO `tbl_migration` VALUES ('m141201_023002_create_user_upload_table', '1417409533');
INSERT INTO `tbl_migration` VALUES ('m141201_044721_create_image_upload_table', '1417409534');
