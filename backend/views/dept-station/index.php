<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '岗位管理';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="hr-dept-station-index">

    <h1 style="display: none;"><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('添加岗位', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
            [
                'attribute' => 'dept_id',
                'label' => '部门',
                'value' => function ($model) {
                    return $model->deptLabel;
                },
                'filter' => Html::activeDropDownList(
                    $searchModel,
                    'dept_id',
                    $arrayDept,
                    ['class' => 'form-control', 'prompt' => Yii::t('app', 'Please Filter')]
                )
            ],
            'title',
            'created_at',
            'updated_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
