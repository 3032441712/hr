<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\HrDept;
use backend\helpers\UtilHelper;
use yii\web\JqueryAsset;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model backend\models\HrDeptStation */
/* @var $form yii\widgets\ActiveForm */
$this->registerCssFile('@web/css/bootstrap-treeview.min.css');
$this->registerJsFile("@web/js/bootstrap-treeview.min.js", ['depends' => JqueryAsset::className()]);
$deptTree = UtilHelper::getDeptTreeData($data, 0, false);

$this->registerJs("
    var data = '".json_encode($deptTree)."';
    $('#tree').treeview({
        data: data
    });
    $('#tree').treeview('expandAll');
");
?>

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

<div class="hr-dept-station-form">

    <?php $form = ActiveForm::begin(); ?>

     <div class="form-group field-hrdept-parent_id">
        <label class="control-label" for="hrdeptstation-dept_id_title">上级部门</label>
        <input onclick="select_parent_dept();" type="text" readonly="readonly" id="hrdeptstation-dept_id_title" class="form-control" style="cursor: pointer;" title="单击选择部门" value="总部" />
        <input type="hidden" id="hrdeptstation-dept_id" class="form-control" name="HrDeptStation[dept_id]" value="0">
        <div class="help-block"></div>
    </div>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '添加' : '编辑', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<script type="text/javascript">
    var deptData = <?php echo json_encode(ArrayHelper::map($data, 'id', 'title')); ?>;
    function select_parent_dept()
    {
        $('#myModal').modal('show');
    }

    function confirm_select_dept()
    {
        var obj = $('#tree').treeview('getSelected');
        if (obj != '') {
            selected = obj[0]['id'];
            $('#hrdeptstation-dept_id_title').val(deptData[selected]);
            $('#hrdeptstation-dept_id').val(selected);
            $('#myModal').modal('hide');
        } else {
            alert('请选择一个部门,然后点击确定按钮.');
        }
    }

    <?php if ($model->id):?>
    document.getElementById('hrdeptstation-dept_id_title').value = deptData[<?php echo $model->dept_id?>];
    document.getElementById('hrdeptstation-dept_id').value = <?php echo $model->dept_id?>;
    <?php endif;?>
</script>
