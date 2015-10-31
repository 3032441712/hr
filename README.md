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
CREATE TABLE `hr_dept` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `title` varchar(32) NOT NULL DEFAULT '' COMMENT '部门名称',
  `created_at` datetime NOT NULL COMMENT '创建时间',
  `updated_at` datetime NOT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='部门';