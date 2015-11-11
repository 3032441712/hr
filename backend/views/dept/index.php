<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\web\JqueryAsset;
use backend\helpers\UtilHelper;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '部门管理';
$this->params['breadcrumbs'][] = $this->title;
$this->registerCssFile('@web/css/bootstrap-treeview.min.css');
$this->registerJsFile("@web/js/bootstrap-treeview.min.js", ['depends' => JqueryAsset::className()]);

$deptTree = [['id' => 0, 'text' => '总部', 'nodes' => UtilHelper::getDeptTreeData($data)]];

$this->registerJs("
    var data = '".json_encode($deptTree)."';
    $('#tree').treeview({
        data: data,
        enableLinks: true,
        onNodeSelected: function(event, data) {
            alert(data.id);
        }
    });
");
?>
<div class="hr-dept-index">

    <h1 style="display: none;"><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('添加部门', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    
    <div>
        <div id="tree"></div>
    </div>

</div>
