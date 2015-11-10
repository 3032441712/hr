<?php
/**
 * 部门总监查看部门员工
 *
 * PHP version 5.5
 *
 * @category backend\controllers
 * @package  backend\controllers
 * @author   zhaoyan <1210965963@qq.com>
 * @license  http://www.168helps.com License
 * @version  GIT: $Id$
 * @link     https://github.com/3032441712/hr
 */
namespace backend\controllers;

use Yii;
use yii\data\ActiveDataProvider;
use backend\models\User;
use yii\web\NotFoundHttpException;
use app\components\CController;
use yii\filters\AccessControl;
use app\components\RoleAuthComponent;

/**
 * 个人信息管理
 *
 * PHP version 5.5
 *
 * @category backend\controllers
 * @package  backend\controllers
 * @author   zhaoyan <1210965963@qq.com>
 * @license  http://www.168helps.com License
 * @link     https://github.com/3032441712/hr
 */
class MasterDeptController extends CController
{
    /**
     * 权限验证
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
                        'allow' => RoleAuthComponent::getDeptMasterRole(),
                        'roles' => ['@']
                    ]
                ]
            ],
        ];
    }

    /**
     * 查看部门成员列表信息
     * 
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => User::find()->onCondition(['dept_id' => Yii::$app->user->identity->dept_id])->andWhere('id <> 1'),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }
    
    /**
     * 查看部门成员详细信息
     * 
     * @param integer $id 主键ID
     * 
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }
    
    /**
     * 查找成员
     * 
     * @param integer $id 主键ID
     * 
     * @return array
     */
    protected function findModel($id)
    {
        if (($model = User::findOne(['id' => $id, 'dept_id' => Yii::$app->user->identity->dept_id])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
