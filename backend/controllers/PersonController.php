<?php

namespace backend\controllers;

use Yii;
use backend\models\HrPerson;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\components\CController;

/**
 * PersonController implements the CRUD actions for HrPerson model.
 */
class PersonController extends CController
{
    public function behaviors()
    {
        $verbs = [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];

        return array_merge(parent::behaviors(), $verbs);
    }

    /**
     * Displays a single HrPerson model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel(Yii::$app->user->id),
        ]);
    }

    /**
     * Updates an existing HrPerson model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel(Yii::$app->user->id);
        $model->setScenario('user-update');

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
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
     * @param integer $id
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
