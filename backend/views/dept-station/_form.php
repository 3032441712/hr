<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\HrDept;

/* @var $this yii\web\View */
/* @var $model backend\models\HrDeptStation */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="hr-dept-station-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'dept_id', ['labelOptions' => ['label' => '部门']])->dropDownList(HrDept::getArrayDept()) ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '添加' : '编辑', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
