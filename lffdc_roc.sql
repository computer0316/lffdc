-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 2018-07-26 15:08:05
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
  `department` int(11) NOT NULL COMMENT '发布部门',
  `creater` int(11) NOT NULL COMMENT '发布人',
  `updatetime` datetime NOT NULL,
  `times` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

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
('admin', '1', 1532413665),
('editor', '1', 1532413945),
('guest', '1', 1532414512),
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
  `outsite` int(11) DEFAULT NULL COMMENT '是否外部链接',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=18 ;

--
-- 转存表中的数据 `category`
--

INSERT INTO `category` (`id`, `name`, `fatherid`, `url`, `outsite`) VALUES
(0, '根', -1, '', 0),
(3, '房产新闻', 0, NULL, NULL),
(4, '物业新闻', 3, NULL, NULL),
(6, '中介新闻', 3, NULL, NULL),
(7, '产权交易', 3, NULL, NULL),
(8, '本地新闻', 3, NULL, NULL),
(9, NULL, 3, 'http://www.ifeng.com/', NULL),
(10, '政策法规', 0, NULL, NULL),
(11, '政务公开', 0, NULL, NULL),
(12, '办事指南', 0, NULL, NULL),
(13, '行政执法公示', 0, NULL, NULL),
(14, '商品房预售', 11, NULL, NULL),
(15, '开发企业资质', 11, NULL, NULL),
(16, '售前预售', 14, NULL, NULL),
(17, '售后预售', 14, NULL, NULL);

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
  `userid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
(7, '15530639625', '15530639625', '2226ce94cf0f3231556d320a9260f037', '2018-07-25 14:14:43', '2018-07-26 14:29:19', '127.0.0.1', 0);

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
