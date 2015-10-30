<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\Accounts;

/* @var $this yii\web\View */
/* @var $model backend\models\Accounts */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="accounts-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'account_title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'account_cat')->dropDownList(Accounts::getArrayCategory()) ?>

    <?= $form->field($model, 'account_content')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'user_id')->dropDownList(Accounts::getArrayUser()) ?>

    <?= $form->field($model, 'acount_status')->dropDownList(Accounts::getArrayStatus()) ?>

    <?= $form->field($model, 'createtime')->textInput() ?>

    <?= $form->field($model, 'updated')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
