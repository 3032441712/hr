<?php

use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '我的联系人';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            'id',
            'real_name',
            [
                'attribute' => 'job_station',
                'value' => function($model) {
                    return $model->jobStationLabel;
                }
            ],
            'mobile_phone',
            'email:email',
            'created_at:datetime',
            ['class' => 'yii\grid\ActionColumn', 'template' => '{view}'],
        ],
    ]); ?>

</div>