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
     * @param array   $array 分类数组
     * @param integer $pid   无限分类
     * 
     * @return array
     */
    public static function getDeptTreeData($array, $pid = 0)
    {
        $arr = array();
        
        foreach ($array as $k => $v) {
            if ($v['parent_id'] == $pid) {
                $v['text'] = $v['title'];
                $arr[$k] = $v;
                $arr[$k]['nodes'] = self::getDeptTreeData($array, $v['id']);
                if (count($arr[$k]['nodes']) == 0) {
                    unset($arr[$k]['nodes']);
                }
            }
        }
        
        return $arr;
    }
}