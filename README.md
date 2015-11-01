# hr
*力资源管理系统系统基于YII2开发*

##系统模块##
1. 员工管理模块
2. 部门管理模块
3. 员工打卡管理模块
4. 公告管理模块
5. 消息模块
6. 员工相关系统列表
7. 系统中心
8. 物料发放管理
9. 日常工作备注

###数据库SQL###

CREATE TABLE IF NOT EXISTS `hr_user` (
  `id` int(11) NOT NULL,
  `dept_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '部门',
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `sex` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '性别',
  `birthday` date NOT NULL COMMENT '生日',
  `last_login` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '上次登陆时间',
  `last_ip` varchar(15) COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '上次登录的IP地址',
  `country` smallint(6) NOT NULL DEFAULT '0' COMMENT '国家',
  `province` smallint(6) NOT NULL DEFAULT '0' COMMENT '省份',
  `city` smallint(6) NOT NULL DEFAULT '0' COMMENT '城市',
  `district` smallint(6) NOT NULL DEFAULT '0' COMMENT '区域',
  `address` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '地址',
  `zipcode` varchar(60) COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '邮政编码',
  `qq` varchar(20) COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT 'QQ',
  `office_phone` varchar(20) COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '办公电话',
  `home_phone` varchar(20) COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '家庭电话',
  `mobile_phone` varchar(20) COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '手机',
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `role` varchar(64) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'user',
  `status` smallint(6) NOT NULL DEFAULT '10',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `hr_dept` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `title` varchar(32) NOT NULL DEFAULT '' COMMENT '部门名称',
  `created_at` datetime NOT NULL COMMENT '创建时间',
  `updated_at` datetime NOT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='部门';