<?php

use yii\helpers\Html;
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
            'exec_action',
            [
                'attribute' => 'content',
                'value' => function($model) {
                    return mb_substr($model->content, 0, 11, 'UTF-8').'...';
                }
            ],
            'created_at',
        ],
    ]); ?>

</div>
