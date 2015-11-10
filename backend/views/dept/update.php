<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\HrDept */

$this->title = '编辑部门: ' . ' ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => '部门管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = '更新';
?>
<div class="hr-dept-update">

    <h1 style="display: none;"><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
