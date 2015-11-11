<?php
/**
 * 部门管理,实现对部门数据的增删改查.
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
use app\models\HrDept;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\components\CController;
use app\models\HrLog;

/**
 * 部门管理,实现对部门数据的增删改查.
 *
 * PHP version 5.5
 * 
 * @category backend\controllers
 * @package  backend\controllers
 * @author   zhaoyan <1210965963@qq.com>
 * @license  http://www.168helps.com License
 * @link     https://github.com/3032441712/hr
 */
class DeptController extends CController
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
     * Lists all HrDept models.
     * @return mixed
     */
    public function actionIndex()
    {
        return $this->render('index', [
            'data' => HrDept::find()->asArray()->all(),
        ]);
    }

    /**
     * Displays a single HrDept model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new HrDept model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new HrDept();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing HrDept model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing HrDept model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }
    
    public function actionLog()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => HrLog::find()->onCondition(['exec_action' => HrLog::DEPT_ACTION])->orderBy('id DESC'),
        ]);

        return $this->render('log', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Finds the HrDept model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return HrDept the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = HrDept::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
