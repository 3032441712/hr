<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\AccountCategory */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="account-category-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'cat_title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'cat_parent')->textInput() ?>

    <?= $form->field($model, 'cat_status')->textInput() ?>

    <?= $form->field($model, 'cat_count')->textInput() ?>

    <?= $form->field($model, 'createtime')->textInput() ?>

    <?= $form->field($model, 'updated')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
