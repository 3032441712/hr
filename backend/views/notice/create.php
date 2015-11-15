<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\HrNotice */

$this->title = '添加公告';
$this->params['breadcrumbs'][] = ['label' => '公告列表', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="hr-notice-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>