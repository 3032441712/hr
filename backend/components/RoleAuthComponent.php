<?php
/**
 * 系统权限管理
 *
 * PHP version 5.5
 *
 * @category app\components
 * @package  app\components
 * @author   zhaoyan <1210965963@qq.com>
 * @license  http://www.168helps.com License
 * @version  GIT: $Id$
 * @link     https://github.com/3032441712/hr
 */
namespace app\components;

use Yii;

/**
 * 系统权限管理
 *
 * PHP version 5.5
 *
 * @category app\components
 * @package  app\components
 * @author   zhaoyan <1210965963@qq.com>
 * @license  http://www.168helps.com License
 * @link     https://github.com/3032441712/hr
 */
class RoleAuthComponent
{
    /**
     * 系统管理组权限
     * 默认系统管理成员与人力资源管理成员具有相同系统权限.
     * 
     * @return boolean true/false
     */
    public static function getAdminRole()
    {
        return (Yii::$app->user->can('admin') || Yii::$app->user->can('hrman'));
    }
}