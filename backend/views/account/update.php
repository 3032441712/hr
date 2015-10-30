<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Accounts */

$this->title = '编辑信息: ' . ' ' . $model->account_id;
$this->params['breadcrumbs'][] = ['label' => '编辑信息', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->account_id, 'url' => ['view', 'id' => $model->account_id]];
$this->params['breadcrumbs'][] = '更新';
?>
<div class="accounts-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
