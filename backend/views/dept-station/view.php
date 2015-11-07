<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\HrDeptStation */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => '岗位', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="hr-dept-station-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('编辑', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('删除', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => '你确定删除这个元素吗?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            [
                'attribute' => 'dept_id',
                'value' => $model->deptLabel,
            ],
            'title',
            'created_at',
            'updated_at',
        ],
    ]) ?>

</div>
