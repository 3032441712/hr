<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\User;
use app\models\HrDept;
use yii\web\JqueryAsset;
use backend\helpers\UtilHelper;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model backend\models\User */
/* @var $form yii\widgets\ActiveForm */

$this->registerCssFile('@web/adminlte/css/datepicker/datepicker3.css');
$this->registerJsFile("@web/adminlte/js/plugins/datepicker/bootstrap-datepicker.js", ['depends' => JqueryAsset::className()]);
$this->registerJsFile("@web/adminlte/js/plugins/datepicker/locales/bootstrap-datepicker.zh-CN.js", ['depends' => JqueryAsset::className()]);
$this->registerJsFile("@web/js/area.js", ['depends' => JqueryAsset::className()]);
$this->registerCssFile('@web/css/bootstrap-treeview.min.css');
$this->registerJsFile("@web/js/bootstrap-treeview.min.js", ['depends' => JqueryAsset::className()]);

$deptData = HrDept::find()->asArray()->all();
$deptTree = [['id' => 0, 'text' => '总部', 'nodes' => UtilHelper::getDeptTreeData($deptData, 0, false)]];

$this->registerJs("
    var data = '".json_encode($deptTree)."';
    $('#tree').treeview({
        data: data
    });
    $('#tree').treeview('expandAll');
");

$this->registerJs('
    $("#birthday").datepicker({format:"yyyy-mm-dd", startDate: new Date(1900,01,01), language:"zh-CN"});
    $("#entry_time").datepicker({format:"yyyy-mm-dd", startDate: new Date(1900,01,01), language:"zh-CN"});
    $("#salary_time").datepicker({format:"yyyy-mm-dd", startDate: new Date(1900,01,01), language:"zh-CN"});
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
    $("#dept_id").change(function(){
        $("#job_station").empty();
        $.get("index.php?r=dept-station/dept", {dept_id: $(this).val()}, function(data){
            for (k in data) {
                $("#job_station").append("<option value=\'"+data[k].id+"\'>"+data[k].title+"</option>");
            }
        }, "json");
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

<!-- 模态框（Modal） -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" 
   aria-labelledby="myModalLabel" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" 
               aria-hidden="true">×
            </button>
            <h4 class="modal-title" id="myModalLabel">
               <button onclick="confirm_select_dept();" class="btn btn-primary btn-sm" title="选择好部门后,点击确定.">确定</button>
            </h4>
         </div>
         <div class="modal-body">
            <div id="tree"></div>
         </div>
      </div><!-- /.modal-content -->
   </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'real_name')->textInput(['maxlength' => 255]) ?>
    
    <?= $form->field($model, 'job_number', ['labelOptions' => ['label' => '工号']])->textInput(['maxlength' => true]) ?>

    <div class="form-group field-user-dept_id">
        <label for="user-dept_id" class="control-label">部门</label>
        <input onclick="select_parent_dept();" type="text" id="user-dept_id_title" readonly="readonly" class="form-control" style="cursor: pointer;" title="单击选择部门" value="总部" />
        <input type="hidden" value="0" name="User[dept_id]" class="form-control" id="user-dept_id">
        <div class="help-block"></div>
    </div>

    <?= $form->field($model, 'password')->passwordInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'repassword')->passwordInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'sex')->dropDownList(User::getArraySex()) ?>

    <?= $form->field($model, 'birthday')->textInput(['id' => 'birthday']) ?>
    
    <?= $form->field($model, 'marital_status')->dropDownList(User::getArrayMaritalStatus()) ?>

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
    
    <?= $form->field($model, 'entry_time')->textInput(['id' => 'entry_time']) ?>
    
    <?= $form->field($model, 'salary_time')->textInput(['id' => 'salary_time']) ?>
    
    <?= $form->field($model, 'working_status')->dropDownList(User::getArrayWorkingStatus()) ?>
    
    <?= $form->field($model, 'job_type')->dropDownList(User::getArrayJobType()) ?>
    
    <?= $form->field($model, 'job_station')->dropDownList(User::getArrayJobStation($model->dept_id), ['id' => 'job_station']) ?>
    
    <?= $form->field($model, 'job_level')->dropDownList(User::getArrayJobLevel()) ?>
    
    <?= $form->field($model, 'attendance_type')->dropDownList(User::getArrayAttendanceType()) ?>
    
    <?= $form->field($model, 'role')->dropDownList(User::getArrayRole()) ?>

    <?= $form->field($model, 'status')->dropDownList(User::getArrayStatus()) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<script type="text/javascript">
    var deptData = <?php echo json_encode(ArrayHelper::map(HrDept::getArrayAppendDept($deptData), 'id', 'title')); ?>;
    function select_parent_dept()
    {
        $('#myModal').modal('show');
    }

    function confirm_select_dept()
    {
        var obj = $('#tree').treeview('getSelected');
        if (obj != '') {
            selected = obj[0]['id'];
            $('#user-dept_id_title').val(deptData[selected]);
            $('#user-dept_id').val(selected);
            $("#job_station").empty();
            $.get("index.php?r=dept-station/dept", {dept_id: selected}, function(data){
                for (k in data) {
                    $("#job_station").append("<option value=\'"+data[k].id+"\'>"+data[k].title+"</option>");
                }
            }, "json");
            $('#myModal').modal('hide');
        } else {
            alert('请选择一个部门,然后点击确定按钮.');
        }
    }

    <?php if ($model->id):?>
    document.getElementById('user-dept_id_title').value = deptData[<?php echo $model->dept_id?>];
    document.getElementById('user-dept_id').value = <?php echo $model->dept_id?>;
    <?php endif;?>
</script>