<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\HrDept */

$this->title = '添加部门';
$this->params['breadcrumbs'][] = ['label' => '部门管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="hr-dept-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
