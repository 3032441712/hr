<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\User;
use yii\web\JqueryAsset;
use backend\helpers\UtilHelper;
use yii\helpers\ArrayHelper;
use app\models\HrDept;

/* @var $this yii\web\View */
/* @var $model app\models\HrDept */
/* @var $form yii\widgets\ActiveForm */
$this->registerCssFile('@web/css/bootstrap-treeview.min.css');
$this->registerJsFile("@web/js/bootstrap-treeview.min.js", ['depends' => JqueryAsset::className()]);
$deptTree = [['id' => 0, 'text' => '总部', 'nodes' => UtilHelper::getDeptTreeData($data, 0, false)]];

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

<div class="hr-dept-form">

    <?php $form = ActiveForm::begin(); ?>
    
    <div class="form-group field-hrdept-parent_id">
        <label class="control-label" for="hrdept-parent_id">上级部门</label>
        <input onclick="select_parent_dept();" type="text" readonly="readonly" id="hrdept-parent_id_title" class="form-control" style="cursor: pointer;" title="单击选择部门" value="总部" />
        <input type="hidden" id="hrdept-parent_id" class="form-control" name="HrDept[parent_id]" value="0">
        <div class="help-block"></div>
    </div>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?php if ($model->id) :?>
    <?= $form->field($model, 'master_user')->dropDownList(User::getArrayUser($model->id)) ?>
    <?php endif;?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '创建' : '编辑', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<script type="text/javascript">
    var deptData = <?php echo json_encode(ArrayHelper::map(HrDept::getArrayAppendDept($data), 'id', 'title')); ?>;
    function select_parent_dept()
    {
        $('#myModal').modal('show');
    }

    function confirm_select_dept()
    {
        var obj = $('#tree').treeview('getSelected');
        if (obj != '') {
            selected = obj[0]['id'];
            <?php if ($model->id):?>
            
            if (<?php echo $model->id ?> == selected) {
                alert('自己不能变为自己的上级部门');
                return false;
            }
            
            <?php endif;?>
            $('#hrdept-parent_id_title').val(deptData[selected]);
            $('#hrdept-parent_id').val(selected);
            $('#myModal').modal('hide');
        } else {
            alert('请选择一个部门,然后点击确定按钮.');
        }
    }

    <?php if ($model->id):?>
    document.getElementById('hrdept-parent_id_title').value = deptData[<?php echo $model->parent_id?>];
    document.getElementById('hrdept-parent_id').value = <?php echo $model->parent_id?>;
    <?php else:?>
    document.getElementById('hrdept-parent_id_title').value = deptData[<?php echo Yii::$app->request->get('parent', 0); ?>];
    document.getElementById('hrdept-parent_id').value = <?php echo Yii::$app->request->get('parent', 0); ?>;
    <?php endif;?>
</script>
