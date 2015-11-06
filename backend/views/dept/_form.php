<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\User;

/* @var $this yii\web\View */
/* @var $model app\models\HrDept */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="hr-dept-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?php if ($model->id) :?>
    <?= $form->field($model, 'master_user')->dropDownList(User::getArrayUser($model->id)) ?>
    <?php endif;?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '创建' : '编辑', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
