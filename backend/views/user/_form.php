<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\User;
use app\models\HrDept;
use yii\web\JqueryAsset;

/* @var $this yii\web\View */
/* @var $model backend\models\User */
/* @var $form yii\widgets\ActiveForm */

$this->registerCssFile('@web/adminlte/css/datepicker/datepicker3.css');
$this->registerJsFile("@web/adminlte/js/plugins/datepicker/bootstrap-datepicker.js", ['depends' => JqueryAsset::className()]);
$this->registerJsFile("@web/adminlte/js/plugins/datepicker/locales/bootstrap-datepicker.zh-CN.js", ['depends' => JqueryAsset::className()]);
$this->registerJsFile("@web/js/area.js", ['depends' => JqueryAsset::className()]);
$this->registerJs('
    $("#birthday").datepicker({format:"yyyy-mm-dd", startDate: new Date(1900,01,01), language:"zh-CN"});
    init_area("user-province", "user-city", "user-district");
    $("#user-province").change(function() {
        v = $(this).val();
        $(this).attr("data", v);
        area_change(v, $("#user-city"));
        init_area("user-province", "user-city", "user-district");
    });
    $("#user-city").change(function(){
        $(this).attr("data", $(this).val());
        init_area("user-province", "user-city", "user-district");
    });
    $("#user-district").change(function(){
        $(this).attr("data", $(this).val());
        init_area("user-province", "user-city", "user-district");
    });
');
?>
<style>
<!--
div.area-control select{
	display: inline-block;
	width: 33%;
}
-->
</style>
<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'real_name')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'dept_id')->dropDownList(HrDept::getArrayDept()) ?>

    <?= $form->field($model, 'password')->passwordInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'repassword')->passwordInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'sex')->dropDownList(User::getArraySex()) ?>

    <?= $form->field($model, 'birthday')->textInput(['id' => 'birthday']) ?>

    <div class="form-group field-user-country">
        <label for="user-role" class="control-label">籍贯</label>
        <div class="area-control">
            <select class="form-control" id="user-province" name="User[province]" data="<?php echo ($model->province > 0 ? $model->province : 2)?>">
                <option>省份</option>
            </select>
            <select class="form-control" id="user-city" name="User[city]" data="<?php echo ($model->city > 0 ? $model->city : 52)?>">
                <option>城市</option>
            </select>
            <select class="form-control" id="user-district" name="User[district]" data="<?php echo ($model->district > 0 ? $model->district : 500)?>">
                <option>区域</option>
            </select>
        </div>
    </div>

    <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'zipcode')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'qq')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'office_phone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'home_phone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'mobile_phone')->textInput(['maxlength' => true]) ?>
    
    <?= $form->field($model, 'role')->dropDownList(User::getArrayRole()) ?>

    <?= $form->field($model, 'status')->dropDownList(User::getArrayStatus()) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
