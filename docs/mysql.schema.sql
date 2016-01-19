-- --------------------------------------------------------
-- 主机:                           127.0.0.1
-- 服务器版本:                        5.6.20-log - MySQL Community Server (GPL)
-- 服务器操作系统:                      Win64
-- HeidiSQL 版本:                  9.3.0.4984
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- 导出  表 yii2_skeleton.www_grid_column_config 结构
CREATE TABLE IF NOT EXISTS `www_grid_column_config` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `attribute` varchar(255) NOT NULL,
  `css_class` varchar(255) DEFAULT NULL,
  `css_style` varchar(255) DEFAULT NULL,
  `visible` tinyint(1) NOT NULL DEFAULT '1',
  `user_id` int(11) NOT NULL,
  `tenant_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- 数据导出被取消选择。


-- 导出  表 yii2_skeleton.www_group_option 结构
CREATE TABLE IF NOT EXISTS `www_group_option` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `group_name` varchar(255) NOT NULL,
  `text` varchar(255) NOT NULL,
  `value` varchar(255) NOT NULL,
  `alias` varchar(255) DEFAULT NULL,
  `enabled` tinyint(1) NOT NULL,
  `defaulted` tinyint(1) NOT NULL,
  `ordering` int(11) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `tenant_id` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `deleted_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- 数据导出被取消选择。


-- 导出  表 yii2_skeleton.www_ip_access_rule 结构
CREATE TABLE IF NOT EXISTS `www_ip_access_rule` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(255) NOT NULL,
  `final_date` int(11) DEFAULT NULL,
  `type` tinyint(1) NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `tenant_id` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `deleted_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- 数据导出被取消选择。


-- 导出  表 yii2_skeleton.www_lookup 结构
CREATE TABLE IF NOT EXISTS `www_lookup` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `label` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `value` text NOT NULL,
  `return_type` varchar(255) NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `deleted_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- 数据导出被取消选择。


-- 导出  表 yii2_skeleton.www_migration 结构
CREATE TABLE IF NOT EXISTS `www_migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- 数据导出被取消选择。


-- 导出  表 yii2_skeleton.www_user 结构
CREATE TABLE IF NOT EXISTS `www_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` smallint(6) NOT NULL DEFAULT '1',
  `username` varchar(255) NOT NULL,
  `nickname` varchar(255) NOT NULL,
  `auth_key` varchar(32) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `password_reset_token` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `role` smallint(6) NOT NULL DEFAULT '10',
  `status` smallint(6) NOT NULL DEFAULT '0',
  `register_ip` varchar(255) NOT NULL,
  `login_count` smallint(6) NOT NULL DEFAULT '0',
  `last_login_ip` varchar(255) DEFAULT NULL,
  `last_login_time` int(11) DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `deleted_at` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- 数据导出被取消选择。


-- 导出  表 yii2_skeleton.www_user_login_log 结构
CREATE TABLE IF NOT EXISTS `www_user_login_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `login_ip` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `client_informations` varchar(255) NOT NULL,
  `login_at` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- 数据导出被取消选择。
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
