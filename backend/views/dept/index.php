<?php

use yii\helpers\Html;
use yii\web\JqueryAsset;
use backend\helpers\UtilHelper;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '部门管理';
$this->params['breadcrumbs'][] = $this->title;
$this->registerCssFile('@web/css/bootstrap-treeview.min.css');
$this->registerJsFile("@web/js/bootstrap-treeview.min.js", ['depends' => JqueryAsset::className()]);

$deptTree = UtilHelper::getDeptTreeData($data);

$this->registerJs("
    var data = '".json_encode($deptTree)."';
    $('#tree').treeview({
        data: data,
        selectedBackColor : 'tan',
        showTags: true
    });
    $('#tree').treeview('expandAll');
");
?>
<div class="hr-dept-index">

    <h1 style="display: none;"><?= Html::encode($this->title) ?></h1>

    <p style="display: none;">
        <?= Html::a('添加部门', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    
    <div>
        <div id="tree"></div>
    </div>

</div>

<script type="text/javascript">
function create_dept(parent_id) {
    window.location.href = 'index.php?r=dept/create&parent='+parent_id;
}

function update_dept(id, parent_id) {
    window.location.href = 'index.php?r=dept/update&id='+id+'&parent='+parent_id;
}

function view_dept(id) {
    window.location.href = 'index.php?r=dept/view&id='+id;
}

function dept_station_list(id)
{
    window.location.href = 'index.php?HrDeptStationSearch[dept_id]='+id+'&r=dept-station/index';
}
</script>