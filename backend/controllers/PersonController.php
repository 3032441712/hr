<?php
/**
 * 个人信息管理
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
use backend\models\HrPerson;
use yii\web\NotFoundHttpException;
use app\components\UserRoleController;

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
class PersonController extends UserRoleController
{
    /**
     * 显示员工基本基本信息详情
     * 
     * @param integer $id
     * 
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel(Yii::$app->user->id),
        ]);
    }

    /**
     * 员工更新自己的基本信息.
     * 这里传递的id是没有作用的.默认取登录员工自身的id.
     * 无法修改他人的基本信息
     * 
     * @param integer $id
     * 
     * @return mixed
     */
    public function actionUpdate($id)
    {
        return $this->redirect(['view', 'id' => $id]);
//         $model = $this->findModel(Yii::$app->user->id);
//         $model->setScenario('user-update');

//         if ($model->load(Yii::$app->request->post()) && $model->save()) {
//             return $this->redirect(['view', 'id' => $model->id]);
//         } else {
//             return $this->render('update', [
//                 'model' => $model,
//             ]);
//         }
    }

    /**
     * 查看员工手册
     * 
     * @return mixed
     */
    public function actionBook()
    {
        return $this->renderPartial('book');
    }
    
    /**
     * 通过PHP来进行员工手册图片的输出
     * 
     * @param integer 员工手册的图片ID
     * 
     * @return mixed
     */
    public function actionRead($id)
    {
        $imagename = '0';
        if ($id < 10) {
            $imagename .= '0'.$id;
        } else {
            $imagename .= $id;
        }
        // 定义图片头
        header('Content-type: image/jpeg');
        $filename = Yii::getAlias('@webroot').DIRECTORY_SEPARATOR.'book'.DIRECTORY_SEPARATOR.$imagename.'.jpg';
        if (file_exists($filename)) {
            echo file_get_contents($filename);
        } else {
            echo 'SUCCESS';
        }
        
        Yii::$app->end();
    }

    /**
     * Finds the HrPerson model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * 
     * @param integer $id
     * 
     * @return HrPerson the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = HrPerson::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
