<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\HrDeptStation */

$this->title = '编辑岗位: ' . ' ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => '岗位', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="hr-dept-station-update">

    <h1 style="display: none;"><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'data' => $data
    ]) ?>

</div>
