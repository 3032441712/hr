<?php

use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '操作日志';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="log-index">

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            'id',
            [
                'attribute' => 'content',
                'value' => function($model) {
                    return mb_substr($model->content, 0, 11, 'UTF-8').'...';
                }
            ],
            [
                'label' => '操作人',
                'attribute' => 'user_id',
                'value' => function($model) {
                    return $model->userLabel.'('.$model->user_id.')';
                }
            ],
            'ip_address',
            'created_at',
        ],
    ]); ?>

</div>
