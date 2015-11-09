<?php
/**
 * 员工管理,实现对员工数据的增删改查.
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
use backend\models\User;
use backend\models\UserSearch;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\components\CController;
use app\models\HrLog;
use yii\data\ActiveDataProvider;

/**
 * 员工管理,实现对员工数据的增删改查.
 *
 * PHP version 5.5
 *
 * @category backend\controllers
 * @package  backend\controllers
 * @author   zhaoyan <1210965963@qq.com>
 * @license  http://www.168helps.com License
 * @link     https://github.com/3032441712/hr
 */
class UserController extends CController
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
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $arrayStatus = User::getArrayStatus();
        $arrayRole = User::getArrayRole();

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'arrayStatus' => $arrayStatus,
            'arrayRole' => $arrayRole,
        ]);
    }

    /**
     * Displays a single User model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new User(['scenario' => 'admin-create']);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->authManager->assign(Yii::$app->authManager->getRole($model->role), $model->id);
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model->setScenario('admin-update');

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->authManager->revokeAll($id);
            Yii::$app->authManager->assign(Yii::$app->authManager->getRole($model->role), $id);
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * 删除员工信息,目前不支持员工信息的删除.
     * 本功能目前属于禁用状态.
     * 
     * @param integer $id
     * 
     * @return mixed
     */
    public function actionDelete($id)
    {
//         $this->findModel($id)->delete();
        $model = $this->findModel($id);
        if (false == empty($model)) {
            $model->updateAttributes(['status' => User::STATUS_DELETED]);
        }

        return $this->redirect(['index']);
    }

    public function actionLog()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => HrLog::find()->onCondition(['exec_action' => HrLog::USER_ACTION])->orderBy('id DESC'),
        ]);

        return $this->render('log', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
