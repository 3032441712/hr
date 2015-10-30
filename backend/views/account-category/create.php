<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\AccountCategory */

$this->title = '添加分类';
$this->params['breadcrumbs'][] = ['label' => '信息分类', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="account-category-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
