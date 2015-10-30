<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '信息管理';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="accounts-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('添加信息', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'account_id',
            'account_title',
            [
                'attribute' => 'account_cat',
                'value' => function ($model)  {
                    return $model->categoryLabel;
                }
            ],
            [
                'attribute' => 'user_id',
                'value' => function ($model) {
                    return $model->userLabel;
                }
            ],
            [
                'attribute' => 'acount_status',
                'value' => function ($model) {
                    return $model->statusLabel;
                }
            ],
            'createtime',
            'updated',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
