<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use backend\models\User;

/* @var $this yii\web\View */
/* @var $model backend\models\User */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Users'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-view">

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'username',
            [
                'attribute' => 'dept_id',
                'value' => $model->deptLabel,
            ],
            //'auth_key',
            //'password_hash',
            //'password_reset_token',
            'email:email',
            [
                'attribute' => 'role',
                'value' => $model->roleLabel,
            ],
            [
                'attribute' => 'status',
                'value' => $model->statusLabel,
            ],
            [
                'attribute' => 'sex',
                'value' => $model->sexLabel,
            ],
            'birthday',
            'country',
            'province',
            'city',
            'district',
            'address',
            'zipcode',
            'qq',
            'office_phone',
            'home_phone',
            'mobile_phone',
            'created_at:datetime',
            'updated_at:datetime',
        ],
    ]) ?>

</div>
