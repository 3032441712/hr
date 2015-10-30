<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '信息分类';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="account-category-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('添加分类', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'cat_id',
            'cat_title',
            'cat_parent',
            'cat_status',
            'cat_count',
            'createtime',
            'updated',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
