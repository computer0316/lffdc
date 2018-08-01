-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 2018-08-01 09:52:39
-- 服务器版本： 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `lffdc_roc`
--

-- --------------------------------------------------------

--
-- 表的结构 `article`
--

CREATE TABLE IF NOT EXISTS `article` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title_before` varchar(128) DEFAULT NULL,
  `title` varchar(128) NOT NULL,
  `title_after` varchar(128) DEFAULT NULL,
  `number` varchar(16) DEFAULT NULL COMMENT '文号',
  `text` mediumtext NOT NULL,
  `creater` int(11) NOT NULL COMMENT '发布人',
  `updatetime` datetime NOT NULL,
  `times` int(11) DEFAULT NULL,
  `ontop` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- 转存表中的数据 `article`
--

INSERT INTO `article` (`id`, `title_before`, `title`, `title_after`, `number`, `text`, `creater`, `updatetime`, `times`, `ontop`) VALUES
(1, '', '这里是标题', '', NULL, '<p>&lt;a href="#"&gt;test&lt;/a&gt;</p>', 7, '2018-07-27 10:46:59', NULL, 0),
(2, '', '这里是标题', '', NULL, '<p>&lt;a href="#"&gt;test&lt;/a&gt;</p>', 7, '2018-07-27 10:46:59', NULL, 0),
(3, '', '这里是标题', '', NULL, '<p>sdf</p>', 7, '2018-07-27 11:21:39', NULL, 0),
(4, '', '这里是标题', '', NULL, '<p>thry</p>', 1, '2018-07-30 16:58:08', NULL, 0),
(5, '', '这里是标题', '', NULL, '<p>thry</p>', 1, '2018-07-30 16:58:08', NULL, 0),
(6, '', '这里是标题', '', NULL, '<p>ddd</p>', 1, '2018-07-30 17:02:05', NULL, 0),
(7, '', '这里是标题', '', NULL, '<p>sdfsdf</p>', 1, '2018-07-30 17:02:42', NULL, 0),
(8, '', '这里是标题', '', NULL, '<p>kluh</p>', 1, '2018-07-30 17:03:13', NULL, 0),
(9, '', '市房管局举行“我为提升服务献一计”活动', '', '', '<p> 为深入开展“解放思想大讨论”活动，全面查找我局机关服务存在的不足，进一步改进工作作风，提高全局的服务水平和工作效率，增强全体工作人员立足岗位、干事创业的责任感，市房管局于7月27日开展了“我为提升服务献一计”活动。 </p><p> “我为提升服务献一计”活动面向全体工作人员，内容要求就如何提升服务素质、优化环境服务、改革服务流程、打造服务品牌、完善服务机制等方面谈感想、提建议、献计策。此次活动得到了全体工作人员的热烈支持，共收到有效建议18条，为提升我局机关服务效率和服务质量具有一定的借鉴意义。会上，市房管局党委书记、局长刘文荣就局机关如何进一步提升服务提出了要求。一是认清形势，找准提升服务制高点。按照“六个高质量”发展要求，持续推进“放管服”改革，完善政务服务“一张网”建设，建立标准体系，强化联动机制，拓展服务功能。二是倾心工作，找准提升服务的发力点。全体机关工作人员要树立全局一盘棋的思想，上下同心、目标同向、工作同步，在机关要能坐得住，在基层能够沉下去，振奋精神，始终锐意进取，全心全意做好机关工作和对局属基层单位的督查指导。局机关各处室要把前期梳理的解放思想大讨论调研成果，实实在在落到解决深层次问题上来。 </p>', 1, '2018-08-01 07:16:55', NULL, 0);

-- --------------------------------------------------------

--
-- 表的结构 `auth_assignment`
--

CREATE TABLE IF NOT EXISTS `auth_assignment` (
  `item_name` varchar(64) NOT NULL,
  `user_id` varchar(64) NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`item_name`,`user_id`),
  KEY `auth_assignment_user_id_idx` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `auth_assignment`
--

INSERT INTO `auth_assignment` (`item_name`, `user_id`, `created_at`) VALUES
('admin', '1', 1532939512),
('admin', '7', 1532658060),
('user', '6', 1532414741);

-- --------------------------------------------------------

--
-- 表的结构 `auth_item`
--

CREATE TABLE IF NOT EXISTS `auth_item` (
  `name` varchar(64) NOT NULL,
  `type` smallint(6) NOT NULL,
  `description` text,
  `rule_name` varchar(64) DEFAULT NULL,
  `data` blob,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`),
  KEY `rule_name` (`rule_name`),
  KEY `type` (`type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `auth_item`
--

INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
('admin', 1, '创建了 admin 角色', NULL, NULL, 1532240632, 1532240632),
('editor', 1, '创建了 editor 角色', NULL, NULL, 1532245984, 1532245984),
('guest', 1, '创建了 guest 角色', NULL, NULL, 1532300078, 1532300078),
('test', 1, '创建了 test 角色', NULL, NULL, 1532412135, 1532412135),
('user', 1, '创建了 user 角色', NULL, NULL, 1532245988, 1532245988);

-- --------------------------------------------------------

--
-- 表的结构 `auth_item_child`
--

CREATE TABLE IF NOT EXISTS `auth_item_child` (
  `parent` varchar(64) NOT NULL,
  `child` varchar(64) NOT NULL,
  PRIMARY KEY (`parent`,`child`),
  KEY `child` (`child`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `auth_rule`
--

CREATE TABLE IF NOT EXISTS `auth_rule` (
  `name` varchar(64) NOT NULL,
  `data` blob,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(32) DEFAULT NULL,
  `fatherid` int(11) NOT NULL,
  `url` varchar(512) DEFAULT NULL COMMENT '外部链接地址',
  `addmenu` int(11) DEFAULT NULL COMMENT '是否外部链接',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=40 ;

--
-- 转存表中的数据 `category`
--

INSERT INTO `category` (`id`, `name`, `fatherid`, `url`, `addmenu`) VALUES
(0, '根', -1, '', 0),
(20, '政务公开', 0, NULL, 1),
(21, '商品房预售', 20, NULL, 1),
(22, '开发企业资质', 20, NULL, 1),
(23, '物业企业资质', 20, NULL, 1),
(24, '房地产估价机构', 20, NULL, 1),
(25, '房地产经纪机构', 20, NULL, 0),
(26, '行政处罚案件', 20, NULL, 0),
(28, '政务公告', 20, NULL, 0),
(29, '政策法规', 0, NULL, 1),
(30, '房产开发', 29, NULL, 0),
(31, '物业管理', 29, NULL, 0),
(32, '产权交易', 29, NULL, 0),
(33, '中介评估', 29, NULL, 0),
(34, '住房保障', 29, NULL, 0),
(35, '房屋安全', 29, NULL, 0),
(36, '办事指南', 0, NULL, 1),
(37, '资质管理', 36, NULL, 0),
(39, '商品房预售1', 36, NULL, 0);

-- --------------------------------------------------------

--
-- 表的结构 `category_article`
--

CREATE TABLE IF NOT EXISTS `category_article` (
  `categoryid` int(11) NOT NULL,
  `articleid` int(11) NOT NULL,
  PRIMARY KEY (`categoryid`,`articleid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `category_article`
--

INSERT INTO `category_article` (`categoryid`, `articleid`) VALUES
(3, 4),
(3, 5),
(3, 6),
(3, 7),
(3, 9),
(4, 8);

-- --------------------------------------------------------

--
-- 表的结构 `category_user`
--

CREATE TABLE IF NOT EXISTS `category_user` (
  `categoryid` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  PRIMARY KEY (`categoryid`,`userid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `category_user`
--

INSERT INTO `category_user` (`categoryid`, `userid`) VALUES
(3, 1),
(4, 1),
(6, 1),
(7, 1),
(8, 1),
(9, 1);

-- --------------------------------------------------------

--
-- 表的结构 `department`
--

CREATE TABLE IF NOT EXISTS `department` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(32) NOT NULL,
  `managerid` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- 转存表中的数据 `department`
--

INSERT INTO `department` (`id`, `name`, `managerid`) VALUES
(1, '开发管理科', NULL),
(2, '物业处', NULL),
(3, '保障房中心', NULL),
(4, '廉租房中心', NULL),
(5, '机关党委', NULL),
(6, '财务科', NULL),
(7, '人事科', NULL);

-- --------------------------------------------------------

--
-- 表的结构 `department_user`
--

CREATE TABLE IF NOT EXISTS `department_user` (
  `departmentid` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  PRIMARY KEY (`departmentid`,`userid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `department_user`
--

INSERT INTO `department_user` (`departmentid`, `userid`) VALUES
(1, 1),
(2, 7);

-- --------------------------------------------------------

--
-- 表的结构 `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(16) NOT NULL,
  `mobile` varchar(16) NOT NULL,
  `password` varchar(64) NOT NULL,
  `firsttime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatetime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ip` varchar(32) NOT NULL,
  `admin` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- 转存表中的数据 `user`
--

INSERT INTO `user` (`id`, `name`, `mobile`, `password`, `firsttime`, `updatetime`, `ip`, `admin`) VALUES
(1, 'Roc', '13931657890', 'd4cd5e9c8f07658b81a06d17b6d321ea', '0000-00-00 00:00:00', '2018-07-02 08:56:05', '127.0.0.1', 1),
(7, '15530639625', '15530639625', '2226ce94cf0f3231556d320a9260f037', '2018-07-25 14:14:43', '2018-07-27 11:21:25', '127.0.0.1', 0);

--
-- 限制导出的表
--

--
-- 限制表 `auth_assignment`
--
ALTER TABLE `auth_assignment`
  ADD CONSTRAINT `auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 限制表 `auth_item`
--
ALTER TABLE `auth_item`
  ADD CONSTRAINT `auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `auth_rule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- 限制表 `auth_item_child`
--
ALTER TABLE `auth_item_child`
  ADD CONSTRAINT `auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
