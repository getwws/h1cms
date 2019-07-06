# Host: localhost  (Version: 5.5.53)
# Date: 2018-04-24 20:08:32
# Generator: MySQL-Front 5.3  (Build 4.234)

/*!40101 SET NAMES utf8 */;

#
# Structure for table "h_attachment"
#

DROP TABLE IF EXISTS `h_attachment`;
CREATE TABLE `h_attachment` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `filename` varchar(255) NOT NULL,
  `meta_type` varchar(255) DEFAULT '',
  `width` int(10) unsigned NOT NULL,
  `height` int(10) unsigned NOT NULL,
  `type` varchar(15) NOT NULL,
  `created_at` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

#
# Data for table "h_attachment"
#

/*!40000 ALTER TABLE `h_attachment` DISABLE KEYS */;
/*!40000 ALTER TABLE `h_attachment` ENABLE KEYS */;

#
# Structure for table "h_logs"
#

DROP TABLE IF EXISTS `h_logs`;
CREATE TABLE `h_logs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) DEFAULT '0',
  `level` varchar(10) DEFAULT 'system',
  `message` text,
  `location` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

#
# Data for table "h_logs"
#

/*!40000 ALTER TABLE `h_logs` DISABLE KEYS */;
/*!40000 ALTER TABLE `h_logs` ENABLE KEYS */;

#
# Structure for table "h_node"
#

DROP TABLE IF EXISTS `h_node`;
CREATE TABLE `h_node` (
  `node_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `author` bigint(20) unsigned NOT NULL DEFAULT '0',
  `node_date` int(11) unsigned DEFAULT NULL,
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
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

#
# Data for table "h_node"
#

/*!40000 ALTER TABLE `h_node` DISABLE KEYS */;
INSERT INTO `h_node` VALUES (1,1,1481410906,'publish','open','node','html',0,0,1481410906,1481410906),(5,1,1516241100,'publish','open','node','html',0,0,1516241138,1520903990),(6,1,1523355720,'publish','open','page','html',0,0,1523355783,1523355783),(7,1,1523357580,'publish','open','page','html',0,0,1523357621,1523412301);
/*!40000 ALTER TABLE `h_node` ENABLE KEYS */;

#
# Structure for table "h_node_category"
#

DROP TABLE IF EXISTS `h_node_category`;
CREATE TABLE `h_node_category` (
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
) ENGINE=MyISAM AUTO_INCREMENT=29 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

#
# Data for table "h_node_category"
#

/*!40000 ALTER TABLE `h_node_category` DISABLE KEYS */;
INSERT INTO `h_node_category` VALUES (1,NULL,0,'1',0,0,3,1515306164,1515306164,1),(2,NULL,0,'2',0,0,0,1515306164,1515306164,1),(20,NULL,2,'2,20',1,0,0,1515324913,1515324913,1),(21,NULL,2,'2,21',1,0,0,1515324920,1515324920,1),(22,NULL,1,'1,22',1,0,0,1515324929,1515324929,1),(23,NULL,1,'1,23',1,0,0,1515324935,1515324935,1),(24,NULL,1,'1,24',1,0,0,1515324945,1515324945,1);
/*!40000 ALTER TABLE `h_node_category` ENABLE KEYS */;

#
# Structure for table "h_node_category_language"
#

