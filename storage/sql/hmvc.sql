-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- 主机： 127.0.0.1
-- 生成日期： 2019-07-25 15:20:22
-- 服务器版本： 10.3.16-MariaDB
-- PHP 版本： 7.3.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 数据库： `hmvc`
--

-- --------------------------------------------------------

--
-- 表的结构 `h_attachment`
--

CREATE TABLE `h_attachment` (
  `id` int(10) UNSIGNED NOT NULL,
  `filename` varchar(255) NOT NULL,
  `meta_type` varchar(255) DEFAULT '',
  `width` int(10) UNSIGNED NOT NULL,
  `height` int(10) UNSIGNED NOT NULL,
  `type` varchar(15) NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- 表的结构 `h_logs`
--

CREATE TABLE `h_logs` (
  `id` int(11) NOT NULL,
  `uid` int(11) DEFAULT 0,
  `level` varchar(10) DEFAULT 'system',
  `message` text DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- 表的结构 `h_menu`
--

CREATE TABLE `h_menu` (
  `category_id` int(11) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `parent_id` int(11) NOT NULL DEFAULT 0,
  `path` varchar(255) DEFAULT NULL,
  `level` smallint(5) UNSIGNED DEFAULT 0,
  `count` int(11) DEFAULT 0,
  `sort_order` smallint(6) DEFAULT 0,
  `created_at` int(11) UNSIGNED DEFAULT NULL,
  `updated_at` int(11) UNSIGNED DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

--
-- 转存表中的数据 `h_menu`
--

INSERT INTO `h_menu` (`category_id`, `image`, `parent_id`, `path`, `level`, `count`, `sort_order`, `created_at`, `updated_at`, `status`) VALUES
(1, NULL, 0, '1', 0, 0, 3, 1515306164, 1515306164, 1),
(2, NULL, 0, '2', 0, 0, 0, 1515306164, 1515306164, 1),
(20, NULL, 2, '2,20', 1, 0, 0, 1515324913, 1515324913, 1),
(21, NULL, 2, '2,21', 1, 0, 0, 1515324920, 1515324920, 1),
(22, NULL, 1, '1,22', 1, 0, 0, 1515324929, 1515324929, 1),
(23, NULL, 1, '1,23', 1, 0, 0, 1515324935, 1515324935, 1),
(24, NULL, 1, '1,24', 1, 0, 0, 1515324945, 1515324945, 1);

-- --------------------------------------------------------

--
-- 表的结构 `h_menu_language`
--

CREATE TABLE `h_menu_language` (
  `category_id` int(11) NOT NULL DEFAULT 0,
  `language_id` int(11) NOT NULL DEFAULT 1,
  `title` varchar(255) NOT NULL DEFAULT '',
  `description` text NOT NULL,
  `meta_keywords` varchar(255) DEFAULT NULL,
  `meta_description` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

--
-- 转存表中的数据 `h_menu_language`
--

INSERT INTO `h_menu_language` (`category_id`, `language_id`, `title`, `description`, `meta_keywords`, `meta_description`) VALUES
(1, 1, '开发语言', '', NULL, NULL),
(2, 1, '前端语言', '', NULL, NULL),
(23, 1, 'JAVA', '', NULL, NULL),
(24, 1, 'Python', '', NULL, NULL),
(22, 1, 'PHP', '', NULL, NULL),
(20, 1, 'Javascript', '', NULL, NULL),
(21, 1, 'Css', '', NULL, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `h_node`
--

CREATE TABLE `h_node` (
  `node_id` bigint(20) UNSIGNED NOT NULL,
  `author` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `node_date` int(11) UNSIGNED DEFAULT NULL,
  `node_status` varchar(20) NOT NULL DEFAULT 'publish',
  `comment_status` varchar(20) NOT NULL DEFAULT 'open',
  `node_type` varchar(20) NOT NULL DEFAULT 'node',
  `content_type` varchar(20) DEFAULT 'html',
  `comment_count` bigint(20) NOT NULL DEFAULT 0,
  `click_count` int(11) DEFAULT 0,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

--
-- 转存表中的数据 `h_node`
--

INSERT INTO `h_node` (`node_id`, `author`, `node_date`, `node_status`, `comment_status`, `node_type`, `content_type`, `comment_count`, `click_count`, `created_at`, `updated_at`) VALUES
(1, 1, 1481410906, 'publish', 'open', 'node', 'html', 0, 0, 1481410906, 1481410906),
(5, 1, 1516241100, 'publish', 'open', 'node', 'html', 0, 0, 1516241138, 1520903990),
(6, 1, 1523355720, 'publish', 'open', 'page', 'html', 0, 0, 1523355783, 1523355783),
(7, 1, 1523357580, 'publish', 'open', 'page', 'html', 0, 0, 1523357621, 1523412301);

-- --------------------------------------------------------

--
-- 表的结构 `h_node_category`
--

CREATE TABLE `h_node_category` (
  `category_id` int(11) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `parent_id` int(11) NOT NULL DEFAULT 0,
  `path` varchar(255) DEFAULT NULL,
  `level` smallint(5) UNSIGNED DEFAULT 0,
  `count` int(11) DEFAULT 0,
  `sort_order` smallint(6) DEFAULT 0,
  `created_at` int(11) UNSIGNED DEFAULT NULL,
  `updated_at` int(11) UNSIGNED DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

--
-- 转存表中的数据 `h_node_category`
--

INSERT INTO `h_node_category` (`category_id`, `image`, `parent_id`, `path`, `level`, `count`, `sort_order`, `created_at`, `updated_at`, `status`) VALUES
(1, NULL, 0, '1', 0, 0, 3, 1515306164, 1515306164, 1),
(2, NULL, 0, '2', 0, 0, 0, 1515306164, 1515306164, 1),
(20, NULL, 2, '2,20', 1, 0, 0, 1515324913, 1515324913, 1),
(21, NULL, 2, '2,21', 1, 0, 0, 1515324920, 1515324920, 1),
(22, NULL, 1, '1,22', 1, 0, 0, 1515324929, 1515324929, 1),
(23, NULL, 1, '1,23', 1, 0, 0, 1515324935, 1515324935, 1),
(24, NULL, 1, '1,24', 1, 0, 0, 1515324945, 1515324945, 1);

-- --------------------------------------------------------

--
-- 表的结构 `h_node_category_language`
--

CREATE TABLE `h_node_category_language` (
  `category_id` int(11) NOT NULL DEFAULT 0,
  `language_id` int(11) NOT NULL DEFAULT 1,
  `title` varchar(255) NOT NULL DEFAULT '',
  `description` text NOT NULL,
  `meta_keywords` varchar(255) DEFAULT NULL,
  `meta_description` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

--
-- 转存表中的数据 `h_node_category_language`
--

INSERT INTO `h_node_category_language` (`category_id`, `language_id`, `title`, `description`, `meta_keywords`, `meta_description`) VALUES
(1, 1, '开发语言', '', NULL, NULL),
(2, 1, '前端语言', '', NULL, NULL),
(23, 1, 'JAVA', '', NULL, NULL),
(24, 1, 'Python', '', NULL, NULL),
(22, 1, 'PHP', '', NULL, NULL),
(20, 1, 'Javascript', '', NULL, NULL),
(21, 1, 'Css', '', NULL, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `h_node_language`
--

CREATE TABLE `h_node_language` (
  `node_id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL DEFAULT 1,
  `title` varchar(255) DEFAULT NULL,
  `content` longtext DEFAULT NULL,
  `meta_keywords` varchar(255) DEFAULT NULL,
  `meta_description` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

--
-- 转存表中的数据 `h_node_language`
--

INSERT INTO `h_node_language` (`node_id`, `language_id`, `title`, `content`, `meta_keywords`, `meta_description`) VALUES
(1, 1, '中文测试!!!', '<h1>\r\n	通知\r\n</h1>\r\n<p>\r\n	测试\r\n</p>', '测试', ''),
(5, 1, 'test', '<p>test</p>', NULL, NULL),
(6, 1, 'test', '<p>test</p>', NULL, NULL),
(7, 1, 'Hello Page', '<p>This test page<img src=\"http://127.0.0.1/h1cms/storage/upload/images/20180411/21c7dc19-d0fa-45d4-a14f-2f406f92bc6d.png\" style=\"width: 89px;\"></p>', NULL, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `h_node_meta`
--

CREATE TABLE `h_node_meta` (
  `meta_id` bigint(20) UNSIGNED NOT NULL,
  `node_id` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `meta_key` varchar(255) DEFAULT NULL,
  `meta_value` longtext DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

--
-- 转存表中的数据 `h_node_meta`
--

INSERT INTO `h_node_meta` (`meta_id`, `node_id`, `meta_key`, `meta_value`) VALUES
(1, 2, '_wp_page_template', 'default'),
(4, 5, '_edit_last', '1'),
(5, 5, '_edit_lock', '1477724531:1'),
(6, 2, 'test', '123123');

-- --------------------------------------------------------

--
-- 表的结构 `h_node_relationships`
--

CREATE TABLE `h_node_relationships` (
  `node_id` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `category_id` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `term_order` int(9) UNSIGNED DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `h_node_relationships`
--

INSERT INTO `h_node_relationships` (`node_id`, `category_id`, `term_order`) VALUES
(5, 21, 0),
(7, 0, 0);

-- --------------------------------------------------------

--
-- 表的结构 `h_options`
--

CREATE TABLE `h_options` (
  `option_group` varchar(50) NOT NULL DEFAULT 'system',
  `option_name` varchar(191) NOT NULL DEFAULT '',
  `option_value` longtext NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

--
-- 转存表中的数据 `h_options`
--

INSERT INTO `h_options` (`option_group`, `option_name`, `option_value`) VALUES
('mail', 'timeout', '10'),
('mail', 'port', '25'),
('mail', 'password', ''),
('mail', 'username', ''),
('mail', 'hostname', ''),
('mail', 'protocol', 'smtp'),
('site', 'maintenance_info', '系统维护中,请稍后访问 ...'),
('site', 'icp_number', 'ICP 10000000'),
('system', 'admin_language', 'zh_CN'),
('system', 'language', 'zh_CN'),
('site', 'sitename', 'H1CMS'),
('system', 'theme', 'basic'),
('system', 'h1cms_version', 'v1.0.2'),
('site', 'maintenance', '0'),
('site', 'title', 'H1CMS OpenSource CMS'),
('site', 'meta_keywords', 'OpenSource CMS'),
('site', 'meta_description', 'H1CMS OpenSource CMS'),
('upload', 'status', 'enabled'),
('upload', 'upload_dir', ''),
('upload', 'ext_img', 'jpg,png'),
('upload', 'ext_file', ''),
('upload', 'baseurl', ''),
('site', 'theme', 'default');

-- --------------------------------------------------------

--
-- 表的结构 `h_roles`
--

CREATE TABLE `h_roles` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL DEFAULT '',
  `description` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

--
-- 转存表中的数据 `h_roles`
--

INSERT INTO `h_roles` (`id`, `title`, `description`) VALUES
(1, 'Administrator', '超级管理员');

-- --------------------------------------------------------

--
-- 表的结构 `h_role_permissions`
--

CREATE TABLE `h_role_permissions` (
  `role_id` int(11) NOT NULL DEFAULT 0,
  `permission` varchar(255) NOT NULL DEFAULT '0',
  `permission_name` varchar(255) DEFAULT NULL,
  `assign_time` int(11) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

--
-- 转存表中的数据 `h_role_permissions`
--

INSERT INTO `h_role_permissions` (`role_id`, `permission`, `permission_name`, `assign_time`) VALUES
(1, 'admin.system', NULL, 1478348882),
(1, 'admin.system.setting', NULL, 1478348882);

-- --------------------------------------------------------

--
-- 表的结构 `h_users`
--

CREATE TABLE `h_users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(128) NOT NULL DEFAULT '',
  `username` varchar(60) NOT NULL DEFAULT '',
  `password` varchar(255) NOT NULL DEFAULT '',
  `created_at` int(11) DEFAULT 0,
  `updated_at` int(11) DEFAULT 0,
  `status` int(11) NOT NULL DEFAULT 0,
  `display_name` varchar(250) NOT NULL DEFAULT '',
  `avatar` varchar(255) DEFAULT NULL,
  `private_notes` varchar(255) DEFAULT NULL,
  `lasttime` int(11) DEFAULT 0,
  `lastip` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

--
-- 转存表中的数据 `h_users`
--

INSERT INTO `h_users` (`id`, `email`, `username`, `password`, `created_at`, `updated_at`, `status`, `display_name`, `avatar`, `private_notes`, `lasttime`, `lastip`) VALUES
(1, 'support@getssl.cn', 'admin', '$2y$10$hnfZMl19O/PXWxHXvVPr0.htYoVBD8kFkf6OAKlJjQ1neyHviUXj6', 1478521265, 1478521265, 1, 'Allen', NULL, NULL, 1564039537, '127.0.0.1'),
(3, '83390286@qq.com', 'hmvc', '$2y$10$5dFoGFfmx19LoJ5rxfx1bOsb7jU8uZoku.ujMu16j2FFusSl4cj3u', 0, 0, 1, 'hmvc', NULL, NULL, 1515419055, '127.0.0.1');

-- --------------------------------------------------------

--
-- 表的结构 `h_users_profile`
--

CREATE TABLE `h_users_profile` (
  `uid` int(11) NOT NULL DEFAULT 0,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `sex` tinyint(3) DEFAULT 0,
  `birthday` date DEFAULT NULL COMMENT 'birthday',
  `company` varchar(255) DEFAULT NULL,
  `job_title` varchar(255) DEFAULT NULL,
  `about` text DEFAULT NULL,
  `office_phone` varchar(255) DEFAULT NULL COMMENT '公司电话',
  `phone` varchar(255) DEFAULT NULL COMMENT '私人电话'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

--
-- 转存表中的数据 `h_users_profile`
--

INSERT INTO `h_users_profile` (`uid`, `first_name`, `last_name`, `sex`, `birthday`, `company`, `job_title`, `about`, `office_phone`, `phone`) VALUES
(1, '振华', '牛', 1, '0000-00-00', 'GETSSL', 'CEO', '', '', '15216688667'),
(3, '', '', 0, '0000-00-00', '', '', '', '', '');

-- --------------------------------------------------------

--
-- 表的结构 `h_users_roles`
--

CREATE TABLE `h_users_roles` (
  `uid` int(11) NOT NULL DEFAULT 0,
  `role_id` int(11) NOT NULL DEFAULT 0,
  `assign_time` int(11) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=FIXED;

--
-- 转存表中的数据 `h_users_roles`
--

INSERT INTO `h_users_roles` (`uid`, `role_id`, `assign_time`) VALUES
(1, 1, 1478348882),
(3, 1, 0);

--
-- 转储表的索引
--

--
-- 表的索引 `h_attachment`
--
ALTER TABLE `h_attachment`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `h_logs`
--
ALTER TABLE `h_logs`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `h_menu`
--
ALTER TABLE `h_menu`
  ADD PRIMARY KEY (`category_id`);

--
-- 表的索引 `h_node`
--
ALTER TABLE `h_node`
  ADD PRIMARY KEY (`node_id`),
  ADD KEY `node_author` (`author`),
  ADD KEY `type_status_date` (`node_type`,`node_status`,`node_date`,`node_id`);

--
-- 表的索引 `h_node_category`
--
ALTER TABLE `h_node_category`
  ADD PRIMARY KEY (`category_id`);

--
-- 表的索引 `h_node_language`
--
ALTER TABLE `h_node_language`
  ADD PRIMARY KEY (`node_id`,`language_id`);

--
-- 表的索引 `h_node_meta`
--
ALTER TABLE `h_node_meta`
  ADD PRIMARY KEY (`meta_id`),
  ADD KEY `meta_key` (`meta_key`(191)),
  ADD KEY `post_id` (`node_id`);

--
-- 表的索引 `h_node_relationships`
--
ALTER TABLE `h_node_relationships`
  ADD PRIMARY KEY (`node_id`,`category_id`),
  ADD KEY `category_id` (`category_id`);

--
-- 表的索引 `h_options`
--
ALTER TABLE `h_options`
  ADD UNIQUE KEY `unique_gn` (`option_group`,`option_name`);

--
-- 表的索引 `h_roles`
--
ALTER TABLE `h_roles`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `h_role_permissions`
--
ALTER TABLE `h_role_permissions`
  ADD PRIMARY KEY (`role_id`,`permission`);

--
-- 表的索引 `h_users`
--
ALTER TABLE `h_users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_email` (`email`),
  ADD KEY `user_login_key` (`username`);

--
-- 表的索引 `h_users_profile`
--
ALTER TABLE `h_users_profile`
  ADD PRIMARY KEY (`uid`);

--
-- 表的索引 `h_users_roles`
--
ALTER TABLE `h_users_roles`
  ADD PRIMARY KEY (`uid`,`role_id`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `h_attachment`
--
ALTER TABLE `h_attachment`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- 使用表AUTO_INCREMENT `h_logs`
--
ALTER TABLE `h_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- 使用表AUTO_INCREMENT `h_menu`
--
ALTER TABLE `h_menu`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- 使用表AUTO_INCREMENT `h_node`
--
ALTER TABLE `h_node`
  MODIFY `node_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- 使用表AUTO_INCREMENT `h_node_category`
--
ALTER TABLE `h_node_category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- 使用表AUTO_INCREMENT `h_node_meta`
--
ALTER TABLE `h_node_meta`
  MODIFY `meta_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- 使用表AUTO_INCREMENT `h_roles`
--
ALTER TABLE `h_roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- 使用表AUTO_INCREMENT `h_users`
--
ALTER TABLE `h_users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
