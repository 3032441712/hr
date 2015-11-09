<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\HrRegion;

/* @var $this yii\web\View */
/* @var $model backend\models\User */

$this->title = $model->real_name;
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
            'job_number',
            'real_name',
            [
                'attribute' => 'sex',
                'value' => $model->sexLabel
            ],
            [
                'attribute' => 'dept_id',
                'value' => $model->deptLabel,
            ],
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
            [
                'attribute' => 'marital_status',
                'value' => $model->maritalStatusLabel
            ],
            [
                'label' => '户籍所在地',
                'attribute' => 'address',
                'value' => HrRegion::getAreaTitle([$model->province,$model->city,$model->district]).' '.$model->address
            ],
            'zipcode',
            'qq',
            'office_phone',
            'home_phone',
            'mobile_phone',
            'entry_time',
            'salary_time',
            [
                'attribute' => 'working_status',
                'value' => $model->workingStatusLabel
            ],
            [
                'attribute' => 'job_type',
                'value' => $model->jobTypeLabel
            ],
            [
                'attribute' => 'job_station',
                'value' => $model->jobStationLabel
            ],
            [
                'attribute' => 'job_level',
                'value' => $model->jobLevelLabel
            ],
            [
                'attribute' => 'attendance_type',
                'value' => $model->attendanceTypeLabel
            ],
            'created_at:datetime',
            'updated_at:datetime',
        ],
    ]) ?>

</div>
