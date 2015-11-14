<?php
/**
 * 系统的相关工具类方法
 *
 * PHP version 5.5
 *
 * @category backend\helpers
 * @package  backend\helpers
 * @author   zhaoyan <1210965963@qq.com>
 * @license  http://www.168helps.com License
 * @version  GIT: $Id$
 * @link     https://github.com/3032441712/hr
 */
namespace backend\helpers;

use yii\helpers\ArrayHelper;

/**
 * 系统的相关工具类方法
 *
 * PHP version 5.5
 *
 * @category backend\helpers
 * @package  backend\helpers
 * @author   zhaoyan <1210965963@qq.com>
 * @license  http://www.168helps.com License
 * @link     https://github.com/3032441712/hr
 */
class UtilHelper extends ArrayHelper
{
    /**
     * 处理无限极分类
     * 
     * @param array   $array     分类数组
     * @param integer $pid       无限分类
     * @param boolean $showEvent 是否显示操作事件
     * 
     * @return array
     */
    public static function getDeptTreeData($array, $pid = 0, $showEvent = true)
    {
        $arr = array();
        
        foreach ($array as $k => $v) {
            if ($v['parent_id'] == $pid) {
                $v['text'] = $showEvent ? $v['title'].' &nbsp;<a title=\"添加下级部门\" class=\"fa fa-fw fa-plus-square-o\" onclick=\"create_dept('.$v['id'].')\" href=\"#\"></a>&nbsp;&nbsp;<a title=\"编辑部门信息\" class=\"glyphicon glyphicon-pencil\" style=\"color:green\" onclick=\"update_dept('.$v['id'].','.$pid.')\" href=\"#\"></a>&nbsp;&nbsp;<a title=\"展示部门信息\" class=\"glyphicon glyphicon-eye-open\" style=\"color:green\" onclick=\"view_dept('.$v['id'].','.$pid.')\" href=\"#\"></a>&nbsp;&nbsp;<a title=\"显示部门下的岗位\" class=\"fa fa-fw fa-bars\" style=\"color:green\" onclick=\"dept_station_list('.$v['id'].')\" href=\"#\"></a>' : $v['title'];
                $arr[$k] = $v;
                $arr[$k]['nodes'] = static::getDeptTreeData($array, $v['id'], $showEvent);
                if (count($arr[$k]['nodes']) == 0) {
                    unset($arr[$k]['nodes']);
                }
            }
        }
        
        return $arr;
    }
}