DROP TABLE IF EXISTS `h_node_category_language`;
CREATE TABLE `h_node_category_language` (
  `category_id` int(11) NOT NULL DEFAULT '0',
  `language_id` int(11) NOT NULL DEFAULT '1',
  `title` varchar(255) NOT NULL DEFAULT '',
  `description` text NOT NULL,
  `meta_keywords` varchar(255) DEFAULT NULL,
  `meta_description` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

#
# Data for table "h_node_category_language"
#

/*!40000 ALTER TABLE `h_node_category_language` DISABLE KEYS */;
INSERT INTO `h_node_category_language` VALUES (1,1,'开发语言','',NULL,NULL),(2,1,'前端语言','',NULL,NULL),(23,1,'JAVA','',NULL,NULL),(24,1,'Python','',NULL,NULL),(22,1,'PHP','',NULL,NULL),(20,1,'Javascript','',NULL,NULL),(21,1,'Css','',NULL,NULL);
/*!40000 ALTER TABLE `h_node_category_language` ENABLE KEYS */;

#
# Structure for table "h_node_language"
#

DROP TABLE IF EXISTS `h_node_language`;
CREATE TABLE `h_node_language` (
  `node_id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL DEFAULT '1',
  `title` varchar(255) DEFAULT NULL,
  `content` longtext,
  `meta_keywords` varchar(255) DEFAULT NULL,
  `meta_description` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`node_id`,`language_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

#
# Data for table "h_node_language"
#

/*!40000 ALTER TABLE `h_node_language` DISABLE KEYS */;
INSERT INTO `h_node_language` VALUES (1,1,'中文测试!!!','<h1>\r\n\t通知\r\n</h1>\r\n<p>\r\n\t测试\r\n</p>','测试',''),(5,1,'test','<p>test</p>',NULL,NULL),(6,1,'test','<p>test</p>',NULL,NULL),(7,1,'Hello Page','<p>This test page<img src=\"http://127.0.0.1/h1cms/storage/upload/images/20180411/21c7dc19-d0fa-45d4-a14f-2f406f92bc6d.png\" style=\"width: 89px;\"></p>',NULL,NULL);
/*!40000 ALTER TABLE `h_node_language` ENABLE KEYS */;

#
# Structure for table "h_node_meta"
#

DROP TABLE IF EXISTS `h_node_meta`;
CREATE TABLE `h_node_meta` (
  `meta_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `node_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `meta_key` varchar(255) DEFAULT NULL,
  `meta_value` longtext,
  PRIMARY KEY (`meta_id`),
  KEY `meta_key` (`meta_key`(191)),
  KEY `post_id` (`node_id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

#
# Data for table "h_node_meta"
#

/*!40000 ALTER TABLE `h_node_meta` DISABLE KEYS */;
INSERT INTO `h_node_meta` VALUES (1,2,'_wp_page_template','default'),(4,5,'_edit_last','1'),(5,5,'_edit_lock','1477724531:1'),(6,2,'test','123123');
/*!40000 ALTER TABLE `h_node_meta` ENABLE KEYS */;

#
# Structure for table "h_node_relationships"
#

DROP TABLE IF EXISTS `h_node_relationships`;
CREATE TABLE `h_node_relationships` (
  `node_id` int(11) unsigned NOT NULL DEFAULT '0',
  `category_id` int(11) unsigned NOT NULL DEFAULT '0',
  `term_order` int(9) unsigned DEFAULT '0',
  PRIMARY KEY (`node_id`,`category_id`),
  KEY `category_id` (`category_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

#
# Data for table "h_node_relationships"
#

/*!40000 ALTER TABLE `h_node_relationships` DISABLE KEYS */;
INSERT INTO `h_node_relationships` VALUES (5,21,0),(7,0,0);
/*!40000 ALTER TABLE `h_node_relationships` ENABLE KEYS */;

#
# Structure for table "h_options"
#

DROP TABLE IF EXISTS `h_options`;
CREATE TABLE `h_options` (
  `option_group` varchar(50) NOT NULL DEFAULT 'system',
  `option_name` varchar(191) NOT NULL DEFAULT '',
  `option_value` longtext NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

#
# Data for table "h_options"
#

/*!40000 ALTER TABLE `h_options` DISABLE KEYS */;
INSERT INTO `h_options` VALUES ('mail','timeout','10'),('mail','port','25'),('mail','password',''),('mail','username',''),('mail','hostname',''),('mail','protocol','smtp'),('site','maintenance_info','系统维护中,请稍后访问 ...'),('site','icp_number','ICP 10000000'),('system','admin_language','zh_CN'),('system','language','zh_CN'),('site','sitename','H1CMS v1.0'),('system','theme','basic'),('system','h1cms_version','v1.0.2'),('site','maintenance','0'),('site','title','H1CMS OpenSource CMS'),('site','meta_keywords','OpenSource CMS'),('site','meta_description','H1CMS OpenSource CMS'),('upload','status','enabled'),('upload','upload_dir',''),('upload','ext_img','jpg,png'),('upload','ext_file',''),('upload','baseurl','');
/*!40000 ALTER TABLE `h_options` ENABLE KEYS */;

#
# Structure for table "h_role_permissions"
#

DROP TABLE IF EXISTS `h_role_permissions`;
CREATE TABLE `h_role_permissions` (
  `role_id` int(11) NOT NULL DEFAULT '0',
  `permission` varchar(255) NOT NULL DEFAULT '0',
  `permission_name` varchar(255) DEFAULT NULL,
  `assign_time` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`role_id`,`permission`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

#
# Data for table "h_role_permissions"
#

/*!40000 ALTER TABLE `h_role_permissions` DISABLE KEYS */;
INSERT INTO `h_role_permissions` VALUES (1,'admin.system',NULL,1478348882),(1,'admin.system.setting',NULL,1478348882);
/*!40000 ALTER TABLE `h_role_permissions` ENABLE KEYS */;

#
# Structure for table "h_roles"
#

DROP TABLE IF EXISTS `h_roles`;
CREATE TABLE `h_roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL DEFAULT '',
  `description` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

#
# Data for table "h_roles"
#

/*!40000 ALTER TABLE `h_roles` DISABLE KEYS */;
INSERT INTO `h_roles` VALUES (1,'Administrator','');
/*!40000 ALTER TABLE `h_roles` ENABLE KEYS */;

#
# Structure for table "h_users"
#

DROP TABLE IF EXISTS `h_users`;
CREATE TABLE `h_users` (
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
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

#
# Data for table "h_users"
#

/*!40000 ALTER TABLE `h_users` DISABLE KEYS */;
INSERT INTO `h_users` VALUES (1,'support@getssl.cn','admin','$2y$10$BKVsdKyiEr9tPwxBCx1y..8kxxFRWdRUJdFnabYtRTQbcHlYqHXOK',1478521265,1478521265,1,'Allen',NULL,NULL,1524532849,'127.0.0.1'),(3,'83390286@qq.com','hmvc','$2y$10$5dFoGFfmx19LoJ5rxfx1bOsb7jU8uZoku.ujMu16j2FFusSl4cj3u',0,0,1,'hmvc',NULL,NULL,1515419055,'127.0.0.1');
/*!40000 ALTER TABLE `h_users` ENABLE KEYS */;

#
# Structure for table "h_users_profile"
#

DROP TABLE IF EXISTS `h_users_profile`;
CREATE TABLE `h_users_profile` (
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

#
# Data for table "h_users_profile"
#

/*!40000 ALTER TABLE `h_users_profile` DISABLE KEYS */;
INSERT INTO `h_users_profile` VALUES (1,'振华','牛',1,'1990-01-20','GETSSL','CEO','','','15216688667'),(3,'','',0,'0000-00-00','','','','','');
/*!40000 ALTER TABLE `h_users_profile` ENABLE KEYS */;

#
# Structure for table "h_users_roles"
#

DROP TABLE IF EXISTS `h_users_roles`;
CREATE TABLE `h_users_roles` (
  `uid` int(11) NOT NULL DEFAULT '0',
  `role_id` int(11) NOT NULL DEFAULT '0',
  `assign_time` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`uid`,`role_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=FIXED;

#
# Data for table "h_users_roles"
#

/*!40000 ALTER TABLE `h_users_roles` DISABLE KEYS */;
INSERT INTO `h_users_roles` VALUES (1,1,1478348882),(3,1,0);
/*!40000 ALTER TABLE `h_users_roles` ENABLE KEYS */;
