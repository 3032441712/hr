<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\AccountCategory */

$this->title = $model->cat_id;
$this->params['breadcrumbs'][] = ['label' => '信息分类', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="account-category-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('编辑', ['update', 'id' => $model->cat_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('删除', ['delete', 'id' => $model->cat_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'cat_id',
            'cat_title',
            'cat_parent',
            'cat_status',
            'cat_count',
            'createtime',
            'updated',
        ],
    ]) ?>

</div>
