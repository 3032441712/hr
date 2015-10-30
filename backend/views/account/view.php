<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Accounts */

$this->title = $model->account_id;
$this->params['breadcrumbs'][] = ['label' => '信息管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="accounts-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('编辑', ['update', 'id' => $model->account_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('删除', ['delete', 'id' => $model->account_id], [
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
            'account_id',
            'account_title',
            [
                'attribute' => 'account_cat',
                'value' => $model->categoryLabel
            ],
            [
                'attribute' => 'account_content',
                'format' => 'html',
                'value' => $model->getContentLabel()
            ],
            [
                'attribute' => 'user_id',
                'value' => $model->userLabel
            ],
            [
                'attribute' => 'acount_status',
                'value' => $model->statusLabel
            ],
            'createtime',
            [
                'attribute' => 'updated',
                'label' => '更新时间'
            ],
        ],
    ]) ?>

</div>
