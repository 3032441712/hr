<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\HrPerson */

$this->title = $model->real_name;
$this->params['breadcrumbs'][] = ['label' => $model->real_name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = '编辑个人信息';
?>
<div class="hr-person-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
