-- --------------------------------------------------------
-- 主机:                           127.0.0.1
-- 服务器版本:                        5.5.53 - MySQL Community Server (GPL)
-- 服务器操作系统:                      Win32
-- HeidiSQL 版本:                  8.3.0.4694
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- 导出 hmvc 的数据库结构
CREATE DATABASE IF NOT EXISTS `hmvc` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `hmvc`;


-- 导出  表 hmvc.h_logs 结构
CREATE TABLE IF NOT EXISTS `h_logs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) DEFAULT '0',
  `level` varchar(10) DEFAULT 'system',
  `message` text,
  `location` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- 正在导出表  hmvc.h_logs 的数据：0 rows
/*!40000 ALTER TABLE `h_logs` DISABLE KEYS */;
/*!40000 ALTER TABLE `h_logs` ENABLE KEYS */;


-- 导出  表 hmvc.h_node 结构
CREATE TABLE IF NOT EXISTS `h_node` (
  `node_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `author` bigint(20) unsigned NOT NULL DEFAULT '0',
  `node_date` varchar(128) NOT NULL DEFAULT '0000-00-00 00:00:00',
  `node_status` varchar(20) NOT NULL DEFAULT 'publish',
  `comment_status` varchar(20) NOT NULL DEFAULT 'open',
  `node_type` varchar(20) NOT NULL DEFAULT 'node',
  `content_type` varchar(20) DEFAULT 'html',
  `comment_count` bigint(20) NOT NULL DEFAULT '0',
  `click_count` int(11) DEFAULT '0',
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`node_id`),
  KEY `node_author` (`author`),
  KEY `type_status_date` (`node_type`,`node_status`,`node_date`,`node_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- 正在导出表  hmvc.h_node 的数据：1 rows
/*!40000 ALTER TABLE `h_node` DISABLE KEYS */;
INSERT INTO `h_node` (`node_id`, `author`, `node_date`, `node_status`, `comment_status`, `node_type`, `content_type`, `comment_count`, `click_count`, `created_at`, `updated_at`) VALUES
	(1, 1, '2016-12-11 07:01:40', 'publish', 'open', 'node', 'html', 0, 0, 1481410906, 1481410906);
/*!40000 ALTER TABLE `h_node` ENABLE KEYS */;


-- 导出  表 hmvc.h_node_category 结构
CREATE TABLE IF NOT EXISTS `h_node_category` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `image` varchar(255) DEFAULT NULL,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `path` varchar(255) DEFAULT NULL,
  `level` smallint(5) unsigned DEFAULT '0',
  `count` int(11) DEFAULT '0',
  `sort_order` smallint(6) DEFAULT '0',
  `created_at` int(11) unsigned DEFAULT NULL,
  `updated_at` int(11) unsigned DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`category_id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- 正在导出表  hmvc.h_node_category 的数据：6 rows
/*!40000 ALTER TABLE `h_node_category` DISABLE KEYS */;
INSERT INTO `h_node_category` (`category_id`, `image`, `parent_id`, `path`, `level`, `count`, `sort_order`, `created_at`, `updated_at`, `status`) VALUES
	(1, NULL, 0, NULL, 0, 0, 0, 2017, 2017, 1),
	(2, NULL, 0, NULL, 0, 0, 0, 2017, 2017, 1),
	(3, NULL, 1, NULL, 1, 0, 1, 2017, 2017, 1),
	(4, NULL, 1, NULL, 1, 0, 0, 2017, 2017, 1),
	(5, NULL, 3, NULL, 2, 0, 1, 2017, 2017, 1),
	(6, NULL, 5, NULL, 3, 0, 0, 2017, 2017, 1);
/*!40000 ALTER TABLE `h_node_category` ENABLE KEYS */;


-- 导出  表 hmvc.h_node_category_language 结构
CREATE TABLE IF NOT EXISTS `h_node_category_language` (
  `category_id` int(11) NOT NULL DEFAULT '0',
  `language_id` int(11) NOT NULL DEFAULT '1',
  `title` varchar(255) NOT NULL DEFAULT '',
  `description` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- 正在导出表  hmvc.h_node_category_language 的数据：6 rows
/*!40000 ALTER TABLE `h_node_category_language` DISABLE KEYS */;
INSERT INTO `h_node_category_language` (`category_id`, `language_id`, `title`, `description`) VALUES
	(1, 1, '开发语言', ''),
	(2, 1, '前端语言', ''),
	(3, 1, 'Java', ''),
	(4, 1, 'JavaScript', ''),
	(5, 1, 'Spring', 'Spring Boot'),
	(6, 1, 'Spring AOP', '');
/*!40000 ALTER TABLE `h_node_category_language` ENABLE KEYS */;


-- 导出  表 hmvc.h_options 结构
CREATE TABLE IF NOT EXISTS `h_options` (
  `option_group` varchar(50) NOT NULL DEFAULT 'system',
  `option_name` varchar(191) NOT NULL DEFAULT '',
  `option_value` longtext NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- 正在导出表  hmvc.h_options 的数据：17 rows
/*!40000 ALTER TABLE `h_options` DISABLE KEYS */;
INSERT INTO `h_options` (`option_group`, `option_name`, `option_value`) VALUES
	('mail', 'timeout', '10'),
	('mail', 'port', '25'),
	('mail', 'password', ''),
	('mail', 'username', ''),
	('mail', 'hostname', ''),
	('mail', 'protocol', 'smtp'),
	('site', 'maintenance_info', '系统维护中,请稍后访问 ...'),
	('site', 'icp_number', 'ICP 1000000'),
	('system', 'admin_language', 'zh_CN'),
	('system', 'language', 'zh_CN'),
	('site', 'sitename', 'H1CMS v1.0'),
	('system', 'theme', 'basic'),
	('system', 'h1cms_version', 'v1.0.2'),
	('site', 'maintenance', '0'),
	('site', 'title', 'H1CMS OpenSource CMS'),
	('site', 'meta_keywords', 'OpenSource CMS'),
	('site', 'meta_description', 'H1CMS OpenSource CMS');
/*!40000 ALTER TABLE `h_options` ENABLE KEYS */;


-- 导出  表 hmvc.h_roles 结构
CREATE TABLE IF NOT EXISTS `h_roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL DEFAULT '',
  `description` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- 正在导出表  hmvc.h_roles 的数据：2 rows
/*!40000 ALTER TABLE `h_roles` DISABLE KEYS */;
INSERT INTO `h_roles` (`id`, `title`, `description`) VALUES
	(1, 'Administrator', '超级管理员'),
	(2, '高级工程师', 'user');
/*!40000 ALTER TABLE `h_roles` ENABLE KEYS */;


-- 导出  表 hmvc.h_role_permissions 结构
CREATE TABLE IF NOT EXISTS `h_role_permissions` (
  `role_id` int(11) NOT NULL DEFAULT '0',
  `permission` varchar(255) NOT NULL DEFAULT '0',
  `permission_name` varchar(255) DEFAULT NULL,
  `assign_time` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`role_id`,`permission`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- 正在导出表  hmvc.h_role_permissions 的数据：2 rows
/*!40000 ALTER TABLE `h_role_permissions` DISABLE KEYS */;
INSERT INTO `h_role_permissions` (`role_id`, `permission`, `permission_name`, `assign_time`) VALUES
	(1, 'admin.system', NULL, 1478348882),
	(1, 'admin.system.setting', NULL, 1478348882);
/*!40000 ALTER TABLE `h_role_permissions` ENABLE KEYS */;


-- 导出  表 hmvc.h_users 结构
CREATE TABLE IF NOT EXISTS `h_users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(128) NOT NULL DEFAULT '',
  `username` varchar(60) NOT NULL DEFAULT '',
  `password` varchar(255) NOT NULL DEFAULT '',
  `created_at` int(11) DEFAULT '0',
  `updated_at` int(11) DEFAULT '0',
  `status` int(11) NOT NULL DEFAULT '0',
  `display_name` varchar(250) NOT NULL DEFAULT '',
  `avatar` varchar(255) DEFAULT NULL,
  `private_notes` varchar(255) DEFAULT NULL,
  `lasttime` int(11) DEFAULT '0',
  `lastip` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_email` (`email`),
  KEY `user_login_key` (`username`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- 正在导出表  hmvc.h_users 的数据：2 rows
/*!40000 ALTER TABLE `h_users` DISABLE KEYS */;
INSERT INTO `h_users` (`id`, `email`, `username`, `password`, `created_at`, `updated_at`, `status`, `display_name`, `avatar`, `private_notes`, `lasttime`, `lastip`) VALUES
	(1, 'support@getssl.cn', 'admin', '$2y$10$BKVsdKyiEr9tPwxBCx1y..8kxxFRWdRUJdFnabYtRTQbcHlYqHXOK', 1478521265, 1478521265, 1, 'Allen', NULL, NULL, 1514338527, '127.0.0.1'),
	(2, '83390286@qq.com', 'hmvc', '$2y$10$1GFmScPM/WJD2eRqiYKjheGmwfxLzXxk70pAz5ITemIqJbfn4a6tG', 0, 0, 0, 'hmvc', NULL, NULL, 0, NULL);
/*!40000 ALTER TABLE `h_users` ENABLE KEYS */;


-- 导出  表 hmvc.h_users_profile 结构
CREATE TABLE IF NOT EXISTS `h_users_profile` (
  `uid` int(11) NOT NULL DEFAULT '0',
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `sex` tinyint(3) DEFAULT '0',
  `birthday` date DEFAULT NULL COMMENT 'birthday',
  `company` varchar(255) DEFAULT NULL,
  `job_title` varchar(255) DEFAULT NULL,
  `about` text,
  `office_phone` varchar(255) DEFAULT NULL COMMENT '公司电话',
  `phone` varchar(255) DEFAULT NULL COMMENT '私人电话',
  PRIMARY KEY (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- 正在导出表  hmvc.h_users_profile 的数据：2 rows
/*!40000 ALTER TABLE `h_users_profile` DISABLE KEYS */;
INSERT INTO `h_users_profile` (`uid`, `first_name`, `last_name`, `sex`, `birthday`, `company`, `job_title`, `about`, `office_phone`, `phone`) VALUES
	(1, '振华', '牛', 1, '1990-01-20', 'GETSSL', 'CEO', '', '', '15216688667'),
	(2, '', '', 0, '0000-00-00', '', '', '', '', '');
/*!40000 ALTER TABLE `h_users_profile` ENABLE KEYS */;


-- 导出  表 hmvc.h_users_roles 结构
CREATE TABLE IF NOT EXISTS `h_users_roles` (
  `uid` int(11) NOT NULL DEFAULT '0',
  `role_id` int(11) NOT NULL DEFAULT '0',
  `assign_time` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`uid`,`role_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=FIXED;

-- 正在导出表  hmvc.h_users_roles 的数据：1 rows
/*!40000 ALTER TABLE `h_users_roles` DISABLE KEYS */;
INSERT INTO `h_users_roles` (`uid`, `role_id`, `assign_time`) VALUES
	(1, 1, 1478348882);
/*!40000 ALTER TABLE `h_users_roles` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
