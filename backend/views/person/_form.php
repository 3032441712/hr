<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\User;
use yii\web\JqueryAsset;

/* @var $this yii\web\View */
/* @var $model backend\models\HrPerson */
/* @var $form yii\widgets\ActiveForm */
$this->registerCssFile('@web/adminlte/css/datepicker/datepicker3.css');
$this->registerJsFile("@web/adminlte/js/plugins/datepicker/bootstrap-datepicker.js", ['depends' => JqueryAsset::className()]);
$this->registerJsFile("@web/adminlte/js/plugins/datepicker/locales/bootstrap-datepicker.zh-CN.js", ['depends' => JqueryAsset::className()]);
$this->registerJsFile("@web/js/area.js", ['depends' => JqueryAsset::className()]);

// $this->registerJs('
//     $("#birthday").datepicker({format:"yyyy-mm-dd", startDate: new Date(1900,01,01), language:"zh-CN"});
//     init_area("user-province", "user-city", "user-district");
//     $("#user-province").change(function() {
//         v = $(this).val();
//         $(this).attr("data", v);
//         area_change(v, $("#user-city"));
//         init_area("user-province", "user-city", "user-district");
//     });
//     $("#user-city").change(function(){
//         $(this).attr("data", $(this).val());
//         init_area("user-province", "user-city", "user-district");
//     });
//     $("#user-district").change(function(){
//         $(this).attr("data", $(this).val());
//         init_area("user-province", "user-city", "user-district");
//     });
// ');
?>
<style>
<!--
div.area-control select{
	display: inline-block;
	width: 33%;
}
-->
</style>
<div class="hr-person-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'password', ['labelOptions' => ['label' => '输入密码']])->passwordInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'repassword', ['labelOptions' => ['label' => '确认密码']])->passwordInput(['maxlength' => 255]) ?>
    
    <?php $form->field($model, 'real_name', ['labelOptions' => ['label' => '姓名']])->textInput(['maxlength' => 64]) ?>

    <?php $form->field($model, 'sex')->dropDownList(User::getArraySex()) ?>

    <?php $form->field($model, 'birthday')->textInput() ?>

    <?php $form->field($model, 'email', ['labelOptions' => ['label' => '邮箱']])->textInput(['maxlength' => true]) ?>

    <?php $form->field($model, 'marital_status')->dropDownList(User::getArrayMaritalStatus()) ?>

    <!--
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
    -->

    <?php $form->field($model, 'address')->textInput(['maxlength' => true]) ?>

    <?php $form->field($model, 'zipcode')->textInput(['maxlength' => true]) ?>

    <?php $form->field($model, 'qq')->textInput(['maxlength' => true]) ?>

    <?php $form->field($model, 'office_phone')->textInput(['maxlength' => true]) ?>

    <?php $form->field($model, 'home_phone')->textInput(['maxlength' => true]) ?>

    <?php $form->field($model, 'mobile_phone')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('编辑', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
