<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '部门管理';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="hr-dept-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('添加部门', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
            'title',
            [
                'attribute' => 'master_user',
                'value' => function ($model) {
                    return $model->userLabel;
                }
            ],
            'created_at',
            'updated_at',

            [
                'class' => 'yii\grid\ActionColumn' , 
                'template' => '{station} {view} {update} {delete}',
                'buttons' => [
                    'station' => function ($url, $model, $key) {
                        return Html::a('<span title="岗位" class="glyphicon glyphicon-list"></span>', Url::to(['dept-station/index', 'HrDeptStationSearch[dept_id]' => $model->id]));
                    }
                ]
            ],
        ],
    ]); ?>

</div>
