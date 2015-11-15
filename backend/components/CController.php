<?php
/**
 * 控制器基本组件,控制项目访问权限.
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

use yii\web\Controller;
use yii\filters\AccessControl;

/**
 * 控制器基本组件,控制项目访问权限.
 *
 * PHP version 5.5
 *
 * @category app\components
 * @package  app\components
 * @author   zhaoyan <1210965963@qq.com>
 * @license  http://www.168helps.com License
 * @link     https://github.com/3032441712/hr
 */
class CController extends Controller
{
    /**
     * 只有登录的用户才可以访问应用程序的功能
     * 
     * @return array
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => RoleAuthComponent::getAdminRole(),
                        'roles' => ['@']
                    ]
                ]
            ],
        ];
    }
}