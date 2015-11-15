<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\HrDeptStation */

$this->title = '添加岗位';
$this->params['breadcrumbs'][] = ['label' => '岗位', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="hr-dept-station-create">

    <h1 style="display: none;"><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
