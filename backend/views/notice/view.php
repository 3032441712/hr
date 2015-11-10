<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\HrNotice */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Hr Notices', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="hr-notice-view">

    <h1 style="display: none;"><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('编辑', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('删除', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => '你确定要删除这个元素吗?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'title',
            'content:ntext',
            'status',
            'created_at',
            'updated_at',
        ],
    ]) ?>

</div>