<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\HrNotice */

$this->title = '编辑公告: ' . ' ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => '公告列表', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="hr-notice-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>