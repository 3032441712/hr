<?php

/* @var $this yii\web\View */
/* @var $model backend\models\HrPerson */

$this->title = $model->real_name;
$this->params['breadcrumbs'][] = ['label' => $model->real_name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = '修改密码';
?>
<div class="hr-person-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
