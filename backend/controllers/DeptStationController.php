<?php
/**
 * 部门岗位管理,实现对部门岗位数据的增删改查.
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
use backend\models\HrDeptStation;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\HrDeptStationSearch;
use app\models\HrDept;
use app\components\CController;

/**
 * 部门岗位管理,实现对部门岗位数据的增删改查.
 *
 * PHP version 5.5
 *
 * @category backend\controllers
 * @package  backend\controllers
 * @author   zhaoyan <1210965963@qq.com>
 * @license  http://www.168helps.com License
 * @link     https://github.com/3032441712/hr
 */
class DeptStationController extends CController
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
     * Lists all HrDeptStation models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new HrDeptStationSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $arrayDept = HrDept::getArrayDept();

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'arrayDept' => $arrayDept
        ]);
    }

    /**
     * Displays a single HrDeptStation model.
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
     * Creates a new HrDeptStation model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new HrDeptStation();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'data' => HrDept::find()->asArray()->all()
            ]);
        }
    }

    /**
     * Updates an existing HrDeptStation model.
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
                'data' => HrDept::find()->asArray()->all()
            ]);
        }
    }

    /**
     * Deletes an existing HrDeptStation model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }
    
    public function actionDept()
    {
        $deptId = Yii::$app->request->get('dept_id', 0);
        $data = HrDeptStation::find()->onCondition(['dept_id' => $deptId])->select('id, title')->asArray()->all();
        
        if (empty($data)) {
            $data = [['id' => '0', 'title' => '无']];
        }
        
        return json_encode($data);
    }

    /**
     * Finds the HrDeptStation model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return HrDeptStation the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = HrDeptStation::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
